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

    date_default_timezone_set('America/Lima'); $date_now = date("d_m_Y__h_i_s_A");
    $imagen_error = "this.src='../dist/svg/user_default.svg'";
    $toltip = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';
    $scheme_host =  ($_SERVER['HTTP_HOST'] == 'localhost' ? $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/fun_route/admin/' :  $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/admin/');

    // :::::::::::::::::::::::::: MISION VISION :::::::::::::::::::::
    $id           = isset($_POST["idnosotros"])? limpiarCadena($_POST["idnosotros"]):"";
    $mision       = isset($_POST["mision"])? ($_POST["mision"]):"";
    $vision       = isset($_POST["vision"])? ($_POST["vision"]):"";
    $valores      = isset($_POST["valores"])? ($_POST["valores"]):"";

    // :::::::::::::::::::::::::: RESEÑA Y CEO :::::::::::::::::::::
    $palabras_ceo = isset($_POST["palabras_ceo"])? ($_POST["palabras_ceo"]):"";
    $nombre_ceo   = isset($_POST["nombre_ceo"])? ($_POST["nombre_ceo"]):"";
    $resenia_h    = isset($_POST["resenia_h"])? ($_POST["resenia_h"]):"";

    // ::::::::::::::::::::::::::DATOS GENERALES :::::::::::::::::::::
    $direccion    = isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
    $nombre       = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
    $tipo_documento = isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";
    $num_documento= isset($_POST["num_documento"])? limpiarCadena($_POST["num_documento"]):"";
    $celular      = isset($_POST["celular"])? limpiarCadena($_POST["celular"]):"";
    $telefono     = isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
    $latitud      = isset($_POST["latitud"])? limpiarCadena($_POST["latitud"]):"";
    $longuitud    = isset($_POST["longuitud"])? limpiarCadena($_POST["longuitud"]):"";
    $correo       = isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
    $horario      = isset($_POST["horario"])? limpiarCadena($_POST["horario"]):"";
    $rs_facebook  = isset($_POST["rs_facebook"])? limpiarCadena($_POST["rs_facebook"]):"";
    $rs_instagram = isset($_POST["rs_instagram"])? limpiarCadena($_POST["rs_instagram"]):"";
    $rs_tiktok    = isset($_POST["rs_tiktok"])? limpiarCadena($_POST["rs_tiktok"]):"";
    
    switch ($_GET["op"]) {

      case 'mostrar':
        $rspta=$contacto->mostrar();
        echo json_encode($rspta);		
      break;

      case 'actualizar_mision_vision':
        if (empty($id)){
          $rspta = ['status'=> 'error_personalizado', 'user'=>$_SESSION["nombre"], 'message'=>"No no modifique el codigo por favor", 'data'=>[]];
          json_encode( $rspta, true) ;
        }else {          
          // editamos un documento existente
          $rspta=$contacto->actualizar_mision_vision( $id, $mision, $vision, $valores);          
          echo json_encode( $rspta, true) ;
        }            
      break;

      case 'actualizar_ceo_resenia':

        // imagen
        if (!file_exists($_FILES['foto1']['tmp_name']) || !is_uploaded_file($_FILES['foto1']['tmp_name'])) {
          $imagen1 = $_POST["foto1_actual"];
          $flat_img1 = false;
        } else {
          $ext1 = explode(".", $_FILES["foto1"]["name"]);
          $flat_img1 = true;
          $imagen1 = $date_now .'__'. random_int(0, 20) . round(microtime(true)) . random_int(21, 41) . '.' . end($ext1);
          move_uploaded_file($_FILES["foto1"]["tmp_name"], "../dist/docs/nosotros/perfil_ceo/" . $imagen1);
        }

        if (empty($id)){
          $rspta = ['status'=> 'error_personalizado', 'user'=>$_SESSION["nombre"], 'message'=>"No no modifique el codigo por favor", 'data'=>[]];
          json_encode( $rspta, true) ;
        }else {
          // validamos si existe LA IMG para eliminarlo          
          if ($flat_img1 == true) {
            $datos_f1 = $contacto->mostrar();
            $img1_ant = $datos_f1['data']['perfil_ceo'];
            if ( !empty( $img1_ant ) ) { unlink("../dist/docs/nosotros/perfil_ceo/" . $img1_ant); }
          }
          // editamos un documento existente
          $rspta=$contacto->actualizar_ceo_resenia( $id, $palabras_ceo, $nombre_ceo, $resenia_h, $imagen1 );          
          echo json_encode( $rspta, true) ;
        }
      break;

      case 'actualizar_datos_generales':
        if (empty($id)){
          $rspta = ['status'=> 'error_personalizado', 'user'=>$_SESSION["nombre"], 'message'=>"No no modifique el codigo por favor", 'data'=>[]];
          json_encode( $rspta, true) ;
        }else {
          // editamos un documento existente
          $rspta=$contacto->actualizar_datos_generales( $id,$direccion,$nombre,$tipo_documento, $num_documento,$celular,$telefono,$latitud,$longuitud,$correo,$horario, $rs_facebook,$rs_instagram,$rs_tiktok );          
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
