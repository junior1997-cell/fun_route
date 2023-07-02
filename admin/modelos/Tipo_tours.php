<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion_v2.php";

Class Tipo_tours
{
	//Implementamos nuestro variable global
  public $id_usr_sesion;

  //Implementamos nuestro constructor
  public function __construct($id_usr_sesion = 0)
  {
    $this->id_usr_sesion = $id_usr_sesion;
  }

	//Implementamos un método para insertar registros
	public function insertar($nombre_tt, $descripcion_tt)
	{
		$sql="INSERT INTO tipo_tours (nombre, descripcion, user_created)VALUES ('$nombre_tt', '$descripcion_tt','$this->id_usr_sesion')";
		$insertar =  ejecutarConsulta_retornarID($sql); 
		if ($insertar['status'] == false) {  return $insertar; } 
		
		//add registro en nuestra bitacora
		$sql_d = $nombre_tt.', '.$descripcion_tt;
		$sql_bit = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (5,'tipo_tours','".$insertar['data']."','$sql_d','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; } 
		
		return $insertar;
	}

	//Implementamos un método para editar registros
	public function editar($idtipo_tours,$nombre_tt,$descripcion_tt)
	{
		$sql="UPDATE tipo_tours SET nombre='$nombre_tt', descripcion= '$descripcion_tt', user_updated= '$this->id_usr_sesion' WHERE idtipo_tours='$idtipo_tours'";
		$editar =  ejecutarConsulta($sql);
		if ( $editar['status'] == false) {return $editar; } 
	
		//add registro en nuestra bitacora
		$sql_d = $idtipo_tours.','.$nombre_tt.','.$descripcion_tt;
		$sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (6,'tipo_tours','$idtipo_tours','$sql_d','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
	
		return $editar;
	}

	//Implementamos un método para desactivar tipo
	public function desactivar($idtipo_tours)
	{
		$sql="UPDATE tipo_tours SET estado='0',user_trash= '$this->id_usr_sesion' WHERE idtipo_tours='$idtipo_tours'";
		$desactivar= ejecutarConsulta($sql);

		if ($desactivar['status'] == false) {  return $desactivar; }
		
		//add registro en nuestra bitacora
		$sql_d = $idtipo_tours;
		$sql_bit = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (2,'persona','$idtipo_tours','$sql_d','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }   
		
		return $desactivar;
	}

	//Implementamos un método para activar tipo
	public function activar($idtipo_tours)
	{
		$sql="UPDATE tipo_tours SET estado='1' WHERE idtipo_tours='$idtipo_tours'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar tipo
	public function eliminar($idtipo_tours)
	{
		$sql="UPDATE tipo_tours SET estado_delete='0',user_delete= '$this->id_usr_sesion' WHERE idtipo_tours='$idtipo_tours'";
		$eliminar =  ejecutarConsulta($sql);
		if ( $eliminar['status'] == false) {return $eliminar; }  
		
		//add registro en nuestra bitacora
		$sql_d = $idtipo_tours;

		$sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (4,'bancos','$idtipo_tours','$sql_d','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		return $eliminar;
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idtipo_tours)
	{
		$sql="SELECT * FROM tipo_tours WHERE idtipo_tours='$idtipo_tours'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar_tabla_principal()
	{
		$sql="SELECT * FROM tipo_tours WHERE estado=1 AND estado_delete=1 ORDER BY idtipo_tours ASC";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM tipo_tours where estado=1";
		return ejecutarConsulta($sql);		
	}
}
?>