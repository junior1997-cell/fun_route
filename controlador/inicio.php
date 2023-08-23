<?php

  ob_start();   

    require_once "../modelos/Inicio.php";

    $inicio = new Inicio();

    date_default_timezone_set('America/Lima'); $date_now = date("d-m-Y h.i.s A");

    
    switch ($_GET["op"]) {     

      case 'mostrar_paquetes': $rspta=$inicio->mostrar_paquetes(); echo json_encode($rspta, true); break;
      case 'mostrar_tours': $rspta=$inicio->mostrar_tours(); echo json_encode($rspta, true); break;
 

      default: 
        $rspta = ['status'=>'error_code', 'message'=>'Te has confundido en escribir en el <b>swich.</b>', 'data'=>[]]; echo json_encode($rspta, true); 
      break;

    }   

  ob_end_flush();

?>