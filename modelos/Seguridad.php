<?php
require "../config/Conexion_v2.php";

  class Seguridad
  {
    //Implementamos nuestro variable global
    public $id_usr_sesion;

    //Implementamos nuestro constructor
    public function __construct($id_usr_sesion = 0)
    {
      $this->id_usr_sesion = $id_usr_sesion;
    } 

    public function politicas_paquete(){
      $sql="SELECT * FROM politicas WHERE idpoliticas = '1' AND estado = '1' AND estado_delete = '1';";
      return ejecutarConsultaSimpleFila($sql);
    }
    public function politicas_tours(){
      $sql="SELECT * FROM politicas WHERE idpoliticas = '2' AND estado = '1' AND estado_delete = '1';";
      return ejecutarConsultaSimpleFila($sql);
    }


  }

?>