<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion_v2.php";

class Venta_tours
{
  public $id_usr_sesion;
  //Implementamos nuestro constructor
  public function __construct( $id_usr_sesion = 0)
  {
    $this->id_usr_sesion = $id_usr_sesion;
  }
  
  // ::::::::::::::::::::::::::::::::::::::::: S E C C I O N   C O M P R A  ::::::::::::::::::::::::::::::::::::::::: 
  //Implementamos un método para insertar registros
  public function insertar( $idcliente, $num_doc, $fecha_venta, $tipo_comprobante, $serie_comprobante, $numero_comprobante, $impuesto, $descripcion,
  $subtotal_venta, $tipo_gravada, $igv_venta, $total_venta, $metodo_pago, $code_vaucher, $pagar_con_ctdo, $pagar_con_tarj , $vuelto_venta ,
  $idtours, $unidad_medida, $tipo_tours, $cantidad, $precio_sin_igv, $precio_igv, $precio_con_igv, $descuento, $subtotal_producto) {

    // buscamos al si la FACTURA existe
    $sql_2 = "SELECT  vt.fecha_venta, vt.tipo_comprobante, vt.serie_comprobante, vt.igv, vt.total, p.numero_documento, 
    p.tipo_documento, p.nombres as razon_social,  vt.estado, vt.estado_delete, vt.metodo_pago
    FROM venta_tours as vt, persona as p 
    WHERE vt.idpersona = p.idpersona AND vt.tipo_comprobante ='$tipo_comprobante' AND vt.serie_comprobante = '$serie_comprobante' AND vt.numero_comprobante = '$numero_comprobante' AND p.numero_documento='$num_doc'";
    $venta_existe = ejecutarConsultaArray($sql_2); if ($venta_existe['status'] == false) { return  $venta_existe;}

    if (empty($venta_existe['data']) || $tipo_comprobante == 'Ninguno') {

      // Extraemos la correlacion actual
      $sql_comp = "SELECT * FROM sunat_correlacion_comprobante WHERE nombre = '$tipo_comprobante'";
      $data_comp = ejecutarConsultaSimpleFila($sql_comp); if ( $data_comp['status'] == false) {return $data_comp; } 
      $serie_comprobante =  $data_comp['data']['serie'];
      $numero_comprobante =  $data_comp['data']['numero'];

      $sql_3 = "INSERT INTO venta_tours( idpersona, fecha_venta, tipo_comprobante, serie_comprobante, numero_comprobante, impuesto, subtotal, igv, total, tipo_gravada, 
      descripcion, metodo_pago, code_vaucher, pago_con_efe, pago_con_tar, vuelto_pago, user_created) 
      VALUES ('$idcliente','$fecha_venta','$tipo_comprobante','$serie_comprobante','$numero_comprobante','$impuesto','$subtotal_venta','$igv_venta','$total_venta',
      '$tipo_gravada','$descripcion','$metodo_pago','$code_vaucher','$pagar_con_ctdo','$pagar_con_tarj','$vuelto_venta', '$this->id_usr_sesion')";
      $idventanew = ejecutarConsulta_retornarID($sql_3); if ($idventanew['status'] == false) { return  $idventanew;}
      $id = $idventanew['data'];

      //add registro en nuestra bitacora
      $sql_d = "$idcliente, $num_doc, $fecha_venta, $tipo_comprobante, $serie_comprobante, $numero_comprobante, $impuesto, $descripcion,  $subtotal_venta, $tipo_gravada, $igv_venta, $total_venta, $metodo_pago, $code_vaucher, $pagar_con_ctdo, $pagar_con_tarj, $vuelto_venta ";
      $sql_bit = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (5, 'venta_tours','$id','$sql_d','$this->id_usr_sesion')";
      $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; } 

      //add update table autoincrement_comprobante - numero de comprobante de pago
      if ($tipo_comprobante == 'NINGUNO') {
        $sql_nro = "UPDATE sunat_correlacion_comprobante SET numero = numero + '1' WHERE nombre = '$tipo_comprobante'";
        $nro_comprobante = ejecutarConsulta($sql_nro); if ($nro_comprobante['status'] == false) { return  $nro_comprobante;}
      } else if ($tipo_comprobante == 'NOTA DE VENTA'){
        $sql_nro = "UPDATE sunat_correlacion_comprobante SET numero = numero + '1' WHERE nombre = '$tipo_comprobante'";
        $nro_comprobante = ejecutarConsulta($sql_nro); if ($nro_comprobante['status'] == false) { return  $nro_comprobante;}
      }   

      // creamos un pago de compra
      $sum_pago = floatval($pagar_con_ctdo) + floatval($pagar_con_tarj)  ;
      $total_pago =  $sum_pago > floatval($total_venta) ? $total_venta : $sum_pago ;

      $insert_pago = "INSERT INTO venta_tours_pago(	idventa_tours, forma_pago, fecha_pago, monto, descripcion, comprobante, user_created) 
      VALUES ('$id','EFECTIVO','$fecha_venta','$total_pago', '', '', '$this->id_usr_sesion')";
      $new_pago = ejecutarConsulta_retornarID($insert_pago); if ($new_pago['status'] == false) { return  $new_pago;}

      //add registro en nuestra bitacora
      $sql_d = "$id, EFECTIVO, $fecha_venta, $total_pago";
      $sql_bit = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (5, 'venta_tours_pago','".$new_pago['data']."','$sql_d','$this->id_usr_sesion')";
      $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; } 

      $i = 0;
      $detalle_new = "";

      if ( !empty($idventanew['data']) ) {      
        while ($i < count($idtours)) {
         
          $sql_detalle = "INSERT INTO venta_tours_detalle(idventa_tours, idtours, unidad_medida, tipo_tours, cantidad, precio_sin_igv, igv, 
          precio_con_igv, descuento, subtotal, user_created) 
          VALUES ('$id','$idtours[$i]', '$unidad_medida[$i]', '$tipo_tours[$i]', '$cantidad[$i]', '$precio_sin_igv[$i]', '$precio_igv[$i]', 
          '$precio_con_igv[$i]', '$descuento[$i]',  '$subtotal_producto[$i]','$this->id_usr_sesion')";
          $detalle_new =  ejecutarConsulta_retornarID($sql_detalle); if ($detalle_new['status'] == false) { return  $detalle_new;}          
          $id_d = $detalle_new['data'];
          //add registro en nuestra bitacora.
          $sql_d = "$id, $idtours[$i], $unidad_medida[$i], $tipo_tours[$i], $cantidad[$i], $precio_sin_igv[$i], $precio_igv[$i], $precio_con_igv[$i], $descuento[$i], $subtotal_producto[$i]";
          $sql_bit_d = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (5,'detalle_venta_producto','$id_d','$sql_d','$this->id_usr_sesion')";
          $bitacora = ejecutarConsulta($sql_bit_d); if ( $bitacora['status'] == false) {return $bitacora; } 

          $i = $i + 1;
        }
      }
      return $detalle_new;

    } else {

      $info_repetida = ''; 

      foreach ($venta_existe['data'] as $key => $value) {
        $info_repetida .= '<li class="text-left font-size-13px">
          <b class="font-size-18px text-danger">'.$value['tipo_comprobante'].': </b> <span class="font-size-18px text-danger">'.$value['serie_comprobante'].'-'.$value['numero_comprobante'].'</span><br>
          <b>Razón Social: </b>'.$value['razon_social'].'<br>
          <b>'.$value['tipo_documento'].': </b>'.$value['numero_documento'].'<br>          
          <b>Fecha: </b>'.format_d_m_a($value['fecha_venta']).'<br>
          <b>Total: </b>'.number_format($value['total'], 2, '.', ',').'<br>
          <b>Método de pago: </b>'.$value['metodo_pago'].'<br>
          <b>Papelera: </b>'.( $value['estado']==0 ? '<i class="fas fa-check text-success"></i> SI':'<i class="fas fa-times text-danger"></i> NO') .' <b>|</b> 
          <b>Eliminado: </b>'. ($value['estado_delete']==0 ? '<i class="fas fa-check text-success"></i> SI':'<i class="fas fa-times text-danger"></i> NO').'<br>
          <hr class="m-t-2px m-b-2px">
        </li>'; 
      }
      return $sw = array( 'status' => 'duplicado', 'message' => 'duplicado', 'data' => '<ol>'.$info_repetida.'</ol>', 'id_tabla' => '' );      
    }      
  }

  //Implementamos un método para editar registros
  public function editar( $idventa_tours, $idcliente, $num_doc, $fecha_venta, $tipo_comprobante, $serie_comprobante, $numero_comprobante, $impuesto, $descripcion,
  $subtotal_venta, $tipo_gravada, $igv_venta, $total_venta, $metodo_pago, $code_vaucher, $pagar_con_ctdo, $pagar_con_tarj , $vuelto_venta ,
  $idtours, $unidad_medida, $tipo_tours, $cantidad, $precio_sin_igv, $precio_igv, $precio_con_igv,  $descuento, $subtotal_producto, $val_igv, $subtotal_compra, $categoria, $cantidad_old) {

    if ( !empty($idventa_producto) ) {
      //Eliminamos todos los permisos asignados para volverlos a registrar
      $sqldel = "DELETE FROM detalle_venta_producto WHERE idventa_producto='$idventa_producto';";
      $delete_compra = ejecutarConsulta($sqldel);  if ($delete_compra['status'] == false) { return $delete_compra; }

      $sql = "UPDATE venta_producto SET idpersona='$idcliente',fecha_venta='$fecha_venta',tipo_comprobante='$tipo_comprobante',
      serie_comprobante='$serie_comprobante',val_igv='$val_igv',subtotal='$subtotal_compra',igv='$igv_venta',
      total='$total_venta',tipo_gravada='$tipo_gravada',descripcion='$descripcion', user_updated = '$this->id_usr_sesion'
      WHERE idventa_producto = '$idventa_producto'";
      $update_compra = ejecutarConsulta($sql); if ($update_compra['status'] == false) { return $update_compra; }

      //add registro en nuestra bitacora
      $sql_bit = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES ('venta_producto','$idventa_producto','Editar compra','$this->id_usr_sesion')";
      $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }

      $i = 0; $detalle_compra = "";

      while ($i < count($idventa_tours)) {

        $subtotal_producto = (floatval($cantidad[$i]) * floatval($precio_con_igv[$i])) - $descuento[$i];

        $sql_detalle = "INSERT INTO detalle_venta_producto(idventa_producto, idproducto, unidad_medida, categoria, cantidad, precio_sin_igv, igv, 
        precio_con_igv, descuento, subtotal, user_created) 
        VALUES ('$idventa_producto','$idventa_tours[$i]', '$unidad_medida[$i]',  '$categoria[$i]', '$cantidad[$i]', 
        '$precio_sin_igv[$i]', '$precio_igv[$i]', '$precio_con_igv[$i]', '$descuento[$i]', 
        '$subtotal_producto','$this->id_usr_sesion')";
        $detalle_compra =  ejecutarConsulta_retornarID($sql_detalle); if ($detalle_compra['status'] == false) { return  $detalle_compra;}

        //add update table producto el stock
        $stock_new = floatval($cantidad_old[$i]) - floatval($cantidad[$i]);
        $sql_producto = "UPDATE producto SET stock = stock + '$stock_new' WHERE idproducto = '$idventa_tours[$i]'";
        $producto = ejecutarConsulta($sql_producto); if ($producto['status'] == false) { return  $producto;}

        //add registro en nuestra bitacora.
        $sql_bit_d = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES ('detalle_venta_producto','".$detalle_compra['data']."','Detalle editado compra','$this->id_usr_sesion')";
        $bitacora = ejecutarConsulta($sql_bit_d); if ( $bitacora['status'] == false) {return $bitacora; } 

        $i = $i + 1;
      }
      return $detalle_compra; 
    } else { 
      return $retorno = ['status'=>false, 'mesage'=>'no hay nada', 'data'=>'sin data', ]; 
    }
  }

  public function mostrar_venta_para_editar($idventa_producto) {

    $sql = "SELECT  vp.idventa_producto,vp.fecha_venta, vp.idpersona, vp.tipo_comprobante, vp.serie_comprobante, vp.val_igv, vp.subtotal, vp.igv, vp.total, vp.tipo_gravada, 
    vp.descripcion, vp.metodo_pago, vp.fecha_proximo_pago,
    p.nombres, p.tipo_documento, p.numero_documento, p.celular, p.correo, p.direccion,p.correo
    FROM venta_producto as vp, persona as p 
    WHERE vp.idpersona = p.idpersona AND vp.idventa_producto ='$idventa_producto';";

    $venta =  ejecutarConsultaSimpleFila($sql); if ($venta['status'] == false) {return $venta; }

    $sql = "SELECT dvp.idproducto, dvp.unidad_medida, dvp.categoria, dvp.cantidad, dvp.precio_sin_igv, dvp.igv, dvp.precio_con_igv, p.precio_compra_actual as precio_compra,
    dvp.descuento, dvp.subtotal, p.nombre, p.imagen, cp.nombre as categoria, um.abreviatura
    FROM detalle_venta_producto as dvp, producto as p, categoria_producto as cp, unidad_medida as um
    WHERE dvp.idproducto =p.idproducto AND p.idcategoria_producto = cp.idcategoria_producto AND p.idunidad_medida = um.idunidad_medida AND dvp.idventa_producto ='$idventa_producto';";

    $detalle = ejecutarConsultaArray($sql);    if ($detalle['status'] == false) {return $detalle; }

    return $datos= Array('status' => true, 'data' => ['venta' => $venta['data'], 'detalle' => $detalle['data']], 'message' => 'Todo ok' );

  }

  //Implementamos un método para desactivar categorías
  public function desactivar($idventa_tours) {
    // var_dump($idventa_tours);die();
    $sql = "UPDATE venta_tours SET estado='0', user_trash= '$this->id_usr_sesion' WHERE idventa_tours='$idventa_tours'";
		$desactivar= ejecutarConsulta($sql); if ($desactivar['status'] == false) {  return $desactivar; }

    //add registro en nuestra bitacora
    $sql_bit = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (2,'venta_tours','".$idventa_tours."','Se envio a papelera.','$this->id_usr_sesion')";
    $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }   

    // buscamos las cantidades
    $sql_restaurar = "SELECT idtours, cantidad FROM venta_tours_detalle WHERE idventa_tours = '$idventa_tours';";
    $restaurar_stok =  ejecutarConsultaArray($sql_restaurar); if ( $restaurar_stok['status'] == false) {return $restaurar_stok; }
    // actualizamos el stock
    /*foreach ($restaurar_stok['data'] as $key => $value) {      
      $update_tours = "UPDATE tours SET stock = stock + '".$value['cantidad']."' WHERE idtours = '".$value['idtours']."';";
      $tours1 = ejecutarConsulta($update_tours); if ($tours1['status'] == false) { return  $tours1;}
    }	*/

		return $desactivar;
  }

  //Implementamos un método para activar categorías
  public function eliminar($idventa_tours) {
    $sql = "UPDATE venta_tours SET estado_delete='0',user_delete= '$this->id_usr_sesion' WHERE idventa_tours='$idventa_tours'";
		$eliminar =  ejecutarConsulta($sql); if ( $eliminar['status'] == false) {return $eliminar; }  
		//add registro en nuestra bitacora
		$sql = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (4,'venta_tours','$idventa_tours','Se elimino este registro.','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql); if ( $bitacora['status'] == false) {return $bitacora; }  

    // buscamos las cantidades
    $sql_restaurar = "SELECT idtours, cantidad FROM venta_tours_detalle WHERE idventa_tours = '$idventa_tours';";
    $restaurar_stok =  ejecutarConsultaArray($sql_restaurar); if ( $restaurar_stok['status'] == false) {return $restaurar_stok; }
    // actualizamos el stock
    /*foreach ($restaurar_stok['data'] as $key => $value) {      
      $update_tours = "UPDATE tours SET stock = stock + '".$value['cantidad']."' WHERE idtours = '".$value['idtours']."';";
      $tours = ejecutarConsulta($update_tours); if ($tours['status'] == false) { return  $tours;}
    }*/
    		
		return $eliminar;
  }

  //Implementamos un método para activar categorías
  public function recover_stock_producto($idproducto, $stock) {
    $update_producto = "UPDATE producto SET stock = stock + '$stock' WHERE idproducto = '$idproducto';";
		$recover =  ejecutarConsulta($update_producto); if ( $recover['status'] == false) {return $recover; }   

		//add registro en nuestra bitacora
		$sql = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES ('producto','$idproducto','Se Actualizo el Stock.','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		return $recover;
  }

  //Implementar un método para mostrar los datos de un registro a modificar
  public function mostrar($idventa_producto) {
    $sql = "SELECT * FROM venta_producto WHERE idventa_producto='$idventa_producto'";
    return ejecutarConsultaSimpleFila($sql);
  }

  //Implementar un método para listar los registros
  public function tbla_principal($fecha_1, $fecha_2, $id_proveedor, $comprobante) {

    $filtro_proveedor = ""; $filtro_fecha = ""; $filtro_comprobante = ""; 

    if ( !empty($fecha_1) && !empty($fecha_2) ) {
      $filtro_fecha = "AND vt.fecha_venta BETWEEN '$fecha_1' AND '$fecha_2'";
    } else if (!empty($fecha_1)) {      
      $filtro_fecha = "AND vt.fecha_venta = '$fecha_1'";
    }else if (!empty($fecha_2)) {        
      $filtro_fecha = "AND vt.fecha_venta = '$fecha_2'";
    }    

    if (empty($id_proveedor) ) {  $filtro_proveedor = ""; } else { $filtro_proveedor = "AND vt.idpersona = '$id_proveedor'"; }
    if ( empty($comprobante) ) { } else { $filtro_comprobante = "AND vt.tipo_comprobante = '$comprobante'"; } 

    $data = Array();    

    $sql = "SELECT vt.idventa_tours, vt.idpersona, vt.fecha_venta, vt.tipo_comprobante, vt.serie_comprobante, vt.numero_comprobante, vt.impuesto, vt.subtotal, vt.igv, 
    vt.total, vt.tipo_gravada, vt.descripcion, vt.metodo_pago, vt.code_vaucher, vt.pago_con_efe, vt.pago_con_tar, vt.vuelto_pago, vt.comprobante,
    p.nombres as cliente, p.tipo_documento, p.numero_documento, p.celular, p.direccion, tp.nombre as tipo_persona
    FROM venta_tours AS vt, persona as p, tipo_persona as tp 
    WHERE vt.idpersona = p.idpersona AND p.idtipo_persona = tp.idtipo_persona AND vt.estado ='1' AND vt.estado_delete = '1' 
    $filtro_proveedor $filtro_comprobante $filtro_fecha ORDER BY vt.fecha_venta DESC;";
    $venta = ejecutarConsultaArray($sql); if ($venta['status'] == false) {return $venta; }

    foreach ($venta['data'] as $key => $value) {
      $id = $value['idventa_tours'];
      $sql_3 ="SELECT SUM(monto) as deposito FROM venta_tours_pago WHERE idventa_tours = '$id' AND estado ='1' AND estado_delete = '1'";
      $pagos = ejecutarConsultaSimpleFila($sql_3); if ($pagos['status'] == false) { return $pagos; }     

      $data[] = [        
        'idventa_tours'     => $value['idventa_tours'],
        'idpersona'         => $value['idpersona'],
        'fecha_venta'       => $value['fecha_venta'],
        'tipo_comprobante'  => $value['tipo_comprobante'],
        'serie_comprobante' => $value['serie_comprobante'],
        'numero_comprobante'=> $value['numero_comprobante'],
        'impuesto'          => $value['impuesto'],
        'subtotal'          => $value['subtotal'],
        'igv'               => $value['igv'],
        'total'             => $value['total'],
        'tipo_gravada'      => $value['tipo_gravada'],
        'descripcion'       => $value['descripcion'],
        'metodo_pago'       => $value['metodo_pago'],
        'code_vaucher'      => $value['code_vaucher'],
        'pago_con_efe'      => $value['pago_con_efe'],
        'pago_con_tar'      => $value['pago_con_tar'],
        'vuelto_pago'       => $value['vuelto_pago'],
        'comprobante'       => $value['comprobante'],
        'cliente'           => $value['cliente'],
        'tipo_documento'    => $value['tipo_documento'],
        'numero_documento'  => $value['numero_documento'],
        'celular'           => $value['celular'],
        'direccion'         => $value['direccion'],
        'tipo_persona'      => $value['tipo_persona'],
        
        'total_pago'        => (empty($pagos['data']) ? 0 : (empty($pagos['data']['deposito']) ? 0 : floatval($pagos['data']['deposito']) ) ),
      ];
    }

    return $retorno = ['status' => true, 'message' => 'todo ok pe.', 'data' =>$data, 'affected_rows' =>$venta['affected_rows'],  ];
  }

  //Implementar un método para listar los registros x proveedor
  public function listar_compra_x_porveedor() {
    // $idproyecto=2;
    $sql = "SELECT vt.idventa_tours, COUNT(vt.idventa_tours) as cantidad, SUM(vt.total) as total,  
    vt.idpersona, p.nombres as razon_social, p.numero_documento, p.celular
		FROM venta_tours as vt, persona as p 
		WHERE  vt.idpersona=p.idpersona  AND  vt.estado = '1' AND vt.estado_delete = '1'
    GROUP BY vt.idpersona ORDER BY p.nombres ASC;";
    return ejecutarConsulta($sql);
  }

  //Implementar un método para listar los registros x proveedor
  public function listar_detalle_compra_x_proveedor($idcliente) {

    $sql = "SELECT cp.idventa_tours, cp.idpersona,cp.fecha_venta, cp.tipo_comprobante, cp.serie_comprobante, cp.numero_comprobante, cp.total,cp.descripcion
    FROM venta_tours as cp 
    WHERE cp.idpersona = '$idcliente' AND cp.estado= '1' AND cp.estado_delete = '1'";

    return ejecutarConsulta($sql);
  }

  //mostrar detalles uno a uno de la factura
  public function ver_compra($idventa_producto) {

    $sql = "SELECT cp.fecha_venta, cp.tipo_comprobante, cp.serie_comprobante, cp.val_igv, cp.subtotal, cp.igv, cp.total, cp.tipo_gravada, 
    cp.descripcion, 
    p.nombres, p.tipo_documento, p.numero_documento, p.celular, p.correo, p.direccion 
    FROM venta_producto as cp, persona as p 
    WHERE cp.idpersona = p.idpersona AND cp.idventa_producto ='$idventa_producto';";
    $compra=  ejecutarConsultaSimpleFila($sql); if ($compra['status'] == false) {return $compra; }

    $sql = "SELECT dvp.iddetalle_venta_producto, dvp.idventa_producto, dvp.idproducto, dvp.unidad_medida, dvp.categoria, dvp.cantidad, 
    dvp.precio_sin_igv, dvp.igv, dvp.precio_con_igv, dvp.descuento, dvp.subtotal, dvp.estado,
    p.nombre, p.marca, p.contenido_neto, p.imagen, ct.nombre as categoria, um.abreviatura
    FROM detalle_venta_producto as dvp, producto AS p, categoria_producto as ct, unidad_medida as um
    WHERE dvp.idproducto = p.idproducto AND p.idcategoria_producto = ct.idcategoria_producto AND p.idunidad_medida = um.idunidad_medida
    AND dvp.idventa_producto = '$idventa_producto';";

    $detalle = ejecutarConsultaArray($sql);    if ($detalle['status'] == false) {return $detalle; }

    return $datos= Array('status' => true, 'data' => ['venta' => $compra['data'], 'detalle' => $detalle['data']], 'message' => 'Todo ok' );

  }

  // :::::::::::::::::::::::::: S E C C I O N   V E N T A    T O U R S    D E T A L L E    ::::::::::::::::::::::::::     
  public function mostrar_detalle_venta($idventa_tours) {
    $sql = "SELECT dvt.idventa_tours, dvt.unidad_medida, dvt.precio_sin_igv, dvt.subtotal, dvt.tipo_tours,
    dvt.idtours, t.nombre, dvt.cantidad, dvt.precio_con_igv, dvt.descuento, vt.igv
    FROM venta_tours_detalle as dvt, venta_tours as vt, tours as t
    WHERE dvt.idventa_tours=vt.idventa_tours 
    AND dvt.idventa_tours='$idventa_tours'
    AND dvt.idtours = t.idtours;";
    $detalles = ejecutarConsultaArray($sql); if ( $detalles['status'] == false) {return $detalles; }

    $sql_2="SELECT vt.idventa_tours, p.nombres, p.celular, vt.tipo_comprobante, vt.serie_comprobante, vt.descripcion,
    vt.fecha_venta, vt.metodo_pago, vt.code_vaucher, vt.igv, vt.subtotal, vt.tipo_gravada, vt.impuesto, vt.total, p.tipo_documento,
    p.numero_documento, p.direccion
    FROM venta_tours as vt, persona as p 
    WHERE vt.idventa_tours='$idventa_tours'
    AND vt.idpersona=p.idpersona;";
    $venta = ejecutarConsultaSimpleFila($sql_2); if ($venta['status'] == false) { return  $venta;}

    foreach ($detalles['data'] as $key => $value) {
      $detalles_1[] =[
        'idtours'           => $value['idtours'],
        'nombre'            => $value['nombre'],
        'cantidad'          => $value['cantidad'],
        'precio_con_igv'    => $value['precio_con_igv'],
        'idventa_tours'     => $value['idventa_tours'],
        'unidad_medida'     => $value['unidad_medida'],
        'subtotal'          => $value['subtotal'],
        'tipo_tours'        => $value['tipo_tours'],
        'descuento'         => $value['descuento'],
        'igv'               => $value['igv'],

      ];
    }
    return $retorno=['status'=>true, 'message'=>'consulta ok', 'data'=>[  'detalles'=>$detalles_1, //MOSTRAR LOS DATOS EN EL MODAL
                                                                          'venta'=>$venta['data'], //MOSTRAR LOS DATOS EN EL MODAL
                                                                          'detalle_1'=>$detalles['data'] //MOSTRAR LOS DATOS EN EL EXCEL
                                                                        ]];
  }

  // ::::::::::::::::::::::::::::::::::::::::: S E C C I O N   P A G O S ::::::::::::::::::::::::::::::::::::::::: 

  public function crear_pago_compra($idventa_tours, $forma_pago, $fecha_pago, $monto, $descripcion, $comprobante_pago)  {
    $sql_1 = "INSERT INTO venta_tours_pago(idventa_tours, forma_pago, fecha_pago, monto, descripcion, comprobante)
    VALUES ('$idventa_tours', '$forma_pago', '$fecha_pago', '$monto', '$descripcion', '$comprobante_pago')";
    $crear_pago = ejecutarConsulta_retornarID($sql_1); if ( $crear_pago['status'] == false) {return $crear_pago; } 

    //add registro en nuestra bitacora
		$sql_bit = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (1,'venta_tours_pago','".$idventa_tours."','Se creo nuevo registro','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }   
		
		return $crear_pago;
  }

  public function editar_pago_compra($idpago_venta, $idventa_producto, $forma_pago, $fecha_pago, $monto, $descripcion, $comprobante_pago)  {
    $sql_1 = "UPDATE venta_tours_pago SET idventa_tours='$idventa_producto',forma_pago='$forma_pago',
    fecha_pago='$fecha_pago',  monto='$monto', comprobante='$comprobante_pago', descripcion='$descripcion'
    WHERE idventa_tours_pago='$idpago_venta'; ";
    $editar_pago = ejecutarConsulta($sql_1); if ( $editar_pago['status'] == false) {return $editar_pago; } 

    //add registro en nuestra bitacora
		$sql_bit = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (1,'venta_tours_pago','".$idventa_producto."','Se edito este registro','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }   
		
		return $editar_pago;
  }

  public function tabla_pago_compras($idcompra_grano)  {
    $sql_1 = "SELECT pvp.idventa_tours_pago, pvp.idventa_tours, pvp.forma_pago, pvp.fecha_pago, pvp.descripcion, 
    pvp.numero_operacion, pvp.monto, pvp.comprobante, pvp.estado, per.nombres as cliente
    FROM venta_tours_pago as pvp, venta_tours as vp, persona as per
    WHERE pvp.idventa_tours = vp.idventa_tours AND vp.idpersona = per.idpersona AND
    pvp.idventa_tours = '$idcompra_grano' AND pvp.estado = '1' AND pvp.estado_delete = '1' ORDER BY pvp.fecha_pago DESC;";
    return ejecutarConsulta($sql_1);
  }

  //Implementamos un método para desactivar categorías
  public function papelera_pago_venta($idventa_tours_pago) {
    $sql = "UPDATE venta_tours_pago SET estado='0', user_trash= '$this->id_usr_sesion' WHERE idventa_tours_pago='$idventa_tours_pago'";
		$desactivar= ejecutarConsulta($sql); if ($desactivar['status'] == false) {  return $desactivar; }
		
		//add registro en nuestra bitacora
		$sql_bit = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (2,'venta_tours_pago','$idventa_tours_pago','Se envio a papelera.','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }   
		
		return $desactivar;
  }

  //Implementamos un método para activar categorías
  public function eliminar_pago_venta($idventa_tours_pago) {
    $sql = "UPDATE venta_tours_pago SET estado_delete='0',user_delete= '$this->id_usr_sesion' WHERE idventa_tours_pago='$idventa_tours_pago'";
		$eliminar =  ejecutarConsulta($sql);if ( $eliminar['status'] == false) {return $eliminar; }  
		
		//add registro en nuestra bitacora
		$sql = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (4,'pago_venta_tours','$idventa_tours_pago','Se Eliminado este registro.','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		return $eliminar;
  }

  //Implementamos un método para activar categorías
  public function mostrar_editar_pago($idventa_tours_pago) {
    $sql = "SELECT * FROM venta_tours_pago WHERE idventa_tours_pago = '$idventa_tours_pago';";
		return ejecutarConsultaSimpleFila($sql);
  }

  //Implementamos un método para activar categorías
  public function obtener_doc_pago_compra($idventa_tours_pago) {
    $sql = "SELECT idventa_tours_pago, comprobante FROM  venta_tours_pago WHERE idventa_tours_pago ='$idventa_tours_pago'; ";
		$doc =  ejecutarConsultaSimpleFila($sql);		
		return $doc;
  }

}

?>
