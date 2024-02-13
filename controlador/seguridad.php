<?php
  ob_start();  

    require '../modelos/Seguridad.php';
    $seguridad = new Seguridad();
    date_default_timezone_set('America/Lima'); $date_now = date("d-m-Y h.i.s A");

    switch ($_GET["op"]) { 

      case 'politicas_paquete':
        $rspta=$seguridad->politicas_paquete();
        echo json_encode($rspta, true);
      break;

      case 'politicas_tours':
        $rspta=$seguridad->politicas_tours();
        echo json_encode($rspta, true);
      break;


      default: 
          $rspta = ['status'=>'error_code', 'message'=>'Te has confundido en escribir en el <b>swich.</b>', 'data'=>[]]; echo json_encode($rspta, true); 
      break;
    }  

  ob_end_flush();

?>