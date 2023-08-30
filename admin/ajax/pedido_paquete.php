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

      require_once "../modelos/Pedido_paquete.php";

      $pedido = new Pedido_paquete($_SESSION['idusuario']);

      date_default_timezone_set('America/Lima'); $date_now = date("d_m_Y__h_i_s_A");
      $imagen_error = "this.src='../dist/svg/user_default.svg'";
      $toltip = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';
      $scheme_host =  ($_SERVER['HTTP_HOST'] == 'localhost' ? $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/fun_route/admin/' :  $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/admin/');
      
      $idpedido_paquete	  	        = isset($_POST["idpedido_paquete"])? limpiarCadena($_POST["idpedido_paquete"]):"";
      $idpaquete	  	              = isset($_POST["idpaquete"])? limpiarCadena($_POST["idpaquete"]):"";
      $nombre	  	                  = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
      $correo	  	                  = isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
      $telefono	  	                = isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
      $descripcion			            = isset($_POST["descripcionpedido"])? limpiarCadena($_POST["descripcionpedido"]):"";

      switch ($_GET["op"]) {

        case 'eliminar':
          $rspta=$pedido->eliminar($_GET["id_tabla"]);
          echo json_encode($rspta, true);
        break;

        case 'mostrar':
          $rspta=$pedido->mostrar($idpaquete,$idpedido_paquete);
          //Codificar el resultado utilizando json
          echo json_encode($rspta, true);
        break;
        
        case 'vendido':
          $rspta=$pedido->vendido($_POST["idpedido_paquete"]);
          echo json_encode($rspta, true);
        break;

        case 'tbla_principal':          

          $rspta=$pedido->tbla_principal();
          
          //Vamos a declarar un array
          $data= Array(); $cont=1;

          if ($rspta['status'] == true) {

            foreach ($rspta['data'] as $key => $value) {        

              $imagen = (empty($value['imgpaquete']) ? '../dist/svg/user_default.svg' : '../dist/docs/paquete/perfil/'.$value['imgpaquete']) ;
              $estadovisto = ($value['estado_visto']==1 ? '<span class="text-center badge badge-success">Visto</span>' : '<span class="text-center badge badge-danger">No Visto</span>' );// true:false
              $estadovendido = ($value['estado_vendido']==1 ? '<span class="text-center badge badge-success">Vendido</span>' : '<span class="text-center badge badge-danger">No Vendido</span>' );// true:false
              
              $data[]=array(
                "0"=>$cont++,
                "1"=>' <button class="btn btn-info btn-sm" onclick="mostrar_pedido(' . $value['idpaquete'] .', '.$value['idpedido_paquete']. ')" data-toggle="tooltip" data-original-title="Ver"><i class="fa fa-eye"></i></button>' .
                ' <button class="btn btn-danger  btn-sm" onclick="eliminar_pedido(' . $value['idpedido_paquete'] .')" data-toggle="tooltip" data-original-title="Eliminar o Papelera"><i class="fas fa-skull-crossbones"></i></button>'.
                ' <button class="btn btn-success  btn-sm" onclick="vendido(' . $value['idpedido_paquete'] .')" data-toggle="tooltip" data-original-title="Vender"><i class="fa-solid fa-cart-shopping"></i></button>',
                "2"=>'<div class="user-block">
                  <img class="profile-user-img img-responsive img-circle cursor-pointer" src="'. $imagen .'" alt="User Image" onerror="'.$imagen_error.'" onclick="ver_img_paquete(\'' . $imagen . '\', \''.encodeCadenaHtml($value['nombre']).'\');" data-toggle="tooltip" data-original-title="Ver foto">
                  <span class="username"><p class="text-primary m-b-02rem" >'. $value['paquete'] .'</p></span>
                  <span class="description"><b>Duración: </b>'. $value['cant_dias'] .' - '.$value['cant_dias'] .'</span>
                </div>',
                "3"=>$value['nombre'],
                "4"=>$value['correo'],
                "5"=>$value['telefono'],
                "6"=> '<textarea cols="30" rows="2" class="textarea_datatable" readonly="">' . $value['descripcionpedido'] . '</textarea>',
                "7"=> $estadovisto .' '. $estadovendido,

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
