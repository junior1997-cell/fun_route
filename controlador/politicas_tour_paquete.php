<?php

  ob_start();   

    require_once "../modelos/Politicas_tour_paquete.php";

    $Politicas_tour_paquete = new Politicas_tour_paquete();

    date_default_timezone_set('America/Lima'); $date_now = date("d-m-Y h.i.s A");

    
    switch ($_GET["op"]) {     

      case 'politicas_tours': 
        $rspta=$Politicas_tour_paquete->politicas_tours(); echo json_encode($rspta, true); 
      break;

      case 'Politicas_paquetes': 
        $rspta=$Politicas_tour_paquete->Politicas_paquetes(); echo json_encode($rspta, true); 
      break; 

      default: 
        $rspta = ['status'=>'error_code', 'message'=>'Te has confundido en escribir en el <b>swich.</b>', 'data'=>[]]; echo json_encode($rspta, true); 
      break;

    }   

  ob_end_flush();

?>