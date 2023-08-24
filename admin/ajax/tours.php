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
    if ($_SESSION['tours'] == 1) {

      require_once "../modelos/Tours.php";

      $tours = new Tours($_SESSION['idusuario']);

      date_default_timezone_set('America/Lima'); $date_now = date("d-m-Y--h-i-s-A");
      $imagen_error = "this.src='../dist/svg/user_default.svg'";
      $toltip = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';
      $scheme_host =  ($_SERVER['HTTP_HOST'] == 'localhost' ? $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/fun_route/admin/' :  $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/admin/');
      
      $idtours		            = isset($_POST["idtours"])? limpiarCadena($_POST["idtours"]):"";
      $nombre                 = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
      $idtipo_tours           = isset($_POST["idtipo_tours"])? limpiarCadena($_POST["idtipo_tours"]):"";
      $descripcion			      = isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
      $duracion			          = isset($_POST["duracion"])? limpiarCadena($_POST["duracion"]):"";
      $imagen                 = isset($_POST["doc1"])? limpiarCadena($_POST["doc1"]):"";
      $incluye                = isset($_POST["incluye"])? limpiarCadena($_POST["incluye"]):"";
      $no_incluye             = isset($_POST["no_incluye"])? limpiarCadena($_POST["no_incluye"]):"";
      $recomendaciones        = isset($_POST["recomendaciones"])? limpiarCadena($_POST["recomendaciones"]):"";
      $actividad              = isset($_POST["actividad"])? limpiarCadena($_POST["actividad"]):"";
      $costo                  = isset($_POST["costo"])? limpiarCadena($_POST["costo"]):"";
      $estado_descuento       = isset($_POST["estado_descuento"])? limpiarCadena($_POST["estado_descuento"]):"";
      $porcentaje_descuento   = isset($_POST["porcentaje_descuento"])? limpiarCadena($_POST["porcentaje_descuento"]):"";
      $monto_descuento        = isset($_POST["monto_descuento"])? limpiarCadena($_POST["monto_descuento"]):"";
      $resumen_actividad      = isset($_POST["resumen_actividad"])? limpiarCadena($_POST["resumen_actividad"]):"";
      $resumen_comida         = isset($_POST["resumen_comida"])? limpiarCadena($_POST["resumen_comida"]):"";
      $alojamiento            = isset($_POST["alojamiento"])? limpiarCadena($_POST["alojamiento"]):"";

      //$idtours,$nombre,$idtipo_tours,$descripcion,$duracion,$incluye,$no_incluye,$recomendaciones,$actividad,$costo,$estado_descuento,$porcentaje_descuento,$monto_descuento,$imagen
      // galeria tours
      $idgaleria_tours		   = isset($_POST["idgaleria_tours"])? limpiarCadena($_POST["idgaleria_tours"]):"";
      $idtours_t		         = isset($_POST["idtours_t"])? limpiarCadena($_POST["idtours_t"]):"";
      $descripcion_g		     = isset($_POST["descripcion_g"])? limpiarCadena($_POST["descripcion_g"]):"";
      $doc2		               = isset($_POST["doc2"])? limpiarCadena($_POST["doc2"]):"";

      
      switch ($_GET["op"]) {

        case 'guardar_y_editar_tours':

          // imgen de perfil
          if (!file_exists($_FILES['doc1']['tmp_name']) || !is_uploaded_file($_FILES['doc1']['tmp_name'])) {
						$imagen=$_POST["doc_old_1"]; $flat_img1 = false;
					} else {
            //guardar imagen
						$ext1 = explode(".", $_FILES["doc1"]["name"]); $flat_img1 = true;
            $imagen = $date_now .'--'. random_int(0, 20) . round(microtime(true)) . random_int(21, 41) . '.' . end($ext1);
            move_uploaded_file($_FILES["doc1"]["tmp_name"], "../dist/docs/tours/perfil/" . $imagen);						
					}

          if (empty($idtours)){
            
            $rspta=$tours->insertar($nombre,$idtipo_tours,$descripcion,$duracion,$incluye,$no_incluye,$recomendaciones,$actividad,$costo,$estado_descuento,$porcentaje_descuento,$monto_descuento,$imagen,$resumen_actividad,$resumen_comida,$alojamiento);
            
            echo json_encode($rspta, true);
  
          }else {

            // validamos si existe LA IMG para eliminarlo
            if ($flat_img1 == true) {
              $datos_f1 = $tours->obtenerImg($idtours);
              $img1_ant = $datos_f1['data']['imagen'];
              if ( !empty($img1_ant) ) { unlink("../dist/docs/tours/perfil/" . $img1_ant);  }
            }            

            // editamos un tours existente
            $rspta=$tours->editar($idtours,$nombre,$idtipo_tours,$descripcion,$duracion,$incluye,$no_incluye,$recomendaciones,$actividad,$costo,$estado_descuento,$porcentaje_descuento,$monto_descuento,$imagen,$resumen_actividad,$resumen_comida,$alojamiento);
            
            echo json_encode($rspta, true);
          }            

        break;

        case 'desactivar':

          $rspta=$tours->desactivar($_GET["id_tabla"]);

          echo json_encode($rspta, true);

        break;

        case 'eliminar':

          $rspta=$tours->eliminar($_GET["id_tabla"]);

          echo json_encode($rspta, true);

        break;

        case 'mostrar':

          $rspta=$tours->mostrar($idtours);
          //Codificar el resultado utilizando json
          echo json_encode($rspta, true);

        break;

        case 'mostrar_vista':
          $rspta = $tours->mostrar_vista();
          echo json_encode($rspta, true);
        break;      

        case 'tbla_principal':          

          $rspta=$tours->tbla_principal();
          
          //Vamos a declarar un array En Promoción , Sin Promocionar
          $data= Array(); $cont=1;

          if ($rspta['status'] == true) {

            foreach ($rspta['data'] as $key => $value) {        

              $imagen = (empty($value['imagen']) ? '../dist/svg/user_default.svg' : '../dist/docs/tours/perfil/'.$value['imagen']) ;
              $estado_descuento = ($value['estado_descuento']==1 ? '<span class="text-center badge badge-warning">En Promoción</span>' : '<span class="text-center badge badge-info">Sin Promocionar</span>' );// true:false
              $alojamiento = ($value['alojamiento'] == 1 ? '<div class="text-center"><span class="text-center badge badge-warning" style="border: 2px solid green; background-color: green; color: white;">Incluye</span></div>' : '<div class="text-center"><span class="text-center badge badge-info" style="border: 2px solid red; background-color: red; color: white;">No Incluye</span></div>');
              
              $data[]=array(
                "0"=>$cont++,
                "1"=>'<button class="btn btn-info btn-sm" onclick="ver_detalle_tours(' . $value['idtours'] .')" data-toggle="tooltip" data-original-title="Ver detalle tours"><i class="fa fa-eye"></i></button>' . 
                ' <button class="btn btn-warning btn-sm" onclick="mostrar_tours(' . $value['idtours'] . ')" data-toggle="tooltip" data-original-title="Editar tours"><i class="fas fa-pencil-alt"></i></button>' .
                ' <button class="btn btn-danger  btn-sm" onclick="eliminar_tours(' . $value['idtours'] .'.,\'' . $value['nombre'] . '\')" data-toggle="tooltip" data-original-title="Eliminar o Papelera"><i class="fas fa-skull-crossbones"></i></button>',
                "2"=>$value['nombre'],
                "3"=>$alojamiento,
                "4"=> '<textarea cols="30" rows="2" class="textarea_datatable" readonly="">' . $value['descripcion'] . '</textarea>',
                "5"=>'<div class="user-block center">
                      <img class="profile-user-img img-responsive img-circle cursor-pointer" src="'. $imagen .'" alt="User Image" onerror="'.$imagen_error.'" onclick="ver_img_tours(\'' . $imagen . '\', \''.encodeCadenaHtml($value['nombre']).'\');" data-toggle="tooltip" data-original-title="Ver foto">
                     </div>',
                "6"=>$estado_descuento,
                "7"=>'<button class="btn btn-info btn-sm" onclick="galeria(' . $value['idtours'] .', \'' . encodeCadenaHtml($value['nombre']) . '\')" data-toggle="tooltip" data-original-title="Ver detalle compra">Galería <i class="fa fa-eye"></i></button>',
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

        /* ══════════════════════════════════════ T I P O  T O U R S ══════════════════════════════════ */
        case 'selec2tipotours': 
      
          $rspta = $tours->selec2tipotours(); $cont = 1; $data = "";

          if ($rspta['status'] == true) {

            foreach ($rspta['data'] as $key => $value) {  

              $data .= '<option value=' . $value['id'] . '>' . $value['nombre'] .'</option>';
            }

            $retorno = array(
              'status' => true, 
              'message' => 'Salió todo ok', 
              'data' => '<option value="1">NINGUNO</option>'.$data, 
            );
    
            echo json_encode($retorno, true);

          } else {

            echo json_encode($rspta, true); 
          }
        break;

        /* ══════════════════════════════════════ G A L E R Í A  ══════════════════════════════════ */
        /* ══════════════════════════════════════ G A L E R Í A  ══════════════════════════════════ */
        //$idpaqueteg,$idgaleria_paquete,$descripcion_g,$img_galeria
        case 'guardar_y_editar_galeria':

          // imgen de perfil
          if (!file_exists($_FILES['doc2']['tmp_name']) || !is_uploaded_file($_FILES['doc2']['tmp_name'])) {
            $imagen2 = $_POST["doc_old_2"];
            $flat_img2 = false;
          } else {
            //guardar imagen
            $ext2 = explode(".", $_FILES["doc2"]["name"]);
            $flat_img2 = true;
            $imagen2 = $date_now . '--' . random_int(0, 20) . round(microtime(true)) . random_int(21, 41) . '.' . end($ext2);
            move_uploaded_file($_FILES["doc2"]["tmp_name"], "../dist/docs/tours/galeria/" . $imagen2);
          }

          if (empty($idgaleria_tours)) {

            $rspta = $tours->insertar_galeria($idtours_t,$descripcion_g,$imagen2);

            echo json_encode($rspta, true);
          }

        break;
        
        case 'mostrar_galeria':
          $rspta = $tours->mostrar_galeria($_POST['idtours']);
          echo json_encode($rspta, true);
        break;

        case 'eliminar_imagen':
          $rspta = $tours->eliminar_imagen($_POST['idgaleria_tours']);
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