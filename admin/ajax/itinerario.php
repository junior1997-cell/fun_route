<?php

  ob_start();

  if (strlen(session_id()) < 1) {

    session_start(); //Validamos si existe o no la sesión
  }

  if (!isset($_SESSION["nombre"])) {
    $retorno = ['status'=>'login', 'message'=>'Tu sesion a terminado pe, inicia nuevamente', 'data' => [] ];
    echo json_encode($retorno);  //Validamos el acceso solo a los usuarios logueados al sistema.
  } else {

    //Validamos el acceso solo al usuario logueado y autorizado.
    if ($_SESSION['recurso'] == 1) {

      require_once "../modelos/Itinerario.php";

      $itinerario = new Itinerario($_SESSION['idusuario']);

      date_default_timezone_set('America/Lima'); $date_now = date("d-m-Y--h-i-s-A");
      $imagen_error = "this.src='../dist/svg/user_default.svg'";
      $toltip = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';
      $scheme_host =  ($_SERVER['HTTP_HOST'] == 'localhost' ? $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/fun_route/admin/' :  $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/admin/');
      
      $iditinerario	  	  = isset($_POST["iditinerario"])? limpiarCadena($_POST["iditinerario"]):"";
      $idpaquete	  	    = isset($_POST["idpaquete"])? limpiarCadena($_POST["idpaquete"]):"";
      $mapa	  	          = isset($_POST["mapa"])? limpiarCadena($_POST["mapa"]):"";
      $incluye            = isset($_POST["incluye"])? limpiarCadena($_POST["incluye"]):"";
      $no_incluye         = isset($_POST["no_incluye"])? limpiarCadena($_POST["no_incluye"]):"";
      $recomendaciones	  = isset($_POST["recomendaciones"])? limpiarCadena($_POST["recomendaciones"]):"";
      
      switch ($_GET["op"]) {

        case 'guardar_y_editar_itinerario':

          if (empty($iditinerario)){
            
            $rspta=$itinerario->insertar($idpaquete,$mapa, $incluye, $no_incluye, $recomendaciones);
            
            echo json_encode($rspta, true);
  
          }else {
               // editamos un recomendaciones existente
            $rspta=$itinerario->editar($iditinerario,$idpaquete,$mapa, $incluye, $no_incluye, $recomendaciones);
            echo json_encode($rspta, true);
          }            

        break;

        case 'desactivar':

          $rspta=$itinerario->desactivar($_GET["id_tabla"]);

          echo json_encode($rspta, true);

        break;

        case 'eliminar':

          $rspta=$itinerario->eliminar($_GET["id_tabla"]);

          echo json_encode($rspta, true);

        break;

        case 'mostrar':

          $rspta=$itinerario->mostrar($iditinerario);
          //Codificar el resultado utilizando json
          echo json_encode($rspta, true);

        break;

        case 'tbla_principal':          

          $rspta=$itinerario->tbla_principal();
          
          //Vamos a declarar un array
          $data= Array(); $cont=1;

          if ($rspta['status'] == true) {

            foreach ($rspta['data'] as $key => $value) {        
 
              $data[]=array(
                "0"=>$cont++,
                "1"=>'<button class="btn btn-warning btn-sm" onclick="mostrar_itinerario(' . $value['iditinerario'] . ')" data-toggle="tooltip" data-original-title="Editar compra"><i class="fas fa-pencil-alt"></i></button>' .
                ' <button class="btn btn-danger  btn-sm" onclick="eliminar_itinerario(' . $value['iditinerario'] .')" data-toggle="tooltip" data-original-title="Eliminar o Papelera"><i class="fas fa-skull-crossbones"></i></button>',
                "2"=>$value['mapa'],
                "3"=>$value['incluye'],
                "4"=>$value['no_incluye'],
                "5"=>$value['recomendaciones'],
              );
            }
            $results = array(
              "sEcho"=>1, //Información para el datatables
              "iTotalRecords"=>count($data), //enviamos el total registros al datatable
              "iTotalDisplayRecords"=>1, //enviamos el total registros a visualizar
              "data"=>$data);
            echo json_encode($results, true);

          } else {
            echo $rspta['code_error'] .' - '. $rspta['message'] .' '. $rspta['data'];
          }
        break;  

        case 'verdatos':
          $rspta=$persona->verdatos($idpersona);
          //Codificar el resultado utilizando json
          echo json_encode($rspta, true);
        break;        

        case 'formato_banco':           
          $rspta=$persona->formato_banco($_POST["idbanco"]);
          //Codificar el resultado utilizando json
          echo json_encode($rspta, true);           
        break;

        /* =========================== S E C C I O N   R E C U P E R A R   B A N C O S =========================== */
        case 'recuperar_banco':           
          $rspta=$persona->recuperar_banco();
          //Codificar el resultado utilizando json
          echo json_encode($rspta, true);           
        break;
        /* =========================== S E C C I O N  T I P O   P E R S O N A  =========================== */
        case 'tipo_persona':

          $rspta=$persona->tipo_persona();
          //Codificar el resultado utilizando json
          echo json_encode($rspta, true);

        break;

        default: 
          $rspta = ['status'=>'error_code', 'message'=>'Te has confundido en escribir en el <b>swich.</b>', 'data'=>[]]; echo json_encode($rspta, true); 
        break;

      }

      //Fin de las validaciones de acceso
    } else {
      $retorno = ['status'=>'nopermiso', 'message'=>'Tu sesion a terminado pe, inicia nuevamente', 'data' => [] ];
      echo json_encode($retorno);
    }
  }

  ob_end_flush();

?>
