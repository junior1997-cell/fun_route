<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion_v2.php";

Class Politicas
{
	//Implementamos nuestro variable global
  public $id_usr_sesion;

  //Implementamos nuestro constructor
  public function __construct($id_usr_sesion = 0)
  {
    $this->id_usr_sesion = $id_usr_sesion;
  }

		//mostrar_comprobante
		public function mostrar($idpolitica){
		
			$sql="SELECT * FROM politicas WHERE idpoliticas='$idpolitica';";
			return ejecutarConsultaSimpleFila($sql);
		}
	
		//actualizamos condiciones y reservas
		public function actualizar_politicas( $id, $condiciones, $reservas, $pago, $cancelacion)
		{
			$sql="UPDATE politicas SET condiciones_generales='$condiciones', reservas='$reservas', pago='$pago', cancelacion='$cancelacion' WHERE idpoliticas='$id'";
			return ejecutarConsulta($sql);
		}

		public function actualizar_politicas_tours ( $id, $reservas_tours,$cancelacion_tours,$cancelacion_proveedor_tours,$responsabilidad_proveedor_tours,$responsabilidad_cliente_tours )
		{
			$sql="UPDATE politicas SET reservas='$reservas_tours',
			cancelacion='$cancelacion_tours',responsabilidad_cliente='$responsabilidad_cliente_tours',responsabilidad_proveedor='$responsabilidad_proveedor_tours',
			cancelaiones_proveedor='$cancelacion_proveedor_tours' WHERE idpoliticas='$id'";
			return ejecutarConsulta($sql);

			
		}
	
		//actualizamos ceo
		/* 
				public function actualizar_ceo_resenia( $id, $palabras_ceo, $resenia_h)
				{
					$sql="UPDATE politicas SET resenia_historica='$resenia_h', palabras_ceo='$palabras_ceo' WHERE idpoliticas='$id'";
					return ejecutarConsulta($sql);
				} 
		*/
	
		//actualizamos actualizar_datos_generales
		public function actualizar_datos_generales( $id, $condiciones, $reservas, $pago, $cancelacion )
		{
			$sql="UPDATE politicas SET 
			condiciones_generales='$condiciones',
			reservas='$reservas',
			pago='$pago',
			cancelacion='$cancelacion'
			WHERE idpoliticas ='$id'";
			return ejecutarConsulta($sql);
	
		}
	


}
?>