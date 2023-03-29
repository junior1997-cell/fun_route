<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Contacto
{
	//Implementamos nuestro constructor
	public function __construct() { }

	//mostrar_comprobante
	public function mostrar($id){
		
		$sql="SELECT * FROM contacto WHERE idcontacto='$id' AND idpagina_web = '$id';";
		return ejecutarConsultaSimpleFila($sql);
	}

	//actualizamos mision y vision
	public function actualizar_mision_vision( $id, $mision, $vision)
	{
		$sql="UPDATE contacto SET mision='$mision',vision='$vision' WHERE idcontacto='$id'";
		return ejecutarConsulta($sql);
	}

	//actualizamos mision y vision
	public function actualizar_ceo_resenia( $id, $palabras_ceo, $resenia_h)
	{
		$sql="UPDATE contacto SET reseña_historica='$resenia_h', palabras_ceo='$palabras_ceo' WHERE idcontacto='$id'";
		return ejecutarConsulta($sql);
	}

	//actualizamos actualizar_datos_generales
	public function actualizar_datos_generales( $id, $direcccion,$celular,$telefono,$latitud,$longuitud,$correo,$horario)
	{
		$sql="UPDATE contacto SET 
		direccion='$direcccion',
		celular='$celular',
		telefono_fijo='$telefono',
		correo='$correo',
		horario='$horario',
		latitud='$latitud',
		longitud='$longuitud' 
		 WHERE idcontacto='$id'";
		return ejecutarConsulta($sql);

	}



}

?>