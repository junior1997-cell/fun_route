<?php
  //Incluímos inicialmente la conexión a la base de datos
  require "../config/Conexion_v2.php";
  // global $total;
  class Comentario
  {

    //Implementamos nuestro variable global
    public $id_usr_sesion;

    //Implementamos nuestro constructor
    public function __construct($id_usr_sesion = 0)
    {
      $this->id_usr_sesion = $id_usr_sesion;
    }

    //Implementamos un método para insertar registros
    public function insertar($nombre, $correo, $comentario, $fecha, $estrella)
    {
      $sql ="INSERT INTO `comentario`(`nombre`, `correo`, `comentario`, `fecha`, `estrella`) VALUES ('$nombre','$correo','$comentario','$fecha','$estrella')";
      return ejecutarConsulta($sql);
    }

    //implementamos un metodo para editar registros
    public function editar($idcomentario,$idpaquete, $nombre, $correo, $comentario, $fecha, $estrella)
    {
      // var_dump($idpago_trabajador,$idmes_pago_trabajador_p,$nombre_mes,$monto,$fecha_pago,$descripcion,$comprobante);die();
      $sql="";
      return ejecutarConsulta($sql);
    }

    //Implementamos un método para desactivar registros
    public function desactivar_pago($idpago_trabajador)
    {
      $sql="UPDATE pago_trabajador SET estado='0',user_trash= '$this->id_usr_sesion' WHERE idpago_trabajador='$idpago_trabajador'";
      $desactivar =  ejecutarConsulta($sql);

      if ( $desactivar['status'] == false) {return $desactivar; }  

      //add registro en nuestra bitacora
      $sql = "INSERT INTO bitacora_bd( nombre_tabla, id_tabla, accion, id_user) VALUES ('pago_trabajador','.$idpago_trabajador.','Desativar el registro Trabajador','$this->id_usr_sesion')";
      $bitacora = ejecutarConsulta($sql); if ( $bitacora['status'] == false) {return $bitacora; }  

      return $desactivar;
    }
    
    //Implementamos un método para activar registros
    public function eliminar_pago($idpago_trabajador) {
      $sql="UPDATE pago_trabajador SET estado_delete='0',user_delete= '$this->id_usr_sesion' WHERE idpago_trabajador='$idpago_trabajador'";
      $eliminar =  ejecutarConsulta($sql);
      
      if ( $eliminar['status'] == false) {return $eliminar; }  

      //add registro en nuestra bitacora
      $sql = "INSERT INTO bitacora_bd( nombre_tabla, id_tabla, accion, id_user) VALUES ('pago_trabajador','.$idpago_trabajador.','Eliminar registro Trabajador','$this->id_usr_sesion')";
      $bitacora = ejecutarConsulta($sql); if ( $bitacora['status'] == false) {return $bitacora; }  

      return $eliminar;
    }
    //Implementamos un método para mostrar los datos de un registro a modificar
    public function mostrar_pago($idpago_trabajador)
    {
      $sql="SELECT * FROM pago_trabajador WHERE idpago_trabajador='$idpago_trabajador'";
      return ejecutarConsultaSimpleFila($sql);
    }

    //Implementamos un método para listar los registros
    public function tbla_principal()
    {
      $sql="SELECT `idcomentario`, `idpaquete`, `nombre`, `correo`, `comentario`, `fecha`, `estrella` FROM `comentario` WHERE estado = 1 and estado_delete = 1";
      return ejecutarConsultaArray($sql);		
    }
    //total pagos por  total_pago_trabajador
    public function total_pago_trabajador($idmes_pago_trabajador)
    {
      $sql="SELECT SUM(monto) as total FROM pago_trabajador WHERE estado =1 AND estado_delete=1 AND idmes_pago_trabajador='$idmes_pago_trabajador'";
      return ejecutarConsultaSimpleFila($sql);  

    }
    public function obtenerImg($id){
      $sql="SELECT `imagen` FROM `paquete` WHERE idpaquete = '$id' ";
      return ejecutarConsultaSimpleFila($sql);  
    }

  }

?>
