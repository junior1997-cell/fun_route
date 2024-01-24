<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion_v2.php";

Class Contacto
{
	//Implementamos nuestro variable global
  public $id_usr_sesion;

  //Implementamos nuestro constructor
  public function __construct($id_usr_sesion = 0)  {
    $this->id_usr_sesion = $id_usr_sesion;
  }

	//mostrar_comprobante
	public function mostrar(){
	
		$sql="SELECT * FROM nosotros WHERE idnosotros='1'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//actualizamos mision y vision
	public function actualizar_mision_vision( $id, $mision, $vision, $valores)	{
		$sql="UPDATE nosotros SET mision='$mision', vision='$vision', valores='$valores', user_updated ='$this->id_usr_sesion' WHERE idnosotros='$id'";
		return ejecutarConsulta($sql);
	}

	//actualizamos mision y vision
	public function actualizar_ceo_resenia( $id, $palabras_ceo, $nombre_ceo, $resenia_h, $imagen1)	{
		$sql="UPDATE nosotros SET resenia_historica='$resenia_h', nombre_ceo='$nombre_ceo', 
		palabras_ceo='$palabras_ceo', perfil_ceo='$imagen1', user_updated ='$this->id_usr_sesion'  WHERE idnosotros='$id'";
		return ejecutarConsulta($sql);
	}
	
	//actualizamos actualizar_datos_generales
	public function actualizar_datos_generales( $id,$direccion,$nombre,$tipo_documento, $num_documento,$celular,$telefono,$latitud,$longuitud,$correo,$horario, $rs_facebook,$rs_instagram,$rs_tiktok) {
		$sql="UPDATE nosotros SET direccion='$direccion', nombre_empresa='$nombre', tipo_documento = '$tipo_documento',	num_documento='$num_documento',	
		celular='$celular',	telefono_fijo='$telefono', correo='$correo', horario='$horario',	latitud='$latitud',	longitud='$longuitud', user_updated ='$this->id_usr_sesion',
		rs_facebook='$rs_facebook', rs_instagram='$rs_instagram', rs_tiktok='$rs_tiktok'
		WHERE idnosotros ='$id'";
		return ejecutarConsulta($sql);

	}
}
?>