<?php
  //Incluímos inicialmente la conexión a la base de datos
  require "../config/Conexion_v2.php";
  // global $total;
  class Comentario_tours
  {

    //Implementamos nuestro variable global
    public $id_usr_sesion;

    //Implementamos nuestro constructor
    public function __construct($id_usr_sesion = 0)
    {
      $this->id_usr_sesion = $id_usr_sesion;
    }

    //Implementamos un método para insertar registros
    public function insertar($nombre, $correo, $nota, $fecha, $estrella)
    {
      $sql ="INSERT INTO `comentario_tours`(`nombre`, `correo`, `comentario`, `fecha`, `estrella`) VALUES ('$nombre','$correo','$nota','$fecha','$estrella')";
      return ejecutarConsulta($sql);
    }

    //implementamos un metodo para editar registros
    public function editar($idcomentario,$idpaquete, $nombre, $correo, $nota, $fecha, $estrella)
    {
      // var_dump($idpago_trabajador,$idmes_pago_trabajador_p,$nombre_mes,$monto,$fecha_pago,$descripcion,$comprobante);die();
      $sql="";
      return ejecutarConsulta($sql);
    }

    public function mostrar($idcomentario_tours)
    {
      $sql="SELECT * FROM comentario_tours WHERE idcomentario_tours='$idcomentario_tours'";
      return ejecutarConsultaSimpleFila($sql);
    }
   
   
    //Implementamos un método para listar los registros
    public function tbla_principal()
    {
      $sql="SELECT c.idcomentario_tours, c.idtours,c.nombre as name_comentario,c.correo,c.comentario,c.fecha,c.estrella,t.idtipo_tours,t.nombre,t.descripcion FROM comentario_tours as c , tours as t WHERE c.idtours=t.idtours;";
      return ejecutarConsultaArray($sql);		
    }
    
    public function obtenerImg($id){
      $sql="SELECT `imagen` FROM `paquete` WHERE idpaquete = '$id' ";
      return ejecutarConsultaSimpleFila($sql);  
    }

  }

?>
