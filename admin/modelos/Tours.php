<?php
  //Incluímos inicialmente la conexión a la base de datos
  require "../config/Conexion_v2.php";
  // global $total;
  class Tours
  {

    //Implementamos nuestro variable global
    public $id_usr_sesion;

    //Implementamos nuestro constructor
    public function __construct($id_usr_sesion = 0)
    {
      $this->id_usr_sesion = $id_usr_sesion;
    }

    //Implementamos un método para insertar registros
    public function insertar($nombre, $cant_dias, $descripcion, $imagen1)
    {
      $sql ="INSERT INTO tours(nombre, cant_dias, descripcion, imagen) VALUES ('$nombre','$cant_dias','$descripcion','$imagen1')";
      $crear= ejecutarConsulta_retornarID($sql); if ( $crear['status'] == false) {return $crear; }  

      //add registro en nuestra bitacora
		  $sql_d = "$nombre, $cant_dias, $descripcion, $imagen1";

		  $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (5,'idtours','".$crear['data']."','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta_retornarID($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $crear;
    }

    //implementamos un metodo para editar registros
    public function editar($idtours, $nombre, $cant_dias, $descripcion, $imagen1)
    {
      // var_dump($idpago_trabajador,$idmes_pago_trabajador_p,$nombre_mes,$monto,$fecha_pago,$descripcion,$comprobante);die();
      $sql="UPDATE tours SET nombre='$nombre',cant_dias='$cant_dias',descripcion='$descripcion',imagen='$imagen1' WHERE idtours='$idtours';";
      $editar= ejecutarConsulta($sql); if ( $editar['status'] == false) {return $editar; }  

      //add registro en nuestra bitacora
		  $sql_d = "$idtours, $nombre, $cant_dias, $descripcion, $imagen1";

		  $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (6,'idtours','$idtours','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $editar;
    }

    //Implementamos un método para desactivar registros
    public function desactivar($idtours)
    {
      $sql="UPDATE tours SET estado='0',user_trash= '$this->id_usr_sesion' WHERE tours='$idtours'";
      $desactivar =  ejecutarConsulta($sql);

      if ( $desactivar['status'] == false) {return $desactivar; }  
      $sql_d = $idtours;

      //add registro en nuestra bitacora
      $sql = "INSERT INTO bitacora_bd( nombre_tabla, id_tabla, accion, id_user) VALUES ('tours','.$idtours.','Desativar el registro Trabajador','$this->id_usr_sesion')";
      $bitacora = ejecutarConsulta($sql); if ( $bitacora['status'] == false) {return $bitacora; }  

      return $desactivar;
    }
    
    //Implementamos un método para activar registros
    public function eliminar($idtours) {
      $sql="UPDATE tours SET estado_delete='0',user_delete= '$this->id_usr_sesion' WHERE idtours='$idtours'";
      $eliminar =  ejecutarConsulta($sql); if ( $eliminar['status'] == false) {return $eliminar; }  

      //add registro en nuestra bitacora
      $sql_d = $idtours;
      $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (4,'tours','$idtours','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $eliminar;
    }
    
    //Implementamos un método para mostrar los datos de un registro a modificar
    public function mostrar($idtours)
    {
      $sql="SELECT * FROM tours WHERE idtours='$idtours'";
      return ejecutarConsultaSimpleFila($sql);
    }

    //Implementamos un método para listar los registros
    public function tbla_principal()
    {
      $sql="SELECT idtours, nombre, cant_dias, descripcion, imagen, estado 
      FROM tours WHERE estado = 1 and estado_delete = 1";
      return ejecutarConsultaArray($sql);		
    }

    public function obtenerImg($id){
      $sql="SELECT imagen FROM tours WHERE idtours = '$id' ";
      return ejecutarConsultaSimpleFila($sql);  
    }

    //SELEC2 PARA MOSTRAR TIPOS DE TOURS
    public  function selec2tipotours()
    {
      $sql="SELECT idtipo_tours as id, nombre FROM tipo_tours WHERE estado=1 and estado_delete=1;";
      return ejecutarConsultaArray($sql);	

    }

  }

?>
