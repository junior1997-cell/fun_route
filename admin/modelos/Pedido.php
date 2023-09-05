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

    // ::::::::::::::::::::::::::::::::::::::::::: P A Q U E T E :::::::::::::::::::::::::::::::::::::::::::

    //Implementamos un método para activar registros
    public function eliminar_tours($idpedido) {
      $sql="UPDATE pedido_paquete SET estado_delete='0',user_delete= '$this->id_usr_sesion' WHERE idpedido='$idpedido'";
      $eliminar =  ejecutarConsulta($sql); if ( $eliminar['status'] == false) {return $eliminar; }  

      //add registro en nuestra bitacora
      $sql_d = $idpedido;
      $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (4,'pedido_paquete','$idpedido','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $eliminar;
    }

    public function vendido_tours($id){
      $sql="UPDATE pedido_paquete SET estado_vendido='1', user_updated= '$this->id_usr_sesion' WHERE idpedido_paquete='$id'";
      $eliminar =  ejecutarConsulta($sql); if ( $eliminar['status'] == false) {return $eliminar; }  

      //add registro en nuestra bitacora
      $sql_d = $id;
      $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (4,'pedido_paquete','$id','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $eliminar;
    }

    public function visto_tours($id){
      $sql="UPDATE pedido_paquete SET estado_vendido='1', user_updated= '$this->id_usr_sesion' WHERE idpedido_paquete='$id'";
      $eliminar =  ejecutarConsulta($sql); if ( $eliminar['status'] == false) {return $eliminar; }  

      //add registro en nuestra bitacora
      $sql_d = $id;
      $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (6,'pedido_paquete','$id','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $eliminar;
    }

    //mostrar en un arrary los datos para pasar al html
    public function mostrar_tours($idtours, $idpedido_tours)  {
      $data = [];

      $sql_1="SELECT t.idtours, t.idtipo_tours, t.nombre, t.descripcion, t.imagen, t.actividad, t.incluye, t.no_incluye, t.recomendaciones, 
      t.duracion, t.alojamiento, t.resumen_actividad, t.resumen_comida, t.mapa, t.costo, t.estado_descuento, t.porcentaje_descuento, t.monto_descuento, tp.nombre as tipo_tours  
      FROM tours as t, tipo_tours as tp  
      WHERE t.idtipo_tours = tp.idtipo_tours AND idtours = '$idtours'";
      $tours = ejecutarConsultaSimpleFila($sql_1); if ($tours['status'] == false) { return  $tours;}
      
      // Ejecutamos el visto
      $sql_2="UPDATE pedido_tours SET estado_visto='1' WHERE idpedido_tours='$idpedido_tours';";
      $visto = ejecutarConsulta($sql_2); if ($visto['status'] == false) { return  $visto;}
      //add registro en nuestra bitacora
      $sql_d = $idpedido_tours;
      $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (6,'pedido_tours','$idpedido_tours','$sql_d','$this->id_usr_sesion')";
      $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }      
      
      // Ejecutamos el visto
      $sql_3="SELECT * FROM pedido_tours  WHERE idpedido_tours='$idpedido_tours';";
      $visto = ejecutarConsulta($sql_3); if ($visto['status'] == false) { return  $visto;}
      
      return $retorno=['status'=>true, 'message'=>'todo oka ps', 'data'=> $tours['data']];
    }

    //Implementamos un método para listar los registros
    public function tbla_principal_tours()  {
      $sql="SELECT pd.idpedido_tours, pd.idtours, pd.nombre, pd.correo, pd.telefono, pd.descripcion as descripcionpedido,pd.estado_visto,pd.estado_vendido,  
      p.nombre as tours, p.duracion, p.descripcion , p.imagen as imgtours 
      FROM pedido_tours AS pd, tours AS p
      WHERE pd.idtours=p.idtours AND pd.estado=1 AND pd.estado_delete=1 ;";
      return ejecutarConsultaArray($sql);		
    }

    // ::::::::::::::::::::::::::::::::::::::::::: P A Q U E T E :::::::::::::::::::::::::::::::::::::::::::

    public function tbla_principal_paquete()  {
      $sql="SELECT pd.idpedido_paquete, pd.idpaquete, pd.nombre, pd.correo, pd.telefono, pd.descripcion as descripcionpedido,pd.estado_visto,pd.estado_vendido,  
      p.nombre as paquete, p.cant_dias,p.cant_noches, p.descripcion , p.imagen as imgpaquete 
      FROM pedido_paquete AS pd, paquete AS p
      WHERE pd.idpaquete=p.idpaquete AND pd.estado=1 AND pd.estado_delete=1 ;";
      return ejecutarConsultaArray($sql);		
    }
  
  }

?>
