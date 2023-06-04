<?php
  //Incluímos inicialmente la conexión a la base de datos
  require "../config/Conexion_v2.php";
  // global $total;
  class Comentario_paquete
  {

    //Implementamos nuestro variable global
    public $id_usr_sesion;

    //Implementamos nuestro constructor
    public function __construct($id_usr_sesion = 0)
    {
      $this->id_usr_sesion = $id_usr_sesion;
    }


    	//Implementamos un método para desactivar comentario_paquete
	public function desactivar($idcomentario_paquete)
	{
		$sql="UPDATE comentario_paquete SET estado='0',user_trash= '$this->id_usr_sesion' WHERE idcomentario_paquete='$idcomentario_paquete'";
		$desactivar= ejecutarConsulta($sql);

		if ($desactivar['status'] == false) {  return $desactivar; }
		
		//add registro en nuestra bitacora
		$sql_d = $idcomentario_paquete;
		$sql_bit = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (2,'comentario_paquete','$idcomentario_paquete','$sql_d','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }   
		
		return $desactivar;
	}

  //Implementamos un método para verificar comentario_paquete
  public function verificar($idcomentario_paquete)
	{
		$sql="UPDATE comentario_paquete SET estado_aceptado='1',user_trash= '$this->id_usr_sesion' WHERE idcomentario_paquete='$idcomentario_paquete'";
		$verificar= ejecutarConsulta($sql);

		if ($verificar['status'] == false) {  return $verificar; }
		
		//add registro en nuestra bitacora
		$sql_d = $idcomentario_paquete;
		$sql_bit = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (2,'comentario_paquete','$idcomentario_paquete','$sql_d','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }   
		
		return $verificar;
	}

  //Implementamos un método para desactivar la verificación del comentario_paquete
  public function no_verificar($idcomentario_paquete)
	{
		$sql="UPDATE comentario_paquete SET estado_aceptado='0',user_trash= '$this->id_usr_sesion' WHERE idcomentario_paquete='$idcomentario_paquete'";
		$no_verificar= ejecutarConsulta($sql);

		if ($no_verificar['status'] == false) {  return $no_verificar; }
		
		//add registro en nuestra bitacora
		$sql_d = $idcomentario_paquete;
		$sql_bit = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (2,'comentario_paquete','$idcomentario_paquete','$sql_d','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }   
		
		return $no_verificar;
	}

	//Implementamos un método para activar comentario_paquetepo
	public function activar($idcomentario_paquete)
	{
		$sql="UPDATE comentario_paquete SET estado='1' WHERE idcomentario_paquete='$idcomentario_paquete'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar comentario_paquete
	public function eliminar($idcomentario_paquete)
	{
    //var_dump($idcomentario_paquete); die;
    
		$sql="UPDATE comentario_paquete SET estado_delete='0',user_delete= '$this->id_usr_sesion' WHERE idcomentario_paquete='$idcomentario_paquete'";
		$eliminar =  ejecutarConsulta($sql);
		if ( $eliminar['status'] == false) {return $eliminar; }  
		
		//add registro en nuestra bitacora
		$sql_d = $idcomentario_paquete;

		$sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (4,'comentario_paquete','$idcomentario_paquete','$sql_d','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		return $eliminar;
	}

    public function mostrar($idcomentario_paquete)
    {
      $sql="SELECT * FROM comentario_paquete WHERE idcomentario_paquete='$idcomentario_paquete'";
      return ejecutarConsultaSimpleFila($sql);
    }
   
   
    //Implementamos un método para listar los registros
    public function tbla_principal()
    {
      $sql="SELECT c.idcomentario_paquete, c.idpaquete, c.nombre, c.correo, c.comentario, c.fecha, c.estrella ,p.nombre, p.cant_dias,p.cant_noches, p.descripcion, p.estado, c.estado_aceptado 
      FROM comentario_paquete as c , paquete as p WHERE c.idpaquete=p.idpaquete AND c.estado=1 AND c.estado_delete=1";
      return ejecutarConsultaArray($sql);		
    }
    //total pagos por  total_pago_trabajador
    public function total_pago_trabajador($idmes_pago_trabajador)
    {
      $sql="SELECT SUM(monto) as total FROM pago_trabajador WHERE estado =1 AND estado_delete=1 AND idmes_pago_trabajador='$idmes_pago_trabajador'";
      return ejecutarConsultaSimpleFila($sql);  

    }
    public function obtenerImg($id){
      $sql="SELECT `imagen` FROM `paquete` WHERE idpaquete = '$id' ";
      return ejecutarConsultaSimpleFila($sql);  
    }

  }

?>
