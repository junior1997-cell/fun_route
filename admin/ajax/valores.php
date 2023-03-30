<?php

ob_start();

if (strlen(session_id()) < 1) {
  session_start(); //Validamos si existe o no la sesión
}

if (!isset($_SESSION["nombre"])) {
  header("Location: ../vistas/login.html"); //Validamos el acceso solo a los usuarios logueados al sistema.
} else {
  //Validamos el acceso solo al usuario logueado y autorizado.
  if ($_SESSION['valores'] == 1) {

    require_once "../modelos/Valores.php";

    date_default_timezone_set('America/Lima');
    $date_now = date("d-m-Y h.i.s A");

    $valores = new Valores();
    $id_paginaweb = isset($_POST["id_paginaweb"]) ? limpiarCadena($_POST["id_paginaweb"]) : "";
    $carpeta_pag = isset($_POST["carpeta_pag"]) ? limpiarCadena($_POST["carpeta_pag"]) : "";
    $idvalores = isset($_POST["idvalores"]) ? limpiarCadena($_POST["idvalores"]) : "";
    $nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
    $descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";
  
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

          move_uploaded_file($_FILES["doc1"]["tmp_name"], "../dist/".$carpeta_pag."/img/$imagen_perfil");
        }

        if (empty($idvalores)) {
          
          $rspta = $valores->insertar($id_paginaweb,$nombre,$descripcion,$imagen_perfil); 
          echo json_encode($rspta, true);

        } else {
          
          if ($flat_img == true) {

            $datos_ficha1 = $valores->reg_img($idvalores);

            if ( $datos_ficha1['status'] ) {
      
              $ficha1_ant = $datos_ficha1['data']['icono'];
        
              if ($ficha1_ant != "") {

                unlink("../dist/".$carpeta_pag."/img/$ficha1_ant");
              }

            }

          }

          $rspta = $valores->editar($idvalores,$id_paginaweb,$nombre,$descripcion,$imagen_perfil);
          echo json_encode($rspta, true);

        }

      break;

      case 'eliminar':
        $rspta = $valores->eliminar($idvalores);
        echo json_encode($rspta, true);
      break;

      case 'mostrar_valor':
        $rspta = $valores->mostrar($idvalores);
        echo json_encode($rspta, true);
      break;

      case 'listar':

        $rspta = $valores->listar($_GET['id']);
        $carpeta = $_GET['carpeta'];
        //Vamos a declarar un array
        $data = [];
        $comprobante = '';
        $cont = 1;
        $imagen_error = "this.src='../dist/svg/defaul_valor.png'";

        if ($rspta['status']) {

          while ($reg = $rspta['data']->fetch_object()) {
            $img = "../dist/".$carpeta."/img/$reg->icono";
            $data[] = [
              "0" => '<button class="btn btn-warning btn-xs" onclick="mostrar(' .$reg->idvalores .')"><i class="fas fa-pencil-alt"></i></button>
                      <button class="btn btn-danger btn-xs" onclick="eliminar(' .$reg->idvalores .')"><i class="far fa-trash-alt"></i></button>',
              "1" =>  '<div class="d-flex align-items-center mx-auto">
                        <a onclick="ver_img_perfil(\'' . $reg->icono . '\',\'' . $reg->nombre_valor . '\')">
                          <div class="avatar avatar-circle">
                            <img class="avatar-img cursor-pointer" src="'.$img.'" alt="Image Description" onerror="'.$imagen_error.'">
                          </div>
                        </a>
                        <div class="ml-3">
                          <small style="font-size: 14px;font-weight: bold;">'. $reg->nombre_valor .'</small>
                        </div>
                      </div>',
              "2" =>'<textarea cols="30" rows="3" class="textarea_datatable" readonly="" style="font-size: 12px;">' . $reg->descripcion . '</textarea>'
            ];
          }
          $results = [
            "sEcho" => 1, //Información para el datatables
            "iTotalRecords" => count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords" => 1, //enviamos el total registros a visualizar
            "data" => $data,
          ];
          echo json_encode($results,true);

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
  } else {
    require 'noacceso.php';
  }
}

ob_end_flush();

?>
