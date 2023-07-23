<?php

ob_start();

if (strlen(session_id()) < 1) {

  session_start(); //Validamos si existe o no la sesión
}

if (!isset($_SESSION["nombre"])) {
  $retorno = ['status' => 'login', 'message' => 'Tu sesion a terminado pe, inicia nuevamente', 'data' => []];
  echo json_encode($retorno);  //Validamos el acceso solo a los usuarios logueados al sistema.
} else {

  //Validamos el acceso solo al usuario logueado y autorizado.
  if ($_SESSION['recurso'] == 1) {

    require_once "../modelos/Paquete.php";

    $paquete = new Paquete($_SESSION['idusuario']);

    date_default_timezone_set('America/Lima');
    $date_now = date("d-m-Y h.i.s A");

    $imagen_error = "this.src='../dist/svg/user_default.svg'";
    $toltip = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';

    $idpaquete            = isset($_POST["idpaquete"]) ? limpiarCadena($_POST["idpaquete"]) : "";
    $nombre               = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
    $cant_dias            = isset($_POST["cant_dias"]) ? limpiarCadena($_POST["cant_dias"]) : "";
    $cant_noches          = isset($_POST["cant_noches"]) ? limpiarCadena($_POST["cant_noches"]) : "";
    $descripcion          = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";
    $imagen1              = isset($_POST["doc1"]) ? limpiarCadena($_POST["doc1"]) : "";
    $incluye              = isset($_POST["incluye"]) ? limpiarCadena($_POST["incluye"]) : "";
    $no_incluye           = isset($_POST["no_incluye"]) ? limpiarCadena($_POST["no_incluye"]) : "";
    $recomendaciones      = isset($_POST["recomendaciones"]) ? limpiarCadena($_POST["recomendaciones"]) : "";
    $mapa                 = isset($_POST["mapa"]) ? limpiarCadena($_POST["mapa"]) : "";
    $costo                = isset($_POST["costo"]) ? limpiarCadena($_POST["costo"]) : "";
    $estado_descuento     = isset($_POST["estado_descuento"]) ? limpiarCadena($_POST["estado_descuento"]) : "";
    $porcentaje_descuento = isset($_POST["porcentaje_descuento"]) ? limpiarCadena($_POST["porcentaje_descuento"]) : "";
    $monto_descuento      = isset($_POST["monto_descuento"]) ? limpiarCadena($_POST["monto_descuento"]) : "";
    $resumen              = isset($_POST["resumen"]) ? limpiarCadena($_POST["resumen"]) : "" ;
    //---------------G A L E R I A-------------------
    $idpaqueteg          = isset($_POST["idpaqueteg"]) ? limpiarCadena($_POST["idpaqueteg"]) : "";
    $idgaleria_paquete   = isset($_POST["idgaleria_paquete"]) ? limpiarCadena($_POST["idgaleria_paquete"]) : "";
    $descripcion_g       = isset($_POST["descripcion_g"]) ? limpiarCadena($_POST["descripcion_g"]) : "";
    $img_galeria         = isset($_POST["doc2"]) ? limpiarCadena($_POST["doc2"]) : "";
    //$idpaqueteg,$idgaleria_paquete,$descripcion_g,$img_galeria
    $idtours             =isset($_POST['idtours']) ? $_POST['idtours'] : "0";
    $nombre_tours        =isset($_POST['nombre_tours'])? $_POST['nombre_tours'] : "";
    $numero_orden        =isset($_POST['numero_orden'])? $_POST['numero_orden'] : "";
    $actividad           =isset($_POST['actividad'])? $_POST['actividad'] : "";
    
    switch ($_GET["op"]) {

      case 'guardar_y_editar_paquete':

        // imgen de perfil
        if (!file_exists($_FILES['doc1']['tmp_name']) || !is_uploaded_file($_FILES['doc1']['tmp_name'])) {
          $imagen1 = $_POST["doc_old_1"];
          $flat_img1 = false;
        } else {
          //guardar imagen
          $ext1 = explode(".", $_FILES["doc1"]["name"]);
          $flat_img1 = true;
          $imagen1 = $date_now . ' ' . random_int(0, 20) . round(microtime(true)) . random_int(21, 41) . '.' . end($ext1);
          move_uploaded_file($_FILES["doc1"]["tmp_name"], "../dist/docs/paquete/perfil/" . $imagen1);
        }

        if (empty($idpaquete)) {

          $rspta = $paquete->insertar($nombre, $cant_dias, $cant_noches, $descripcion, $imagen1, $incluye, $no_incluye,
          $recomendaciones, $mapa, $costo, $estado_descuento, $porcentaje_descuento, $monto_descuento, $resumen, $idtours,$nombre_tours,$numero_orden,$actividad);

          echo json_encode($rspta, true);
        } else {

          // validamos si existe LA IMG para eliminarlo
          if ($flat_img1 == true) {
            $datos_f1 = $paquete->obtenerImg($idpaquete);
            $img1_ant = $datos_f1['data']['imagen'];
            if (!empty($img1_ant)) {
              unlink("../dist/docs/paquete/perfil/" . $img1_ant);
            }
          }

          // editamos un paquete existente
          $rspta = $paquete->editar($idpaquete,$nombre, $cant_dias, $cant_noches, $descripcion, $imagen1, $incluye, $no_incluye,
            $recomendaciones, $mapa, $costo, $estado_descuento, $porcentaje_descuento, $monto_descuento, $resumen, $_POST['iditinerario'],
            $idtours,$nombre_tours,$numero_orden,$actividad);

          echo json_encode($rspta, true);
        }

      break;

      case 'desactivar':

        $rspta = $paquete->desactivar($_GET["id_tabla"]);

        echo json_encode($rspta, true);

      break;

      case 'eliminar':

        $rspta = $paquete->eliminar($_GET["id_tabla"]);

        echo json_encode($rspta, true);

      break;

      case 'mostrar':

        $rspta = $paquete->mostrar($idpaquete);
        //Codificar el resultado utilizando json
        echo json_encode($rspta, true);

      break;

      case 'tbla_principal':

        $rspta = $paquete->tbla_principal();

        //Vamos a declarar un array
        $data = array();
        $cont = 1;

        if ($rspta['status'] == true) {

          foreach ($rspta['data'] as $key => $value) {

            $imagen = (empty($value['imagen']) ? '../dist/svg/user_default.svg' : '../dist/docs/paquete/perfil/' . $value['imagen']);
            $estado_descuento = ($value['estado_descuento']==1 ? '<span class="text-center badge badge-warning">En Promoción </span><br> <span class="text-center badge badge-warning">Descuento - ' .  $value['porcentaje_descuento'] . ' % </span>' : '<span class="text-center badge badge-info">Sin Promocionar</span>' );// true:false

            $descripcion = (strlen($value['descripcion']) > 130) ? substr($value['descripcion'], 0, 130).' ...' : $value['descripcion'];

            // estado_descuento, porcentaje_descuento, monto_descuento
            $data[] = array(
              "0" => $cont++,
              "1" => '<button class="btn btn-info btn-sm" onclick="ver_detalle_paquete(' . $value['idpaquete'] . ')" data-toggle="tooltip" data-original-title="Ver detalle compra"><i class="fa fa-eye"></i></button>' .
                ' <button class="btn btn-warning btn-sm" onclick="mostrar_paquete(' . $value['idpaquete'] . ')" data-toggle="tooltip" data-original-title="Editar compra"><i class="fas fa-pencil-alt"></i></button>' .
                ' <button class="btn btn-danger  btn-sm" onclick="eliminar_paquete(' . $value['idpaquete'] .'.,\'' . $value['nombre'] . '\')" data-toggle="tooltip" data-original-title="Eliminar o Papelera"><i class="fas fa-skull-crossbones"></i></button>',
              "2" => $value['nombre'],
              "3" => '<span class="text-center badge badge-success">' . $value['cant_dias'] . ' Días' . ' <b>/</b> ' .  $value['cant_noches'] . ' Noches </span>',
              "4" => $descripcion,
              "5" => '<div class="user-block">
                      <img class="profile-user-img img-responsive img-circle cursor-pointer" src="' . $imagen . '" alt="User Image" onerror="' . $imagen_error . '" onclick="ver_img_paquete(\'' . $imagen . '\', \'' . encodeCadenaHtml($value['nombre']) . '\');" data-toggle="tooltip" data-original-title="Ver foto">
                     </div>',
              "6" =>'S/ '.$value['costo'],
              "7" => $estado_descuento,
              "8" => '<button class="btn btn-info btn-sm" onclick="galeria(' . $value['idpaquete'] . ', \'' . encodeCadenaHtml($value['nombre']) . '\')" data-toggle="tooltip" data-original-title="Galería">Galería <i class="fa fa-eye"></i></button>'

            );
          }
          $results = array(
            "sEcho" => 1, //Información para el datatables
            "iTotalRecords" => count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords" => 1, //enviamos el total registros a visualizar
            "data" => $data
          );
          echo json_encode($results, true);
        } else {
          echo $rspta['code_error'] . ' - ' . $rspta['message'] . ' ' . $rspta['data'];
        }
      break;

      case 'ver_actividad':

        $rspta = $paquete->ver_actividad($_POST['idtours']);
        //Codificar el resultado utilizando json
        echo json_encode($rspta, true);

      break;
        /* ══════════════════════════════════════ T I P O  T O U R S ══════════════════════════════════ */
      case 'selec2tours':

        $rspta = $paquete->selec2tours();
        $cont = 1;
        $data = "";

        if ($rspta['status'] == true) {

          foreach ($rspta['data'] as $key => $value) {

            $data .= '<option value=' . $value['id'] . '>' . $value['nombre'] . '</option>';
          }

          $retorno = array(
            'status' => true,
            'message' => 'Salió todo ok',
            'data' => '<option value="1">NINGUNO</option>' . $data,
          );

          echo json_encode($retorno, true);
        } else {

          echo json_encode($rspta, true);
        }
      break;
      /* ══════════════════════════════════════ G A L E R Í A  ══════════════════════════════════ */
      /* ══════════════════════════════════════ G A L E R Í A  ══════════════════════════════════ */
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
          $imagen2 = $date_now . ' ' . random_int(0, 20) . round(microtime(true)) . random_int(21, 41) . '.' . end($ext2);
          move_uploaded_file($_FILES["doc2"]["tmp_name"], "../dist/docs/paquete/galeria/" . $imagen2);
        }

        if (empty($idgaleria_paquete)) {

          $rspta = $paquete->insertar_galeria($idpaqueteg,$descripcion_g,$imagen2);

          echo json_encode($rspta, true);
        }

      break;
      
      case 'mostrar_galeria':
        $rspta = $paquete->mostrar_galeria($_POST['idpaquete']);
        echo json_encode($rspta, true);
      break;

      case 'eliminar_imagen':
        $rspta = $paquete->eliminar_imagen($_POST['idgaleria_paquete']);
        echo json_encode($rspta, true);
      break;

      default:
      $rspta = ['status' => 'error_code', 'message' => 'Te has confundido en escribir en el <b>swich.</b>', 'data' => []];
      echo json_encode($rspta, true);
      break;
    }

    //Fin de las validaciones de acceso
  } else {
    $retorno = ['status' => 'nopermiso', 'message' => 'Tu sesion a terminado pe, inicia nuevamente', 'data' => []];
    echo json_encode($retorno);
  }
}

ob_end_flush();
