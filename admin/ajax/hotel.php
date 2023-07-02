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
              "3" => $reg->estrellas,
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
