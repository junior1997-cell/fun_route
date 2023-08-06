<?php
  ob_start();

  if (strlen(session_id()) < 1) {

    session_start(); //Validamos si existe o no la sesión
  }

  if (!isset($_SESSION["nombre"])) {

    $retorno = ['status'=>'login', 'message'=>'Tu sesion a terminado pe, inicia nuevamente', 'data' => [] ];
    echo json_encode($retorno);  //Validamos el acceso solo a los usuarios logueados al sistema.

  } else {     
    
    require_once "../modelos/Ajax_general.php";
    require_once "../modelos/Producto.php";
    require_once "../modelos/Compra_producto.php";
    require_once "../modelos/Venta_producto.php";
    require_once "../modelos/Compra_cafe.php";
    
    $ajax_general   = new Ajax_general($_SESSION['idusuario']);
    $compra_insumos = new Producto($_SESSION['idusuario']);
    $compra_producto= new Compra_producto($_SESSION['idusuario']);
    $venta_producto = new Venta_producto($_SESSION['idusuario']);
    $compra_cafe = new Compra_cafe($_SESSION['idusuario']);

    $scheme_host  =  ($_SERVER['HTTP_HOST'] == 'localhost' ? 'http://localhost/fun_route/admin/' :  $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/');
    $imagen_error = "this.src='../dist/svg/404-v2.svg'";
    $toltip       = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';

    switch ($_GET["op"]) {       

      // buscar datos de RENIEC
      case 'reniec':

        $dni = $_POST["dni"];

        $rspta = $ajax_general->datos_reniec($dni);

        echo json_encode($rspta);

      break;



      default: 
        $rspta = ['status'=>'error_code', 'message'=>'Te has confundido en escribir en el <b>swich.</b>', 'data'=>[]]; echo json_encode($rspta, true); 
      break;
    }
      
  }

  ob_end_flush();
?>
