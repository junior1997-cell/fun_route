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

    $toltip = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';
    // idhoteles,nro_estrellas, nombre_hotel
    $idhoteles        = isset($_POST["idhoteles"]) ? limpiarCadena($_POST["idhoteles"]) : "";
    $nombre_hotel     = isset($_POST["nombre_hotel"]) ? limpiarCadena($_POST["nombre_hotel"]) : "";
    $nro_estrellas    = isset($_POST["nro_estrellas"]) ? limpiarCadena($_POST["nro_estrellas"]) : "";
    //-----------HABITACION
    $idhoteles_G       = isset($_POST["idhoteles_G"]) ? limpiarCadena($_POST["idhoteles_G"]) : "";
    $idhabitacion      = isset($_POST["idhabitacion"]) ? limpiarCadena($_POST["idhabitacion"]) : "";
    $nombre_habitacion = isset($_POST["nombre_habitacion"]) ? limpiarCadena($_POST["nombre_habitacion"]) : "";

    //$idhoteles_G,$idhabitacion, $nombre_habitacion
    //-----------CARACTISTICA
    $idhabitacion_G       = isset($_POST["idhabitacion_G"]) ? limpiarCadena($_POST["idhabitacion_G"]) : "";
    $iddetalle_habitacion      = isset($_POST["iddetalle_habitacion"]) ? limpiarCadena($_POST["iddetalle_habitacion"]) : "";
    $nombre_caracteristica_h = isset($_POST["nombre_caracteristica_h"]) ? limpiarCadena($_POST["nombre_caracteristica_h"]) : "";
     //$idhabitacion_G,$iddetalle_habitacion,$nombre_caracteristica_h

    //------------------CARACTERISTICAS HOTELES --------------
    $idhoteles_GN           = isset($_POST["idhoteles_GN"]) ? limpiarCadena($_POST["idhoteles_GN"]) : "";
    $idinstalaciones_hotel  = isset($_POST["idinstalaciones_hotel"]) ? limpiarCadena($_POST["idinstalaciones_hotel"]) : "";
    $nombre_c_hotel         = isset($_POST["nombre_c_hotel"]) ? limpiarCadena($_POST["nombre_c_hotel"]) : "";
    //idinstalaciones_hotel ;  idhoteles_GN  ;  nombre_c_hotel

    switch ($_GET["op"]) {
      case 'guardaryeditar_hotel':
        if (empty($idhoteles)) {
          $rspta = $hotel->insertar($nombre_hotel, $nro_estrellas);
          echo json_encode( $rspta, true) ;
        } else {
          $rspta = $hotel->editar($idhoteles, $nombre_hotel, $nro_estrellas);
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
          $rspta = $hotel->insertar_caracteristicas_h($idhabitacion_G, $nombre_caracteristica_h);
          echo json_encode( $rspta, true) ;
        } else {
          $rspta = $hotel->editar_caracteristicas_h($iddetalle_habitacion,$idhabitacion_G, $nombre_caracteristica_h);
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
              "2" => $reg->nombre,
              "3" =>$reg->iddetalle_habitacion,
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
          $rspta = $hotel->insertar_caract_hotel($idhoteles_GN, $nombre_c_hotel);
          echo json_encode( $rspta, true) ;
        } else {
          $rspta = $hotel->editar_caract_hotel($idinstalaciones_hotel,$idhoteles_GN, $nombre_c_hotel);
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
              "2" => $reg->nombre,
              "3" =>$reg->idinstalaciones_hotel,
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
