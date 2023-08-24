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

      require_once "../modelos/Galeria_paquete.php";

      $galeria_paquete = new Galeria_paquete($_SESSION['idusuario']);

      date_default_timezone_set('America/Lima'); $date_now = date("d-m-Y--h-i-s-A");
      $imagen_error = "this.src='../dist/svg/user_default.svg'";
      $toltip = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';
      $scheme_host =  ($_SERVER['HTTP_HOST'] == 'localhost' ? $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/fun_route/admin/' :  $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/admin/');
      
      $idgaleria_paquete	  	      = isset($_POST["idgaleria_paquete"])? limpiarCadena($_POST["idgaleria_paquete"]):"";
      $idpaquete	  	              = isset($_POST["idpaquete"])? limpiarCadena($_POST["idpaquete"]):"";
      $descripcion			            = isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
      switch ($_GET["op"]) {

        case 'guardar_y_editar_galeria_paquete':

          // imgen de galeria_p
          if (!file_exists($_FILES['doc1']['tmp_name']) || !is_uploaded_file($_FILES['doc1']['tmp_name'])) {
						$imagen1=$_POST["doc_old_1"]; $flat_img1 = false;
					} else {
            //guardar imagen
						$ext1 = explode(".", $_FILES["doc1"]["name"]); $flat_img1 = true;
            $imagen1 = $date_now .'--'. random_int(0, 20) . round(microtime(true)) . random_int(21, 41) . '.' . end($ext1);
            move_uploaded_file($_FILES["doc1"]["tmp_name"], "../dist/docs/galeria_paquete/galeria_p/" . $imagen1);						
					}

          if (empty($idgaleria_paquete)){
            
            $rspta=$galeria_paquete->insertar($idpaquete, $descripcion, $imagen1);
            
            echo json_encode($rspta, true);
  
          }else {

            // validamos si existe LA IMG para eliminarlo
            if ($flat_img1 == true) {
              $datos_f1 = $galeria_paquete->obtenerImg($idgaleria_paquete);
              $img1_ant = $datos_f1['data']['imagen'];
              if ( !empty($img1_ant) ) { unlink("../dist/docs/galeria_paquete/galeria_p/" . $img1_ant);  }
            }            

            // editamos una galeria existente
            $rspta=$galeria_paquete->editar($idgaleria_paquete,$idpaquete,$descripcion, $imagen1);
            
            echo json_encode($rspta, true);
          }            

        break;

        case 'desactivar':

          $rspta=$galeria_paquete->desactivar($_GET["id_tabla"]);

          echo json_encode($rspta, true);

        break;

        case 'eliminar':

          $rspta=$galeria_paquete->eliminar($_GET["id_tabla"]);

          echo json_encode($rspta, true);

        break;

        case 'mostrar':

          $rspta=$galeria_paquete->mostrar($idgaleria_paquete);
          //Codificar el resultado utilizando json
          echo json_encode($rspta, true);

        break;

        case 'tbla_principal':          

          $rspta=$galeria_paquete->tbla_principal();
          
          //Vamos a declarar un array
          $data= Array(); $cont=1;

          if ($rspta['status'] == true) {

            foreach ($rspta['data'] as $key => $value) {        

              $imagen = (empty($value['imagen']) ? '../dist/svg/user_default.svg' : '../dist/docs/galeria_paquete/galeria_p/'.$value['imagen']) ;
              
              $data[]=array(
                "0"=>$cont++,
                "1"=>' <button class="btn btn-warning btn-sm" onclick="mostrar_galeria_paquete(' . $value['idgaleria_paquete'] . ')" data-toggle="tooltip" data-original-title="Editar Galeria"><i class="fas fa-pencil-alt"></i></button>' .
                ' <button class="btn btn-danger  btn-sm" onclick="eliminar_galeria_paquete(' . $value['idgaleria_paquete'] .')" data-toggle="tooltip" data-original-title="Eliminar o Papelera"><i class="fas fa-skull-crossbones"></i></button>',
                "2"=>$value['nombre'],
                "3"=> '<textarea cols="30" rows="1" class="textarea_datatable" readonly="">' . $value['descripciongaleria'] . '</textarea>',
                "4"=>'<div class="user-block">
                <img class="profile-user-img img-responsive img-circle cursor-pointer" src="'. $imagen .'" alt="User Image" onerror="'.$imagen_error.'" onclick="ver_img_paquete(\'' . $imagen . '\', \''.encodeCadenaHtml($value['nombre']).'\');" data-toggle="tooltip" data-original-title="Ver foto">
              </div>',

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
