<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion_v2.php";

class Correlacion_comprobante
{
  public $id_usr_sesion;
  //Implementamos nuestro constructor
  public function __construct( $id_usr_sesion = 0)
  {
    $this->id_usr_sesion = $id_usr_sesion;
  }
  
  // ::::::::::::::::::::::::::::::::::::::::: S E C C I O N   C O M P R A  ::::::::::::::::::::::::::::::::::::::::: 
 

  //Implementamos un método para editar registros
  public function editar( $idsunat_correlacion, $nombre, $abreviatura, $serie, $numero) {

    $sql = "UPDATE sunat_correlacion_comprobante SET serie='$serie', numero='$numero', user_updated='$this->id_usr_sesion' 
    WHERE idsunat_correlacion_comprobante='$idsunat_correlacion'";
    $update_correlacion = ejecutarConsulta($sql); if ($update_correlacion['status'] == false) { return $update_correlacion; }

    //add registro en nuestra bitacora
    $sql_d = "$idsunat_correlacion, $nombre, $abreviatura, $serie, $numero";
    $sql_bit = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (6, 'sunat_correlacion_comprobante','$idsunat_correlacion','$sql_d','$this->id_usr_sesion')";
    $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }

    return $update_correlacion;
  }

  public function mostrar($id) {
    $sql = "SELECT *  FROM sunat_correlacion_comprobante  WHERE idsunat_correlacion_comprobante ='$id' ;";
    return  ejecutarConsultaSimpleFila($sql);
  }

  //Implementamos un método para desactivar categorías
  public function desactivar($id) {
    // var_dump($idventa_producto);die();
    $sql = "UPDATE sunat_correlacion_comprobante SET estado='0', user_trash= '$this->id_usr_sesion' WHERE idsunat_correlacion_comprobante='$id'";
		$desactivar= ejecutarConsulta($sql); if ($desactivar['status'] == false) {  return $desactivar; }

    //add registro en nuestra bitacora
    $sql_d = $id;
    $sql_bit = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (2, 'sunat_correlacion_comprobante','$id','$sql_d','$this->id_usr_sesion')";
    $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }
		return $desactivar;
  }

  //Implementamos un método para desactivar categorías
  public function activar_correlacion($id) {
    // var_dump($idventa_producto);die();
    $sql = "UPDATE sunat_correlacion_comprobante SET estado='1', user_trash= '$this->id_usr_sesion' WHERE idsunat_correlacion_comprobante='$id'";
		$desactivar= ejecutarConsulta($sql); if ($desactivar['status'] == false) {  return $desactivar; }

    //add registro en nuestra bitacora
    $sql_d = $id;
    $sql_bit = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (1, 'sunat_correlacion_comprobante','$id','$sql_d','$this->id_usr_sesion')";
    $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }
		return $desactivar;
  }

  //Implementamos un método para activar categorías
  public function eliminar($id) {
    $sql = "UPDATE sunat_correlacion_comprobante SET estado_delete='0',user_delete= '$this->id_usr_sesion' WHERE idsunat_correlacion_comprobante='$id'";
		$eliminar =  ejecutarConsulta($sql); if ( $eliminar['status'] == false) {return $eliminar; }  
		//add registro en nuestra bitacora
    $sql_d = $id;
		$sql = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (4, 'sunat_correlacion_comprobante','$id','$sql_d','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql); if ( $bitacora['status'] == false) {return $bitacora; }      
		return $eliminar;
  }


  //Implementar un método para listar los registros
  public function tbla_principal() {  
    $sql = "SELECT * FROM sunat_correlacion_comprobante ORDER BY estado DESC ;";
    return ejecutarConsultaArray($sql); 
  }


}

?>
