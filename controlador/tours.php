<?php

  ob_start();   

    require_once "../modelos/Tours.php";

    $tours = new Tours(0);

    date_default_timezone_set('America/Lima'); $date_now = date("d-m-Y h.i.s A");

    $imagen_error = "this.src='../dist/svg/user_default.svg'";
    $toltip = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';
    
    $idtours		            = isset($_POST["idtours"])? limpiarCadena($_POST["idtours"]):"";
    $nombre                 = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
    $idtipo_tours           = isset($_POST["idtipo_tours"])? limpiarCadena($_POST["idtipo_tours"]):"";
    $descripcion			      = isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
    
    switch ($_GET["op"]) {     
      
      /* ══════════════════════════════════════ T O U R S  ══════════════════════════════════ */
      case 'mostrar':
        $rspta=$tours->mostrar($idtours);
        //Codificar el resultado utilizando json
        echo json_encode($rspta, true);
      break;

      case 'mostrar_vista':
        $rspta = $tours->mostrar_vista();
        echo json_encode($rspta, true);
      break;      

      /* ══════════════════════════════════════ G A L E R Í A  ══════════════════════════════════ */       
      case 'mostrar_galeria':
        $rspta = $tours->mostrar_galeria($_POST['idtours']);
        echo json_encode($rspta, true);
      break;      

      default: 
        $rspta = ['status'=>'error_code', 'message'=>'Te has confundido en escribir en el <b>swich.</b>', 'data'=>[]]; echo json_encode($rspta, true); 
      break;

    }   

  ob_end_flush();

?>