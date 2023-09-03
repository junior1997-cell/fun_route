<?php
  //Incluímos inicialmente la conexión a la base de datos
  require "../config/Conexion_v2.php";
  // global $total;
  class Experiencia
  {

    //Implementamos nuestro variable global
    public $id_usr_sesion;

    //Implementamos nuestro constructor
    public function __construct($id_usr_sesion = 0)
    {
      $this->id_usr_sesion = $id_usr_sesion;
    }

    //Implementamos un método para insertar registros
    public function insertar($nombre, $lugar, $comentario, $estrella, $imagen1)  {
      $sql ="INSERT INTO experiencias(nombre, img_perfil, lugar, comentario, estrella, user_created) 
      VALUES ('$nombre','$imagen1','$lugar','$comentario','$estrella','$this->id_usr_sesion')";
      $new_experiencia =  ejecutarConsulta($sql); if ($new_experiencia['status'] == false) {  return $new_experiencia; }
      $id = $new_experiencia['data'];

      //add registro en nuestra bitacora
      $sql_d = "$nombre, $lugar, $comentario, $estrella, $imagen1";
      $sql_bit = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (5,'experiencias','$id','$sql_d','$this->id_usr_sesion')";
      $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }   
      
      return $new_experiencia;
    }

    //implementamos un metodo para editar registros
    public function editar($id, $nombre, $lugar, $comentario, $estrella, $imagen1) {
      
      $sql="UPDATE experiencias SET nombre='$nombre', img_perfil='$imagen1', lugar='$lugar', comentario='$comentario,', estrella='$estrella', user_updated = '$this->id_usr_sesion'
      WHERE idexperiencia='$id'";
      return ejecutarConsulta($sql);

      //add registro en nuestra bitacora
      $sql_d = "$id, $nombre, $lugar, $comentario, $estrella, $imagen1";
      $sql_bit = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (6,'experiencias','$id','$sql_d','$this->id_usr_sesion')";
      $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
    }

    //Implementamos un método para desactivar comentario_tours
    public function desactivar($id)	{
      $sql="UPDATE experiencias SET estado='0',user_trash= '$this->id_usr_sesion' WHERE idexperiencia='$id'";
      $desactivar= ejecutarConsulta($sql);  if ($desactivar['status'] == false) {  return $desactivar; }
      
      //add registro en nuestra bitacora
      $sql_d = $id;
      $sql_bit = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (2,'experiencia','$id','$sql_d','$this->id_usr_sesion')";
      $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }   
      
      return $desactivar;
    }

    //Implementamos un método para eliminar experiencia
    public function eliminar($id) {      
      
      $sql="UPDATE experiencias SET estado_delete='0', user_delete= '$this->id_usr_sesion' WHERE idexperiencia='$id'";
      $eliminar =  ejecutarConsulta($sql);  if ( $eliminar['status'] == false) {return $eliminar; }  
      
      //add registro en nuestra bitacora
      $sql_d = $id;
      $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (4,'experiencia','$id','$sql_d','$this->id_usr_sesion')";
      $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
      
      return $eliminar;
    }   

    public function mostrar($id) {
      $sql="SELECT * FROM experiencias WHERE idexperiencia='$id'";
      return ejecutarConsultaSimpleFila($sql);
    }   
   
    //Implementamos un método para listar los registros
    public function tbla_principal() {
      $sql="SELECT * FROM experiencias WHERE estado='1' and estado_delete='1';";
      return ejecutarConsultaArray($sql);		
    }
    
    public function obtenerImg($id){
      $sql="SELECT img_perfil FROM experiencias WHERE idexperiencia = '$id' ";
      return ejecutarConsultaSimpleFila($sql);  
    }

  }

?>
