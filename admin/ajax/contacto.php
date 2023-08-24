<?php
  ob_start();
  if (strlen(session_id()) < 1) {
    session_start(); //Validamos si existe o no la sesión
  }

  if (!isset($_SESSION["nombre"])) {
    $retorno = ['status'=>'login', 'message'=>'Tu sesion a terminado pe, inicia nuevamente', 'data' => [] ];
    echo json_encode($retorno);  //Validamos el acceso solo a los usuarios logueados al sistema.
  } else {
    
    require_once "../modelos/Contacto.php";

    $contacto = new Contacto($_SESSION['idusuario']);

    date_default_timezone_set('America/Lima'); $date_now = date("d-m-Y--h-i-s-A");
    $imagen_error = "this.src='../dist/svg/user_default.svg'";
    $toltip = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';
    $scheme_host =  ($_SERVER['HTTP_HOST'] == 'localhost' ? $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/fun_route/admin/' :  $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/admin/');

    //============D A T O S========================

    $id           = isset($_POST["idnosotros"])? limpiarCadena($_POST["idnosotros"]):"";
    $mision       = isset($_POST["mision"])? ($_POST["mision"]):"";
    $vision       = isset($_POST["vision"])? ($_POST["vision"]):"";
    $valores       = isset($_POST["valores"])? ($_POST["valores"]):"";

    $palabras_ceo = isset($_POST["palabras_ceo"])? ($_POST["palabras_ceo"]):"";
    $resenia_h    = isset($_POST["resenia_h"])? ($_POST["resenia_h"]):"";

    $direccion   = isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
    $nombre       = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
    $ruc          = isset($_POST["ruc"])? limpiarCadena($_POST["ruc"]):"";
    $celular      = isset($_POST["celular"])? limpiarCadena($_POST["celular"]):"";
    $telefono     = isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
    $latitud      = isset($_POST["latitud"])? limpiarCadena($_POST["latitud"]):"";
    $longuitud    = isset($_POST["longuitud"])? limpiarCadena($_POST["longuitud"]):"";
    $correo       = isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
    $horario      = isset($_POST["horario"])? limpiarCadena($_POST["horario"]):"";

    switch ($_GET["op"]) {

      case 'mostrar':
        $rspta=$contacto->mostrar();
        echo json_encode($rspta);		
      break;

      case 'actualizar_mision_vision':

        if (empty($id)){
          echo "Los datos no se pudieron actualizar";
        }else {

          // editamos un documento existente
          $rspta=$contacto->actualizar_mision_vision( $id, $mision, $vision, $valores);
          
          echo json_encode( $rspta, true) ;
        }            

      break;

      case 'actualizar_ceo_resenia':

        if (empty($id)){
          echo "Los datos no se pudieron actualizar";
        }else {

          // editamos un documento existente
          $rspta=$contacto->actualizar_ceo_resenia( $id, $palabras_ceo, $resenia_h );
          
          echo json_encode( $rspta, true) ;
        }            

      break;

      case 'actualizar_datos_generales':

        if (empty($id)){
          echo "Los datos no se pudieron actualizar";
        }else {

          // editamos un documento existente
          $rspta=$contacto->actualizar_datos_generales( $id,$direccion,$nombre,$ruc,$celular,$telefono,$latitud,$longuitud,$correo,$horario );
          
          echo json_encode( $rspta, true) ;
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
