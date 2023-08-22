<?php
  //Incluímos inicialmente la conexión a la base de datos
  require "../config/Conexion_v2.php";
  // global $total;
  class Paquete
  {

    //Implementamos nuestro variable global
    public $id_usr_sesion;

    //Implementamos nuestro constructor
    public function __construct($id_usr_sesion = 0)
    {
      $this->id_usr_sesion = $id_usr_sesion;
    }   
    
    //========================= S E C C I O N   T O U R S =============================

    //Implementamos un método para mostrar los datos de un registro a modificar
    public function mostrar_detalle($idpaquete) {
      $sql="SELECT * FROM paquete WHERE idpaquete='$idpaquete'";
      $datospaquete = ejecutarConsultaSimpleFila($sql); if ( $datospaquete['status'] == false) {return $datospaquete; }

      $sql_2="SELECT * FROM `galeria_paquete` WHERE estado = '1' AND estado_delete = '1' AND idpaquete = '$idpaquete';";
      $galeria = ejecutarConsultaArray($sql_2); if ( $galeria['status'] == false) {return $galeria; }

      $paquete = [
        'idpaquete'              => $datospaquete['data']['idpaquete'],
        'idtipo_paquete'         => $datospaquete['data']['idtipo_paquete'],
        'nombre'               => $datospaquete['data']['nombre'],
        'duracion'             => $datospaquete['data']['duracion'],
        'descripcion'          => $datospaquete['data']['descripcion'],
        'imagen'               => $datospaquete['data']['imagen'],

        'incluye'              => $datospaquete['data']['incluye'],
        'no_incluye'           => $datospaquete['data']['no_incluye'],
        'recomendaciones'      => $datospaquete['data']['recomendaciones'],
        'actividad'            => $datospaquete['data']['actividad'],
        'costo'                => $datospaquete['data']['costo'],
        'estado_descuento'     => $datospaquete['data']['estado_descuento'],
        'porcentaje_descuento' => $datospaquete['data']['porcentaje_descuento'],
        'monto_descuento'      => $datospaquete['data']['monto_descuento'],

        'resumen_actividad'    => $datospaquete['data']['resumen_actividad'],
        'resumen_comida'       => $datospaquete['data']['resumen_comida'],
        'alojamiento'          => $datospaquete['data']['alojamiento'],

        'galeria'             => $galeria['data'],
      ];
      return $retorno=['status'=>true, 'message'=>'todo okey','data'=>$paquete];
    }

    public function mostrar_todos(){
      $sql = "SELECT * FROM paquete WHERE estado = '1' and estado_delete = '1'; ";
      return ejecutarConsultaArray($sql); // Retorna todos los resultados
    } 

    //========================= S E C C I O N   G A L E R  I A =============================

    function mostrar_galeria_5_aleatorios(){
      $sql = "SELECT * FROM galeria_paquete WHERE estado = '1' AND estado_delete = '1' ORDER BY rand() ASC LIMIT 5;";
      return ejecutarConsultaArray($sql);      
    }

    function mostrar_galeria_20_aleatorios(){
      $sql = "SELECT * FROM galeria_paquete WHERE estado = '1' AND estado_delete = '1' ORDER BY rand() ASC LIMIT 20;";
      return ejecutarConsultaArray($sql);      
    }
    

  }

?>