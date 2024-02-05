<?php
  //Incluímos inicialmente la conexión a la base de datos
  require "../config/Conexion_v2.php";
  // global $total;
  class Noticias_inicio
  {
    //Implementamos nuestro variable global
    public $id_usr_sesion;

    //Implementamos nuestro constructor
    public function __construct($id_usr_sesion = 0)
    {
      $this->id_usr_sesion = $id_usr_sesion;
    }

    public function mostrar(){
      $sql = "SELECT * FROM noticias_inicio WHERE estado = 1 AND estado_delete = 1;";
      return ejecutarConsultaArray($sql);
    }

    public function insertar($titulo, $descripcion, $imagen){
      $sql="INSERT INTO noticias_inicio (titulo, descripcion, imagen) 
      VALUES('$titulo', '$descripcion', '$imagen')";
      return ejecutarConsulta($sql);
    }

    public function editar($idnoticias_inicio, $titulo, $descripcion, $imagen){
      $sql="UPDATE noticias_inicio SET titulo='$titulo', descripcion='$descripcion', imagen='$imagen' WHERE idnoticias_inicio= '$idnoticias_inicio' ";
      return ejecutarConsulta($sql);
    }

    function mostrar_editar_noticia($id){
      $sql = "SELECT * FROM noticias_inicio WHERE idnoticias_inicio='$id';";
      return ejecutarConsultaSimpleFila($sql);      
    }

    public function eliminar($idnoticias_inicio){
      $sql="SELECT imagen FROM noticias_inicio WHERE idnoticias_inicio = '$idnoticias_inicio'; ";
      $datos_f1 =ejecutarConsultaSimpleFila($sql); if ( $datos_f1['status'] == false) {return $datos_f1; }
      if (!empty($datos_f1)) { unlink("../dist/docs/noticia_inicio/" . $datos_f1['data']['imagen']); }

      $sql1="DELETE FROM noticias_inicio WHERE idnoticias_inicio='$idnoticias_inicio';";
      return ejecutarConsulta($sql1);
    }

    public function ver_o_no_ver($idnoticias_inicio, $estado_mostrar){
      if ($estado_mostrar == 1) {
        $sql_1 = "UPDATE noticias_inicio SET estado_mostrar = 0 WHERE idnoticias_inicio = '$idnoticias_inicio'";
        $visible = ejecutarConsulta($sql_1);
      } else if ($estado_mostrar == 0) {
          $sql_2 = "UPDATE noticias_inicio SET estado_mostrar = 1 WHERE idnoticias_inicio = '$idnoticias_inicio'";
          $oculto = ejecutarConsulta($sql_2);
      }
      return $retorno=['status'=>true, 'message'=>'todo okey'];
    }

  }



