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

    //Implementamos un método para insertar registros
    public function insertar($nombre,$idtipo_tours,$descripcion,$duracion,$incluye,$no_incluye,$recomendaciones,$actividad,$costo,$estado_descuento,$porcentaje_descuento,$monto_descuento,$imagen,$resumen_actividad,$resumen_comida,$alojamiento)
    {
      // var_dump($nombre,$idtipo_tours,$descripcion,$duracion,$incluye,$no_incluye,$recomendaciones,$actividad,$costo,$estado_descuento,$porcentaje_descuento,$monto_descuento,$imagen);die();
      $sql ="INSERT INTO tours(idtipo_tours, nombre, descripcion, duracion, imagen, actividad, incluye, no_incluye, recomendaciones, costo, estado_descuento, porcentaje_descuento, monto_descuento, resumen_actividad, resumen_comida, alojamiento) 
      VALUES('$idtipo_tours', '$nombre', '$descripcion', '$duracion', '$imagen', '$actividad', '$incluye', '$no_incluye', '$recomendaciones', '$costo', '$estado_descuento', '$porcentaje_descuento', '$monto_descuento', '$resumen_actividad', '$resumen_comida', '$alojamiento')";
      $crear= ejecutarConsulta_retornarID($sql); if ( $crear['status'] == false) {return $crear; }  

      // var_dump($crear);die();

      //add registro en nuestra bitacora
		  $sql_d = "$nombre,$idtipo_tours,$descripcion,$duracion,$incluye,$no_incluye,$recomendaciones,$actividad,$costo,$estado_descuento,$porcentaje_descuento,$monto_descuento,$imagen,$resumen_actividad,$resumen_comida,$alojamiento";

		  $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (5,'idtours','".$crear['data']."','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta_retornarID($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $crear;
    }

    //implementamos un metodo para editar registros
    public function editar($idtours,$nombre,$idtipo_tours,$descripcion,$duracion,$incluye,$no_incluye,$recomendaciones,$actividad,$costo,$estado_descuento,$porcentaje_descuento,$monto_descuento,$imagen,$resumen_actividad,$resumen_comida,$alojamiento)
    {
      // var_dump($idpago_trabajador,$idmes_pago_trabajador_p,$nombre_mes,$monto,$fecha_pago,$descripcion,$comprobante);die();
      $sql="UPDATE tours SET idtipo_tours='$idtipo_tours', nombre='$nombre', descripcion='$descripcion', duracion='$duracion',
      imagen='$imagen', actividad='$actividad', incluye='$incluye', no_incluye='$no_incluye',
      recomendaciones='$recomendaciones', costo='$costo', estado_descuento='$estado_descuento',
      resumen_actividad='$resumen_actividad', resumen_comida='$resumen_comida', alojamiento='$alojamiento',
      porcentaje_descuento='$porcentaje_descuento',monto_descuento='$monto_descuento' WHERE idtours='$idtours';";

      $editar= ejecutarConsulta($sql); if ( $editar['status'] == false) {return $editar; }  

      //add registro en nuestra bitacora
		  $sql_d = "$idtours,$nombre,$idtipo_tours,$descripcion,$duracion,$incluye,$no_incluye,$recomendaciones,$actividad,$costo,$estado_descuento,$porcentaje_descuento,$monto_descuento,$imagen,$resumen_actividad,$resumen_comida,$alojamiento";

		  $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (6,'idtours','$idtours','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $editar;
    }

    //Implementamos un método para desactivar registros
    public function desactivar($idtours){
      // var_dump($idtours);die();
      $sql="UPDATE tours SET estado='0',user_trash= '$this->id_usr_sesion' WHERE idtours='$idtours'";
      $desactivar =  ejecutarConsulta($sql);

      if ( $desactivar['status'] == false) {return $desactivar; }  
      $sql_d = $idtours;

      //add registro en nuestra bitacora
      $sql = "INSERT INTO bitacora_bd(idcodigo,nombre_tabla, id_tabla, sql_d, id_user) VALUES (2,'tours','.$idtours.','$sql_d','$this->id_usr_sesion')";
      $bitacora = ejecutarConsulta($sql); if ( $bitacora['status'] == false) {return $bitacora; }  

      return $desactivar;
    }
    
    //Implementamos un método para activar registros
    public function eliminar($idtours) {
      $sql="UPDATE tours SET estado_delete='0',user_delete= '$this->id_usr_sesion' WHERE idtours='$idtours'";
      $eliminar =  ejecutarConsulta($sql); if ( $eliminar['status'] == false) {return $eliminar; }  

      //add registro en nuestra bitacora
      $sql_d = $idtours;
      $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (4,'tours','$idtours','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $eliminar;
    }
    
    //Implementamos un método para mostrar los datos de un registro a modificar
    public function mostrar($idtours)
    {
      $sql="SELECT * FROM tours WHERE idtours='$idtours'";
      $datostours =ejecutarConsultaSimpleFila($sql); if ( $datostours['status'] == false) {return $datostours; }

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
      ];
      return $retorno=['status'=>true, 'message'=>'todo okey papu','tours'=>$tours];
    }

    //Implementamos un método para listar los registros
    public function tbla_principal(){
      $sql="SELECT t.idtours,t.alojamiento,t.nombre, t.descripcion, t.imagen, t.costo,t.estado_descuento 
      FROM tours as t 
      WHERE t.idtours>1  and t.estado=1 and t.estado_delete=1;";
      return ejecutarConsultaArray($sql);		
    }

    public function obtenerImg($id){
      $sql="SELECT imagen FROM tours WHERE idtours = '$id' ";
      return ejecutarConsultaSimpleFila($sql);  
    }

    //SELEC2 PARA MOSTRAR TIPOS DE TOURS
    public  function selec2tipotours(){
      $sql="SELECT idtipo_tours as id, nombre FROM tipo_tours WHERE estado=1 and estado_delete=1;";
      return ejecutarConsultaArray($sql);	

    }

    //=========================S E C C I O N   G A L E R  I A =============================
    //=========================S E C C I O N   G A L E R  I A =============================

    function insertar_galeria($idtours ,$descripcion_g,$imagen2) {
      $sql="INSERT INTO galeria_tours(idtours, imagen, descripcion) 
      VALUES ('$idtours ','$imagen2','$descripcion_g')";
      return ejecutarConsulta($sql);
    }

    function mostrar_galeria($idtours){
      $sql = "SELECT * FROM galeria_tours WHERE idtours ='$idtours';";
      return ejecutarConsultaArray($sql);
      
    }
    
    function eliminar_imagen($idgaleria_tours){
      
      $sql="SELECT imagen FROM galeria_tours WHERE idgaleria_tours = '$idgaleria_tours'; ";
      $datos_f1 =ejecutarConsultaSimpleFila($sql); if ( $datos_f1['status'] == false) {return $datos_f1; }
      if (!empty($datos_f1)) { unlink("../dist/docs/tours/galeria/" . $datos_f1['data']['imagen']); }

      $sql1="DELETE FROM galeria_tours WHERE idgaleria_tours='$idgaleria_tours';";
      return ejecutarConsulta($sql1);

    }

  }

?>