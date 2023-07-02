<?php
  ob_start();
  if (strlen(session_id()) < 1) {
    session_start(); //Validamos si existe o no la sesión
  }

  if (!isset($_SESSION["nombre"])) {
    $retorno = ['status'=>'login', 'message'=>'Tu sesion a terminado pe, inicia nuevamente', 'data' => [] ];
    echo json_encode($retorno);  //Validamos el acceso solo a los usuarios logueados al sistema.
  } else {
    
    require_once "../modelos/Politicas.php";

    $politica = new politicas($_SESSION['idusuario']);

      //============D A T O S========================

      $id           = isset($_POST["idpoliticas"])? limpiarCadena($_POST["idpoliticas"]):"";
      $condiciones_generales  = isset($_POST["condiciones_generales"])? limpiarCadena($_POST["condiciones_generales"]):"";
      $reservas     = isset($_POST["reservas"])? limpiarCadena($_POST["reservas"]):"";
      $pago = isset($_POST["pago"])? limpiarCadena($_POST["pago"]):"";
      $cancelacion    = isset($_POST["cancelacion"])? limpiarCadena($_POST["cancelacion"]):"";

    switch ($_GET["op"]) {

      case 'mostrar':
        $rspta=$politica->mostrar($_POST['idpolitica']);
        echo json_encode($rspta);		
      break;

      case 'actualizar_politicas':

        if (empty($id)){
          echo "Los datos no se pudieron actualizar";
        }else {

          // editamos un documento existente
          $rspta=$politica->actualizar_politicas( $id, $condiciones_generales, $reservas, $pago, $cancelacion);
          
          echo json_encode( $rspta, true) ;
        }            

      break;
      /*
      case 'actualizar_ceo_resenia':

        if (empty($id)){
          echo "Los datos no se pudieron actualizar";
        }else {

          // editamos un documento existente
          $rspta=$politica->actualizar_ceo_resenia( $id, $palabras_ceo, $resenia_h );
          
          echo json_encode( $rspta, true) ;
        }            

      break;
      */

      case 'actualizar_datos_generales':

        if (empty($id)){
          echo "Los datos no se pudieron actualizar";
        }else {

          // editamos un documento existente
          $rspta=$politica->actualizar_datos_generales( $id,$condiciones_generales,$reservas,$pago,$cancelacion );
          
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
