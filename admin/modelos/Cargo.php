<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Cargo
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

		//Implementamos un método para insertar cargo
	public function insertar($nombre_cargo,$descripcion_cargo){
		$sql="INSERT INTO cargo_persona (nombre_cargo,descripcion,user_created)
		VALUES ('$nombre_cargo','$descripcion_cargo','" . $_SESSION['idusuario'] . "')";
		$intertar =  ejecutarConsulta_retornarID($sql); 
		if ($intertar['status'] == false) {  return $intertar; } 
		
		//add registro en nuestra bitacora
		$sql_bit = "INSERT INTO bitacora_bd( nombre_tabla, id_tabla, accion, id_user) VALUES ('cargo_persona','".$intertar['data']."','Nuevo cargo registrado','" . $_SESSION['idusuario'] . "')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }   
		
		return $intertar;

	}

	//Implementamos un método para editar registros de cargo
	public function editar($idcargo_persona,$nombre_cargo,$descripcion_cargo){

		$sql="UPDATE cargo_persona SET nombre_cargo='$nombre_cargo',descripcion='$descripcion_cargo',user_updated='" . $_SESSION['idusuario'] . "' WHERE idcargo_persona='$idcargo_persona'";
		$editar = ejecutarConsulta($sql); if ($editar['status'] == false) {  return $editar; } 
		
		//add registro en nuestra bitacora
		$sql_bit = "INSERT INTO bitacora_bd( nombre_tabla, id_tabla, accion, id_user) VALUES ('cargo_persona','".$idcargo_persona."','Edito cargo registrado','" . $_SESSION['idusuario'] . "')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }   
		
		return $editar;
	}

	//Implementamos un método para desactivar registros de cargo
	public function desactivar($idcargo_persona){
		$sql="UPDATE cargo_persona SET estado='0',user_trash='" . $_SESSION['idusuario'] . "' WHERE idcargo_persona='$idcargo_persona'";
		$desactivar = ejecutarConsulta($sql); if ($desactivar['status'] == false) {  return $desactivar; } 
		
		//add registro en nuestra bitacora
		$sql_bit = "INSERT INTO bitacora_bd( nombre_tabla, id_tabla, accion, id_user) VALUES ('cargo_persona','".$idcargo_persona."','Desactivo cargo registrado','" . $_SESSION['idusuario'] . "')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }   
		
		return $desactivar;
	}


	//Implementamos un método para eliminar
	public function eliminar($idcargo_persona)
	{
		$sql="UPDATE cargo_persona SET estado_delete='0',user_delete= '" . $_SESSION['idusuario'] . "' WHERE idcargo_persona='$idcargo_persona'";
		$eliminar =  ejecutarConsulta($sql);
		if ( $eliminar['status'] == false) {return $eliminar; }  
		
		//add registro en nuestra bitacora
		$sql = "INSERT INTO bitacora_bd( nombre_tabla, id_tabla, accion, id_user) VALUES ('cargo_persona','$idcargo_persona','Cargo Eliminado','" . $_SESSION['idusuario'] . "')";
		$bitacora = ejecutarConsulta($sql); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		return $eliminar;
	}

	//Implementar un método para mostrar los datos de un registro de cargo
	public function mostrar($idcargo_persona){
		$sql="SELECT * FROM cargo_persona WHERE idcargo_persona='$idcargo_persona'";
		return ejecutarConsultaSimpleFila($sql);
	}
	
	//Implementar un método para listar los registros de cargo
	public function listar(){
		$sql="SELECT * FROM cargo_persona WHERE estado=1 AND estado_delete='1' ORDER BY idcargo_persona DESC";
		return ejecutarConsulta($sql);		
	}

}
?>