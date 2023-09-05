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
    if ($_SESSION['pedido'] == 1) {

      require_once "../modelos/Pedido.php";
      
      $pedido = new Pedido($_SESSION['idusuario']);

      date_default_timezone_set('America/Lima'); $date_now = date("d_m_Y__h_i_s_A");
      $imagen_error = "this.src='../dist/svg/user_default.svg'";
      $toltip = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';
      $scheme_host =  ($_SERVER['HTTP_HOST'] == 'localhost' ? $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/fun_route/admin/' :  $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/admin/');
      
      $idpedido_paquete = isset($_POST["idpedido_paquete"])? limpiarCadena($_POST["idpedido_paquete"]):"";
      $idpaquete	  	  = isset($_POST["idpaquete"])? limpiarCadena($_POST["idpaquete"]):"";
      $nombre	  	      = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
      $correo	  	      = isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
      $telefono	  	    = isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
      $descripcion			= isset($_POST["descripcionpedido"])? limpiarCadena($_POST["descripcionpedido"]):"";

      switch ($_GET["op"]) {       

        // ::::::::::::::::::::::::::::::::::::::::: PEDIDO TOURS :::::::::::::::::::::::::::
        case 'mostrar_detalle_tours':
          $rspta=$pedido->mostrar_tours($_POST["idtours"], $_POST["idpedido_tours"]);
          //Codificar el resultado utilizando json
          echo json_encode($rspta, true);
        break;    
        
        case 'vendido_tours':
          $rspta=$pedido->vendido_tours($_POST["idpedido_tours"]);
          echo json_encode($rspta, true);
        break;

        case 'remover_vendido_tours':
          $rspta=$pedido->remover_vendido_tours($_POST["idpedido_tours"]);
          echo json_encode($rspta, true);
        break;

        case 'desactivar_tours':
          $rspta=$pedido->desactivar_tours($_GET["id_tabla"]);
          echo json_encode($rspta, true);
        break;

        case 'eliminar_tours':
          $rspta=$pedido->eliminar_tours($_GET["id_tabla"]);
          echo json_encode($rspta, true);
        break;

        case 'tbla_principal_tours':          

          $rspta=$pedido->tbla_principal_tours();
          
          //Vamos a declarar un array
          $data= Array(); $cont=1;

          if ($rspta['status'] == true) {

            foreach ($rspta['data'] as $key => $value) {        

              $imagen = (empty($value['imgtours']) ? '../dist/svg/user_default.svg' : '../dist/docs/tours/perfil/'.$value['imgtours']) ;
              $estadovisto = ($value['estado_visto']==1 ? '<span class="text-center badge badge-success">Visto</span>' : '<span class="text-center badge badge-danger">No Visto</span>' );// true:false
              $estadovendido = ($value['estado_vendido']==1 ? '<span class="text-center badge badge-success">Vendido</span>' : '<span class="text-center badge badge-danger">No Vendido</span>' );// true:false
              
              $data[]=array(
                "0"=>$cont++,
                "1"=>' <button class="btn btn-info btn-sm" onclick="mostrar_pedido_tours(' . $value['idtours'] .', '.$value['idpedido_tours']. ')" data-toggle="tooltip" data-original-title="Ver"><i class="fa fa-eye"></i></button>' .
                ($value['estado_vendido'] == 0 ? ' <button class="btn btn-success  btn-sm" onclick="vendido_tours(' . $value['idpedido_tours'] .', \''.encodeCadenaHtml($value['tours']).'\')" data-toggle="tooltip" data-original-title="Vender"><i class="fa-solid fa-cart-shopping"></i></button>' : ' <button class="btn btn-success  btn-sm" onclick="remover_vendido_tours(' . $value['idpedido_tours'] .', \''.encodeCadenaHtml($value['tours']).'\')" data-toggle="tooltip" data-original-title="Remover vendido"><i class="fa-solid fa-cart-arrow-down"></i></button>').
                ' <button class="btn btn-danger  btn-sm" onclick="eliminar_pedido_tours(' . $value['idpedido_tours'] .', \''.encodeCadenaHtml($value['nombre']).'\')" data-toggle="tooltip" data-original-title="Eliminar o Papelera"><i class="fas fa-skull-crossbones"></i></button>' ,
                "2"=> nombre_dia_semana( date("Y-m-d", strtotime($value['created_at'])) ) .', <br>'. date("d/m/Y", strtotime($value['created_at'])) .' - '. date("g:i a", strtotime($value['created_at'])),
                "3"=>'<div class="user-block">
                  <img class="profile-user-img img-responsive img-circle cursor-pointer" src="'. $imagen .'" alt="User Image" onerror="'.$imagen_error.'" onclick="ver_img_perfil(\'' . $imagen . '\', \''.encodeCadenaHtml($value['nombre']).'\');" data-toggle="tooltip" data-original-title="Ver foto">
                  <span class="username"><p class="text-primary m-b-02rem" >'. $value['tours'] .'</p></span>
                  <span class="description"><b>Duración: </b>'. $value['duracion']  .'</span>
                </div>',
                "4"=>$value['nombre'],
                "5"=>$value['telefono'],
                "6"=> '<textarea cols="30" rows="2" class="textarea_datatable" readonly="">' . $value['descripcionpedido'] . '</textarea>',
                "7"=> $estadovisto .' '. $estadovendido . $toltip,

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

        // ::::::::::::::::::::::::::::::::::::::::: PEDIDO PAQUETE :::::::::::::::::::::::::::

        case 'tbla_principal_paquete':          

          $rspta=$pedido->tbla_principal_paquete();
          
          //Vamos a declarar un array
          $data= Array(); $cont=1;

          if ($rspta['status'] == true) {

            foreach ($rspta['data'] as $key => $value) {        

              $imagen = (empty($value['imgpaquete']) ? '../dist/svg/user_default.svg' : '../dist/docs/paquete/perfil/'.$value['imgpaquete']) ;
              $estadovisto = ($value['estado_visto']==1 ? '<span class="text-center badge badge-success">Visto</span>' : '<span class="text-center badge badge-danger">No Visto</span>' );// true:false
              $estadovendido = ($value['estado_vendido']==1 ? '<span class="text-center badge badge-success">Vendido</span>' : '<span class="text-center badge badge-danger">No Vendido</span>' );// true:false
              
              $data[]=array(
                "0"=>$cont++,
                "1"=>' <button class="btn btn-info btn-sm" onclick="mostrar_pedido_paquete(' . $value['idpaquete'] .', '.$value['idpedido_paquete']. ')" data-toggle="tooltip" data-original-title="Ver"><i class="fa fa-eye"></i></button>' .
                ($value['estado_vendido'] == 0 ? ' <button class="btn btn-success  btn-sm" onclick="vendido_paquete(' . $value['idpedido_paquete'] .', \''.encodeCadenaHtml($value['paquete']).'\')" data-toggle="tooltip" data-original-title="Vender"><i class="fa-solid fa-cart-shopping"></i></button>' : ' <button class="btn btn-success  btn-sm" onclick="remover_vendido_paquete(' . $value['idpedido_paquete'] .', \''.encodeCadenaHtml($value['paquete']).'\')" data-toggle="tooltip" data-original-title="Remover vendido"><i class="fa-solid fa-cart-arrow-down"></i></button>').
                ' <button class="btn btn-danger  btn-sm" onclick="eliminar_pedido_paquete(' . $value['idpedido_paquete'] .', \''.encodeCadenaHtml($value['nombre']).'\')" data-toggle="tooltip" data-original-title="Eliminar o Papelera"><i class="fas fa-skull-crossbones"></i></button>',
                "2"=> nombre_dia_semana( date("Y-m-d", strtotime($value['created_at'])) ) .', <br>'. date("d/m/Y", strtotime($value['created_at'])) .' - '. date("g:i a", strtotime($value['created_at'])),
                "3"=>'<div class="user-block">
                  <img class="profile-user-img img-responsive img-circle cursor-pointer" src="'. $imagen .'" alt="User Image" onerror="'.$imagen_error.'" onclick="ver_img_perfil(\'' . $imagen . '\', \''.encodeCadenaHtml($value['nombre']).'\');" data-toggle="tooltip" data-original-title="Ver foto">
                  <span class="username"><p class="text-primary m-b-02rem" >'. $value['paquete'] .'</p></span>
                  <span class="description"><b>Duración: </b>'. $value['cant_dias'] .' días - '.$value['cant_dias'] .' noches</span>
                </div>',
                "4"=>$value['nombre'],
                "5"=>$value['telefono'],
                "6"=> '<textarea cols="30" rows="2" class="textarea_datatable" readonly="">' . $value['descripcionpedido'] . '</textarea>',
                "7"=> $estadovisto .' '. $estadovendido . $toltip,

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

        case 'mostrar_detalle_paquete':
          $rspta=$pedido->mostrar_paquete($_POST["idpaquete"], $_POST["idpedido_paquete"]);
          //Codificar el resultado utilizando json
          echo json_encode($rspta, true);
        break;    
        
        case 'vendido_paquete':
          $rspta=$pedido->vendido_paquete($_POST["idpedido"]);
          echo json_encode($rspta, true);
        break;

        case 'remover_vendido_paquete':
          $rspta=$pedido->remover_vendido_paquete($_POST["idpedido"]);
          echo json_encode($rspta, true);
        break;

        case 'desactivar_paquete':
          $rspta=$pedido->desactivar_paquete($_GET["id_tabla"]);
          echo json_encode($rspta, true);
        break;

        case 'eliminar_paquete':
          $rspta=$pedido->eliminar_paquete($_GET["id_tabla"]);
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
