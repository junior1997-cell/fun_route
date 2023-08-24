<?php
  ob_start();
  if (strlen(session_id()) < 1) {
    session_start(); //Validamos si existe o no la sesión
  }

  if (!isset($_SESSION["nombre"])) {
    $retorno = ['status'=>'login', 'message'=>'Tu sesion a terminado pe, inicia nuevamente', 'data' => [] ];
		echo json_encode($retorno);  //Validamos el acceso solo a los usuarios logueados al sistema.
  } else {

    require_once "../modelos/proveedor.php";

    $proveedor = new Proveedor($_SESSION['idusuario']);

    date_default_timezone_set('America/Lima'); $date_now = date("d-m-Y--h-i-s-A");
    $imagen_error = "this.src='../dist/svg/user_default.svg'";
    $toltip = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';
    $scheme_host =  ($_SERVER['HTTP_HOST'] == 'localhost' ? $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/fun_route/admin/' :  $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/admin/');

    $idproveedor_proyecto = isset($_POST["idproveedor_proyecto"]) ? limpiarCadena($_POST["idproveedor_proyecto"]) : "";
    $idproyecto = isset($_POST["idproyecto"]) ? limpiarCadena($_POST["idproyecto"]) : "";
    $idproveedor = isset($_POST["proveedor"]) ? limpiarCadena($_POST["proveedor"]) : "";

    switch ($_GET["op"]) {
      
      case 'select2_proveedor':
        $rspta = $proveedor->select2_proveedor();

        while ($reg = $rspta['data']->fetch_object()) {
          echo '<option value=' . $reg->idproveedor . '>' . $reg->razon_social . ' - ' . $reg->ruc . '</option>';
        }
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
  }
  
  
  ob_end_flush();
?>
