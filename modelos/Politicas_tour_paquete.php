<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion_v2.php";

Class Politicas_tour_paquete
{
	//Implementamos nuestro variable global
  public $id_usr_sesion;

  //Implementamos nuestro constructor
  public function __construct($id_usr_sesion = 0) {
    $this->id_usr_sesion = $id_usr_sesion;
  }

	// Mostrar datos
	public function politicas_tours()	{
		$sql="SELECT * FROM politicas WHERE idpoliticas ='2'";
		return ejecutarConsultaSimpleFila($sql);
	}

	// Mostrar datos
	public function Politicas_paquetes()	{
		$sql="SELECT * FROM politicas WHERE idpoliticas ='1'";
		return ejecutarConsultaSimpleFila($sql);
	}
	
}
