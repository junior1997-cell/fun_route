<?php

ob_start();

if (strlen(session_id()) < 1) {
  session_start(); //Validamos si existe o no la sesión
}

if (!isset($_SESSION["nombre"])) {
  header("Location: ../vistas/login.html"); //Validamos el acceso solo a los usuarios logueados al sistema.
} else {

  if ($_SESSION['sistema_informativo'] == 1) {

    date_default_timezone_set('America/Lima');
    $date_now = date("d-m-Y h.i.s A");

    require_once "../modelos/Proyecto.php";
    //require_once "../dist/img/proyecto/img_galeria/marca_agua.php";


    $proyecto = new Proyecto();
    $toltip = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';

    $scheme_host=  ($_SERVER['HTTP_HOST'] == 'localhost' ? 'http://localhost/page_amazon_lab/' :  $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/');

    //-----------------------P R O Y E C T O ---------------------------------

    $idproyecto = isset($_POST["idproyecto"]) ? limpiarCadena($_POST["idproyecto"]) : "";
    $id_pryecto_adm = isset($_POST["id_pryecto_adm"]) ? limpiarCadena($_POST["id_pryecto_adm"]) : "";
    $descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";

    $id_pryecto_adm_edith = isset($_POST["id_pryecto_adm_edith"]) ? limpiarCadena($_POST["id_pryecto_adm_edith"]) : "";
  
    $foto1 = isset($_POST["doc1"]) ? limpiarCadena($_POST["doc1"]) : "";


    //-----------------------G A L E R I A------------------------------------

    $idgaleria_proyecto = isset($_POST["idgaleria_proyecto"]) ? limpiarCadena($_POST["idgaleria_proyecto"]) : "";
    $idproyecto_img = isset($_POST["idproyecto_img"]) ? limpiarCadena($_POST["idproyecto_img"]) : "";
    $id_fase_select = isset($_POST["id_fase_select"]) ? limpiarCadena($_POST["id_fase_select"]) : "";
    $nombre_img = isset($_POST["nombre_img"]) ? limpiarCadena($_POST["nombre_img"]) : "";  
    $foto2 = isset($_POST["doc2"]) ? limpiarCadena($_POST["doc2"]) : "";

    //-----------------------F A S E S -----------------------------------------

    $idfase = isset($_POST["idfase"]) ? limpiarCadena($_POST["idfase"]) : "";
    $idproyecto_fase = isset($_POST["idproyecto_fase"]) ? limpiarCadena($_POST["idproyecto_fase"]) : "";
    $n_fase = isset($_POST["n_fase"]) ? limpiarCadena($_POST["n_fase"]) : "";
    $nombre_f = isset($_POST["nombre_f"]) ? limpiarCadena($_POST["nombre_f"]) : "";
    
    switch ($_GET["op"]) {

      //------------------------------------------------------------------------
      //-----------------------P R O Y E C T O ---------------------------------
      //------------------------------------------------------------------------

      case 'guardaryeditar':

        if (!file_exists($_FILES['doc1']['tmp_name']) || !is_uploaded_file($_FILES['doc1']['tmp_name'])) {
          $imagen_perfil = $_POST["doc_old_1"];
          $flat_img = false;
        } else {
          $ext1 = explode(".", $_FILES["doc1"]["name"]);
          $flat_img = true;

          $imagen_perfil = $date_now.' '.rand(0, 20) . round(microtime(true)) . rand(21, 41) . '.' . end($ext1);

          move_uploaded_file($_FILES["doc1"]["tmp_name"], "../dist/img/proyecto/imagen_perfil/" . $imagen_perfil);
        }

        if (empty($idproyecto)) {
          
          $rspta = $proyecto->insertar($id_pryecto_adm,$descripcion,$imagen_perfil);
          echo json_encode($rspta, true);

        } else { 

          if ($flat_img == true) {

            $datos_ficha1 = $proyecto->reg_img($idproyecto);

            if ( $datos_ficha1['status'] ) {
      
              $ficha1_ant = $datos_ficha1['data']['img_perfil'];
        
              if ($ficha1_ant != "") {

                unlink("../dist/img/proyecto/imagen_perfil/" . $ficha1_ant);
              }

            }

          }

          $rspta = $proyecto->editar($idproyecto,$id_pryecto_adm_edith,$descripcion,$imagen_perfil);
          echo json_encode($rspta, true);
        }
      break;
      
      case 'eliminar':
        $rspta = $proyecto->eliminar($idproyecto);
        echo json_encode($rspta, true);
      break;

      case 'mostrar_valor':
        $rspta = $proyecto->mostrar($idproyecto);
        echo json_encode($rspta, true);
      break;

      case 'listar':

        $rspta = $proyecto->listar();
        
        $data = [];
        $comprobante = '';
        $cont = 1;
        $imagen_error = "this.src='../dist/svg/defaul_valor.png'";

        if ($rspta['status']) {


          while ($reg = $rspta['data']->fetch_object()) {

            $data[] = [
              "0" => '<center><button class="btn btn-warning btn-xs margin_topp" onclick="mostrar(' .$reg->idproyecto .')"><i class="fas fa-pencil-alt"></i></button>
                      <button class="btn btn-danger btn-xs margin_topp" onclick="eliminar(' .$reg->idproyecto .')"><i class="far fa-trash-alt"></i></button> </center>',
              "1" =>  '<div class="d-flex align-items-center mx-auto">
                        <a onclick="ver_img_perfil(\'' . $reg->img_perfil . '\',\'' . $reg->nombre_proyecto . '\')">
                          <div class="avatar avatar-circle">
                            <img class="avatar-img" src="../dist/img/proyecto/imagen_perfil/'. $reg->img_perfil .'" alt="Image Description" onerror="'.$imagen_error.'">
                          </div>
                        </a>
                        <div class="ml-3">
                          <small style="font-weight: bold;">'. $reg->nombre_proyecto .'</small>
                        </div>
                      </div>',
              "2" =>'<textarea cols="30" rows="4" class="textarea_datatable" readonly="" style="font-size: 12px; width: 250px;">' . $reg->descripcion . '</textarea>',
              "3" =>'<center><button class="btn btn-info btn-xs margin_topp" onclick="galeria(' .$reg->idproyecto .');" data-toggle="tooltip" title="Galería" ><i class="fas fa-images fa-1x"></i></button> 
                      <button class="btn btn-success btn-xs margin_topp" onclick="fases_proyecto(' .$reg->idproyecto .');" data-toggle="tooltip" title="Fases del proyecto"><i class="fas fa-list-ul"></i></button> </center>'.$toltip
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

      case 'select2_proyecto':

        $rspta =  $proyecto->select2_proyecto();

        foreach ($rspta as $key => $reg) {
          echo '<option value=' . $reg['idproyecto'] . '>' . $reg['codigo_proyecto']  . '</option>';
        }

      break;

      //------------------------------------------------------------------------
      //-----------------------G A L E R I A------------------------------------
      //------------------------------------------------------------------------
      
      case 'guardaryeditar_imagen':

        if (!file_exists($_FILES['doc2']['tmp_name']) || !is_uploaded_file($_FILES['doc2']['tmp_name'])) {
          $img_galeria = $_POST["doc_old_2"];
          $flat_img_g = false;

        } else {

          $ext1 = explode(".", $_FILES["doc2"]["name"]);

          $flat_img_g = true;

          $img_galeria =  $date_now.' '.rand(0, 20) . round(microtime(true)) . rand(21, 41) . '.' . end($ext1);

          move_uploaded_file($_FILES["doc2"]["tmp_name"], "../dist/img/proyecto/img_galeria/" . $img_galeria);
          
        }

        $url="admin/dist/img/proyecto/img_galeria/";

        if (empty($idgaleria_proyecto)) {
          
          $rspta = $proyecto->insertar_galeria($id_fase_select,$nombre_img,$scheme_host,$url,$flat_img_g,$img_galeria);
          echo json_encode($rspta, true);

        } else {

          //validamos si existe comprobante para eliminarlo
          if ($flat_img_g == true) {
            $datos_ficha1 = $proyecto->reg_img_galeria($idgaleria_proyecto);
            if ( $datos_ficha1['status'] ) {      
              $imagen_ant = $datos_ficha1['data']['imagen'];        
              if (validar_url_completo_get_header($scheme_host.$url.$imagen_ant) == 200) {
                unlink("../dist/img/proyecto/img_galeria/" . $imagen_ant);
              }
            }
          }

          $rspta = $proyecto->editar_galeria($idgaleria_proyecto,$id_fase_select,$nombre_img,$scheme_host,$url,$flat_img_g,$img_galeria);
          echo json_encode($rspta, true);
        }
      break;
        
      case 'listar_galeria':
        $rspta =   $rspta = $proyecto->listar_galeria( $_POST['idproyecto']);
        echo json_encode($rspta, true);
      break;
  
      case 'eliminar_galeria':
        $rspta = $proyecto->eliminar_galeria($idgaleria_proyecto);
        echo json_encode($rspta, true);
          //Fin de las validaciones de acceso
      break;

      //--------------------------------------------------------------------------
      //-----------------------F A S E S -----------------------------------------
      //--------------------------------------------------------------------------
            
      case 'guardaryeditar_fase':

        if (empty($idfase)) {

          $rspta = $proyecto->insertar_fase($idproyecto_fase,$n_fase,$nombre_f);
          echo json_encode($rspta, true);

        } else {

          $rspta = $proyecto->editar_fase($idfase,$idproyecto_fase,$n_fase,$nombre_f);
          echo json_encode($rspta, true);

        }
      break;

      case 'listar_fase':
        $rspta = $proyecto->listar_fase($_GET['idproyecto']);
          //Vamos a declarar un array
          $data = [];
          $cont = 1;

          if ($rspta['status']) {


            while ($reg = $rspta['data']->fetch_object()) {

              $data[] = [
                "0" => '<center><button class="btn btn-warning btn-xs" onclick="mostrar_fase(' .$reg->idfase_proyecto .')"><i class="fas fa-pencil-alt"></i></button>
                        <button class="btn btn-danger btn-xs" onclick="eliminar_fase(' .$reg->idfase_proyecto .')"><i class="far fa-trash-alt"></i></button> </center>',
                "1" => $reg->numero_fase,
                "2" =>$reg->nombre
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

      case 'mostrar_fase':
        $rspta = $proyecto->mostrar_fase($idfase);
        //Codificar el resultado utilizando json
        echo json_encode($rspta, true);
        //Fin de las validaciones de acceso
      break;
  
      case 'eliminar_fase':
        $rspta = $proyecto->eliminar_fase($idfase);
        echo json_encode($rspta, true);
      break;  
      
      case 'select2_fases':
        $rspta =  $proyecto->select2_fases($_GET['idproyecto']);

        while ($reg = $rspta['data']->fetch_object())  {
    
          echo '<option value=' . $reg->idfase_proyecto . '>' . $reg->numero_fase .'-'.$reg->nombre.'</option>';
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
