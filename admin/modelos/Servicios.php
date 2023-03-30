<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Servicios
{
	//Implementamos nuestro constructor
	public function __construct() { }

	public function insertar($id_paginaweb,$nombre,$descripcion,$imagen_perfil)
	{
	
		$sql="INSERT INTO servicio(idpagina_web, nombre_servicio, descripcion, icono) 
		VALUES ('$id_paginaweb','$nombre','$descripcion','$imagen_perfil')";
		return ejecutarConsulta($sql);
			
	}

	public function editar($idservicio,$id_paginaweb,$nombre,$descripcion,$imagen_perfil)
	{
		$sql="UPDATE servicio SET idpagina_web='$id_paginaweb', nombre_servicio='$nombre',descripcion='$descripcion',icono='$imagen_perfil'
		 WHERE idservicio='$idservicio'";	
		return ejecutarConsulta($sql);	
	}

	public function eliminar($idservicio)
	{
		$sql="DELETE FROM servicio WHERE idservicio ='$idservicio';";
		return ejecutarConsulta($sql);
	}

	public function mostrar($idservicio )
	{
		$sql="SELECT*FROM servicio WHERE idservicio ='$idservicio'";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function listar($id)
	{
		$sql="SELECT*FROM servicio WHERE idpagina_web='$id' ORDER BY idservicio DESC";
		return ejecutarConsulta($sql);		
	}

	public function reg_img($idservicio)
	{
		$sql="SELECT icono FROM servicio WHERE idservicio='$idservicio'";
		return ejecutarConsultaSimpleFila($sql);		
	}
	//-------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------
	public function insertar_detalle($idservicio_d, $descripcion)
	{
		//insertar registro servicio_detalle
		$sql="INSERT INTO servicio_detalle(idservicio, descripcion)
		VALUES ('$idservicio_d','$descripcion')";
		return ejecutarConsulta($sql);
	}

	public function editar_detalle($idservicio_d, $idservicio_detalle, $descripcion)
	{
		//editar registro servicio_detalle
		$sql="UPDATE servicio_detalle SET idservicio='$idservicio_d', descripcion='$descripcion'
		 WHERE idservicio_detalle='$idservicio_detalle'";
		return ejecutarConsulta($sql);

	}

	public function eliminar_detalle($idservicio_detalle)
	{
		$sql="DELETE FROM servicio_detalle WHERE idservicio_detalle ='$idservicio_detalle';";
		return ejecutarConsulta($sql);
	}

	public function mostrar_detalle($idservicio_detalle )
	{
		$sql="SELECT*FROM servicio_detalle WHERE idservicio_detalle ='$idservicio_detalle'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listar_detalle($id)
	{
		$sql="SELECT*FROM servicio_detalle";
		return ejecutarConsulta($sql);		
	}

		
	//-------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------

	//Implementar un método para listar los registros
	public function listar_serv_web()
	{
		$sql="SELECT*FROM servicio ORDER BY idservicio DESC";
		return ejecutarConsultaArray($sql);		
	}

	//Implementar un método para listar los registros
	public function listar_serv_web_f()
	{
		$sql="SELECT*FROM servicio ORDER BY idservicio DESC LIMIT 3";
		return ejecutarConsultaArray($sql);		
	}

}

?>