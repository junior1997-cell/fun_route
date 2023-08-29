<?php
  ob_start();

    require_once "../modelos/Nosotros.php";

    $nosotros = new Nosotros(0);

    date_default_timezone_set('America/Lima'); $date_now = date("d-m-Y--h-i-s-A");
    $imagen_error = "this.src='../dist/svg/user_default.svg'";
    $toltip = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';
    $scheme_host =  ($_SERVER['HTTP_HOST'] == 'localhost' ? $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/fun_route/admin/' :  $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/admin/');

   
    //--------------------------------- NOSOTROS ---------------------------------------
    // $id       = isset($_POST["id"]) ? limpiarCadena($_POST["id"]) : "";
    switch ($_GET["op"]) { 

      case 'mostrar':
        $rspta = $nosotros->mostrar();
        //Codificar el resultado utilizando json
        echo json_encode( $rspta, true) ;
      break; 

      default: 
        $rspta = ['status'=>'error_code', 'message'=>'Te has confundido en escribir en el <b>swich.</b>', 'data'=>[]]; echo json_encode($rspta, true); 
      break;
    } 
  
  ob_end_flush();
?>
