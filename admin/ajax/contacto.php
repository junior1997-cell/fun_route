<?php

	ob_start();

	if (strlen(session_id()) < 1){
		session_start();//Validamos si existe o no la sesión
	}
  
  if (!isset($_SESSION["nombre"])) {

    header("Location: ../vistas/login.html"); //Validamos el acceso solo a los usuarios logueados al sistema.

  } else {

    //Validamos el acceso solo al usuario logueado y autorizado.
    if ($_SESSION['datos_generales'] == 1) {

      require_once "../modelos/Contacto.php";

      $contacto=new Contacto();

      //============D A T O S========================

      $id           = isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
      $mision       = isset($_POST["mision"])? limpiarCadena($_POST["mision"]):"";
      $vision       = isset($_POST["vision"])? limpiarCadena($_POST["vision"]):"";

      $palabras_ceo = isset($_POST["palabras_ceo"])? limpiarCadena($_POST["palabras_ceo"]):"";
      $resenia_h    = isset($_POST["resenia_h"])? limpiarCadena($_POST["resenia_h"]):"";

      $direcccion   = isset($_POST["direcccion"])? limpiarCadena($_POST["direcccion"]):"";
      $celular      = isset($_POST["celular"])? limpiarCadena($_POST["celular"]):"";
      $telefono     = isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
      $latitud      = isset($_POST["latitud"])? limpiarCadena($_POST["latitud"]):"";
      $longuitud    = isset($_POST["longuitud"])? limpiarCadena($_POST["longuitud"]):"";
      $correo       = isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
      $horario      = isset($_POST["horario"])? limpiarCadena($_POST["horario"]):"";
      
      switch ($_GET["op"]){

        case 'mostrar':
          $rspta=$contacto->mostrar($_POST["id"]);
          echo json_encode($rspta, true);		
        break;

        case 'actualizar_mision_vision':

          if (empty($id)){            
            $rspta = ['status'=> 'error_user', 'message' => 'Los datos no se pudieron actualizar', 'data' => [] ];  
            echo json_encode($rspta, true);	
          }else {

            // editamos un documento existente
            $rspta=$contacto->actualizar_mision_vision( $id, $mision, $vision);            
            echo json_encode($rspta, true);		
          }            

        break;

        case 'actualizar_ceo_resenia':

          if (empty($id)){
            $rspta = ['status'=> 'error_user', 'message' => 'Los datos no se pudieron actualizar', 'data' => [] ];  
            echo json_encode($rspta, true);	
          }else {

            // editamos un documento existente
            $rspta=$contacto->actualizar_ceo_resenia( $id, $palabras_ceo, $resenia_h );            
            echo json_encode($rspta, true);		
          }            

        break;

        case 'actualizar_datos_generales':

          if (empty($id)){
            $rspta = ['status'=> 'error_user', 'message' => 'Los datos no se pudieron actualizar', 'data' => [] ];  
            echo json_encode($rspta, true);	
          }else {

            // editamos un documento existente
            $rspta=$contacto->actualizar_datos_generales( $id, $direcccion,$celular,$telefono,$latitud,$longuitud,$correo,$horario );            
            echo json_encode($rspta, true);		
          }            

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