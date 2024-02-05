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
  if ($_SESSION['acceso'] == 1) {
  
    require_once "../modelos/Noticias_inicio.php";
    $noticias = new Noticias_inicio($_SESSION['idusuario']);

    date_default_timezone_set('America/Lima'); $date_now = date("d_m_Y__h_i_s_A");
    $imagen_error = "this.src='../dist/svg/404-v2.svg'";
    $toltip       = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';
    $scheme_host  =  ($_SERVER['HTTP_HOST'] == 'localhost' ? $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/fun_route/admin/' :  $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/admin/');

    $idnoticias_inicio  = isset($_POST["idnoticias_inicio"]) ? limpiarCadena($_POST["idnoticias_inicio"]) : "";
    $titulo             = isset($_POST["titulo"]) ? limpiarCadena($_POST["titulo"]) : "";
    $descripcion        = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";
    $img                = isset($_POST["doc2"]) ? limpiarCadena($_POST["doc2"]) : "";
  

    switch ($_GET["op"]) {

      case 'galeria_noticia':
        $rspta = $noticias->mostrar();
        echo json_encode($rspta, true);
      break;

      case 'guardar_noticia':
        // imgen de perfil
        if (!file_exists($_FILES['doc2']['tmp_name']) || !is_uploaded_file($_FILES['doc2']['tmp_name'])) {
          $imagen = $_POST["doc_old_2"];
          $flat_img2 = false;
        } else {
          //guardar imagen
          $ext2 = explode(".", $_FILES["doc2"]["name"]);
          $flat_img2 = true;
          $imagen = $date_now . '__' . random_int(0, 20) . round(microtime(true)) . random_int(21, 41) . '.' . end($ext2);
          move_uploaded_file($_FILES["doc2"]["tmp_name"], "../dist/docs/noticia_inicio/" . $imagen);
        }
        if (empty($idnoticias_inicio)) {
          $rspta = $noticias->insertar($titulo, $descripcion, $imagen);
          echo json_encode($rspta, true);
        }else{
          // validamos si existe LA IMG para eliminarlo
          if ($flat_img2 == true) {
            $datos_f1 = $noticias->mostrar_editar_noticia($idnoticias_inicio);
            $img1_ant = $datos_f1['data']['imagen'];
            if (!empty($img1_ant)) { unlink("../dist/docs/noticia_inicio/" . $img1_ant); }
          }

          $rspta = $noticias->editar($idnoticias_inicio, $titulo, $descripcion, $imagen);
          echo json_encode($rspta, true);
        }
      break;

      case 'mostrar_editar_noticia':
        $rspta = $noticias->mostrar_editar_noticia($_POST['idnoticias_inicio']);
        echo json_encode($rspta, true);
      break;

      case 'eliminar':
        $rspta = $noticias->eliminar($_POST['idnoticias_inicio']);
        echo json_encode($rspta, true);
      break;

      case 'visible':
        $rspta = $noticias->ver_o_no_ver($_POST['idnoticias_inicio'], $_POST['estado_mostrar']);
        echo json_encode($rspta, true);
      break;

    }

  } else {
    $retorno = ['status' => 'nopermiso', 'message' => 'Tu sesion a terminado pe, inicia nuevamente', 'data' => []];
    echo json_encode($retorno);
  }

}

ob_end_flush();