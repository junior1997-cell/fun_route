<?php
  //Incluímos inicialmente la conexión a la base de datos
  require "../config/Conexion_v2.php";
  // global $total;
  class Tours
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
    public function mostrar_detalle($idtours) {
      $sql="SELECT * FROM tours WHERE idtours='$idtours'";
      $datostours = ejecutarConsultaSimpleFila($sql); if ( $datostours['status'] == false) {return $datostours; }

      $sql_2="SELECT * FROM `galeria_tours` WHERE estado = '1' AND estado_delete = '1' AND idtours = '$idtours';";
      $galeria = ejecutarConsultaArray($sql_2); if ( $galeria['status'] == false) {return $galeria; }

      $tours = [
        'idtours'              => $datostours['data']['idtours'],
        'idtipo_tours'         => $datostours['data']['idtipo_tours'],
        'nombre'               => $datostours['data']['nombre'],
        'duracion'             => $datostours['data']['duracion'],
        'descripcion'          => $datostours['data']['descripcion'],
        'imagen'               => $datostours['data']['imagen'],

        'incluye'              => $datostours['data']['incluye'],
        'no_incluye'           => $datostours['data']['no_incluye'],
        'recomendaciones'      => $datostours['data']['recomendaciones'],
        'actividad'            => $datostours['data']['actividad'],
        'costo'                => $datostours['data']['costo'],
        'estado_descuento'     => $datostours['data']['estado_descuento'],
        'porcentaje_descuento' => $datostours['data']['porcentaje_descuento'],
        'monto_descuento'      => $datostours['data']['monto_descuento'],

        'resumen_actividad'    => $datostours['data']['resumen_actividad'],
        'resumen_comida'       => $datostours['data']['resumen_comida'],
        'alojamiento'          => $datostours['data']['alojamiento'],

        'galeria'             => $galeria['data'],
      ];
      return $retorno=['status'=>true, 'message'=>'todo okey','data'=>$tours];
    }

    public function mostrar_todos(){
      $sql = "SELECT * FROM tours WHERE estado = '1' and estado_delete = '1'; ";
      return ejecutarConsultaArray($sql); // Retorna todos los resultados
    } 

    //========================= S E C C I O N   G A L E R  I A =============================

    function mostrar_galeria($idtours){
      $sql = "SELECT * FROM galeria_tours WHERE idtours ='$idtours';";
      return ejecutarConsultaArray($sql);
      
    }
    

  }

?>