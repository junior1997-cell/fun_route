<?php
  //Incluímos inicialmente la conexión a la base de datos
  require "../config/Conexion.php";

  class Persona
  {
    //Implementamos nuestro constructor
    public function __construct()
    {
    }

    public function insertar($nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email, $cargo_persona, $imagen1) {
      $sw = Array();
      // var_dump($idcargo_persona,$nombre, $tipo_documento, $num_documento, $direccion, $telefono, $nacimiento, $edad,  $email, $banco, $cta_bancaria,  $cci,  $titular_cuenta, $ruc, $imagen1); die();
      $sql_0 = "SELECT nombre_persona,tipo_documento, numero_documento,estado, estado_delete FROM persona WHERE numero_documento = '$num_documento';";

      $existe = ejecutarConsultaArray($sql_0); if ($existe['status'] == false) { return $existe;}
      
      if ( empty($existe['data']) ) {

        $sql="INSERT INTO persona(idcargo_persona, nombre_persona, tipo_documento, numero_documento, celular, direccion, correo, foto_perfil,user_created) 
        VALUES ('$cargo_persona','$nombre','$tipo_documento','$num_documento','$telefono','$direccion','$email','$imagen1','" . $_SESSION['idusuario'] . "')";
        $new_persona = ejecutarConsulta_retornarID($sql);

        if ($new_persona['status'] == false) { return $new_persona;}

        //add registro en nuestra bitacora
        $sql = "INSERT INTO bitacora_bd( nombre_tabla, id_tabla, accion, id_user) VALUES ('persona','".$new_persona['data']."','Registro Nuevo persona','" . $_SESSION['idusuario'] . "')";
        $bitacora = ejecutarConsulta($sql); if ( $bitacora['status'] == false) {return $bitacora; }  
        
        $sw = array( 'status' => true, 'message' => 'noduplicado', 'data' => $new_persona['data'], 'id_tabla' =>$new_persona['id_tabla'] );

      } else {
        $info_repetida = ''; 

        foreach ($existe['data'] as $key => $value) {
          $info_repetida .= '<li class="text-left font-size-13px">
            <span class="font-size-15px text-danger"><b>Nombre: </b>'.$value['nombre_persona'].'</span><br>
            <b>'.$value['tipo_documento'].': </b>'.$value['numero_documento'].'<br>
            <b>Papelera: </b>'.( $value['estado']==0 ? '<i class="fas fa-check text-success"></i> SI':'<i class="fas fa-times text-danger"></i> NO') .' <b>|</b>
            <b>Eliminado: </b>'. ($value['estado_delete']==0 ? '<i class="fas fa-check text-success"></i> SI':'<i class="fas fa-times text-danger"></i> NO').'<br>
            <hr class="m-t-2px m-b-2px">
          </li>'; 
        }
        $sw = array( 'status' => 'duplicado', 'message' => 'duplicado', 'data' => '<ul>'.$info_repetida.'</ul>', 'id_tabla' => '' );
      }      
      
      return $sw;        
    }

    public function editar($idpersona, $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email, $cargo_persona, $imagen1) {
      $sql="UPDATE persona SET idcargo_persona='$cargo_persona',nombre_persona='$nombre',
      tipo_documento='$tipo_documento',numero_documento='$num_documento',celular='$telefono',
      direccion='$direccion',correo='$email',foto_perfil='$imagen1',user_updated='" . $_SESSION['idusuario'] . "' 
      WHERE idpersona='$idpersona';";	      
      $persona = ejecutarConsulta($sql);
      if ($persona['status'] == false) { return  $persona;}

      //add registro en nuestra bitacora
      $sql = "INSERT INTO bitacora_bd( nombre_tabla, id_tabla, accion, id_user) VALUES ('persona','".$idpersona."','Editamos el registro persona','" . $_SESSION['idusuario'] . "')";
      $bitacora = ejecutarConsulta($sql); if ( $bitacora['status'] == false) {return $bitacora; }  
      
      // return $persona;     
      return array( 'status' => true, 'message' => 'todo ok', 'data' => $idpersona, 'id_tabla' =>$idpersona ); 
      
    }

    public function desactivar($idpersona) {
      $sql="UPDATE persona SET estado='0',user_trash= '" . $_SESSION['idusuario'] . "' WHERE idpersona='$idpersona'";
      $desactivar =  ejecutarConsulta($sql);

      if ( $desactivar['status'] == false) {return $desactivar; }  

      //add registro en nuestra bitacora
      $sql = "INSERT INTO bitacora_bd( nombre_tabla, id_tabla, accion, id_user) VALUES ('persona','.$idpersona.','Desativar el registro persona','" . $_SESSION['idusuario'] . "')";
      $bitacora = ejecutarConsulta($sql); if ( $bitacora['status'] == false) {return $bitacora; }  

      return $desactivar;
    }

    public function eliminar($idpersona) {
      $sql="UPDATE persona SET estado_delete='0',user_delete= '" . $_SESSION['idusuario'] . "' WHERE idpersona='$idpersona'";
      $eliminar =  ejecutarConsulta($sql);
      
      if ( $eliminar['status'] == false) {return $eliminar; }  

      //add registro en nuestra bitacora
      $sql = "INSERT INTO bitacora_bd( nombre_tabla, id_tabla, accion, id_user) VALUES ('persona','.$idpersona.','Eliminar registro persona','" . $_SESSION['idusuario'] . "')";
      $bitacora = ejecutarConsulta($sql); if ( $bitacora['status'] == false) {return $bitacora; }  

      return $eliminar;
    }

    public function mostrar($idpersona) {
      $sql="SELECT * FROM persona WHERE idpersona='$idpersona'";
      return ejecutarConsultaSimpleFila($sql);

    }

    public function tbla_principal() {

      $sql="SELECT p.idpersona, p.idcargo_persona, p.nombre_persona, p.tipo_documento, p.numero_documento, p.celular, p.direccion, p.correo, p.foto_perfil, cp.nombre_cargo
      FROM persona as p, cargo_persona as cp
      WHERE p.idcargo_persona= cp.idcargo_persona AND p.estado_delete='1' AND p.estado='1' ORDER BY p.idpersona DESC";

      $persona = ejecutarConsultaArray($sql); if ($persona['status'] == false) { return  $persona;}
      
      return $persona;


    }

    public function obtenerImg($idpersona) {

      $sql = "SELECT foto_perfil FROM persona WHERE idpersona='$idpersona'";

      return ejecutarConsultaSimpleFila($sql);
    }

    /* =========================== S E C C I O N  T I P O   P E R S O N A  =========================== */

    public function cargo()
    {
      //sql cargo persona
      $sql = "SELECT idcargo_persona, nombre_cargo FROM cargo_persona WHERE estado='1' AND estado_delete='1' ORDER BY nombre_cargo ASC;";
      return ejecutarConsultaArray($sql);
    }

  }

?>
