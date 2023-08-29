<?php
  //Incluímos inicialmente la conexión a la base de datos
  require "../config/Conexion_v2.php";
  // global $total;
  class Experiencia
  {

    //Implementamos nuestro variable global
    public $id_usr_sesion;

    //Implementamos nuestro constructor
    public function __construct($id_usr_sesion = 0)
    {
      $this->id_usr_sesion = $id_usr_sesion;
    }

    //Implementamos un método para insertar registros
    public function insertar($nombre, $lugar, $comentario, $estrella,$imagen1)
    {
      $sql ="INSERT INTO experiencias(nombre, img_perfil, lugar, comentario, estrella, user_created) 
      VALUES ('$nombre','$imagen1','$lugar','$comentario','$estrella','$this->id_usr_sesion')";
      return ejecutarConsulta($sql);
    }

    //Implementamos un método para desactivar comentario_tours
	public function desactivar($idcomentario_tours)
	{
		$sql="UPDATE comentario_tours SET estado='0',user_trash= '$this->id_usr_sesion' WHERE idcomentario_tours='$idcomentario_tours'";
		$desactivar= ejecutarConsulta($sql);

		if ($desactivar['status'] == false) {  return $desactivar; }
		
		//add registro en nuestra bitacora
		$sql_d = $idcomentario_tours;
		$sql_bit = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (2,'comentario_tours','$idcomentario_tours','$sql_d','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }   
		
		return $desactivar;
	}

	//Implementamos un método para eliminar comentario_tours
	public function eliminar($idcomentario_tours)
	{
    //var_dump($idcomentario_tours); die;
    
		$sql="UPDATE comentario_tours SET estado_delete='0',user_delete= '$this->id_usr_sesion' WHERE idcomentario_tours='$idcomentario_tours'";
		$eliminar =  ejecutarConsulta($sql);
		if ( $eliminar['status'] == false) {return $eliminar; }  
		
		//add registro en nuestra bitacora
		$sql_d = $idcomentario_tours;

		$sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (4,'comentario_tours','$idcomentario_tours','$sql_d','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		return $eliminar;
	}

    //implementamos un metodo para editar registros
    public function editar($idcomentario,$idpaquete, $nombre, $correo, $nota, $fecha, $estrella)
    {
      // var_dump($idpago_trabajador,$idmes_pago_trabajador_p,$nombre_mes,$monto,$fecha_pago,$descripcion,$comprobante);die();
      $sql="";
      return ejecutarConsulta($sql);
    }

    public function mostrar($idcomentario_tours)
    {
      $sql="SELECT * FROM comentario_tours WHERE idcomentario_tours='$idcomentario_tours'";
      return ejecutarConsultaSimpleFila($sql);
    }
   
   
    //Implementamos un método para listar los registros
    public function tbla_principal()
    {
      $sql="SELECT idexperiencia, nombre, img_perfil, lugar, comentario, estrella, estado FROM experiencias WHERE estado=1 and estado_delete=1;";
      return ejecutarConsultaArray($sql);		
    }
    
    public function obtenerImg($id){
      $sql="SELECT imagen FROM paquete WHERE idpaquete = '$id' ";
      return ejecutarConsultaSimpleFila($sql);  
    }

  }

?>
