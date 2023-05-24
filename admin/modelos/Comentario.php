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


    public function mostrar($idcomentario)
    {
      $sql="SELECT * FROM comentario WHERE idcomentario='$idcomentario'";
      return ejecutarConsultaSimpleFila($sql);
    }
   
   
    //Implementamos un método para listar los registros
    public function tbla_principal()
    {
      $sql="SELECT c.idcomentario_paquete, c.idpaquete, c.nombre, c.correo, c.comentario, c.fecha, c.estrella ,p.nombre, p.cant_dias,p.cant_noches, p.descripcion FROM comentario_paquete as c , paquete as p WHERE c.idpaquete=p.idpaquete";
      
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
