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

      require_once "../modelos/Comentario_tours.php";

      $comentario_tours = new Comentario_tours($_SESSION['idusuario']);

      date_default_timezone_set('America/Lima'); $date_now = date("d-m-Y h.i.s A");

      $imagen_error = "this.src='../dist/svg/user_default.svg'";
      $toltip = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';
      
      $idcomentario	  	  = isset($_POST["idcomentario"])? limpiarCadena($_POST["idcomentario"]):"";
      $idtours	  	      = isset($_POST["idtours"])? limpiarCadena($_POST["idtours"]):"";
      $nombre             = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
      $correo             = isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
      $nota			          = isset($_POST["nota"])? limpiarCadena($_POST["nota"]):"";
      $fecha			        = isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
      
      switch ($_GET["op"]) {

        case 'guardar_y_editar_comentario':

          // imgen de perfil
          if (!file_exists($_FILES['doc1']['tmp_name']) || !is_uploaded_file($_FILES['doc1']['tmp_name'])) {
						$imagen1=$_POST["doc_old_1"]; $flat_img1 = false;
					} else {
						$ext1 = explode(".", $_FILES["doc1"]["name"]); $flat_img1 = true;
            $imagen1 = $date_now .' '. random_int(0, 20) . round(microtime(true)) . random_int(21, 41) . '.' . end($ext1);
            move_uploaded_file($_FILES["doc1"]["tmp_name"], "../dist/docs/paquete/perfil/" . $imagen1);						
					}

          if (empty($idcomentario)){
            
           // $rspta=$comentario->insertar($nombre, $correo, $comentario, $fecha, $estrella);
            
            echo json_encode($rspta, true);
  
          }else {

            // validamos si existe LA IMG para eliminarlo
            if ($flat_img1 == true) {
              $datos_f1 = $paquete->obtenerImg($idpaquete);
              $img1_ant = $datos_f1['data']['imagen'];
              if ( !empty($img1_ant) ) { unlink("../dist/docs/paquete/perfil/" . $img1_ant);  }
            }            

            // editamos un paquete existente
            //$rspta=$comentario->editar($nombre, $correo, $nota, $fecha, $estrella);
            
            //echo json_encode($rspta, true);

          }            

        break;

        case 'verificar':

          $rspta=$comentario_tours->verificar($_POST["idcomentario_tours"]);
 
           echo json_encode($rspta, true);
 
        break;

        case 'no_verificar':

          $rspta=$comentario_tours->no_verificar($_POST["idcomentario_tours"]);
 
           echo json_encode($rspta, true);
 
        break;

        case 'desactivar':

         $rspta=$comentario_tours->desactivar($_GET["id_tabla"]);

          echo json_encode($rspta, true);

        break;

        case 'eliminar':

          $rspta=$comentario_tours->eliminar($_GET["id_tabla"]);

          echo json_encode($rspta, true);

        break;

        case 'mostrar':

          $rspta=$comentario_tours->mostrar($idcomentario_tours);
          //Codificar el resultado utilizando json
          echo json_encode($rspta, true);

        break;

        case 'tbla_principal':          

          $rspta=$comentario_tours->tbla_principal();
          
          //Vamos a declarar un array
          $data= Array(); $cont=1;

          if ($rspta['status'] == true) {

            foreach ($rspta['data'] as $key => $value) {        

              $imagen = (empty($value['imagen']) ? '../dist/svg/user_default.svg' : '../dist/docs/paquete/perfil/'.$value['imagen']) ;
              
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
                $estadovisto = ($value['estado_aceptado']==1 ? '<span class="text-center badge badge-success">Verificado</span>' : '<span class="text-center badge badge-danger">Sin Verificar</span>' );// true:fals
              $data[]=array(
                "0"=>$cont++,
                "1"=> $value['estado_aceptado'] ? ' <div class=" text-center">   
                <button class="btn btn-warning btn-sm" onclick="desactivar_comentario(' . $value['idcomentario_tours'] . ')" data-toggle="tooltip" data-original-title="Desactivado"><i class="fas fa-times"></i></button>
                <button class="btn btn-danger  btn-sm" onclick="eliminar_comentario_tours(' . $value['idcomentario_tours'] . ')" data-toggle="tooltip" data-original-title="Eliminar o Papelera"><i class="fas fa-skull-crossbones"></i></button>
                        </div>' : ' <div class=" text-center">   
                        <button class="btn btn-info btn-sm" onclick="verificar_comentario(' . $value['idcomentario_tours'] . ')" data-toggle="tooltip" data-original-title="Verificar"><i class="fas fa-check"></i></button>
                        <button class="btn btn-danger  btn-sm" onclick="eliminar_comentario_tours(' . $value['idcomentario_tours'] . ')" data-toggle="tooltip" data-original-title="Eliminar o Papelera"><i class="fas fa-skull-crossbones"></i></button>
                                </div>',
                "2"=>'<div class="user-block">
                        <span class="username"><p class="text-primary m-b-02rem" >'. $value['nombre'] .'</p></span>
                        </div>',
                "3"=>$value['name_comentario'],
                "4"=>$value['correo'],
                "5"=> '<textarea cols="30" rows="2" class="textarea_datatable" readonly="">' . $value['comentario'] . '</textarea>',
                "6" => date('d-m-Y', strtotime($value['fecha'])),
                "7"=>'<div class="rating text-warning text-center">'.$estrellasHTML.'</div>',
                "8"=>' <div class=" text-center">'.$estadovisto.'</div>',

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
