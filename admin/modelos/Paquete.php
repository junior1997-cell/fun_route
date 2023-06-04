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

    //Implementamos un método para insertar registros
    public function insertar($nombre,$cant_dias,$cant_noches,$descripcion, $imagen1,$incluye,$no_incluye,$recomendaciones,
    $mapa,$costo,$estado_descuento,$porcentaje_descuento,$monto_descuento,$idtours,$nombre_tours,$numero_orden,$actividad)
    {

      $sql ="INSERT INTO paquete ( nombre, descripcion, imagen, incluye, no_incluye, recomendaciones,mapa, costo,estado_descuento, porcentaje_descuento, monto_descuento) 
      VALUES('$nombre', '$descripcion', '$imagen1', '$incluye', '$no_incluye', '$recomendaciones','$mapa', '$costo','$estado_descuento', '$porcentaje_descuento', '$monto_descuento')";
      $crear= ejecutarConsulta_retornarID($sql); if ( $crear['status'] == false) {return $crear; }  

      //add registro en nuestra bitacora
		  $sql_d = "$nombre,$cant_dias,$cant_noches,$descripcion, $imagen1,$incluye,$no_incluye,$recomendaciones,$mapa,$costo,$estado_descuento,$porcentaje_descuento,$monto_descuento";

		  $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (5,'idpaquete','".$crear['data']."','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta_retornarID($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }
      
      $num_elementos = 0;
      $sw = true;
      // var_dump(count($idtours));die();
      while ($num_elementos < count($idtours)) {

        $sql = "INSERT INTO itinerario(idpaquete, idtours, actividad, numero_orden) 
        VALUES ('".$crear['data']."','$idtours[$num_elementos]','$actividad[$num_elementos]','$numero_orden[$num_elementos]')";
        $sw = ejecutarConsulta_retornarID($sql); if ($sw['status'] == false) {    return $sw ; }
        # code...
        $idpaquete = $sw['data'];
        //add registro en nuestra bitacora
        $sql_d = $crear['data'].' '.'$idtours[$num_elementos]'.' '.'$actividad[$num_elementos]'.' '.'$numero_orden[$num_elementos]';

        $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (5,'itinerario','$idpaquete','$sql_d','$this->id_usr_sesion')";
        $bitacora = ejecutarConsulta_retornarID($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }

        $num_elementos = $num_elementos + 1;
        
      }    
		
		  return $sw;
    }

    //implementamos un metodo para editar registros
    public function editar(
      $idpaquete,$nombre, $cant_dias, $cant_noches, $descripcion, $imagen1, $incluye, $no_incluye, 
            $recomendaciones, $mapa, $costo, $estado_descuento, $porcentaje_descuento,$monto_descuento, $iditinerario,$idtours,
            $nombre_tours,$numero_orden,$actividad )
    {
      // var_dump($idtours,$numero_orden);die();
      //Eliminamos todos los registros de itinerario
      $sqldel = "DELETE FROM itinerario WHERE idpaquete='$idpaquete';";
      $delete = ejecutarConsulta($sqldel); if ( $delete['status'] == false ) { return $delete; }

      // var_dump($idpago_trabajador,$idmes_pago_trabajador_p,$nombre_mes,$monto,$fecha_pago,$descripcion,$comprobante);die();
      $sql="UPDATE paquete SET 
      nombre='$nombre', cant_dias='$cant_dias', cant_noches='$cant_noches',descripcion='$descripcion',
      imagen='$imagen1',incluye='$incluye',no_incluye='$no_incluye',recomendaciones='$recomendaciones',
      mapa='$mapa',costo='$costo',estado_descuento='$estado_descuento',
      porcentaje_descuento='$porcentaje_descuento',monto_descuento='$monto_descuento' WHERE idpaquete='$idpaquete';";
      $crear= ejecutarConsulta($sql); if ( $crear['status'] == false) {return $crear; }  

      //add registro en nuestra bitacora
		  $sql_d = "$idpaquete,$nombre,$cant_dias,$cant_noches,$descripcion, $imagen1,$incluye,$no_incluye,$recomendaciones,$mapa,$costo,$estado_descuento,$porcentaje_descuento,$monto_descuento";

		  $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (6,'idpaquete','$idpaquete','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; } 
      

      $num_elementos = 0;
      $sw = true;
      // var_dump(count($idtours));die();
      while ($num_elementos < count($idtours)) {

        $sql = "INSERT INTO itinerario(idpaquete, idtours, actividad, numero_orden) 
        VALUES ('$idpaquete','$idtours[$num_elementos]','$actividad[$num_elementos]','$numero_orden[$num_elementos]')";
        $sw = ejecutarConsulta_retornarID($sql); if ($sw['status'] == false) {    return $sw ; }
        # code...
        $itinerario = $sw['data'];
        //add registro en nuestra bitacora
        $sql_d = $idpaquete.' '.'$idtours[$num_elementos]'.' '.'$actividad[$num_elementos]'.' '.'$numero_orden[$num_elementos]';

        $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (5,'itinerario','$itinerario','$sql_d','$this->id_usr_sesion')";
        $bitacora = ejecutarConsulta_retornarID($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }

        $num_elementos = $num_elementos + 1;
        
      }    
		
		  return $sw;
    }

    //Implementamos un método para desactivar registros
    public function desactivar($idpaquete)
    {
      $sql="UPDATE paquete SET estado='0',user_trash= '$this->id_usr_sesion' WHERE paquete='$idpaquete'";
      $desactivar =  ejecutarConsulta($sql);

      if ( $desactivar['status'] == false) {return $desactivar; }  
      $sql_d = $idpaquete;

      //add registro en nuestra bitacora
      $sql = "INSERT INTO bitacora_bd( nombre_tabla, id_tabla, accion, id_user) VALUES ('paquete','.$idpaquete.','Desativar el registro Trabajador','$this->id_usr_sesion')";
      $bitacora = ejecutarConsulta($sql); if ( $bitacora['status'] == false) {return $bitacora; }  

      return $desactivar;
    }
    
    //Implementamos un método para activar registros
    public function eliminar($idpaquete) {
      $sql="UPDATE paquete SET estado_delete='0',user_delete= '$this->id_usr_sesion' WHERE idpaquete='$idpaquete'";
      $eliminar =  ejecutarConsulta($sql); if ( $eliminar['status'] == false) {return $eliminar; }  

      //add registro en nuestra bitacora
      $sql_d = $idpaquete;
      $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (4,'paquete','$idpaquete','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $eliminar;
    }
    
    //Implementamos un método para mostrar los datos de un registro a modificar
    public function mostrar($idpaquete)
    {
      $data =[];

      $sql="SELECT * FROM paquete WHERE idpaquete='$idpaquete'";
      $datospaquete =ejecutarConsultaSimpleFila($sql); if ( $datospaquete['status'] == false) {return $datospaquete; }

      $sql_1="SELECT i.iditinerario,i.idpaquete,i.idtours,i.actividad,i.numero_orden ,t.nombre as turs
      FROM itinerario as i, tours as t 
      WHERE i.idtours=t.idtours and i.idpaquete='$idpaquete';";
      $data_itinerario =ejecutarConsultaArray($sql_1); if ( $data_itinerario['status'] == false) {return $data_itinerario; }

      foreach ($data_itinerario['data'] as $key => $value) {
        
        $data[] = array(
          'orden'           => $key+1,
          'iditinerario'    => $value['iditinerario'],  
          'idpaquete_i'     => $value['idpaquete'], 
          'idtours'         => $value['idtours'], 
          'turs'            => $value['turs'], 
          'actividad'       => $value['actividad'], 
          'numero_orden'    => $value['numero_orden'], 
           
        );
      }
        $paquete = [
          'idpaquete'         => $datospaquete['data']['idpaquete'],
          'nombre'            => $datospaquete['data']['nombre'],
          'cant_dias'         => $datospaquete['data']['cant_dias'],
          'cant_noches'       => $datospaquete['data']['cant_noches'],
          'descripcion'       => $datospaquete['data']['descripcion'],
          'imagen'            => $datospaquete['data']['imagen'],

          'incluye'              => $datospaquete['data']['incluye'],
          'no_incluye'           => $datospaquete['data']['no_incluye'],
          'recomendaciones'      => $datospaquete['data']['recomendaciones'],
          'mapa'                 => $datospaquete['data']['mapa'],
          'costo'                => $datospaquete['data']['costo'],
          'estado_descuento'     => $datospaquete['data']['estado_descuento'],
          'porcentaje_descuento' => $datospaquete['data']['porcentaje_descuento'],
          'monto_descuento'      => $datospaquete['data']['monto_descuento'],

        ];
      
      return $retorno=['status'=>true, 'message'=>'todo oka ps', 'itinerario'=>$data,'paquete'=>$paquete];

    }

    //Implementamos un método para listar los registros
    public function tbla_principal()
    {
      $sql="SELECT idpaquete, nombre, cant_dias,cant_noches, descripcion, imagen,
       costo,estado_descuento, porcentaje_descuento, monto_descuento
      FROM paquete WHERE estado = 1 and estado_delete = 1";
      return ejecutarConsultaArray($sql);		
    }

    public function obtenerImg($id){
      $sql="SELECT imagen FROM paquete WHERE idpaquete = '$id' ";
      return ejecutarConsultaSimpleFila($sql);  
    }

    //==========S E C C I O N   I T I N E R A R I O ==========

    // Consulta ID TOURS
    public  function selec2tours()
    {
      // var_dump($id);die();
      $sql="SELECT idtours as id, nombre FROM tours WHERE idtours!= 1 and estado=1 and estado_delete=1;";
      return ejecutarConsultaArray($sql);	
      // var_dump($id);die();
    }
    // Consulta Actividad
    public  function ver_actividad($idtours)
    {
      //var_dump($idtours);die();
      $sql="SELECT idtours, nombre, actividad FROM tours WHERE idtours='$idtours';";
      return ejecutarConsultaSimpleFila($sql);	

    }

  }

?>
