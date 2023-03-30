<?php

ob_start();

if (strlen(session_id()) < 1) {
  session_start(); //Validamos si existe o no la sesión
}

if (!isset($_SESSION["nombre"])) {
  header("Location: ../vistas/login.html"); //Validamos el acceso solo a los usuarios logueados al sistema.
} else {
  //Validamos el acceso solo al usuario logueado y autorizado.
  if ($_SESSION['sistema_informativo'] == 1) {
    require_once "../modelos/Proveedores.php";

    date_default_timezone_set('America/Lima');
    $date_now = date("d-m-Y h.i.s A");

    $proveedores = new Proveedores();

    $idproveedor = isset($_POST["idproveedor"]) ? limpiarCadena($_POST["idproveedor"]) : "";
    $id_proveedor_adm = isset($_POST["id_proveedor_adm"]) ? limpiarCadena($_POST["id_proveedor_adm"]) : "";
    $descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";

    $id_proveedor_adm_edith = isset($_POST["id_proveedor_adm_edith"]) ? limpiarCadena($_POST["id_proveedor_adm_edith"]) : "";

    $foto2 = isset($_POST["doc1"]) ? limpiarCadena($_POST["doc1"]) : "";

    switch ($_GET["op"]) {

      case 'guardaryeditar':

        if (!file_exists($_FILES['doc1']['tmp_name']) || !is_uploaded_file($_FILES['doc1']['tmp_name'])) {
          $imagen_perfil = $_POST["doc_old_1"];
          $flat_img = false;
        } else {
          $ext1 = explode(".", $_FILES["doc1"]["name"]);
          $flat_img = true;

          $imagen_perfil = $date_now.' '.rand(0, 20) . round(microtime(true)) . rand(21, 41) . '.' . end($ext1);

          move_uploaded_file($_FILES["doc1"]["tmp_name"], "../dist/img/proveedores/imagen_perfil/" . $imagen_perfil);
        }

        if (empty($idproveedor)) {
          $rspta = $proveedores->insertar($id_proveedor_adm, $descripcion, $imagen_perfil);
          echo json_encode($rspta, true);
        } else {

          if ($flat_img == true) {
            $datos_ficha1 = $proveedores->reg_img($idproveedor);

            if ($datos_ficha1['status']) {
              $ficha1_ant = $datos_ficha1['data']['img_perfil'];

              if ($ficha1_ant != "") {
                unlink("../dist/img/proveedores/imagen_perfil/" . $ficha1_ant);
              }
            }
          }

          $rspta = $proveedores->editar($idproveedor, $id_proveedor_adm_edith, $descripcion, $imagen_perfil);
          echo json_encode($rspta, true);
        }

      break;

      case 'eliminar':
        $rspta = $proveedores->eliminar($idproveedor);
        echo json_encode($rspta, true);
      break;

      case 'mostrar':
        $rspta = $proveedores->mostrar($idproveedor);
        echo json_encode($rspta, true);
      break;

      case 'listar':

        $rspta = $proveedores->listar();
        //Vamos a declarar un array
        $data = [];
        $comprobante = '';
        $cont = 1;
        $imagen_error = "this.src='../dist/svg/defaul_valor.png'";
        if ($rspta['status']) {
          while ($reg = $rspta['data']->fetch_object()) {
            $data[] = [
              "0" =>
                '<button class="btn btn-warning btn-xs" onclick="mostrar(' . $reg->idproveedor . ')"><i class="fas fa-pencil-alt"></i></button>
                        <button class="btn btn-danger btn-xs" onclick="eliminar(' . $reg->idproveedor . ')"><i class="far fa-trash-alt"></i></button>',
              "1" => '<div class="d-flex align-items-center mx-auto"> 
                <a onclick="ver_img_perfil(\'' . $reg->img_perfil . '\',\'' . $reg->razon_social . '\')">
                  <div class="avatar avatar-circle">
                    <img class="avatar-img" src="../dist/img/proveedores/imagen_perfil/' . $reg->img_perfil . '" alt="Image Description" onerror="' . $imagen_error . '">
                  </div>
                </a>
                <div class="ml-3">
                  <small style="font-size: 14px;font-weight: bold;">' . $reg->razon_social . '</small>
                  <p style="font-size: 14px;font-weight: bold;">' . $reg->tipo_documento . ' : ' . $reg->num_documento . '</p>
                </div>
              </div>',
              "2" => '<textarea cols="30" rows="4" class="textarea_datatable text-justify" readonly="">' . $reg->descripcion . '</textarea>',
            ];
          }
          $results = [
            "sEcho" => 1, //Información para el datatables
            "iTotalRecords" => count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords" => 1, //enviamos el total registros a visualizar
            "data" => $data,
          ];
          echo json_encode($results, true);
        } else {
          echo $rspta['code_error'] . ' - ' . $rspta['message'] . ' ' . $rspta['data'];
        }

      break;

      case 'select2_proveedor':
        $rspta = $proveedores->select2_proveedor();

        foreach ($rspta as $key => $reg) {
          echo '<option value=' . $reg['idproveedor'] . '>' . $reg['razon_social'] . ' - ' . $reg['ruc'] . '</option>';
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
  } else {
    require 'noacceso.php';
  }
}

ob_end_flush();

?>
