<?php
  //Incluímos inicialmente la conexión a la base de datos
  require "../config/Conexion_v2.php";
  // global $total;
  class PagoTrabajador
  {
    //Implementamos nuestro variable global
    public $id_usr_sesion;
    //Implementamos nuestro constructor
    public function __construct($id_usr_sesion = 0)
    {
      $this->id_usr_sesion = $id_usr_sesion;
    }
   

    public function tbla_principal() {
      $data = Array();
      $sql="SELECT p.idpersona, p.idtipo_persona, p.idcargo_trabajador, p.nombres, p.tipo_documento, p.numero_documento, p.fecha_nacimiento, 
      p.celular, p.direccion, p.correo, p.sueldo_mensual, p.sueldo_diario, p.foto_perfil, p.estado, cp.nombre as cargo
      FROM persona as p, cargo_trabajador as cp 
      WHERE p.idcargo_trabajador=cp.idcargo_trabajador AND p.idtipo_persona='2' AND p.estado='1' AND p.estado_delete ='1';";
      $trabajdor = ejecutarConsultaArray($sql); if ($trabajdor['status'] == false) { return  $trabajdor;}

      foreach ($trabajdor['data'] as $key => $val) {
        $sql_2 = "SELECT SUM(pg.monto) as pago_total
        FROM mes_pago_trabajador as mpt, pago_trabajador as pg
        WHERE pg.idmes_pago_trabajador = mpt.idmes_pago_trabajador AND mpt.idpersona = '".$val['idpersona']."' 
        AND mpt.estado = '1' AND mpt.estado_delete = '1' AND pg.estado = '1' AND pg.estado_delete = '1';";
        $pago = ejecutarConsultaSimpleFila($sql_2); if ($pago['status'] == false) { return  $pago;}

        $data[] = array(
          'idpersona'         => $val['idpersona'],
          'idtipo_persona'    => $val['idtipo_persona'],
          'idcargo_trabajador'=> $val['idcargo_trabajador'],
          'nombres'           => $val['nombres'],
          'tipo_documento'    => $val['tipo_documento'],          
          'numero_documento'  => $val['numero_documento'],
          'fecha_nacimiento'  => $val['fecha_nacimiento'], 
          'celular'           => $val['celular'],
          'direccion'         => $val['direccion'],
          'correo'            => $val['correo'],
          'sueldo_mensual'    => $val['sueldo_mensual'],
          'sueldo_diario'     => $val['sueldo_diario'],
          'foto_perfil'       => $val['foto_perfil'],
          'estado'            => $val['estado'],
          'cargo'             => $val['cargo'],

          'pago'             => empty($pago['data'])? 0 :(empty($pago['data']['pago_total'])? 0 : floatval($pago['data']['pago_total']) )  ,
        );
      }

      return $retorno = ['status'=> true, 'message' => 'Salió todo ok,', 'data' => $data ];   

    }

    // =====================================================================================================
    //================================== S E C C I O N   M E S ========================================= 
    // =====================================================================================================

    public function insertar_mes_pago($idpersona,$mes,$anio) {

      $sql="SELECT idmes_pago_trabajador, idpersona, mes_nombre, anio,estado,estado_delete 
      FROM mes_pago_trabajador 
      WHERE idpersona='$idpersona' AND mes_nombre='$mes' AND anio='$anio' ";
      $buscando = ejecutarConsultaArray($sql); if ($buscando['status'] == false) { return $buscando; }
  
      if ( empty($buscando['data']) ) {
        $sql="INSERT INTO mes_pago_trabajador (idpersona,mes_nombre,anio, user_created) VALUES ('$idpersona','$mes','$anio', '$this->id_usr_sesion')";
        $new_mes = ejecutarConsulta_retornarID($sql); if ( $new_mes['status'] == false) {return $new_mes; } 
        $id = $new_mes['data'];
        //add registro en nuestra bitacora
        $sql_d = "$idpersona, $mes, $anio";
        $sql = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (5,'mes_pago_trabajador','$id','$sql_d', '$this->id_usr_sesion')";
        $bitacora = ejecutarConsulta($sql); if ( $bitacora['status'] == false) {return $bitacora; } 

        return $new_mes;
      } else {
        $info_repetida = ''; 
  
        foreach ($buscando['data'] as $key => $value) {
          $info_repetida .= '<li class="text-left font-size-13px">
            <b>Mes: </b>'.$value['mes_nombre'].'<br>
            <b>Anio: </b>'.$value['anio'].'<br>
            <b>Papelera: </b>'.( $value['estado']==0 ? '<i class="fas fa-check text-success"></i> SI':'<i class="fas fa-times text-danger"></i> NO') .'<br>
            <b>Eliminado: </b>'. ($value['estado_delete']==0 ? '<i class="fas fa-check text-success"></i> SI':'<i class="fas fa-times text-danger"></i> NO').'<br>
            <hr class="m-t-2px m-b-2px">
          </li>'; 
        }
        $sw = array( 'status' => 'duplicado', 'message' => 'duplicado', 'data' => '<ul>'.$info_repetida.'</ul>', 'id_tabla' => '' );
        return $sw;
      }   
    }

    public function actualizar_mes_pago($id, $idpersona, $mes, $anio) {

      $sql = "SELECT * FROM mes_pago_trabajador 
      WHERE idmes_pago_trabajador != '$id' AND mes_nombre = '$mes' AND anio='$anio' AND idpersona = '$idpersona';";      
      $buscando = ejecutarConsultaArray($sql); if ($buscando['status'] == false) { return $buscando; }
  
      if ( empty($buscando['data']) ) {
        $sql="UPDATE mes_pago_trabajador SET mes_nombre='$mes',anio='$anio', user_updated='$this->id_usr_sesion'
        WHERE idmes_pago_trabajador='$id'";
        $new_mes = ejecutarConsulta($sql); if ( $new_mes['status'] == false) {return $new_mes; } 

        //add registro en nuestra bitacora
        $sql_d = "$id, $idpersona, $mes, $anio";
        $sql = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (6, 'mes_pago_trabajador','$id','$sql_d', '$this->id_usr_sesion')";
        $bitacora = ejecutarConsulta($sql); if ( $bitacora['status'] == false) {return $bitacora; } 

        return $new_mes; 
      } else {
        $info_repetida = ''; 
  
        foreach ($buscando['data'] as $key => $value) {
          $info_repetida .= '<li class="text-left font-size-13px">
            <b>Mes: </b>'.$value['mes_nombre'].'<br>
            <b>Anio: </b>'.$value['anio'].'<br>
            <b>Papelera: </b>'.( $value['estado']==0 ? '<i class="fas fa-check text-success"></i> SI':'<i class="fas fa-times text-danger"></i> NO') .'<br>
            <b>Eliminado: </b>'. ($value['estado_delete']==0 ? '<i class="fas fa-check text-success"></i> SI':'<i class="fas fa-times text-danger"></i> NO').'<br>
            <hr class="m-t-2px m-b-2px">
          </li>'; 
        }
        $sw = array( 'status' => 'duplicado', 'message' => 'duplicado', 'data' => '<ul>'.$info_repetida.'</ul>', 'id_tabla' => '' );
        return $sw;
      }       
    }

    public function tbla_mes_pago($idpersona) {
      $data = Array();
      $sql="SELECT idmes_pago_trabajador, mes_nombre, anio FROM mes_pago_trabajador WHERE idpersona='$idpersona'  AND estado=1 AND estado_delete =1";

      $pagos_meses = ejecutarConsultaArray($sql); if ($pagos_meses['status'] == false) { return  $pagos_meses;}

      // actualizamos el stock
      foreach ($pagos_meses['data'] as $key => $value) { 
           
        $slq2 = "SELECT SUM(monto) as total FROM pago_trabajador WHERE estado =1 AND estado_delete=1 AND idmes_pago_trabajador='".$value['idmes_pago_trabajador']."';";
        $total_por_meses = ejecutarConsultaSimpleFila($slq2); if ($total_por_meses['status'] == false) { return  $total_por_meses;}

        $pago_total_por_meses =(empty($total_por_meses['data']) ? 0 : (empty($total_por_meses['data']['total']) ? 0 : floatval($total_por_meses['data']['total']) ) );        

        $data[] = [
          'idmes_pago_trabajador'   => $value['idmes_pago_trabajador'],
          'anio'  => $value['anio'],
          'mes_nombre'        => $value['mes_nombre'],
          'pago_total_por_meses'   => $pago_total_por_meses,
        ];
        
      }	
      return $retorno = ['status' => true, 'message' => 'todo ok pe.', 'data' =>$data, 'affected_rows' =>$pagos_meses['affected_rows'],  ] ;

    }

    public function ver_datos_mes($id) {
      $sql="SELECT idmes_pago_trabajador, idpersona, mes_nombre, anio FROM mes_pago_trabajador WHERE idmes_pago_trabajador = '$id' AND estado = '1' AND estado_delete = '1'";
      $mes = ejecutarConsultaSimpleFila($sql); 
      return $mes; 
    }

    // =====================================================================================================
    //================================== S E C C I O N   P A G O S ========================================= 
    // =====================================================================================================

    //Implementamos un método para insertar registros
    public function insertar_pago($idmes_pago_trabajador,$nombre_mes,$monto,$fecha_pago,$descripcion,$comprobante)
    {
      $sql ="INSERT INTO pago_trabajador(idmes_pago_trabajador, fecha_pago, nombre_mes, monto, descripcion, comprobante, user_created)
      VALUES ('$idmes_pago_trabajador','$fecha_pago','$nombre_mes','$monto','$descripcion','$comprobante', '$this->id_usr_sesion')";
      $new_pago = ejecutarConsulta_retornarID($sql); if ( $new_pago['status'] == false) {return $new_pago; } 
      $id = $new_pago['data'];
      //add registro en nuestra bitacora
      $sql_d = "$idmes_pago_trabajador, $nombre_mes, $monto, $fecha_pago, $descripcion, $comprobante";
      $sql = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (5, 'pago_trabajador', '$id', '$sql_d', '$this->id_usr_sesion')";
      $bitacora = ejecutarConsulta($sql); if ( $bitacora['status'] == false) {return $bitacora; } 

      return $new_pago;
    }

    //implementamos un metodo para editar registros
    public function editar_pago($id,$idmes_pago_trabajador_p,$nombre_mes,$monto,$fecha_pago,$descripcion,$comprobante)
    {
      // var_dump($idpago_trabajador,$idmes_pago_trabajador_p,$nombre_mes,$monto,$fecha_pago,$descripcion,$comprobante);die();
      $sql="UPDATE pago_trabajador SET 
      idmes_pago_trabajador='$idmes_pago_trabajador_p',
      fecha_pago='$fecha_pago',
      nombre_mes='$nombre_mes',
      monto='$monto',
      descripcion='$descripcion',
      comprobante='$comprobante' , user_updated='$this->id_usr_sesion'
      WHERE idpago_trabajador='$id'";
      $edit_pago = ejecutarConsulta($sql); if ( $edit_pago['status'] == false) {return $edit_pago; } 

      //add registro en nuestra bitacora
      $sql_d = "$id, $idmes_pago_trabajador_p, $nombre_mes, $monto, $fecha_pago, $descripcion, $comprobante";
      $sql = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (6, 'pago_trabajador','$id','$sql_d', '$this->id_usr_sesion')";
      $bitacora = ejecutarConsulta($sql); if ( $bitacora['status'] == false) {return $bitacora; } 

      return $edit_pago;
    }

    //Implementamos un método para desactivar registros
    public function desactivar_pago($id)
    {
      $sql="UPDATE pago_trabajador SET estado='0',user_trash= '$this->id_usr_sesion' WHERE idpago_trabajador='$id'";
      $desactivar =  ejecutarConsulta($sql);  if ( $desactivar['status'] == false) {return $desactivar; }  

      //add registro en nuestra bitacora
      $sql_d = "$id";
      $sql = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (2, 'pago_trabajador','.$id.', '$sql_d', '$this->id_usr_sesion')";
      $bitacora = ejecutarConsulta($sql); if ( $bitacora['status'] == false) {return $bitacora; }  

      return $desactivar;
    }
    
    //Implementamos un método para activar registros
    public function eliminar_pago($id) {
      $sql="UPDATE pago_trabajador SET estado_delete='0',user_delete= '$this->id_usr_sesion' WHERE idpago_trabajador='$id'";
      $eliminar =  ejecutarConsulta($sql);  if ( $eliminar['status'] == false) {return $eliminar; }  

      //add registro en nuestra bitacora
      $sql = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (4, 'pago_trabajador','$id','$id', '$this->id_usr_sesion')";
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
    public function listar_pago($idmes_pago_trabajador)
    {
      $sql="SELECT pt.idpago_trabajador, pt.idmes_pago_trabajador, pt.fecha_pago, pt.nombre_mes, pt.monto, pt.descripcion, pt.comprobante 
      FROM pago_trabajador as pt, mes_pago_trabajador as mpt 
      WHERE pt.idmes_pago_trabajador = mpt.idmes_pago_trabajador AND pt.estado=1 AND pt.estado_delete=1 AND mpt.idmes_pago_trabajador='$idmes_pago_trabajador';";
      return ejecutarConsulta($sql);		
    }
    //total pagos por  total_pago_trabajador
    public function total_pago_trabajador($idmes_pago_trabajador)
    {
      $sql="SELECT SUM(monto) as total FROM pago_trabajador WHERE estado =1 AND estado_delete=1 AND idmes_pago_trabajador='$idmes_pago_trabajador'";
      return ejecutarConsultaSimpleFila($sql);  

    }
    // =====================================================================================================
    // =====================================================================================================
    // =====================================================================================================
    // =====================================================================================================

    //datos trabajador
    public function datos_trabajador($idtrabajador)
    {
      $sql = "SELECT p.idpersona, p.idtipo_persona, p.idbancos, p.idcargo_trabajador, p.nombres, p.tipo_documento, p.numero_documento, 
      p.fecha_nacimiento, p.celular, p.direccion, p.correo, p.sueldo_mensual, p.sueldo_diario, p.foto_perfil, ct.nombre as cargo 
      FROM persona as p , cargo_trabajador as ct
      WHERE p.idcargo_trabajador = ct.idcargo_trabajador AND p.idpersona='$idtrabajador';";
      return ejecutarConsultaSimpleFila($sql);
    }
    // Ver pagos trabajador
    public function verdatos($idpago_trabajador) {
      $sql=" SELECT pt.idpago_trabajador, pt.fecha_pago, pt.monto as monto_pago, pt.descripcion, pt.comprobante, t.idtrabajador, ct.nombre as cargo,
      t.nombres as nombre_trabajador, t.numero_documento, t.sueldo_mensual, t.imagen_perfil, t.tipo_documento, t.sueldo_diario, pt.estado
      FROM pago_trabajador as pt, trabajador as t, cargo_trabajador as ct
      WHERE pt.idtrabajador= t.idtrabajador AND t.idcargo_trabajador = ct.idcargo_trabajador  AND pt.idpago_trabajador='$idpago_trabajador' ";
      return ejecutarConsultaSimpleFila($sql);

    }

   

    public function obtenerImg($idtrabajador) {

      $sql = "SELECT comprobante FROM pago_trabajador WHERE idtrabajador='$idtrabajador'";

      return ejecutarConsultaSimpleFila($sql);
    }

    public function formato_banco($idbanco){
      $sql="SELECT nombre, formato_cta, formato_cci, formato_detracciones FROM bancos WHERE estado='1' AND idbancos = '$idbanco';";
      return ejecutarConsultaSimpleFila($sql);		
    }

    /* =========================== S E C C I O N   R E C U P E R A R   B A N C O S =========================== */

   

  }

?>
