<?php
ob_start();
if (strlen(session_id()) < 1) {
  session_start(); //Validamos si existe o no la sesión
}

if (!isset($_SESSION["nombre"])) {
  $retorno = ['status'=>'login', 'message'=>'Tu sesion a terminado pe, inicia nuevamente', 'data' => [] ];
  echo json_encode($retorno);  //Validamos el acceso solo a los usuarios logueados al sistema.
} else {

  if ($_SESSION['venta_paquete'] == 1) {
    
    require_once "../modelos/Venta_paquete.php";
    require_once "../modelos/Persona.php";
    require_once "../modelos/Producto.php";

    $venta_producto = new Venta_paquete($_SESSION['idusuario']);
    $persona = new Persona($_SESSION['idusuario']);
    $producto = new Producto($_SESSION['idusuario']);      
    
    date_default_timezone_set('America/Lima'); $date_now = date("d_m_Y__h_i_s_A");
    $imagen_error = "this.src='../dist/svg/user_default.svg'";
    $toltip = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';
    $scheme_host =  ($_SERVER['HTTP_HOST'] == 'localhost' ? $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/fun_route/admin/' :  $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/admin/');

    // :::::::::::::::::::::::::::::::::::: D A T O S   V E N T A ::::::::::::::::::::::::::::::::::::::
    $idventa_paquete      = isset($_POST["idventa_paquete"]) ? limpiarCadena($_POST["idventa_paquete"]) : "";
    $idcliente          = isset($_POST["idcliente"]) ? limpiarCadena($_POST["idcliente"]) : "";
    $num_doc            = isset($_POST["num_doc"]) ? limpiarCadena($_POST["num_doc"]) : "";
    $fecha_venta        = isset($_POST["fecha_venta"]) ? limpiarCadena($_POST["fecha_venta"]) : "";
    $tipo_comprobante   = isset($_POST["tipo_comprobante"]) ? limpiarCadena($_POST["tipo_comprobante"]) : "";    
    $serie_comprobante  = isset($_POST["serie_comprobante"]) ? limpiarCadena($_POST["serie_comprobante"]) : "";
    $numero_comprobante = isset($_POST["numero_comprobante"]) ? limpiarCadena($_POST["numero_comprobante"]) : "";
    $impuesto           = isset($_POST["impuesto"]) ? limpiarCadena($_POST["impuesto"]) : "";    
    $descripcion        = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";

    $subtotal_venta   = isset($_POST["subtotal_venta"]) ? limpiarCadena($_POST["subtotal_venta"]) : "";
    $tipo_gravada     = isset($_POST["tipo_gravada"]) ? limpiarCadena($_POST["tipo_gravada"]) : "";    
    $igv_venta        = isset($_POST["igv_venta"]) ? limpiarCadena($_POST["igv_venta"]) : "";
    $total_venta      = isset($_POST["total_venta"]) ? limpiarCadena($_POST["total_venta"]) : "";    

    $metodo_pago      = isset($_POST["metodo_pago"]) ? limpiarCadena($_POST["metodo_pago"]) : "";
    $code_vaucher     = isset($_POST["code_vaucher"]) ? limpiarCadena($_POST["code_vaucher"]) : "";
    $pagar_con_ctdo   = isset($_POST["pagar_con_ctdo"]) ? limpiarCadena($_POST["pagar_con_ctdo"]) : "";
    $pagar_con_tarj   = isset($_POST["pagar_con_tarj"]) ? limpiarCadena($_POST["pagar_con_tarj"]) : "";
    $vuelto_venta     = isset($_POST["vuelto_venta"]) ? limpiarCadena($_POST["vuelto_venta"]) : "";
    
    // :::::::::::::::::::::::::::::::::::: D A T O S   P A G O   V E N T A ::::::::::::::::::::::::::::::::::::::
    $idventa_paquete_pago_pv  = isset($_POST["idventa_paquete_pago_pv"]) ? limpiarCadena($_POST["idventa_paquete_pago_pv"]) : "";
    $idventa_paquete_pv       = isset($_POST["idventa_paquete_pv"]) ? limpiarCadena($_POST["idventa_paquete_pv"]) : "";  
    $tipo_comprobante_p       = isset($_POST["tipo_comprobante_p"]) ? limpiarCadena($_POST["tipo_comprobante_p"]) : "";
    $forma_pago_pv            = isset($_POST["forma_pago_pv"]) ? limpiarCadena($_POST["forma_pago_pv"]) : "";
    $fecha_pago_pv            = isset($_POST["fecha_pago_pv"]) ? limpiarCadena($_POST["fecha_pago_pv"]) : "";
    $monto_pv                 = isset($_POST["monto_pv"]) ? limpiarCadena($_POST["monto_pv"]) : "";  
    $descripcion_pv           = isset($_POST["descripcion_pv"]) ? limpiarCadena($_POST["descripcion_pv"]) : "";  
     
    // :::::::::::::::::::::::::::::::::::: D A T O S   C O M P R O B A N T E ::::::::::::::::::::::::::::::::::::::
    $id_compra_proyecto       = isset($_POST["id_compra_proyecto"]) ? limpiarCadena($_POST["id_compra_proyecto"]) : "";
    $idfactura_compra_insumo  = isset($_POST["idfactura_compra_insumo"]) ? limpiarCadena($_POST["idfactura_compra_insumo"]) : "";
    $doc_comprobante          = isset($_POST["doc1"]) ? limpiarCadena($_POST["doc1"]) : "";
    $doc_old_1                = isset($_POST["doc_old_1"]) ? limpiarCadena($_POST["doc_old_1"]) : "";

    // :::::::::::::::::::::::::::::::::::: D A T O S   P R O D U C T O  ::::::::::::::::::::::::::::::::::::::
    $idproducto_pro               = isset($_POST["idproducto_pro"]) ? limpiarCadena($_POST["idproducto_pro"]) : "" ;
    $idcategoria_producto_pro = isset($_POST["categoria_producto_pro"]) ? limpiarCadena($_POST["categoria_producto_pro"]) : "" ;
    $unidad_medida_pro        = isset($_POST["unidad_medida_pro"]) ? limpiarCadena($_POST["unidad_medida_pro"]) : "" ;
    $nombre_producto_pro      = isset($_POST["nombre_producto_pro"]) ? encodeCadenaHtml($_POST["nombre_producto_pro"]) : "" ;
    $marca_pro                = isset($_POST["marca_pro"]) ? encodeCadenaHtml($_POST["marca_pro"]) : "" ;
    $contenido_neto_pro       = isset($_POST["contenido_neto_pro"]) ? limpiarCadena($_POST["contenido_neto_pro"]) : "" ;
    $descripcion_pro          = isset($_POST["descripcion_pro"]) ? encodeCadenaHtml($_POST["descripcion_pro"]) : "" ;
    $imagen2                  = isset($_POST["foto2"]) ? limpiarCadena($_POST["foto2"]) : "" ;

    // :::::::::::::::::::::::::::::::::::: D A T O S   A G R I C U L T O R ::::::::::::::::::::::::::::::::::::::
    $idpersona_per	  	  = isset($_POST["idpersona_per"])? limpiarCadena($_POST["idpersona_per"]):"";
    $id_tipo_persona_per 	= isset($_POST["id_tipo_persona_per"])? limpiarCadena($_POST["id_tipo_persona_per"]):"";
    $nombre_per 		      = isset($_POST["nombre_per"])? limpiarCadena($_POST["nombre_per"]):"";
    $tipo_documento_per 	= isset($_POST["tipo_documento_per"])? limpiarCadena($_POST["tipo_documento_per"]):"";
    $num_documento_per  	= isset($_POST["num_documento_per"])? limpiarCadena($_POST["num_documento_per"]):"";    
    $direccion_per		    = isset($_POST["direccion_per"])? limpiarCadena($_POST["direccion_per"]):"";
    $telefono_per		      = isset($_POST["telefono_per"])? limpiarCadena($_POST["telefono_per"]):"";     
    $email_per			      = isset($_POST["email_per"])? limpiarCadena($_POST["email_per"]):"";
    
    $banco                = isset($_POST["banco"])? $_POST["banco"] :"";
    $cta_bancaria_format  = isset($_POST["cta_bancaria"])?$_POST["cta_bancaria"]:"";
    $cta_bancaria         = isset($_POST["cta_bancaria"])?$_POST["cta_bancaria"]:"";
    $cci_format      	    = isset($_POST["cci"])? $_POST["cci"]:"";
    $cci            	    = isset($_POST["cci"])? $_POST["cci"]:"";
    $titular_cuenta_per		= isset($_POST["titular_cuenta_per"])? limpiarCadena($_POST["titular_cuenta_per"]):"";

    $nacimiento_per       = isset($_POST["nacimiento_per"])? limpiarCadena($_POST["nacimiento_per"]):"";
    $cargo_trabajador_per = isset($_POST["cargo_trabajador_per"])? limpiarCadena($_POST["cargo_trabajador_per"]):"";
    $sueldo_mensual_per   = isset($_POST["sueldo_mensual_per"])? limpiarCadena($_POST["sueldo_mensual_per"]):"";
    $sueldo_diario_per    = isset($_POST["sueldo_diario_per"])? limpiarCadena($_POST["sueldo_diario_per"]):"";
    $edad_per             = isset($_POST["edad_per"])? limpiarCadena($_POST["edad_per"]):"";
      
    $imagen1			        = isset($_POST["foto1"])? limpiarCadena($_POST["foto1"]):"";
    
    switch ($_GET["op"]) {   
      
      // :::::::::::::::::::::::::: S E C C I O N   P R O D U C T O S ::::::::::::::::::::::::::
      case 'guardar_y_editar_productos':
        // imagen
        if (!file_exists($_FILES['foto2']['tmp_name']) || !is_uploaded_file($_FILES['foto2']['tmp_name'])) {
          $imagen2 = $_POST["foto2_actual"];
          $flat_img2 = false;
        } else {
          $ext1 = explode(".", $_FILES["foto2"]["name"]);
          $flat_img2 = true;
          $imagen2 = $date_now .'__'. random_int(0, 20) . round(microtime(true)) . random_int(21, 41) . '.' . end($ext1);
          move_uploaded_file($_FILES["foto2"]["tmp_name"], "../dist/docs/producto/img_perfil/" . $imagen2);
        }

        if (empty($idproducto_pro)) {

          $rspta = $producto->insertar($idcategoria_producto_pro, $unidad_medida_pro, $nombre_producto_pro, $marca_pro, $contenido_neto_pro, $descripcion_pro, $imagen2 );            
          echo json_encode( $rspta, true);
    
        } else {

          // validamos si existe LA IMG para eliminarlo          
          if ($flat_img2 == true) {
            $datos_f1 = $producto->obtenerImg($idproducto_pro);
            $img2_ant = $datos_f1['data']->fetch_object()->imagen;
            if ( !empty( $img2_ant ) ) { unlink("../dist/docs/producto/img_perfil/" . $img2_ant); }
          }
            
          $rspta = $producto->editar($idproducto_pro, $idcategoria_producto_pro, $unidad_medida_pro, $nombre_producto_pro, $marca_pro, $contenido_neto_pro, $descripcion_pro, $imagen2 );            
          echo json_encode( $rspta, true);
        }
    
      break;
    
      case 'mostrar_productos':
    
        $rspta = $producto->mostrar($idproducto_pro);
        echo json_encode($rspta, true);
    
      break;
        
      // :::::::::::::::::::::::::: S E C C I O N   P R O V E E D O R  ::::::::::::::::::::::::::
      case 'guardar_proveedor':
        // imgen de perfil
        if (!file_exists($_FILES['foto1']['tmp_name']) || !is_uploaded_file($_FILES['foto1']['tmp_name'])) {
          $imagen1=$_POST["foto1_actual"]; $flat_img1 = false;
        } else {
          $ext1 = explode(".", $_FILES["foto1"]["name"]); $flat_img1 = true;
          $imagen1 = $date_now .'__'. random_int(0, 20) . round(microtime(true)) . random_int(21, 41) . '.' . end($ext1);
          move_uploaded_file($_FILES["foto1"]["tmp_name"], "../dist/docs/persona/perfil/" . $imagen1);          
        }

        if (empty($idpersona_per)){

          $rspta=$persona->insertar($id_tipo_persona_per,$tipo_documento_per,$num_documento_per,$nombre_per,$email_per,$telefono_per,$banco,$cta_bancaria,$cci,
            $titular_cuenta_per,$direccion_per,$nacimiento_per,$cargo_trabajador_per,$sueldo_mensual_per,$sueldo_diario_per,$edad_per, $imagen1);
                      
          echo json_encode($rspta, true);
          
        }else{
          // validamos si existe LA IMG para eliminarlo
          if ($flat_img1 == true) {
            $datos_f1 = $persona->obtenerImg($idpersona_per);
            $img1_ant = $datos_f1['data']['foto_perfil'];
            if ( !empty($img1_ant) ) { unlink("../dist/docs/persona/perfil/" . $img1_ant);  }
          }           

          // editamos un persona existente
          $rspta=$persona->editar($idpersona_per,$id_tipo_persona_per,$tipo_documento_per,$num_documento_per,$nombre_per,$email_per,$telefono_per,$banco,$cta_bancaria,$cci,
            $titular_cuenta_per,$direccion_per,$nacimiento_per,$cargo_trabajador_per,$sueldo_mensual_per,$sueldo_diario_per,$edad_per, $imagen1);
            
          echo json_encode($rspta, true);
        }
    
      break;

      case 'mostrar_editar_proveedor':
        $rspta = $persona->mostrar($_POST["idpersona"]);
        //Codificar el resultado utilizando json
        echo json_encode($rspta, true);
      break;
    
      // :::::::::::::::::::::::::: S E C C I O N   V E N T A  ::::::::::::::::::::::::::
      case 'guardar_y_editar_venta':

        if (empty($idventa_paquete)) {
          
          $rspta = $venta_producto->insertar( $idcliente, $num_doc, $tipo_comprobante,  $impuesto, $descripcion,
          $subtotal_venta, $tipo_gravada, $igv_venta, $total_venta, $metodo_pago, $code_vaucher, $pagar_con_ctdo, $pagar_con_tarj , $vuelto_venta ,
          $_POST["idpaquete"], $_POST["unidad_medida"], $_POST["cantidad"], $_POST["precio_sin_igv"], $_POST["precio_igv"], $_POST["precio_con_igv"], 
          $_POST["descuento"], $_POST["subtotal_producto"]);

          echo json_encode($rspta, true);
        } else {

          $rspta = $venta_producto->editar( $idventa_paquete, $idcliente, $idproducto, $val_igv, $subtotal_compra, $categoria, $cantidad_old, $num_doc, $tipo_comprobante,  $impuesto, $descripcion,
          $subtotal_venta, $tipo_gravada, $igv_venta, $total_venta, $metodo_pago, $code_vaucher, $pagar_con_ctdo, $pagar_con_tarj , $vuelto_venta ,
          $_POST["idpaquete"], $_POST["unidad_medida"], $_POST["cantidad"], $_POST["precio_sin_igv"], $_POST["precio_igv"], $_POST["precio_con_igv"], 
          $_POST["descuento"], $_POST["subtotal_producto"]);
    
          echo json_encode($rspta, true);
        }
    
      break;      
      
      case 'papelera_venta':
        $rspta = $venta_producto->desactivar($_GET["id_tabla"]);    
        echo json_encode($rspta, true);    
      break;
    
      case 'eliminar_venta':
        $rspta = $venta_producto->eliminar($_GET["id_tabla"]);    
        echo json_encode($rspta, true);    
      break;

      case 'recover_stock_producto':
        $rspta = $venta_producto->recover_stock_producto($_POST["idproducto_pro"], $_POST["stock"]);    
        echo json_encode($rspta, true);    
      break;      
    
      case 'tbla_principal':
        $rspta = $venta_producto->tbla_principal($_GET["fecha_1"], $_GET["fecha_2"], $_GET["id_proveedor"], $_GET["comprobante"]);
        
        //Vamos a declarar un array
        $data = []; $cont = 1;
        
        if ($rspta['status'] == true) {
          foreach ($rspta['data'] as $key => $reg) {
            $saldo = $reg['total'] - $reg['total_pago'];
            
            if ($saldo == $reg['total']) {
              $estado = '<span class="text-center badge badge-danger">Sin pagar</span>';
              $color_btn = "danger"; $nombre = "Pagar"; $icon = "dollar-sign";
            } else if ($saldo < $reg['total'] && $saldo > "0") {              
              $estado = '<span class="text-center badge badge-warning">En proceso</span>';
              $color_btn = "warning"; $nombre = "Pagar"; $icon = "dollar-sign";
            } else if ($saldo <= "0" || $saldo == "0") {              
              $estado = '<span class="text-center badge badge-success">Pagado</span>';
              $color_btn = "success"; $nombre = "Ver"; $icon = "eye";
            } else {
              $estado = '<span class="text-center badge badge-success">Error</span>';               
            }   
            
            $btn_impresion = ' <div class="btn-group">            
            <button type="button" class="btn btn-warning btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
              <span class="sr-onlyyy"> <i class="fa-solid fa-gear"></i></span>
            </button>
            <div class="dropdown-menu" role="menu">
              <a class="dropdown-item" href="../reportes/exTicket_paquete.php?id=' . $reg['idventa_paquete'] . '" target="_blank" ><i class="fa-solid fa-print"></i> Tiket</a>
              <div class="dropdown-divider my-1"></div>
              <a class="dropdown-item" href="../reportes/comprobante_paquete.php?id=' . $reg['idventa_paquete'] . '" target="_blank" ><i class="fa-solid fa-print"></i> A4</a>                
              <div class="dropdown-divider my-1"></div>
              <a class="dropdown-item" href="../reportes/export_xlsx_venta_paquete.php?id=' . $reg['idventa_paquete'] . '" target="_blank" ><i class="fa-regular fa-file-excel"></i> Excel</a>                
            </div>
          </div>';

            $data[] = [
              "0" => $cont,
              "1" => '<button class="btn btn-info btn-sm" onclick="ver_detalle_ventas_paquete(' . $reg['idventa_paquete'] . ')" data-toggle="tooltip" data-original-title="Ver detalle compra"><i class="fa fa-eye"></i></button>' .
                '<!-- <button class="btn bg-purple btn-sm" onclick="copiar_venta(' . $reg['idventa_paquete'] . ')" data-toggle="tooltip" data-original-title="copiar"><i class="fa-regular fa-copy"></i></button> -->' . 
                '<!-- <button class="btn btn-warning btn-sm" onclick="mostrar_venta(' . $reg['idventa_paquete'] . ')" data-toggle="tooltip" data-original-title="Editar compra"><i class="fas fa-pencil-alt"></i></button> -->' . 
                $btn_impresion .
                ' <button class="btn btn-danger  btn-sm" onclick="eliminar_venta(' . $reg['idventa_paquete'] .', \''.encodeCadenaHtml('<del><b>' . $reg['tipo_comprobante'] .  '</b> '.(empty($reg['serie_comprobante']) ?  "" :  '- '.$reg['serie_comprobante']).'</del> <del>'.$reg['cliente'].'</del>'). '\')" data-toggle="tooltip" data-original-title="Eliminar o papelera"><i class="fas fa-skull-crossbones"></i> </button>',
                 
              "2" => $reg['fecha_venta'],
              "3" => '<span class="text-primary font-weight-bold" >' . $reg['cliente'] . '</span>',              
              "4" =>'<span class="" ><b>' . $reg['tipo_comprobante'] . '</b> '.(empty($reg['serie_comprobante']) ?  "" : '- '.$reg['serie_comprobante'].'-'.$reg['numero_comprobante']).'</span>',
              "5" => $reg['metodo_pago'], 
              "6" => $reg['total'],
              "7" => '<div class="text-center text-nowrap">'.
                '<button class="btn btn-' . $color_btn . ' btn-xs m-t-2px" onclick="tbla_venta_paquete_pago(' . $reg['idventa_paquete'] . ', ' . $reg['total'] . ', ' . floatval($reg['total_pago']) .', \''.encodeCadenaHtml($reg['cliente']) .'\')" data-toggle="tooltip" data-original-title="Ingresar a pagos"> <i class="fas fa-' . $icon . ' nav-icon"></i> ' . $nombre . '</button>' . 
                ' <button style="font-size: 14px;" class="btn btn-' . $color_btn . ' btn-sm">' . number_format(floatval($reg['total_pago']), 2, '.', ',') . '</button>'.
              '</div>'. $toltip,
              "8" => $saldo,

              "9" => $reg['tipo_documento'],
              "10" => $reg['numero_documento'],
              "11" => $reg['tipo_comprobante'],
              "12" => $reg['serie_comprobante'].'-'.$reg['numero_comprobante'],
              "13" => $reg['total_pago'],
            ];
            $cont++;
          }
          $results = [
            "sEcho" => 1, //Información para el datatables
            "iTotalRecords" => count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
            "data" => $data,
          ];
          echo json_encode($results, true);
        } else {
          echo $rspta['code_error'] .' - '. $rspta['message'] .' '. $rspta['data'];
        }
    
      break;
    
      case 'listar_compra_x_porveedor':
        
        $rspta = $venta_producto->listar_compra_x_porveedor();
        //Vamos a declarar un array
        $data = []; $cont = 1;
        
        if ($rspta['status'] == true) {
          while ($reg = $rspta['data']->fetch_object()) {
            $data[] = [
              "0" => $cont++,
              "1" => '<button class="btn btn-info btn-sm" onclick="listar_facuras_proveedor(' . $reg->idpersona . ')" data-toggle="tooltip" data-original-title="Ver ventas">
                <i class="fa fa-eye"></i>
              </button>'. $toltip ,
              "2" => $reg->razon_social,
              "3" => $reg->numero_documento,
              "4" => $reg->cantidad,
              "5" => $reg->celular,
              "6" => $reg->total,
            ];
          }
          $results = [
            "sEcho" => 1, //Información para el datatables
            "iTotalRecords" => count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
            "aaData" => $data,
          ];
          echo json_encode($results, true);
        } else {
          echo $rspta['code_error'] .' - '. $rspta['message'] .' '. $rspta['data'];
        }
    
      break;
    
      case 'tabla_detalle_compra_x_porveedor':
        
        $rspta = $venta_producto->listar_detalle_compra_x_proveedor($_GET["idcliente"]);
        //Vamos a declarar un array
        $data = []; $cont = 1;
        
        if ($rspta['status']) {
          while ($reg = $rspta['data']->fetch_object()) {
            $data[] = [
              "0" => $cont++,
              "1" => '<center><button class="btn btn-info btn-sm" onclick="ver_detalle_ventas(' . $reg->idventa_paquete . ')" data-toggle="tooltip" data-original-title="Ver detalle venta">Ver detalle <i class="fa fa-eye"></i></button></center>' . $toltip,
              "2" => $reg->fecha_venta,
              "3" => $reg->tipo_comprobante,
              "4" => $reg->serie_comprobante .'-'. $reg->numero_comprobante,
              "5" => number_format($reg->total, 2, '.', ','),
              "6" => '<textarea cols="30" rows="1" class="textarea_datatable" readonly >'.$reg->descripcion.'</textarea>'
            ];
          }
          $results = [
            "sEcho" => 1, //Información para el datatables
            "iTotalRecords" => count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
            "aaData" => $data,
          ];
          echo json_encode($results, true);
        } else {
          echo $rspta['code_error'] .' - '. $rspta['message'] .' '. $rspta['data'];
        }
    
      break;        
    
      case 'ver_venta_editar':

        $rspta = $venta_producto->mostrar_venta_para_editar($_POST["idventa_paquete"]);
        //Codificar el resultado utilizando json
        echo json_encode($rspta, true);
    
      break;   
      
      // :::::::::::::::::::::::::: S E C C I O N   V E N T A   D E T A L L E    P A Q U E T E  ::::::::::::::::::::::::::     
      case 'mostrar_detalle_ventas_paquete':
      
        $rspta = $venta_producto->mostrar_detalle_venta($idventa_paquete);
        echo '<div class="tab-pane fade active show" id="custom-datos1_html" role="tabpanel" aria-labelledby="custom-datos1_html-tab">';
        echo '<div class="table-responsive p-0">
          <table class="table table-hover table-bordered  mt-4">          
            <tbody>
              <tr> <th>Nombre</th>        <td>'.$rspta['data']['venta']['nombres'].' 
              <div class="font-size-12px" >Cel: <a href="tel:+51'.$rspta['data']['venta']['celular'].'">'.$rspta['data']['venta']['celular'].'</a></div> 
              <div class="font-size-12px" >E-mail: <a href="mailto:'.$rspta['data']['venta']['correo'].'">'.$rspta['data']['venta']['correo'].'</a></div> </td> </tr>            
              <tr> <th>Total venta</th>      <td>'.$rspta['data']['venta']['total'].'</td> </tr>             
              <tr> <th>Fecha</th>         <td>'.$rspta['data']['venta']['fecha_venta'].'</td> </tr>                
              <tr> <th>Comprobante</th>   <td>'.$rspta['data']['venta']['tipo_comprobante']. ' | '.$rspta['data']['venta']['serie_comprobante'] .'-'. $rspta['data']['venta']['numero_comprobante'].'</td> </tr>
              <tr> <th>Observacion</th>   <td>'.$rspta['data']['venta']['descripcion'].'</td> </tr>         
            </tbody>
          </table>
        </div>';
        echo '</div>'; # div-content

        echo'<div class="tab-pane fade" id="custom-home2_html" role="tabpanel" aria-labelledby="custom-home2_html-tab">';
        echo '<div class="table-responsive p-0">
          <table class="table table-hover table-bordered  mt-4">  
            <thead>
              <tr> <th>#</th> <th>Nombre</th> <th>Cantidad</th> <th>Precio Unitario</th> <th>Dcto.</th>  <th>Subtotal</th> </tr>
            </thead>        
            <tbody>';
            foreach ($rspta['data']['detalles'] as $key => $val) {
              echo '<tr> <td>'. $key + 1 .'</td> <td>'.$val['nombre'].'</td> <td>'.$val['cantidad'].'</td> <td>'.$val['precio_con_igv'].'</td> <td>'.$val['descuento'].'</td> <td>'.$val['subtotal'].'</td> </tr>';
            }
        echo '</tbody>
          </table>
        </div>';
        echo'</div>';# div-content

        echo'<div class="tab-pane fade" id="custom-otros3_html" role="tabpanel" aria-labelledby="custom-otros3_html-tab">'; 
        echo '<div class="table-responsive p-0">
          <table class="table table-hover table-bordered  mt-4">  
            <thead>
              <tr> <th>#</th> <th>Fecha</th> <th>Método de Pago</th> <th>Comprobante</th>  <th>Total</th> </tr>
            </thead>        
            <tbody>';
            foreach ($rspta['data']['pagos'] as $key => $val) {
              echo '<tr> <td>'. $key + 1 .'<td>'.$val['fecha_pago'].'</td> <td>'.$val['forma_pago'].'</td>  <td>'.$val['tipo_comprobante']. ' | '.$val['serie_comprobante'] .'-'. $val['numero_comprobante'].'</td> <td>'.$val['monto'].'</td> </tr>';
            }
        echo '</tbody>
          </table>
        </div>';   
        echo '</div>';# div-content      
    
      break;




      // :::::::::::::::::::::::::: S E C C I O N   P A G O  ::::::::::::::::::::::::::     
      case 'guardar_y_editar_venta_paquete_pago':
    
        // imgen de perfil
        if (!file_exists($_FILES['doc1']['tmp_name']) || !is_uploaded_file($_FILES['doc1']['tmp_name'])) {
          $comprobante_pago = $_POST["doc_old_1"]; $flat_doc1 = false;
        } else {
          $ext1 = explode(".", $_FILES["doc1"]["name"]); $flat_doc1 = true;	
          $comprobante_pago  = $date_now .'__'. random_int(0, 20) . round(microtime(true)) . random_int(21, 41) . '.' . end($ext1);
          move_uploaded_file($_FILES["doc1"]["tmp_name"], "../dist/docs/venta_producto/comprobante_pago/" . $comprobante_pago );          
        }

        if (empty($idventa_paquete_pago_pv)){
          
          $rspta=$venta_producto->crear_pago_compra( $idventa_paquete_pv, $tipo_comprobante_p, $forma_pago_pv, $fecha_pago_pv, quitar_formato_miles($monto_pv), $descripcion_pv, $comprobante_pago);          
          echo json_encode($rspta, true);

        }else {

          // validamos si existe LA IMG para eliminarlo
          if ($flat_doc1 == true) {
            $doc_pago = $venta_producto->obtener_doc_pago_compra($idventa_paquete_pago_pv);
            $doc_pago_antiguo = $doc_pago['data']['comprobante'];
            if ( !empty($doc_pago_antiguo) ) { unlink("../dist/docs/venta_producto/comprobante_pago/" . $doc_pago_antiguo);  }
          }            

          // editamos un persona existente
          $rspta=$venta_producto->editar_pago_compra( $idventa_paquete_pago_pv, $idventa_paquete_pv, $forma_pago_pv, $fecha_pago_pv, quitar_formato_miles($monto_pv), $descripcion_pv, $comprobante_pago );          
          echo json_encode($rspta, true);
        }
    
      break;

      case 'tabla_venta_paquete_pago':
        
        $rspta = $venta_producto->tabla_pago_compras($_GET["idventa_paquete"]);
        //Vamos a declarar un array
        $data = []; $cont = 1;
        
        if ($rspta['status'] == true) {
          while ($reg = $rspta['data']->fetch_object()) {
            $doc = (empty($reg->comprobante) ? '<button class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-original-title="Vacio" ><i class="fa-regular fa-file-pdf fa-2x"></i></button>' : '<a href="#" class="btn btn-sm btn-info" data-toggle="tooltip" data-original-title="Ver documento" onclick="ver_documento_pago(\''.$reg->comprobante. '\', \'' . removeSpecialChar($reg->cliente) . ' - ' .date("d/m/Y", strtotime($reg->fecha_pago)).'\')"><i class="fa-regular fa-file-pdf fa-2x"></i></a>');
            $data[] = [
              "0" => $cont++,
              "1" => ' <button class="btn btn-sm btn-warning" id="btn_monto_pagado_' . $reg->idventa_paquete_pago . '" monto_pagado="'.$reg->monto.'" onclick="mostrar_editar_pago(' . $reg->idventa_paquete_pago . ')" data-toggle="tooltip" data-original-title="Editar compra"><i class="fas fa-pencil-alt"></i></button>' .
              ' <button class="btn btn-sm btn-danger" onclick="elim_venta_paquete_pago(' . $reg->idventa_paquete_pago .', \''.encodeCadenaHtml( number_format($reg->monto, 2, '.',',')).' - '.date("d/m/Y", strtotime($reg->fecha_pago)).'\')" data-toggle="tooltip" data-original-title="Eliminar o papelera"><i class="fas fa-skull-crossbones"></i> </button>',
              "2" => $reg->fecha_pago,
              "3" => $reg->forma_pago,
              "4" => '<span class="" ><b>' . $reg->tipo_comprobante . '</b> '.(empty($reg->serie_comprobante) ?  "" : '- '.$reg->serie_comprobante.'-'.$reg->numero_comprobante).'</span>',
              "5" => $reg->monto,
              "6" => '<textarea cols="30" rows="1" class="textarea_datatable" readonly >'.$reg->descripcion.'</textarea>',
              "7" => $doc,
              "8" => $reg->estado == '1' ? '<span class="badge bg-success">Aceptado</span>' : '<span class="badge bg-danger">Anulado</span>',
            ];
          }
          $results = [
            "sEcho" => 1, //Información para el datatables
            "iTotalRecords" => count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
            "aaData" => $data,
          ];
          echo json_encode($results, true);
        } else {
          echo $rspta['code_error'] .' - '. $rspta['message'] .' '. $rspta['data'];
        }
    
      break;
      
      case 'papelera_venta_paquete_pago':
        $rspta = $venta_producto->papelera_venta_paquete_pago($_GET["id_tabla"]);    
        echo json_encode($rspta, true);    
      break;    
      
      case 'eliminar_venta_paquete_pago':

        $rspta = $venta_producto->eliminar_venta_paquete_pago($_GET["id_tabla"]);    
        echo json_encode($rspta, true);
    
      break;

      case 'mostrar_editar_pago':

        $rspta = $venta_producto->mostrar_editar_pago($_POST["idventa_paquete_pago"]);    
        echo json_encode($rspta, true);
    
      break;

      default: 
        $rspta = ['status'=>'error_code', 'message'=>'Te has confundido en escribir en el <b>swich.</b>', 'data'=>[]]; echo json_encode($rspta, true); 
      break;
    }

  } else {
    $retorno = ['status'=>'nopermiso', 'message'=>'Tu sesion a terminado pe, inicia nuevamente', 'data' => [] ];
    echo json_encode($retorno);
  }  
}

ob_end_flush();
?>
