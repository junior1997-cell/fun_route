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

      $sql_2 = "SELECT * FROM galeria_paquete WHERE estado = '1' AND estado_delete = '1' AND idpaquete = '$idpaquete';";
      $galeria = ejecutarConsultaArray($sql_2); if ( $galeria['status'] == false) {return $galeria; }

      $sql_3 = "SELECT it.iditinerario, it.idpaquete, it.idtours, it.actividad, it.numero_orden, t.imagen, t.nombre as nombre_tours 
      FROM itinerario as it, tours as t
      WHERE it.idtours = t.idtours AND it.estado = '1' AND it.estado_delete = '1' AND it.idpaquete = '$idpaquete' ORDER BY it.numero_orden ;";
      $itinerario = ejecutarConsultaArray($sql_3); if ( $itinerario['status'] == false) {return $itinerario; }

      $sql_4 = "SELECT * FROM politicas WHERE idpoliticas ='1'";
      $politica = ejecutarConsultaSimpleFila($sql_4); if ( $politica['status'] == false) {return $politica; }

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
          'imagen'        => $value['imagen'],
          'nombre_tours'  => $value['nombre_tours'],
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
        'politica'              => $politica['data'],
      ];
      return $retorno=['status'=>true, 'message'=>'todo okey','data'=>$paquete];
    }

    public function mostrar_todos(){

      $sql = "SELECT idpaquete,nombre,descripcion,imagen FROM paquete WHERE estado='1' and estado_delete='1';";
      $A_paquetes = ejecutarConsultaArray($sql); if ( $A_paquetes['status'] == false) {return $A_paquetes; }

      $array__paquetes = [];

      foreach ($A_paquetes['data'] as $key => $val) {

        $id=$val['idpaquete'];

        $sql_1 = "SELECT i.idpaquete, t.nombre FROM itinerario as i inner join tours as t  on i.idtours=t.idtours where idpaquete='$id';";
        $Arr_itinerario = ejecutarConsultaArray($sql_1); if ( $Arr_itinerario['status'] == false) {return $Arr_itinerario; }


        $array__paquetes []= [
          'idpaquete'     => $val['idpaquete'],
          'nombre'        => $val['nombre'],
          'descripcion'     => $val['descripcion'],
          'imagen'      => $val['imagen'], 

          'destinos'      => $Arr_itinerario, 
        ];

      }

      return $retorno=[ 'status'=>true, 'message'=>'todo okey','data'=>$array__paquetes ];

    } 

    function mostrar_empresa(){
      $sql = "SELECT direccion, celular, correo FROM nosotros WHERE estado='1' AND estado_delete='1';";
      return ejecutarConsultaSimpleFila($sql);
    }

    //========================= S E C C I O N   G A L E R  I A =============================

    public function mostrar_hoteles(){
      $sql_1 = "SELECT * FROM hoteles as h WHERE h.estado = '1' AND h.estado_delete = '1' order by estrellas asc;";
      $hoteles = ejecutarConsultaArray($sql_1); if ( $hoteles['status'] == false) {return $hoteles; } // Retorna todos los resultados

      $array_hotel = [];

      foreach ($hoteles['data'] as $key => $val) {        

        $estrellasHTML = '';
        for ($i = 0; $i < 5; $i++) {
          if ($i < floatval($val['estrellas']) ) {
            $estrellasHTML .= '<i class="fas fa-star"></i>'; // Estrella llena
          } else {
            $estrellasHTML .= '<i class="far fa-star"></i>'; // Estrella vacía
          }
        }    

        $array_hotel []= [
          'idhoteles'     => $val['idhoteles'],
          'nombre'        => $val['nombre'],
          'estrellas'     => $val['estrellas'],
          'estrellas_html'=> $estrellasHTML,
          'check_in'      => $val['check_in'],
          'check_out'     => $val['check_out'],
          'imagen_perfil' => $val['imagen_perfil'],                   
        ];
      }

      return $retorno=[ 'status'=>true, 'message'=>'todo okey','data'=>$array_hotel ];
    } 

    public function ver_detalle_hotel($id){
      $sql_1 = "SELECT * FROM hoteles as h WHERE h.estado = '1' AND h.estado_delete = '1' AND idhoteles = '$id' ;";
      $hotel = ejecutarConsultaSimpleFila($sql_1); if ( $hotel['status'] == false) {return $hotel; } // Retorna todos los resultados

      $array_hotel = [];             

      $sql_3 = "SELECT * FROM galeria_hotel WHERE estado ='1' AND estado_delete ='1'AND idhoteles = '$id';";
      $galeria_hotel = ejecutarConsultaArray($sql_3); if ( $galeria_hotel['status'] == false) {return $galeria_hotel; }

      $sql_4 = "SELECT * FROM instalaciones_hotel WHERE estado ='1' AND estado_delete ='1' AND idhoteles = '$id' ;";
      $instalaciones_hotel = ejecutarConsultaArray($sql_4); if ( $instalaciones_hotel['status'] == false) {return $instalaciones_hotel; }

      $sql_2 = "SELECT * FROM habitacion WHERE estado ='1' AND estado_delete ='1' AND idhoteles = '$id';";
      $habitacion = ejecutarConsultaArray($sql_2); if ( $habitacion['status'] == false) {return $habitacion; }

      $array_habitacion = [];
      foreach ($habitacion['data'] as $key2 => $val2) {
        $id_i = $val2['idhabitacion'];
        $sql_5 = "SELECT * FROM detalle_habitacion WHERE estado ='1' AND estado_delete ='1' AND idhabitacion = '$id_i'";
        $detalle_habitacion = ejecutarConsultaArray($sql_5); if ( $detalle_habitacion['status'] == false) {return $detalle_habitacion; }

        $array_habitacion []= [
          'idhabitacion'        => $val2['idhabitacion'],
          'idhoteles'           => $val2['idhoteles'],
          'nombre'              => $val2['nombre'],

          'detalle_habitacion'  => $detalle_habitacion['data'],                     
        ];
      }

      $estrellasHTML = '';
      for ($i = 0; $i < 5; $i++) {
        if ($i < floatval($hotel['data']['estrellas']) ) {
          $estrellasHTML .= '<i class="fas fa-star"></i>'; // Estrella llena
        } else {
          $estrellasHTML .= '<i class="far fa-star"></i>'; // Estrella vacía
        }
      }    

      $array_hotel = [
        'idhoteles'     => $hotel['data']['idhoteles'],
        'nombre'        => $hotel['data']['nombre'],
        'estrellas'     => $hotel['data']['estrellas'],
        'estrellas_html'=> $estrellasHTML,
        'check_in'      => $hotel['data']['check_in'],
        'check_out'     => $hotel['data']['check_out'],

        'imagen_perfil' => $hotel['data']['imagen_perfil'],
        
        'galeria_hotel' => $galeria_hotel['data'],
        'instalaciones_hotel'  => $instalaciones_hotel['data'],  
        'habitacion'    => $array_habitacion,        
      ];
      

      return $retorno=[ 'status'=>true, 'message'=>'todo okey','data'=>$array_hotel ];
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

    //========================= S E C C I O N   P E D I D O =============================
    function crear_pedido($idpaquete, $nombre, $correo, $telefono, $mensaje){
      $sql = "INSERT INTO pedido_paquete(idpaquete, nombre, correo, telefono, descripcion) VALUES 
      ('$idpaquete','$nombre','$correo','$telefono','$mensaje');";
      return ejecutarConsulta($sql);      
    }
    

  }

?>