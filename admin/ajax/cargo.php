<?php
  ob_start();
  if (strlen(session_id()) < 1) {
    session_start(); //Validamos si existe o no la sesión
  }

  if (!isset($_SESSION["nombre"])) {
    $retorno = ['status'=>'login', 'message'=>'Tu sesion a terminado pe, inicia nuevamente', 'data' => [] ];
    echo json_encode($retorno);  //Validamos el acceso solo a los usuarios logueados al sistema.
  } else {
    require_once "../modelos/Cargo.php";

    $cargo = new Cargo();

    $idcargo = isset($_POST["idcargo"]) ? limpiarCadena($_POST["idcargo"]) : "";
    $descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";
    $nombre = isset($_POST["nombre_cargo"]) ? limpiarCadena($_POST["nombre_cargo"]) : "";

    switch ($_GET["op"]) {
      case 'guardaryeditar_cargo':
        if (empty($idcargo)) {
          $rspta = $cargo->insertar($descripcion, $nombre);
          echo json_encode( $rspta, true) ;
        } else {
          $rspta = $cargo->editar($idcargo, $nombre, $descripcion);
          echo json_encode( $rspta, true) ;
        }
      break;

      case 'desactivar':
        $rspta = $cargo->desactivar($_GET["id_tabla"]);
        echo json_encode( $rspta, true) ;
      break;

      case 'eliminar':
        $rspta = $cargo->eliminar($_GET["id_tabla"]);
        echo json_encode( $rspta, true) ;
      break;

      case 'mostrar':
        //$idcargo='1';
        $rspta = $cargo->mostrar($idcargo);
        //Codificar el resultado utilizando json
        echo json_encode( $rspta, true) ;
      break;

      case 'listar_cargo':
        $rspta = $cargo->listar();
        //Vamos a declarar un array
        $data = []; $cont = 1;

        $toltip = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';

        if ($rspta['status']) {
          while ($reg = $rspta['data']->fetch_object()) {
            $data[] = [
              "0" => $cont++,
              "1" =>'<button class="btn btn-warning btn-xs" onclick="mostrar_cargo(' . $reg->idcargo_persona  . ')" data-toggle="tooltip" data-original-title="Editar"><i class="fas fa-pencil-alt"></i></button>' .
                  ' <button class="btn btn-danger  btn-xs" onclick="eliminar_cargo(' . $reg->idcargo_persona  .', \''.encodeCadenaHtml($reg->nombre_cargo).'\')" data-toggle="tooltip" data-original-title="Eliminar o papelera"><i class="fas fa-skull-crossbones"></i> </button>',
              "2" => $reg->nombre_cargo,
              "3" => $reg->descripcion.$toltip,
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
