<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion_v2.php";

Class Nosotros
{
	//Implementamos nuestro variable global
  public $id_usr_sesion;

  //Implementamos nuestro constructor
  public function __construct($id_usr_sesion = 0) {
    $this->id_usr_sesion = $id_usr_sesion;
  }

	// Mostrar datos
	public function mostrar()	{
		$sql="SELECT * FROM nosotros WHERE idnosotros='1'";
		return ejecutarConsultaSimpleFila($sql);
	}
}
