<?php
  //Incluímos inicialmente la conexión a la base de datos
  require "../config/Conexion_v2.php";
  // global $total;
  class Galeria_paquete
  {

    //Implementamos nuestro variable global
    public $id_usr_sesion;

    //Implementamos nuestro constructor
    public function __construct($id_usr_sesion = 0)
    {
      $this->id_usr_sesion = $id_usr_sesion;
    }

    //Implementamos un método para insertar registros
    public function insertar($idpaquete,$descripcion, $imagen1)
    {
      $sql ="INSERT INTO galeria_paquete (idpaquete, descripcion, imagen) VALUES ('$idpaquete','$descripcion','$imagen1')"; // orden
      $crear= ejecutarConsulta_retornarID($sql); if ( $crear['status'] == false) {return $crear; }  

      //add registro en nuestra bitacora
		  $sql_d = "$idpaquete,$descripcion, $imagen1";

		  $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (5,'idgaleria_paquete','".$crear['data']."','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta_retornarID($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $crear;
    }

    //implementamos un metodo para editar registros
    public function editar($idgaleria_paquete, $idpaquete, $descripcion, $imagen1)
    
    {
      // var_dump($idpago_trabajador,$idmes_pago_trabajador_p,$nombre_mes,$monto,$fecha_pago,$descripcion,$comprobante);die();
      $sql="UPDATE galeria_paquete SET idpaquete='$idpaquete',descripcion='$descripcion',imagen='$imagen1' WHERE idgaleria_paquete='$idgaleria_paquete';";
      $editar= ejecutarConsulta($sql); if ( $editar['status'] == false) {return $editar; }  

      //add registro en nuestra bitacora
		  $sql_d = "$idgaleria_paquete,$idpaquete, $descripcion, $imagen1";

		  $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (6,'idgaleria_paquete','$idgaleria_paquete','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $editar;
    }

    //Implementamos un método para desactivar registros
    public function desactivar($idgaleria_paquete)
    {
      $sql="UPDATE galeria_paquete SET estado='0',user_trash= '$this->id_usr_sesion' WHERE galeria_paquete='$idgaleria_paquete'";
      $desactivar =  ejecutarConsulta($sql);

      if ( $desactivar['status'] == false) {return $desactivar; }  
      $sql_d = $idgaleria_paquete;

      //add registro en nuestra bitacora
      $sql = "INSERT INTO bitacora_bd( nombre_tabla, id_tabla, accion, id_user) VALUES ('galeria_paquete','.$idgaleria_paquete.','Desativar el registro Trabajador','$this->id_usr_sesion')";
      $bitacora = ejecutarConsulta($sql); if ( $bitacora['status'] == false) {return $bitacora; }  

      return $desactivar;
    }
    
    //Implementamos un método para activar registros
    public function eliminar($idgaleria_paquete) {
      $sql="UPDATE galeria_paquete SET estado_delete='0',user_delete= '$this->id_usr_sesion' WHERE idgaleria_paquete='$idgaleria_paquete'";
      $eliminar =  ejecutarConsulta($sql); if ( $eliminar['status'] == false) {return $eliminar; }  

      //add registro en nuestra bitacora
      $sql_d = $idgaleria_paquete;
      $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (4,'galeria_paquete','$idgaleria_paquete','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $eliminar;
    }
    //Implementamos un método para mostrar los datos de un registro a modificar
    public function mostrar($idgaleria_paquete)
    {
      $sql="SELECT * FROM galeria_paquete WHERE idgaleria_paquete='$idgaleria_paquete';";
      return ejecutarConsultaSimpleFila($sql);
    }

    //Implementamos un método para listar los registros
    public function tbla_principal()
    {
      $sql="SELECT gp.idgaleria_paquete, gp.idpaquete, gp.imagen, gp.descripcion as descripciongaleria, p.nombre, p.cant_dias,p.cant_noches, p.descripcion as descripcionpaquete
      FROM galeria_paquete AS gp, paquete AS p
      WHERE gp.idpaquete=p.idpaquete AND gp.estado=1 AND p.estado=1 AND gp.estado_delete=1 AND p.estado_delete=1;";
      return ejecutarConsultaArray($sql);		
    }
    //total pagos por  total_pago_trabajador
    public function total_pago_trabajador($idmes_pago_trabajador)
    {
      $sql="SELECT SUM(monto) as total FROM pago_trabajador WHERE estado =1 AND estado_delete=1 AND idmes_pago_trabajador='$idmes_pago_trabajador'";
      return ejecutarConsultaSimpleFila($sql);  

    }
    public function obtenerImg($id){
      $sql="SELECT `imagen` FROM `galeria_paquete` WHERE idgaleria_paquete = '$id' ";
      return ejecutarConsultaSimpleFila($sql);  
    }

  }

?>
