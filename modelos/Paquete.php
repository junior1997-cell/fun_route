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

      $sql_2="SELECT * FROM galeria_paquete WHERE estado = '1' AND estado_delete = '1' AND idpaquete = '$idpaquete';";
      $galeria = ejecutarConsultaArray($sql_2); if ( $galeria['status'] == false) {return $galeria; }

      $sql_3="SELECT * FROM itinerario WHERE estado = '1' AND estado_delete = '1' AND idpaquete = '$idpaquete' ORDER BY numero_orden ;";
      $itinerario = ejecutarConsultaArray($sql_3); if ( $itinerario['status'] == false) {return $itinerario; }
      
      $array_iti = [];
      foreach ($itinerario['data'] as $key => $value) {
        $id = $value['idtours'];
        $sql_2="SELECT * FROM galeria_tours WHERE estado = '1' AND estado_delete = '1' AND idtours = '$id';";
        $gal_tours = ejecutarConsultaArray($sql_2); if ( $gal_tours['status'] == false) {return $gal_tours; }
        $array_iti []= [
          'iditinerario'  => $value['iditinerario'],
          'idpaquete'     => $value['idpaquete'],
          'idtours'       => $value['idtours'],
          'actividad'     => $value['actividad'],
          'numero_orden'  => $value['numero_orden'],
          'galeria'       => $gal_tours['data'],
        ];
      }

      $paquete = [
        'idpaquete'             => $datospaquete['data']['idpaquete'],
        'nombre'                => $datospaquete['data']['nombre'],
        'cant_dias'             => $datospaquete['data']['cant_dias'],
        'cant_noches'           => $datospaquete['data']['cant_noches'],
        'alimentacion'          => $datospaquete['data']['alimentacion'],
        'alojamiento'           => $datospaquete['data']['alojamiento'],

        'descripcion'           => $datospaquete['data']['descripcion'],
        'imagen'                => $datospaquete['data']['imagen'],
        'incluye'               => $datospaquete['data']['incluye'],
        'no_incluye'            => $datospaquete['data']['no_incluye'],
        'recomendaciones'       => $datospaquete['data']['recomendaciones'],
        'mapa'                  => $datospaquete['data']['mapa'],
        'costo'                 => $datospaquete['data']['costo'],
        'estado_descuento'      => $datospaquete['data']['estado_descuento'],

        'porcentaje_descuento'  => $datospaquete['data']['porcentaje_descuento'],
        'monto_descuento'       => $datospaquete['data']['monto_descuento'],
        'resumen'               => $datospaquete['data']['resumen'],
        'desc_alojamiento'      => $datospaquete['data']['desc_alojamiento'],
        'desc_comida'           => $datospaquete['data']['desc_comida'],

        'galeria'               => $galeria['data'],
        'itinerario'            => $array_iti,
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