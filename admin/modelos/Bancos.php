<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion_v2.php";

Class Bancos
{
	//Implementamos nuestro variable global
  public $id_usr_sesion;

  //Implementamos nuestro constructor
  public function __construct($id_usr_sesion = 0)
  {
    $this->id_usr_sesion = $id_usr_sesion;
  }

	//Implementamos un método para insertar registros
	public function insertar($nombre, $alias, $formato_cta, $formato_cci, $formato_detracciones, $imagen1)
	{
		$sql="INSERT INTO bancos (nombre, alias, formato_cta, formato_cci, formato_detracciones, icono, user_created)
		VALUES ('$nombre', '$alias', '$formato_cta', '$formato_cci', '$formato_detracciones', '$imagen1','$this->id_usr_sesion')";

		$insertar =  ejecutarConsulta_retornarID($sql); if ($insertar['status'] == false) {  return $insertar; } 

		//add registro en nuestra bitacora
		$sql_d = $nombre.', '.$alias.', '.$formato_cta.', '.$formato_cci.', '.$formato_detracciones.', '.$imagen1;
		$sql_bit = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (5,'bancos','".$insertar['data']."','$sql_d','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  

		return $insertar;
	}

	//Implementamos un método para editar registros
	public function editar($idbancos, $nombre, $alias, $formato_cta, $formato_cci, $formato_detracciones, $imagen1)
	{
		$sql="UPDATE bancos SET nombre='$nombre', alias ='$alias', formato_cta='$formato_cta', 
		formato_cci='$formato_cci', formato_detracciones='$formato_detracciones', icono='$imagen1',
		user_updated= '$this->id_usr_sesion' 
		WHERE idbancos='$idbancos'";
		$editar =  ejecutarConsulta($sql);

		if ( $editar['status'] == false) {return $editar; } 
	
		//add registro en nuestra bitacora
		$sql_d = $idbancos.', '.$nombre.', '.$alias.', '.$formato_cta.', '.$formato_cci.', '.$formato_detracciones.', '.$imagen1;

		$sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (6,'bancos','$idbancos','$sql_d','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
	
		return $editar;
	}

	//Implementamos un método para desactivar bancos
	public function desactivar($idbancos)
	{
		$sql="UPDATE bancos SET estado='0' ,user_trash= '$this->id_usr_sesion' WHERE idbancos='$idbancos'";
		$desactivar= ejecutarConsulta($sql);

		if ($desactivar['status'] == false) {  return $desactivar; }
		
		//add registro en nuestra bitacora
		$sql_d = $idbancos;

		$sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (2,'persona','$idbancos','$sql_d','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		return $desactivar;
	}

	//Implementamos un método para activar bancos
	public function activar($idbancos)
	{
		$sql="UPDATE bancos SET estado='1' WHERE idbancos='$idbancos'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar bancos
	public function eliminar($idbancos)
	{
		$sql="UPDATE bancos SET estado_delete='0',user_delete= '$this->id_usr_sesion' WHERE idbancos='$idbancos'";
		$eliminar =  ejecutarConsulta($sql);
		if ( $eliminar['status'] == false) {return $eliminar; }  
		
		//add registro en nuestra bitacora.', '.
		$sql_d = $idbancos;

		$sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (4,'bancos','$idbancos','$sql_d','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		return $eliminar;
	}
	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idbancos)
	{
		$sql="SELECT * FROM bancos WHERE idbancos='$idbancos'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM bancos WHERE idbancos > 1 	AND estado=1  AND estado_delete=1 ORDER BY nombre ASC";
		return ejecutarConsulta($sql);		
	}
	
	//Implementar un método para listar los registros y mostrar en el select
	public function obtenerImg($id){
		$sql="SELECT icono FROM bancos where idbancos = '$id' ";
		return ejecutarConsultaSimpleFila($sql);		
	}
}
?>