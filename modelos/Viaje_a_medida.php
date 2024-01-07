<?php
  //Incluímos inicialmente la conexión a la base de datos
  require "../config/Conexion_v2.php";
  // global $total;
  class Viaje_a_medida
  {

    //Implementamos nuestro variable global
    public $id_usr_sesion;

    //Implementamos nuestro constructor
    public function __construct($id_usr_sesion = 0)
    {
      $this->id_usr_sesion = $id_usr_sesion;
    }  
    
    public function agregar_y_editar_viaje($idtours, $otro_lugar, $tipo_viaje, $ocacion_viaje, $presupuesto, $tipo_hotel, $p_nombre, $p_correo, $p_celular, 
    $p_tipo_contacto, $p_descripcion) {
      $sql = "INSERT INTO paquete_a_medida(otro_lugar, tipo_viaje, ocacion_viaje, presupuesto, tipo_hotel, p_nombre, p_celular, p_correo, p_tipo_contacto, p_descripcion) VALUES 
      ('$otro_lugar', '$tipo_viaje','$ocacion_viaje','$presupuesto','$tipo_hotel','$p_nombre','$p_celular','$p_correo','$p_tipo_contacto','$p_descripcion')";
      $crear = ejecutarConsulta_retornarID($sql); if ( $crear['status'] == false) {return $crear; }

      //add registro en nuestra bitacora
		  $sql_d = "$tipo_viaje, $ocacion_viaje, $presupuesto, $tipo_hotel, $p_nombre, $p_correo, $p_celular, $p_tipo_contacto";

		  $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (5,'paquete_a_medida','".$crear['data']."','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta_retornarID($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }

      $ii = 0;
      $compra_new = "No hay ID";

      if ( !empty($crear['data']) ) {
      
        while ($ii < count($idtours)) {

          $id = $crear['data'];

          $sql_detalle = "INSERT INTO lugar_a_conocer( idtours, idpaquete_a_medida) VALUES ('$idtours[$ii]','$id')";
          $compra_new =  ejecutarConsulta($sql_detalle); if ($compra_new['status'] == false) { return  $compra_new;}
      
          $ii = $ii + 1;
        }
      }
      return $compra_new;
    }
    
    //========================= S E C C I O N   V I A J E =============================

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
      $sql = "SELECT t.idtours, t.idtipo_tours, t.nombre, t.descripcion, t.imagen, t.actividad, t.incluye, t.no_incluye, 
      t.recomendaciones, t.duracion, t.alojamiento, t.resumen_actividad, t.resumen_comida, t.mapa, t.costo, t.estado_descuento, 
      t.porcentaje_descuento, t.monto_descuento, tt.nombre as tipo_tours 
      FROM tours as t, tipo_tours as tt 
      WHERE t.idtipo_tours = tt.idtipo_tours AND t.estado = '1' AND t.estado_delete = '1'; ";
      return ejecutarConsultaArray($sql); // Retorna todos los resultados
    } 

    //========================= S E C C I O N   G A L E R  I A =============================

    function mostrar_galeria($idtours){
      $sql = "SELECT * FROM galeria_tours WHERE idtours ='$idtours';";
      return ejecutarConsultaArray($sql);      
    }

    //========================= S E C C I O N   P E D I D O =============================
    function crear_pedido($idtours, $nombre, $correo, $telefono, $mensaje){
      $sql = "INSERT INTO pedido_tours(idtours, nombre, correo, telefono, descripcion) VALUES 
      ('$idtours','$nombre','$correo','$telefono','$mensaje');";
      return ejecutarConsulta($sql);      
    }

  }

?>