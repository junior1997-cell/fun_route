<?php
  //Incluímos inicialmente la conexión a la base de datos
  require "../config/Conexion_v2.php";
  // global $total;
  class Pedido
  {

    //Implementamos nuestro variable global
    public $id_usr_sesion;

    //Implementamos nuestro constructor
    public function __construct($id_usr_sesion = 0)
    {
      $this->id_usr_sesion = $id_usr_sesion;
    }

    // ::::::::::::::::::::::::::::::::::::::::::: T O U R S :::::::::::::::::::::::::::::::::::::::::::
    //mostrar en un arrary los datos para pasar al html
    public function mostrar_tours($idtours, $idpedido_tours)  {
      $data = [];

      $sql_1="SELECT t.idtours, t.idtipo_tours, t.nombre, t.descripcion, t.imagen, t.actividad, t.incluye, t.no_incluye, t.recomendaciones, 
      t.duracion, t.alojamiento, t.resumen_actividad, t.resumen_comida, t.mapa, t.costo, t.estado_descuento, t.porcentaje_descuento, t.monto_descuento, tp.nombre as tipo_tours  
      FROM tours as t, tipo_tours as tp  
      WHERE t.idtipo_tours = tp.idtipo_tours AND idtours = '$idtours'";
      $tours = ejecutarConsultaSimpleFila($sql_1); if ($tours['status'] == false) { return  $tours;}
      
      // Ejecutamos el visto
      $sql_2="UPDATE pedido_tours SET estado_visto='1', user_updated= '$this->id_usr_sesion' WHERE idpedido_tours='$idpedido_tours';";
      $visto = ejecutarConsulta($sql_2); if ($visto['status'] == false) { return  $visto;}
      //add registro en nuestra bitacora
      $sql_d = $idpedido_tours;
      $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (6,'pedido_tours','$idpedido_tours','$sql_d','$this->id_usr_sesion')";
      $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }      
      
      // Mostramos el pedido
      $sql_3="SELECT * FROM pedido_tours  WHERE idpedido_tours='$idpedido_tours';";
      $pedido = ejecutarConsultaSimpleFila($sql_3); if ($pedido['status'] == false) { return  $pedido;}
      
      return $retorno=['status'=>true, 'message'=>'todo oka ps', 'data'=> [ 'tours'=> $tours['data'], 'pedido'=> $pedido['data'] ] ];
    }    

    public function vendido_tours($id){
      $sql="UPDATE pedido_tours SET estado_vendido='1', user_updated= '$this->id_usr_sesion' WHERE idpedido_tours='$id'";
      $vendido =  ejecutarConsulta($sql); if ( $vendido['status'] == false) {return $vendido; }  

      //add registro en nuestra bitacora
      $sql_d = $id;
      $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (6,'pedido_tours','$id','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $vendido;
    }

    public function remover_vendido_tours($id){
      $sql="UPDATE pedido_tours SET estado_vendido='0', user_updated= '$this->id_usr_sesion' WHERE idpedido_tours='$id'";
      $vendido =  ejecutarConsulta($sql); if ( $vendido['status'] == false) {return $vendido; }  

      //add registro en nuestra bitacora
      $sql_d = $id;
      $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (6,'pedido_tours','$id','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $vendido;
    }

    //Implementamos un método para activar registros
    public function desactivar_tours($idpedido) {
      $sql="UPDATE pedido_tours SET estado='0', user_trash= '$this->id_usr_sesion' WHERE idpedido_tours='$idpedido'";
      $eliminar =  ejecutarConsulta($sql); if ( $eliminar['status'] == false) {return $eliminar; }  

      //add registro en nuestra bitacora
      $sql_d = $idpedido;
      $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (2,'pedido_tours','$idpedido','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $eliminar;
    }    

    //Implementamos un método para activar registros
    public function eliminar_tours($idpedido) {
      $sql="UPDATE pedido_tours SET estado_delete='0', user_delete= '$this->id_usr_sesion' WHERE idpedido_tours='$idpedido'";
      $eliminar =  ejecutarConsulta($sql); if ( $eliminar['status'] == false) {return $eliminar; }  

      //add registro en nuestra bitacora
      $sql_d = $idpedido;
      $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (4,'pedido_tours','$idpedido','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $eliminar;
    }    

    //Implementamos un método para listar los registros
    public function tbla_principal_tours()  {
      $sql="SELECT pd.idpedido_tours, pd.idtours, pd.nombre, pd.correo, pd.telefono, pd.descripcion as descripcionpedido, pd.estado_visto, pd.estado_vendido, pd.created_at, 
      p.nombre as tours, p.duracion, p.descripcion , p.imagen as imgtours 
      FROM pedido_tours AS pd, tours AS p
      WHERE pd.idtours=p.idtours AND pd.estado=1 AND pd.estado_delete=1 ;";
      return ejecutarConsultaArray($sql);		
    }

    // ::::::::::::::::::::::::::::::::::::::::::: P A Q U E T E :::::::::::::::::::::::::::::::::::::::::::

    public function tbla_principal_paquete()  {
      $sql="SELECT pd.idpedido_paquete, pd.idpaquete, pd.nombre, pd.correo, pd.telefono, pd.descripcion as descripcionpedido, pd.estado_visto, pd.estado_vendido, 
      pd.created_at, p.nombre as paquete, p.cant_dias,p.cant_noches, p.descripcion , p.imagen as imgpaquete 
      FROM pedido_paquete AS pd, paquete AS p
      WHERE pd.idpaquete = p.idpaquete AND pd.estado=1 AND pd.estado_delete=1 ;";
      return ejecutarConsultaArray($sql);		
    }

    public function mostrar_paquete($idpaquete, $idpedido_paquete)  {
      $itinerario = [];

      $sql="SELECT * FROM paquete WHERE idpaquete='$idpaquete'";
      $datospaquete =ejecutarConsultaSimpleFila($sql); if ( $datospaquete['status'] == false) {return $datospaquete; }

      $sql_1="SELECT i.iditinerario,i.idpaquete,i.idtours,i.actividad,i.numero_orden ,t.nombre as turs
      FROM itinerario as i, tours as t 
      WHERE i.idtours=t.idtours and i.idpaquete='$idpaquete' ORDER BY i.numero_orden ASC ;";
      $data_itinerario =ejecutarConsultaArray($sql_1); if ( $data_itinerario['status'] == false) {return $data_itinerario; }

      // Ejecutamos el visto
      $sql_2="UPDATE pedido_paquete SET estado_visto='1', user_updated= '$this->id_usr_sesion' WHERE idpedido_paquete='$idpedido_paquete';";
      $visto = ejecutarConsulta($sql_2); if ($visto['status'] == false) { return  $visto;}
      //add registro en nuestra bitacora
      $sql_d = $idpedido_paquete;
      $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (6,'pedido_paquete','$idpedido_paquete','$sql_d','$this->id_usr_sesion')";
      $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }      
      
      // Mostramos el pedido
      $sql_3="SELECT * FROM pedido_paquete  WHERE idpedido_paquete='$idpedido_paquete';";
      $pedido = ejecutarConsultaSimpleFila($sql_3); if ($pedido['status'] == false) { return  $pedido;}

      foreach ($data_itinerario['data'] as $key => $value) {        
        $itinerario[] = array(
          'orden'           => $key+1,
          'iditinerario'    => $value['iditinerario'],  
          'idpaquete_i'     => $value['idpaquete'], 
          'idtours'         => $value['idtours'], 
          'turs'            => $value['turs'], 
          'actividad'       => $value['actividad'], 
          'numero_orden'    => $value['numero_orden'],            
        );
      };
      $paquete = [
        'idpaquete'            => $datospaquete['data']['idpaquete'],
        'nombre'               => $datospaquete['data']['nombre'],
        'cant_dias'            => $datospaquete['data']['cant_dias'],
        'cant_noches'          => $datospaquete['data']['cant_noches'],
        'alimentacion'         => $datospaquete['data']['desc_comida'],
        'alojamiento'          => $datospaquete['data']['desc_alojamiento'],
        'descripcion'          => $datospaquete['data']['descripcion'],
        'imagen'               => $datospaquete['data']['imagen'],
        'incluye'              => $datospaquete['data']['incluye'],
        'no_incluye'           => $datospaquete['data']['no_incluye'],
        'recomendaciones'      => $datospaquete['data']['recomendaciones'],
        'mapa'                 => $datospaquete['data']['mapa'],
        'costo'                => $datospaquete['data']['costo'],
        'estado_descuento'     => $datospaquete['data']['estado_descuento'],
        'porcentaje_descuento' => $datospaquete['data']['porcentaje_descuento'],
        'monto_descuento'      => $datospaquete['data']['monto_descuento'],
        'resumen'              => $datospaquete['data']['resumen'],
      ];
      
      return $retorno=['status'=>true, 'message'=>'todo oka ps', 'data'=> ['itinerario'=>$itinerario,'paquete'=>$paquete,'pedido'=> $pedido['data']  ] ];
    }    

    public function vendido_paquete($id){
      $sql="UPDATE pedido_paquete SET estado_vendido='1', user_updated= '$this->id_usr_sesion' WHERE idpedido_paquete='$id'";
      $vendido =  ejecutarConsulta($sql); if ( $vendido['status'] == false) {return $vendido; }  

      //add registro en nuestra bitacora
      $sql_d = $id;
      $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (6,'pedido_paquete','$id','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $vendido;
    }

    public function remover_vendido_paquete($id){
      $sql="UPDATE pedido_paquete SET estado_vendido='0', user_updated= '$this->id_usr_sesion' WHERE idpedido_paquete='$id'";
      $vendido =  ejecutarConsulta($sql); if ( $vendido['status'] == false) {return $vendido; }  

      //add registro en nuestra bitacora
      $sql_d = $id;
      $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (6,'pedido_paquete','$id','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $vendido;
    }

     //Implementamos un método para activar registros
     public function desactivar_paquete($idpedido) {
      $sql="UPDATE pedido_paquete SET estado='0', user_trash= '$this->id_usr_sesion' WHERE idpedido_paquete='$idpedido'";
      $eliminar =  ejecutarConsulta($sql); if ( $eliminar['status'] == false) {return $eliminar; }  

      //add registro en nuestra bitacora
      $sql_d = $idpedido;
      $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (2,'pedido_paquete','$idpedido','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $eliminar;
    }   

    //Implementamos un método para activar registros
    public function eliminar_paquete($idpedido) {
      $sql="UPDATE pedido_paquete SET estado_delete='0',user_delete= '$this->id_usr_sesion' WHERE idpedido_paquete='$idpedido'";
      $eliminar =  ejecutarConsulta($sql); if ( $eliminar['status'] == false) {return $eliminar; }  

      //add registro en nuestra bitacora
      $sql_d = $idpedido;
      $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (4,'pedido_paquete','$idpedido','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $eliminar;
    } 



    // ::::::::::::::::::::::::::::::::::::::::::: P A Q U E T E   A   M E D I D A  :::::::::::::::::::::::::::::::::::::::::::

    public function tbla_principal_a_medida()  {
      $sql="SELECT idpaquete_a_medida, tipo_viaje, ocacion_viaje, presupuesto, tipo_hotel, p_nombre, p_celular, p_correo, p_descripcion, estado_visto, estado_vendido, 
      estado, estado_delete, created_at
      FROM paquete_a_medida 
      WHERE estado=1 AND estado_delete=1 ORDER BY idpaquete_a_medida DESC ;";
      return ejecutarConsultaArray($sql);		
    }

    public function mostrar_paquete_medida($id)  {     

      // Mostramos el pedido
      $sql_1="SELECT * FROM paquete_a_medida  WHERE idpaquete_a_medida='$id';";
      $paquete_medida = ejecutarConsultaSimpleFila($sql_1); if ($paquete_medida['status'] == false) { return  $paquete_medida;}

      $sql = "SELECT t.nombre as nombre_tours, t.descripcion, t.imagen, t.actividad, t.incluye, t.no_incluye, t.recomendaciones, 
      t.duracion, t.alojamiento, t.resumen_actividad, t.resumen_comida, t.mapa, t.costo, t.estado_descuento, 
      t.porcentaje_descuento, t.monto_descuento
      FROM lugar_a_conocer as lc
      INNER JOIN paquete_a_medida as pm ON pm.idpaquete_a_medida = lc.idpaquete_a_medida
      INNER JOIN tours as t ON t.idtours = lc.idtours
      WHERE lc.idpaquete_a_medida = '$id' ;";
      $detalle = ejecutarConsultaArray($sql); if ( $detalle['status'] == false) {return $detalle; }  
      
      // Ejecutamos el visto
      $sql_2="UPDATE paquete_a_medida SET estado_visto='1', user_updated= '$this->id_usr_sesion' WHERE idpaquete_a_medida='$id';";
      $visto = ejecutarConsulta($sql_2); if ($visto['status'] == false) { return  $visto;}

      return $retorno=['status'=>true, 'message'=>'todo oka ps', 'data'=> ['paquete_a_medida'=>$paquete_medida['data'], 'tours'=> $detalle['data'] ] ];
    } 
  
  }

?>
