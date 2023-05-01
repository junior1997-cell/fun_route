<?php
  //Incluímos inicialmente la conexión a la base de datos
  require "../config/Conexion_v2.php";
  // global $total;
  class Itinerario
  {

    //Implementamos nuestro variable global
    public $id_usr_sesion;

    //Implementamos nuestro constructor
    public function __construct($id_usr_sesion = 0)
    {
      $this->id_usr_sesion = $id_usr_sesion;
    }

    //Implementamos un método para insertar registros
    public function insertar($idpaquete, $mapa, $incluye, $no_incluye, $recomendaciones)
    {
      $sql ="INSERT INTO itinerario( idpaquete, mapa, incluye, no_incluye, recomendaciones) VALUES
       ('1','$mapa','$incluye','$no_incluye','$recomendaciones')";
     $insertar =  ejecutarConsulta($sql);	if ( $insertar['status'] == false) {return $insertar; } 
	
     //add registro en nuestra bitacora
     $sql_d = $idpaquete.', '  .$mapa.', ' .$incluye.', '. $no_incluye.', '. $recomendaciones;
     $sql_bit = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (5, 'itinerario','".$insertar['data']."','$sql_d','$this->id_usr_sesion')";
     $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
   
     return $insertar;
    }
    
    //implementamos un metodo para editar registros
    public function editar($iditinerario,$idpaquete,$mapa, $incluye, $no_incluye, $recomendaciones)
    {
      // var_dump($idpago_trabajador,$idmes_pago_trabajador_p,$nombre_mes,$monto,$fecha_pago,$descripcion,$comprobante);die();
      $sql="UPDATE itinerario SET idpaquete='$idpaquete',mapa='$mapa',
      incluye='$incluye',no_incluye='$no_incluye',recomendaciones='$recomendaciones'
      WHERE iditinerario='$iditinerario';";
      return ejecutarConsulta($sql);
    }

    //Implementamos un método para desactivar registros
    public function desactivar($iditinerario)
    {
      $sql="UPDATE itinerario SET estado='0',user_trash= '$this->id_usr_sesion' WHERE iditinerario='$iditinerario'";
      $desactivar =  ejecutarConsulta($sql);

      if ( $desactivar['status'] == false) {return $desactivar; }  

      //add registro en nuestra bitacora
		  $sql_d = $iditinerario;

		  $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (2,'itinerario','$iditinerario','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $desactivar;
    }
    
    //Implementamos un método para activar registros
    public function eliminar($iditinerario) {
      //var_dump($iditinerario);die;
      $sql="UPDATE itinerario SET estado_delete='0',user_delete= '$this->id_usr_sesion' WHERE iditinerario='$iditinerario'";
      $eliminar =  ejecutarConsulta($sql);
      
      if ( $eliminar['status'] == false) {return $eliminar; }  

      $sql_d = $iditinerario;

		  $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (4,'itinerario','$iditinerario','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $eliminar;
    }
    //Implementamos un método para mostrar los datos de un registro a modificar
    public function mostrar($iditinerario)
    {
      $sql="SELECT * FROM itinerario WHERE iditinerario='$iditinerario'";
      return ejecutarConsultaSimpleFila($sql);
    }

    //Implementamos un método para listar los registros
    public function tbla_principal()
    {
      $sql="SELECT * FROM itinerario WHERE idpaquete=1 AND estado='1' AND estado_delete='1'";
      return ejecutarConsultaArray($sql);		
    }
    //total pagos por  total_pago_trabajador
    public function total_pago_trabajador($idmes_pago_trabajador)
    {
      $sql="SELECT SUM(monto) as total FROM pago_trabajador WHERE estado =1 AND estado_delete=1 AND idmes_pago_trabajador='$idmes_pago_trabajador'";
      return ejecutarConsultaSimpleFila($sql);  

    }
    public function obtenerImg($id){
      $sql="SELECT imagen FROM paquete WHERE idpaquete = '$id' ";
      return ejecutarConsultaSimpleFila($sql);  
    }

  }

?>
