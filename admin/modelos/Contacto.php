<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion_v2.php";

Class Contacto
{
	//Implementamos nuestro variable global
  public $id_usr_sesion;

  //Implementamos nuestro constructor
  public function __construct($id_usr_sesion = 0)
  {
    $this->id_usr_sesion = $id_usr_sesion;
  }

		//mostrar_comprobante
		public function mostrar(){
		
			$sql="SELECT * FROM nosotros WHERE idnosotros='1'";
			return ejecutarConsultaSimpleFila($sql);
		}
	
		//actualizamos mision y vision
		public function actualizar_mision_vision( $id, $mision, $vision)
		{
			$sql="UPDATE nosotros SET mision='$mision',vision='$vision' WHERE idnosotros='$id'";
			return ejecutarConsulta($sql);
		}
	
		//actualizamos mision y vision
		public function actualizar_ceo_resenia( $id, $palabras_ceo, $resenia_h)
		{
			$sql="UPDATE nosotros SET resenia_historica='$resenia_h', palabras_ceo='$palabras_ceo' WHERE idnosotros='$id'";
			return ejecutarConsulta($sql);
		}
	
		//actualizamos actualizar_datos_generales
		public function actualizar_datos_generales( $id,$direccion,$nombre,$ruc,$celular,$telefono,$latitud,$longuitud,$correo,$horario)
		{
			$sql="UPDATE nosotros SET 
			direccion='$direccion',
			nombre_empresa='$nombre',
			ruc='$ruc',
			celular='$celular',
			telefono_fijo='$telefono',
			correo='$correo',
			horario='$horario',
			latitud='$latitud',
			longitud='$longuitud' 
			WHERE idnosotros ='$id'";
			return ejecutarConsulta($sql);
	
		}
	


}
?>