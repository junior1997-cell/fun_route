<?php
ob_start();
if (strlen(session_id()) < 1) {
  session_start(); //Validamos si existe o no la sesión
}

if (!isset($_SESSION["nombre"])) {
  $retorno = ['status'=>'login', 'message'=>'Tu sesion a terminado pe, inicia nuevamente', 'data' => [] ];
  echo json_encode($retorno);  //Validamos el acceso solo a los usuarios logueados al sistema.
} else {

  if ($_SESSION['venta_tours'] == 1) {
    
    require_once "../modelos/Correlacion_comprobante.php";

    $correlacion = new Correlacion_comprobante($_SESSION['idusuario']);
    
    date_default_timezone_set('America/Lima'); $date_now = date("d_m_Y__h_i_s_A");
    $imagen_error = "this.src='../dist/svg/user_default.svg'";
    $toltip = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';
    $scheme_host =  ($_SERVER['HTTP_HOST'] == 'localhost' ? $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/fun_route/admin/' :  $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/admin/');

    // :::::::::::::::::::::::::::::::::::: D A T O S   V E N T A ::::::::::::::::::::::::::::::::::::::
    $idsunat_correlacion= isset($_POST["idcorrelacion"]) ? limpiarCadena($_POST["idcorrelacion"]) : "";
    $nombre             = isset($_POST["nombre_co"]) ? limpiarCadena($_POST["nombre_co"]) : "";
    $abreviatura        = isset($_POST["abreviatura_co"]) ? limpiarCadena($_POST["abreviatura_co"]) : "";
    $serie              = isset($_POST["serie_co"]) ? limpiarCadena($_POST["serie_co"]) : "";
    $numero             = isset($_POST["numero_co"]) ? limpiarCadena($_POST["numero_co"]) : "";    

    switch ($_GET["op"]) {   
      
      // :::::::::::::::::::::::::: S E C C I O N   C O R R E L A C I O N  ::::::::::::::::::::::::::
      case 'guardar_y_editar_correlacion':
        if (empty($idsunat_correlacion)) {
          $rspta = $correlacion->insertar($nombre, $abreviatura, $serie, $numero );            
          echo json_encode( $rspta, true);    
        } else {             
          $rspta = $correlacion->editar($idsunat_correlacion, $nombre, $abreviatura, $serie, $numero);            
          echo json_encode( $rspta, true);
        }    
      break;
    
      case 'mostrar_correlacion':    
        $rspta = $correlacion->mostrar($idsunat_correlacion);
        echo json_encode($rspta, true);    
      break;    
      
      case 'papelera_correlacion':
        $rspta = $correlacion->desactivar($_GET["id_tabla"]);    
        echo json_encode($rspta, true);    
      break;

      case 'activar_correlacion':
        $rspta = $correlacion->activar_correlacion($_GET["id_tabla"]);    
        echo json_encode($rspta, true);    
      break;
    
      case 'eliminar_correlacion':
        $rspta = $correlacion->eliminar($_GET["id_tabla"]);    
        echo json_encode($rspta, true);    
      break;     
    
      case 'tbla_principal':
        $rspta = $correlacion->tbla_principal();
        
        //Vamos a declarar un array
        $data = []; $cont = 1;
        
        if ($rspta['status'] == true) {
          foreach ($rspta['data'] as $key => $reg) {
            $data[] = [
              "0" => $cont,
              "1" => '<button class="btn btn-warning btn-sm" onclick="mostrar_correlacion(' . $reg['idsunat_correlacion_comprobante'] . ')" data-toggle="tooltip" data-original-title="Editar compra"><i class="fas fa-pencil-alt"></i></button>' . 
                ($reg['estado'] ? ' <button class="btn btn-danger  btn-sm" onclick="desactivar_correlacion(' . $reg['idsunat_correlacion_comprobante'] .', \''.encodeCadenaHtml( $reg['nombre'] ) . '\')" data-toggle="tooltip" data-original-title="Eliminar o papelera"><i class="fas fa-skull-crossbones"></i> </button>' :
                ' <button class="btn btn-success  btn-sm" onclick="activar_correlacion(' . $reg['idsunat_correlacion_comprobante'] .', \''.encodeCadenaHtml( $reg['nombre'] ) . '\')" data-toggle="tooltip" data-original-title="Eliminar o papelera"><i class="fa-solid fa-check"></i> </button>' ) . $toltip,                 
              "2" => '<span class="text-primary font-weight-bold" >' . $reg['nombre'] . '</span>',
              "3" =>  $reg['abreviatura'] ,
              "4" => $reg['serie'],
              "5" => $reg['numero'],   
              "6" => ($reg['estado'] ? '<span class="text-center badge badge-success">Activado</span>' : '<span class="text-center badge badge-danger">Desactivado</span>'),   
            ];
            $cont++;
          }
          $results = [
            "sEcho" => 1, //Información para el datatables
            "iTotalRecords" => count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
            "data" => $data,
          ];
          echo json_encode($results, true);
        } else {
          echo $rspta['code_error'] .' - '. $rspta['message'] .' '. $rspta['data'];
        }
    
      break;

      default: 
        $rspta = ['status'=>'error_code', 'message'=>'Te has confundido en escribir en el <b>swich.</b>', 'data'=>[]]; echo json_encode($rspta, true); 
      break;
    }

  } else {
    $retorno = ['status'=>'nopermiso', 'message'=>'Tu sesion a terminado pe, inicia nuevamente', 'data' => [] ];
    echo json_encode($retorno);
  }  
}

ob_end_flush();
?>
