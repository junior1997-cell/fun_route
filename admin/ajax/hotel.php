<?php
  ob_start();
  if (strlen(session_id()) < 1) {
    session_start(); //Validamos si existe o no la sesión
  }

  if (!isset($_SESSION["nombre"])) {
    $retorno = ['status'=>'login', 'message'=>'Tu sesion a terminado pe, inicia nuevamente', 'data' => [] ];
    echo json_encode($retorno);  //Validamos el acceso solo a los usuarios logueados al sistema.
  } else {
    
    require_once "../modelos/Hotel.php";

    $hotel = new Hotel($_SESSION['idusuario']);

    date_default_timezone_set('America/Lima'); $date_now = date("d-m-Y--h-i-s-A");
    $imagen_error = "this.src='../dist/svg/user_default.svg'";
    $toltip = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';
    $scheme_host =  ($_SERVER['HTTP_HOST'] == 'localhost' ? $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/fun_route/admin/' :  $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/admin/');

    //------------------------------------ HOTEL ---------------------------------------------
    $idhoteles        = isset($_POST["idhoteles"]) ? limpiarCadena($_POST["idhoteles"]) : "";
    $nombre_hotel     = isset($_POST["nombre_hotel"]) ? limpiarCadena($_POST["nombre_hotel"]) : "";
    $nro_estrellas    = isset($_POST["nro_estrellas"]) ? limpiarCadena($_POST["nro_estrellas"]) : "";
    $check_in         = isset($_POST["check_in"]) ? limpiarCadena($_POST["check_in"]) : "";
    $check_out        = isset($_POST["check_out"]) ? limpiarCadena($_POST["check_out"]) : "";
    //idhoteles  ;  nro_estrellas  ;  nombre_hotel

    //----------------------------------- HABITACION ------------------------------------------
    $idhoteles_G       = isset($_POST["idhoteles_G"]) ? limpiarCadena($_POST["idhoteles_G"]) : "";
    $idhabitacion      = isset($_POST["idhabitacion"]) ? limpiarCadena($_POST["idhabitacion"]) : "";
    $nombre_habitacion = isset($_POST["nombre_habitacion"]) ? limpiarCadena($_POST["nombre_habitacion"]) : "";
    //$idhoteles_G  ;  $idhabitacion  ;  $nombre_habitacion

    //------------------------------ CARACTISTICA HABITACION -----------------------------------
    $idhabitacion_G           = isset($_POST["idhabitacion_G"]) ? limpiarCadena($_POST["idhabitacion_G"]) : "";
    $iddetalle_habitacion     = isset($_POST["iddetalle_habitacion"]) ? limpiarCadena($_POST["iddetalle_habitacion"]) : "";
    $nombre_caracteristica_h  = isset($_POST["nombre_caracteristica_h"]) ? limpiarCadena($_POST["nombre_caracteristica_h"]) : "";
    $icono_font_c             = isset($_POST["icono_font_c"]) ? limpiarCadena($_POST["icono_font_c"]) : "";
    $estado_si_no             = isset($_POST["estado_si_no"]) ? limpiarCadena($_POST["estado_si_no"]) : "";
     //$idhabitacion_G  ;  $iddetalle_habitacion  ;  $nombre_caracteristica_h

    //------------------------------ INSTALACIONES HOTELES --------------------------------------
    $idhoteles_GN           = isset($_POST["idhoteles_GN"]) ? limpiarCadena($_POST["idhoteles_GN"]) : "";
    $idinstalaciones_hotel  = isset($_POST["idinstalaciones_hotel"]) ? limpiarCadena($_POST["idinstalaciones_hotel"]) : "";
    $nombre_c_hotel         = isset($_POST["nombre_c_hotel"]) ? limpiarCadena($_POST["nombre_c_hotel"]) : "";
    $icono_font_i           = isset($_POST["icono_font_i"]) ? limpiarCadena($_POST["icono_font_i"]) : "";
    $estado_si_no2          = isset($_POST["estado_si_no2"]) ? limpiarCadena($_POST["estado_si_no2"]) : "";
    //idinstalaciones_hotel ;  idhoteles_GN  ;  nombre_c_hotel

    //--------------------------------- GALERIA DE HOTEL ---------------------------------------
    $idhotelesG           = isset($_POST["idhotelesG"]) ? limpiarCadena($_POST["idhotelesG"]) : "";
    $idgaleria_hotel      = isset($_POST["idgaleria_hotel"]) ? limpiarCadena($_POST["idgaleria_hotel"]) : "";
    $descripcion_G        = isset($_POST["descripcion_G"]) ? limpiarCadena($_POST["descripcion_G"]) : "";
    $imagen             = isset($_POST["imagen_H"]) ? limpiarCadena($_POST["imagen_H"]) : "";
    //idhotelesG  ;  idgaleria_hotel  ;  descripcion_G  ;  imagen_H

    switch ($_GET["op"]) {
      case 'guardar_y_editar_hotel':
        // imagen
        if (!file_exists($_FILES['foto1']['tmp_name']) || !is_uploaded_file($_FILES['foto1']['tmp_name'])) {
          $perfil_hotel = $_POST["foto1_actual"];
          $flat_img1 = false;
        } else { 
          $ext1 = explode(".", $_FILES["foto1"]["name"]);
          $flat_img1 = true;
          $perfil_hotel = $date_now .'--'. random_int(0, 20) . round(microtime(true)) . random_int(21, 41) . '.' . end($ext1);
          move_uploaded_file($_FILES["foto1"]["tmp_name"], "../dist/docs/hotel/img_perfil/" . $perfil_hotel);
        }
        if (empty($idhoteles)) {
          $rspta = $hotel->insertar($nombre_hotel, $nro_estrellas, $check_in, $check_out, $perfil_hotel);
          echo json_encode( $rspta, true) ;
        } else {
          // validamos si existe LA IMG para eliminarlo          
          if ($flat_img1 == true) {
            $datos_f1 = $hotel->obtener_perfil_hotel($idhoteles);
            $img1_ant = $datos_f1['data']['imagen_perfil'];
            if ( !empty( $img1_ant ) ) { unlink("../dist/docs/hotel/img_perfil/" . $img1_ant); }
          }
          $rspta = $hotel->editar($idhoteles, $nombre_hotel, $nro_estrellas, $check_in, $check_out, $perfil_hotel);
          echo json_encode( $rspta, true) ;
        }
      break;

      case 'desactivar_hotel':
        $rspta = $hotel->desactivar($_GET["id_tabla"]);
        echo json_encode( $rspta, true) ;
      break;

      case 'eliminar_hotel':
        $rspta = $hotel->eliminar($_GET["id_tabla"]);
        echo json_encode( $rspta, true) ;
      break;

      case 'mostrar_hotel':
        $rspta = $hotel->mostrar($idhoteles);
        //Codificar el resultado utilizando json
        echo json_encode( $rspta, true) ;
      break;

      case 'listar_hotel':
        $rspta = $hotel->listar_hotel();
        //Vamos a declarar un array
        $data = [];  $cont = 1;       

        if ($rspta['status'] == true) {
          while ($reg = $rspta['data']->fetch_object()) {      
            $numeroEstrellas = $reg->estrellas;
            // Genera las estrellas en base al número obtenido
            $estrellasHTML = '';
            for ($i = 0; $i < 5; $i++) {
              if ($i < $numeroEstrellas) {
                $estrellasHTML .= '★'; // Estrella llena
              } else {
                $estrellasHTML .= '☆'; // Estrella vacía
              }
            }         
            
            $data[] = [
              "0" => $cont++,
              "1" => '<button class="btn btn-warning btn-sm" onclick="mostrar_hotel(' . $reg->idhoteles . ')" data-toggle="tooltip" data-original-title="Editar compra"><i class="fas fa-pencil-alt"></i></button>' .
                  ' <button class="btn btn-danger  btn-sm" onclick="eliminar_hotel(' . $reg->idhoteles .', \'' . encodeCadenaHtml($reg->nombre) . '\')" data-toggle="tooltip" data-original-title="Eliminar o Papelera"><i class="fas fa-skull-crossbones"></i></button>',
              "2" => '<div >'.$reg->nombre. '<br>
                  <span class="rating text-warning text-center">'.$estrellasHTML.'</span>                
                  </div>',
              "3" => $reg->idhoteles,
              "4" => $reg->nombre,
            ];
          }
          $results = [
            "sEcho" => 1, //Información para el datatables
            "iTotalRecords" => count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
            "aaData" => $data,
          ];
          echo json_encode($results, true);
        } else {
          echo $rspta['code_error'] .' - '. $rspta['message'] .' '. $rspta['data'];
        }

      break;

      //==========================HABITACIONES========================
      //==========================HABITACIONES========================
      //==========================HABITACIONES========================

      case 'guardaryeditar_habitacion':
        if (empty($idhabitacion)) {
          $rspta = $hotel->insertar_habitacion($idhoteles_G, $nombre_habitacion);
          echo json_encode( $rspta, true) ;
        } else {
          $rspta = $hotel->editar_habitacion($idhabitacion,$idhoteles_G, $nombre_habitacion);
          echo json_encode( $rspta, true) ;
        }
      break;

      case 'desactivar_habitacion':
        $rspta = $hotel->desactivar_habitacion($_GET["id_tabla"]);
        echo json_encode( $rspta, true) ;
      break;

      case 'eliminar_habitacion':
        $rspta = $hotel->eliminar_habitacion($_GET["id_tabla"]);
        echo json_encode( $rspta, true) ;
      break;

      case 'mostrar_habitacion':
        $rspta = $hotel->mostrar_habitacion($idhabitacion);
        //Codificar el resultado utilizando json
        echo json_encode( $rspta, true) ;
      break;

      case 'listar_habitacion':
        $rspta = $hotel->listar_habitacion( $_GET['idhoteles']);
        //Vamos a declarar un array
        $data = [];  $cont = 1;       

        if ($rspta['status'] == true) {
          while ($reg = $rspta['data']->fetch_object()) {

            $data[] = [
              "0" => $cont++,
              "1" => '<button class="btn btn-warning btn-sm" onclick="mostrar_habitacion(' . $reg->idhabitacion . ')" data-toggle="tooltip" data-original-title="Editar compra"><i class="fas fa-pencil-alt"></i></button>' .
                  ' <button class="btn btn-danger  btn-sm" onclick="eliminar_habitacion(' . $reg->idhabitacion .', \'' . encodeCadenaHtml($reg->nombre) . '\')" data-toggle="tooltip" data-original-title="Eliminar o Papelera"><i class="fas fa-skull-crossbones"></i></button>',
              "2" => $reg->nombre,
              "3" =>$reg->idhabitacion,
            ];
          }
          $results = [
            "sEcho" => 1, //Información para el datatables
            "iTotalRecords" => count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
            "aaData" => $data,
          ];
          echo json_encode($results, true);
        } else {
          echo $rspta['code_error'] .' - '. $rspta['message'] .' '. $rspta['data'];
        }

      break;
      //==========================FIN HABITACIONES===================

     //$idhabitacion_G,$iddetalle_habitacion,$nombre_caracteristica_h
      //==========================CARACTERISTICAS====================
      //==========================CARACTERISTICAS====================
      case 'guardaryeditar_caracteristicas_h':
        if (empty($iddetalle_habitacion)) {
          $rspta = $hotel->insertar_caracteristicas_h($idhabitacion_G, $nombre_caracteristica_h, $icono_font_c, $estado_si_no);
          echo json_encode( $rspta, true) ;
        } else {
          $rspta = $hotel->editar_caracteristicas_h($iddetalle_habitacion,$idhabitacion_G, $nombre_caracteristica_h, $icono_font_c, $estado_si_no);
          echo json_encode( $rspta, true) ;
        }
      break;

      case 'desactivar_caracteristicas_h':
        $rspta = $hotel->desactivar_caracteristicas_h($_GET["id_tabla"]);
        echo json_encode( $rspta, true) ;
      break;

      case 'eliminar_caracteristicas_h':
        $rspta = $hotel->eliminar_caracteristicas_h($_GET["id_tabla"]);
        echo json_encode( $rspta, true) ;
      break;

      case 'mostrar_caracteristicas_h':
        $rspta = $hotel->mostrar_caracteristicas_h($iddetalle_habitacion);
        //Codificar el resultado utilizando json
        echo json_encode( $rspta, true) ;
      break;

      case 'listar_caracteristicas_h':
        $rspta = $hotel->listar_caracteristicas_h( $_GET['idhabitacion']);
        //Vamos a declarar un array
        $data = [];  $cont = 1;       

        if ($rspta['status'] == true) {
          while ($reg = $rspta['data']->fetch_object()) {

            $data[] = [
              "0" => $cont++,
              "1" => '<button class="btn btn-warning btn-sm" onclick="mostrar_caracteristicas_h(' . $reg->iddetalle_habitacion. ')" data-toggle="tooltip" data-original-title="Editar compra"><i class="fas fa-pencil-alt"></i></button>' .
                  ' <button class="btn btn-danger  btn-sm" onclick="eliminar_caracteristicas_h(' . $reg->iddetalle_habitacion.', \'' . encodeCadenaHtml($reg->nombre) . '\')" data-toggle="tooltip" data-original-title="Eliminar o Papelera"><i class="fas fa-skull-crossbones"></i></button>',
              "2" => '<i class="'.$reg->icono_font.' mr-1"></i>' . $reg->nombre,
              "3" => ($reg->estado_si_no ? '<div class="text-center"><span class="badge badge-success"><i class="fas fa-check"></i></span></div>' : '<div class="text-center"><span class="badge badge-danger"><i class="fas fa-times"></i></span></div>').$toltip,
              "4" =>$reg->iddetalle_habitacion,
            ];
          }
          $results = [
            "sEcho" => 1, //Información para el datatables
            "iTotalRecords" => count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
            "aaData" => $data,
          ];
          echo json_encode($results, true);
        } else {
          echo $rspta['code_error'] .' - '. $rspta['message'] .' '. $rspta['data'];
        }

      break;

      //==========================FIN CARACTERISTICAS====================
      //==========================FIN CARACTERISTICAS====================

      //==========================CARACTERISTICAS HOTELES================
      case 'guardaryeditar_caract_hotel':
        if (empty($idinstalaciones_hotel)) {
          $rspta = $hotel->insertar_caract_hotel($idhoteles_GN, $nombre_c_hotel, $icono_font_i, $estado_si_no2);
          echo json_encode( $rspta, true) ;
        } else {
          $rspta = $hotel->editar_caract_hotel($idinstalaciones_hotel,$idhoteles_GN, $nombre_c_hotel, $icono_font_i, $estado_si_no2);
          echo json_encode( $rspta, true) ;
        }
      break;

      case 'desactivar_caract_hotel':
        $rspta = $hotel->desactivar_caract_hotel($_GET["id_tabla"]);
        echo json_encode( $rspta, true) ;
      break;

      case 'eliminar_caract_hotel':
        $rspta = $hotel->eliminar_caract_hotel($_GET["id_tabla"]);
        echo json_encode( $rspta, true) ;
      break;

      case 'mostrar_caract_hotel':
        $rspta = $hotel->mostrar_caract_hotel($idinstalaciones_hotel);
        //Codificar el resultado utilizando json
        echo json_encode( $rspta, true) ;
      break;

      case 'listar_caract_hotel':
        $rspta = $hotel->listar_caract_hotel( $_GET['idhoteles']);
        //Vamos a declarar un array
        $data = [];  $cont = 1;       

        if ($rspta['status'] == true) {
          while ($reg = $rspta['data']->fetch_object()) {

            $data[] = [
              "0" => $cont++,
              "1" => '<button class="btn btn-warning btn-sm" onclick="mostrar_caract_hotel(' . $reg->idinstalaciones_hotel . ')" data-toggle="tooltip" data-original-title="Editar compra"><i class="fas fa-pencil-alt"></i></button>' .
                  ' <button class="btn btn-danger  btn-sm" onclick="eliminar_caract_hotel(' . $reg->idinstalaciones_hotel .', \'' . encodeCadenaHtml($reg->nombre) . '\')" data-toggle="tooltip" data-original-title="Eliminar o Papelera"><i class="fas fa-skull-crossbones"></i></button>',
              "2" => '<i class="'.$reg->icono_font.' mr-1"></i>' .$reg->nombre,
              "3" => ($reg->estado_si_no ? '<div class="text-center"><span class="badge badge-success"><i class="fas fa-check"></i></span></div>' : '<div class="text-center"><span class="badge badge-danger"><i class="fas fa-times"></i></span></div>').$toltip,
              "4" => $reg->idinstalaciones_hotel,
            ];
          }
          $results = [
            "sEcho" => 1, //Información para el datatables
            "iTotalRecords" => count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
            "aaData" => $data,
          ];
          echo json_encode($results, true);
        } else {
          echo $rspta['code_error'] .' - '. $rspta['message'] .' '. $rspta['data'];
        }

      break;

      //========================FIN CARACTERISTICAS HOTELES==============
      //========================FIN CARACTERISTICAS HOTELES==============
      //========================FIN CARACTERISTICAS HOTELES==============



      //============================ GALERIA HOTEL ======================
      //============================ GALERIA HOTEL ======================
      //============================ GALERIA HOTEL ======================
      case 'guardar_editar_galeria_hotel':
        // imgen 
        if (!file_exists($_FILES['imagen_H']['tmp_name']) || !is_uploaded_file($_FILES['imagen_H']['tmp_name'])) {
          $imagen = $_POST["doc_old"];
          $flat_img = false;
        } else {
          //guardar imagen
          $ext = explode(".", $_FILES["imagen_H"]["name"]);
          $flat_img = true;
          $imagen = $date_now . '--' . random_int(0, 20) . round(microtime(true)) . random_int(21, 41) . '.' . end($ext);
          move_uploaded_file($_FILES["imagen_H"]["tmp_name"], "../dist/docs/hotel/galeria/" . $imagen);
        }

        if (empty($idgaleria_hotel)) {
          $rspta = $hotel->insertar_galeria_hotel($idhotelesG,$descripcion_G,$imagen);
          echo json_encode($rspta, true);
        }

      break;

      case 'listar_galeria_hotel':
        $rspta = $hotel->listar_galeria_hotel($_POST['idhoteles']);
        echo json_encode($rspta, true);
      break;


      case 'eliminar_imagen_hotel':
        $rspta = $hotel->eliminar_imagen_hotel($_POST['idgaleria_hotel']);
        echo json_encode($rspta, true);
      break;

      //========================== FIN GALERIA HOTEL ====================
      //========================== FIN GALERIA HOTEL ====================
      //========================== FIN GALERIA HOTEL ====================
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
