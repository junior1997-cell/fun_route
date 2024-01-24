<?php

  ob_start();   

    require_once "../modelos/Inicio.php";

    $inicio = new Inicio();

    date_default_timezone_set('America/Lima'); $date_now = date("d-m-Y h.i.s A");

    
    switch ($_GET["op"]) {     
      case 'datos_empresa': 
        $rspta=$inicio->datos_empresa(); echo json_encode($rspta, true); 
      break;

      case 'oferta_semanal': 
        $rspta=$inicio->oferta_semanal(); echo json_encode($rspta, true); 
      break;

      case 'mostrar_tours_paquete': 
        $rspta=$inicio->mostrar_tours_paquete(); echo json_encode($rspta, true); 
      break;

      case 'mostrar_testimonio_ceo': 
        $rspta=$inicio->mostrar_testimonio_ceo(); echo json_encode($rspta, true); 
      break; 

      default: 
        $rspta = ['status'=>'error_code', 'message'=>'Te has confundido en escribir en el <b>swich.</b>', 'data'=>[]]; echo json_encode($rspta, true); 
      break;

    }   

  ob_end_flush();

?>