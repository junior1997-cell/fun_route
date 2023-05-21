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
    public function insertar($nombre, $correo, $nota, $fecha, $estrella)
    {
      $sql ="INSERT INTO `comentario`(`nombre`, `correo`, `comentario`, `fecha`, `estrella`) VALUES ('$nombre','$correo','$nota','$fecha','$estrella')";
      return ejecutarConsulta($sql);
    }

    //implementamos un metodo para editar registros
    public function editar($idcomentario,$idpaquete, $nombre, $correo, $nota, $fecha, $estrella)
    {
      // var_dump($idpago_trabajador,$idmes_pago_trabajador_p,$nombre_mes,$monto,$fecha_pago,$descripcion,$comprobante);die();
      $sql="";
      return ejecutarConsulta($sql);
    }

    public function mostrar($idcomentario)
    {
      $sql="SELECT * FROM comentario WHERE idcomentario='$idcomentario'";
      return ejecutarConsultaSimpleFila($sql);
    }
   
   
    //Implementamos un método para listar los registros
    public function tbla_principal()
    {
      $sql="SELECT c.idcomentario, c.idpaquete, c.nombre, c.correo, c.nota, c.fecha, c.estrella ,p.nombre, p.cant_dias,p.cant_noches, p.descripcion FROM comentario as c , paquete as p WHERE c.idpaquete=p.idpaquete";
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
