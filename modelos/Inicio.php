<?php
  //Incluímos inicialmente la conexión a la base de datos
  require "../config/Conexion_v2.php";
  // global $total;
  class Inicio
  {

    //Implementamos nuestro constructor
    public function __construct(){}   
    
    public function mostrar_paquetes(){
      $sql = "SELECT nombre, imagen FROM paquete WHERE estado=1 and estado_delete='1';";
      return ejecutarConsultaArray($sql); 
    } 
    public function mostrar_tours(){

        $sql="SELECT nombre,descripcion,imagen,duracion,costo FROM tours WHERE estado='1' and estado_delete='1';";
        return ejecutarConsultaArray($sql);
    }

  }

?>