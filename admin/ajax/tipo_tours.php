<?php
  ob_start();
  if (strlen(session_id()) < 1) {
    session_start(); //Validamos si existe o no la sesión
  }

  if (!isset($_SESSION["nombre"])) {
    $retorno = ['status'=>'login', 'message'=>'Tu sesion a terminado pe, inicia nuevamente', 'data' => [] ];
    echo json_encode($retorno);  //Validamos el acceso solo a los usuarios logueados al sistema.
  } else {
    
    require_once "../modelos/Tipo_tours.php";

    $tipo_tours = new Tipo_tours($_SESSION['idusuario']);

    $toltip = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';

    $idtipo_tours = isset($_POST["idtipo_tours"]) ? limpiarCadena($_POST["idtipo_tours"]) : "";
    $nombre_tt   = isset($_POST["nombre_tt"]) ? limpiarCadena($_POST["nombre_tt"]) : "";
    $descripcion_tt    = isset($_POST["descripcion_tt"]) ? limpiarCadena($_POST["descripcion_tt"]) : "";

    switch ($_GET["op"]) {
      case 'guardaryeditar_tipo_tours':
        if (empty($idtipo_tours)) {
          $rspta = $tipo_tours->insertar($nombre_tt, $descripcion_tt);
          echo json_encode( $rspta, true) ;
        } else {
          $rspta = $tipo_tours->editar($idtipo_tours, $nombre_tt, $descripcion_tt);
          echo json_encode( $rspta, true) ;
        }
      break;

      case 'desactivar_tipo_tours':
        $rspta = $tipo_tours->desactivar($_GET["id_tabla"]);
        echo json_encode( $rspta, true) ;
      break;

      case 'eliminar_tipo_tours':
        $rspta = $tipo_tours->eliminar($_GET["id_tabla"]);
        echo json_encode( $rspta, true) ;
      break;

      case 'mostrar_tipo_tours':
        $rspta = $tipo_tours->mostrar($idtipo_tours);
        //Codificar el resultado utilizando json
        echo json_encode( $rspta, true) ;
      break;

      case 'listar_tabla_principal':
        $rspta = $tipo_tours->listar_tabla_principal();
        //Vamos a declarar un array
        $data = [];  $cont = 1;       

        if ($rspta['status'] == true) {
          while ($reg = $rspta['data']->fetch_object()) {

            
            $data[] = [
              "0" => $cont++,
              "1" => '<button class="btn btn-warning btn-sm" onclick="mostrar_tipo_tours('.$reg->idtipo_tours.')" data-toggle="tooltip" data-original-title="Editar"><i class="fas fa-pencil-alt"></i></button>' .
              ' <button class="btn btn-danger  btn-sm" onclick="eliminar_tipo_tours('.$reg->idtipo_tours.', \''.encodeCadenaHtml($reg->nombre).'\')" data-toggle="tooltip" data-original-title="Eliminar o papelera"><i class="fas fa-skull-crossbones"></i> </button>',   
              "2" => $reg->nombre,
              "3" => '<div class="bg-color-242244245 " style="overflow: auto; resize: vertical; height: 45px;">'. $reg->descripcion .'</div>',
              "4" => ($reg->estado ? '<span class="text-center badge badge-success">Activado</span>' : '<span class="text-center badge badge-danger">Desactivado</span>').$toltip,
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
