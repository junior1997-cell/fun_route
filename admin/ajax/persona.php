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
    if ($_SESSION['trabajadores'] == 1) {

      require_once "../modelos/Persona.php";

      $persona = new Persona();

      date_default_timezone_set('America/Lima');
      $date_now = date("d-m-Y h.i.s A");

      $imagen_error = "this.src='../dist/svg/user_default.svg'";
      $toltip = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';
      
      $idpersona	  	= isset($_POST["idpersona"])? limpiarCadena($_POST["idpersona"]):"";
      $nombre 		      = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
      $tipo_documento 	= isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";
      $num_documento  	= isset($_POST["num_documento"])? limpiarCadena($_POST["num_documento"]):"";
      $direccion		    = isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
      $telefono		      = isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";     
      $email			      = isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
      $cargo_persona     = isset($_POST["cargo_persona"])? $_POST["cargo_persona"] :"";

       
      $imagen1			    = isset($_POST["foto1"])? limpiarCadena($_POST["foto1"]):"";
      switch ($_GET["op"]) {

        case 'guardaryeditar':

          // imgen de perfil
          if (!file_exists($_FILES['foto1']['tmp_name']) || !is_uploaded_file($_FILES['foto1']['tmp_name'])) {

						$imagen1=$_POST["foto1_actual"]; $flat_img1 = false;

					} else {

						$ext1 = explode(".", $_FILES["foto1"]["name"]); $flat_img1 = true;						

            $imagen1 = $date_now .' '. rand(0, 20) . round(microtime(true)) . rand(21, 41) . '.' . end($ext1);

            move_uploaded_file($_FILES["foto1"]["tmp_name"], "../dist/img/persona/perfil/" . $imagen1);
						
					}

          if (empty($idpersona)){
            
            $rspta=$persona->insertar($nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email, $cargo_persona, $imagen1);
            
            echo json_encode($rspta, true);
  
          }else {

            // validamos si existe LA IMG para eliminarlo
            if ($flat_img1 == true) {
              $datos_f1 = $persona->obtenerImg($idpersona);
              $img1_ant = $datos_f1['data']['foto_perfil'];
              if ($img1_ant != "") { unlink("../dist/img/persona/perfil/" . $img1_ant);  }
            }            

            // editamos un persona existente
            $rspta=$persona->editar($idpersona, $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email, $cargo_persona, $imagen1);
            
            echo json_encode($rspta, true);
          }            

        break;

        case 'desactivar':

          $rspta=$persona->desactivar($_GET["id_tabla"]);

          echo json_encode($rspta, true);

        break;

        case 'eliminar':

          $rspta=$persona->eliminar($_GET["id_tabla"]);

          echo json_encode($rspta, true);

        break;

        case 'mostrar':

          $rspta=$persona->mostrar($idpersona);
          //Codificar el resultado utilizando json
          echo json_encode($rspta, true);

        break;

        case 'tbla_principal':          

          $rspta=$persona->tbla_principal();
          
          //Vamos a declarar un array
          $data= Array(); $cont=1;

          if ($rspta['status'] == true) {

            foreach ($rspta['data'] as $key => $value) {         
          
              $data[]=array(
                "0"=>$cont++,
                "1"=>'<button class="btn btn-warning btn-xs" onclick="mostrar('.$value['idpersona'].')" data-toggle="tooltip" data-original-title="Editar"><i class="fas fa-pencil-alt"></i></button>'.
                  ' <button class="btn btn-danger btn-xs" onclick="eliminar_persona('.$value['idpersona'].', \''.encodeCadenaHtml($value['nombre_persona']).'\')" data-toggle="tooltip" data-original-title="Eliminar o papelera"><i class="fas fa-skull-crossbones"></i></button>',
                "2"=>'<div class="d-flex align-items-center mx-auto">
                      <a onclick="ver_img_perfil(\'' .$value['foto_perfil'] . '\',\'' . $value['nombre_persona'] . '\')">
                        <div class="avatar avatar-circle">
                          <img class="avatar-img" src="../dist/img/persona/perfil/'.$value['foto_perfil'] . '" alt="Image Description" onerror="'.$imagen_error.'">
                        </div>
                      </a>
                      <div class="ml-3">
                        <small style="font-size: 14px;font-weight: bold;">'. $value['nombre_persona'] .'</small> <br>                         
                        <small class="text-muted"> ' . $value['tipo_documento'] .  ': ' . $value['numero_documento'] .  '</small> -
                        <small class="text-muted"> Cell : ' . $value['celular'] .  '</small>
                      </div>
                    </div>',
                "3"=> $value['direccion'],
                "4"=> $value['nombre_persona'],
                "5"=> $value['tipo_documento'],
                "6"=> $value['numero_documento'],
                "7"=> $value['celular'],
                "8"=> $value['correo'],

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

        /* =========================== C A R G O   P E R S O N A  =========================== */
        case 'cargo_persona':

          $rspta=$persona->cargo();
          $data = "";

          if ($rspta['status'] == true) {

            foreach ($rspta['data'] as $key => $reg) { 
             $data .= '<option value=' . $reg['idcargo_persona'] . '>' . $reg['nombre_cargo'] . '</option>';
           }
           $retorno = array(
             'status' => true, 
             'message' => 'Salió todo ok', 
             'data' => $data, 
           );
   
           echo json_encode($retorno, true);
 
         } else {
 
           echo json_encode($rspta, true); 
         }

      }

      //Fin de las validaciones de acceso
    } else {
      $retorno = ['status'=>'nopermiso', 'message'=>'Tu sesion a terminado pe, inicia nuevamente', 'data' => [] ];
      echo json_encode($retorno);
    }
  }

  ob_end_flush();

?>
