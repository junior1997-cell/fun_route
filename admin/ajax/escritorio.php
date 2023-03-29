<?php

ob_start();

if (strlen(session_id()) < 1) {
  session_start(); 
}

if (!isset($_SESSION["nombre"])) {

  header("Location: ../vistas/login.html"); 

} else {

  if ($_SESSION['escritorio'] == 1) {

    require_once "../modelos/Escritorio.php";

    date_default_timezone_set('America/Lima');
    $date_now = date("d-m-Y h.i.s A");

    $escritorio = new Escritorio();

    switch ($_GET["op"]) {

      case 'grafico_barras':
        $rspta = $escritorio->grafico_barras($_POST['fecha_1'],$_POST['fecha_2']);
        echo json_encode($rspta, true);

      break;
      case 'grafico_radar':
        $rspta = $escritorio->grafico_radar($_POST['fecha_1'],$_POST['fecha_2']);
        echo json_encode($rspta, true);

      break;

      case 'salir':
        //Limpiamos las variables de sesión
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../index.php");

      break;

      default: 
        $rspta = ['status'=>'error_code', 'message'=>'Te has confundido en escribir en el <b>swich.</b>', 'data'=>[]]; echo json_encode($rspta, true); 
      break;
    }
  } else {
    require 'noacceso.php';
  }
}

ob_end_flush();

?>
