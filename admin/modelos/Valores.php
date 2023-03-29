<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Valores
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}
	//Implementamos un método para insertar registros
	public function insertar($id_paginaweb,$nombre,$descripcion,$imagen_perfil)
	{
		// var_dump($id_paginaweb,$nombre,$descripcion,$imagen_perfil);die();
		$sql="INSERT INTO valores(idpagina_web,nombre_valor, descripcion, icono) VALUES ('$id_paginaweb','$nombre','$descripcion','$imagen_perfil')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idvalores,$id_paginaweb,$nombre,$descripcion,$imagen_perfil)
	{
		$sql="UPDATE valores SET idpagina_web='$id_paginaweb', nombre_valor='$nombre', descripcion='$descripcion', icono='$imagen_perfil' WHERE idvalores='$idvalores'";	
		return ejecutarConsulta($sql);	
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idvalores )
	{
		$sql="UPDATE valores SET estado='0' WHERE idvalores ='$idvalores'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function eliminar($idvalores)
	{
		$sql="DELETE FROM valores WHERE idvalores ='$idvalores';";
		return ejecutarConsulta($sql);
	}
	
	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idvalores )
	{
		$sql="SELECT*FROM valores WHERE idvalores ='$idvalores'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar($id)
	{
		$sql="SELECT*FROM valores WHERE idpagina_web = '$id' AND estado='1' ORDER BY idvalores DESC;";
		return ejecutarConsulta($sql);		
	}

	//Seleccionar un comprobante
	public function reg_img($idvalores)
	{
		$sql="SELECT icono FROM valores WHERE idvalores='$idvalores'";
		return ejecutarConsultaSimpleFila($sql);		
	}

	//funciones vista web
	
	//Implementar un método para listar los registros
	public function listar_v_web()
	{
		$sql="SELECT*FROM valores ORDER BY idvalores DESC";
		return ejecutarConsultaArray($sql);		
	}
	
	//Implementar un método para listar los registros
	public function listar_v_foot_web()
	{
		$sql="SELECT*FROM valores ORDER BY idvalores DESC LIMIT 4";
		return ejecutarConsultaArray($sql);		
	}
}

?>