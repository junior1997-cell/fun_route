<?php
  //Incluímos inicialmente la conexión a la base de datos
  require "../config/Conexion_v2.php";
  // global $total;
  class Valores
  {

    //Implementamos nuestro variable global
    public $id_usr_sesion;

    //Implementamos nuestro constructor
    public function __construct($id_usr_sesion = 0)
    {
      $this->id_usr_sesion = $id_usr_sesion;
    }

    //Implementamos un método para insertar registros
    public function insertar($nombre,$descripcion, $imagen1)
    {
      //var_dump($nombre,$descripcion, $imagen1);die;
      $sql ="INSERT INTO `valores`(`nombre_valor`, `icono`, `descripcion`) VALUES ('$nombre','$imagen1','$descripcion')";
      $crear= ejecutarConsulta_retornarID($sql); if ( $crear['status'] == false) {return $crear; }  

      //add registro en nuestra bitacora
		  $sql_d = "$nombre, $imagen1, $descripcion";

		  $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (5,'valores','".$crear['data']."','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta_retornarID($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $crear;
      
    }

    //implementamos un metodo para editar registros
    public function editar($idvalores, $nombre, $descripcion,$imagen1)
    
    {
      // var_dump($idpago_trabajador,$idmes_pago_trabajador_p,$nombre_mes,$monto,$fecha_pago,$descripcion,$comprobante);die();
      $sql="UPDATE `valores` SET `nombre_valor`='$nombre',`icono`='$imagen1',`descripcion`='$descripcion' WHERE idvalores='$idvalores';";
      $editar= ejecutarConsulta($sql); if ( $editar['status'] == false) {return $editar; }  

      //add registro en nuestra bitacora
		  $sql_d = "$idvalores, $nombre, $imagen1, $descripcion";
                                                                                                        //tabla-nombre
		  $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (6,'valores','$idvalores','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $editar;

    }

    //Implementamos un método para desactivar registros
    public function desactivar($idvalores)
    {
      $sql="UPDATE valores SET estado='0',user_trash= '$this->id_usr_sesion' WHERE valores='$idvalores'";
      $desactivar =  ejecutarConsulta($sql);

      if ( $desactivar['status'] == false) {return $desactivar; }  
      $sql_d = $idvalores;

      //add registro en nuestra bitacora
      $sql = "INSERT INTO bitacora_bd( nombre_tabla, id_tabla, accion, id_user) VALUES ('valores','.$idvalores.','Desativar el registro Trabajador','$this->id_usr_sesion')";
      $bitacora = ejecutarConsulta($sql); if ( $bitacora['status'] == false) {return $bitacora; }  

      return $desactivar;
    }
    
    //Implementamos un método para activar registros
    public function eliminar($idvalores) {
      $sql="UPDATE valores SET estado_delete='0',user_delete= '$this->id_usr_sesion' WHERE idvalores='$idvalores'";
      $eliminar =  ejecutarConsulta($sql); if ( $eliminar['status'] == false) {return $eliminar; }  

      //add registro en nuestra bitacora
      $sql_d = $idvalores;
      $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (4,'valores','$idvalores','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $eliminar;
    }
    //Implementamos un método para mostrar los datos de un registro a modificar
    public function mostrar($idvalores)
    {
      $sql="SELECT * FROM valores WHERE idvalores='$idvalores'";
      return ejecutarConsultaSimpleFila($sql);
    }

    //Implementamos un método para listar los registros
    public function tbla_principal()
    {
      $sql="SELECT idvalores, nombre_valor,  descripcion, icono
      FROM valores WHERE estado = 1 and estado_delete = 1";
      return ejecutarConsultaArray($sql);		
    }
    //total pagos por  total_pago_trabajador
    public function total_pago_trabajador($idmes_pago_trabajador)
    {
      $sql="SELECT SUM(monto) as total FROM pago_trabajador WHERE estado =1 AND estado_delete=1 AND idmes_pago_trabajador='$idmes_pago_trabajador'";
      return ejecutarConsultaSimpleFila($sql);  

    }
    public function obtenerImg($id){
      $sql="SELECT `imagen` FROM `valores` WHERE idvalores = '$id' ";
      return ejecutarConsultaSimpleFila($sql);  
    }

  }

?>
