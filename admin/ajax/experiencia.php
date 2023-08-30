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

      require_once "../modelos/Experiencia.php";

      $experiencia = new Experiencia($_SESSION['idusuario']);

      date_default_timezone_set('America/Lima'); $date_now = date("d-m-Y--h-i-s-A");
      $imagen_error = "this.src='../dist/svg/user_default.svg'";
      $toltip = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';
      $scheme_host =  ($_SERVER['HTTP_HOST'] == 'localhost' ? $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/fun_route/admin/' :  $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/admin/');
      
      $idexperiencia	  	= isset($_POST["idexperiencia"])? limpiarCadena($_POST["idexperiencia"]):"";
      $nombre             = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
      $lugar              = isset($_POST["lugar"])? limpiarCadena($_POST["lugar"]):"";
      $comentario			    = isset($_POST["comentario"])? limpiarCadena($_POST["comentario"]):"";
      $estrella			      = isset($_POST["estrella"])? limpiarCadena($_POST["estrella"]):"";

      $imagen1			    = isset($_POST["foto1"])? limpiarCadena($_POST["foto1"]):"";

      //idexperiencia,nombre, lugar, estrella, comentario
      switch ($_GET["op"]) {

        case 'guardar_y_editar':

          // imgen de perfil
          if (!file_exists($_FILES['foto1']['tmp_name']) || !is_uploaded_file($_FILES['foto1']['tmp_name'])) {
						$imagen1=$_POST["foto1_actual"]; $flat_img1 = false;
					} else {
						$ext1 = explode(".", $_FILES["foto1"]["name"]); $flat_img1 = true;
            $imagen1 = $date_now .'--'. random_int(0, 20) . round(microtime(true)) . random_int(21, 41) . '.' . end($ext1);
            move_uploaded_file($_FILES["foto1"]["tmp_name"], "../dist/docs/experiencia/perfil/" . $imagen1);						
					}

          if (empty($idexperiencia)){
            
            $rspta=$experiencia->insertar($nombre, $lugar, $comentario, $estrella,$imagen1);
            
            echo json_encode($rspta, true);
  
          }else {

            // validamos si existe LA IMG para eliminarlo
            if ($flat_img1 == true) {
              $datos_f1 = $persona->obtenerImg($idpersona);
              $img1_ant = $datos_f1['data']['foto_perfil'];
              if ( !empty($img1_ant) ) { unlink("../dist/docs/experiencia/perfil/" . $img1_ant);  }
            }              

            // editamos un paquete existente
            $rspta=$experiencia->insertar($idexperiencia, $nombre, $lugar, $comentario, $estrella,$imagen1);

            echo json_encode($rspta, true);

          }            

        break;

        case 'verificar':

          $rspta=$experiencia->verificar($_POST["idexperiencia_tours"]);
 
           echo json_encode($rspta, true);
 
        break;

        case 'no_verificar':

          $rspta=$experiencia->no_verificar($_POST["idexperiencia_tours"]);
 
           echo json_encode($rspta, true);
 
        break;

        case 'desactivar':

         $rspta=$experiencia->desactivar($_GET["id_tabla"]);

          echo json_encode($rspta, true);

        break;

        case 'eliminar':

          $rspta=$experiencia->eliminar($_GET["id_tabla"]);

          echo json_encode($rspta, true);

        break;

        case 'mostrar':

          $rspta=$experiencia->mostrar($idexperiencia_tours);
          //Codificar el resultado utilizando json
          echo json_encode($rspta, true);

        break;

        case 'tbla_principal':          

          $rspta=$experiencia->tbla_principal();
          
          //Vamos a declarar un array
          $data= Array(); $cont=1;

          if ($rspta['status'] == true) {

            foreach ($rspta['data'] as $key => $value) {        

              $imagen = (empty($value['img_perfil']) ? '../dist/svg/user_default.svg' : '../dist/docs/experiencia/perfil/'.$value['img_perfil']) ;
              
                // Obtén el número de estrellas del hotel
                $numeroEstrellas = $value['estrella'];
                
                // Genera las estrellas en base al número obtenido
                $estrellasHTML = '';
                for ($i = 0; $i < 5; $i++) {
                    if ($i < $numeroEstrellas) {
                        $estrellasHTML .= '★'; // Estrella llena
                    } else {
                        $estrellasHTML .= '☆'; // Estrella vacía
                    }
                }
                
              $data[]=array(
                "0"=>$cont++,
                "1"=> ' <div class=" text-center">   
                <button class="btn btn-warning btn-sm" onclick="editar(' . $value['idexperiencia'] . ')" data-toggle="tooltip" data-original-title="Desactivado"><i class="fas fa-pencil-alt"></i></button>
                <button class="btn btn-danger  btn-sm" onclick="eliminar(' . $value['idexperiencia'] . ')" data-toggle="tooltip" data-original-title="Eliminar o Papelera"><i class="fas fa-skull-crossbones"></i></button>',
                "2"=>'<div class="user-block">
                  <img class="profile-user-img img-responsive img-circle cursor-pointer" src="'. $imagen .'" alt="User Image" onerror="'.$imagen_error.'" onclick="ver_img_persona(\'' . $imagen . '\', \''.encodeCadenaHtml($value['nombre']).'\');" data-toggle="tooltip" data-original-title="Ver foto">
                  <span class="username"><p class="text-primary m-b-02rem" >'. $value['nombre'] .'</p></span>
                </div>',
                "3"=>$value['lugar'],
                "4"=> '<textarea cols="30" rows="2" class="textarea_datatable" readonly="">' . $value['comentario'] . '</textarea>',
                "5" =>'<div class="rating text-warning text-center">'.$estrellasHTML.'</div>',

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
