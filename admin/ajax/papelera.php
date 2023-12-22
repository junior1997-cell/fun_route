<?php

	ob_start();

	if (strlen(session_id()) < 1){
		session_start();//Validamos si existe o no la sesión
	}
  
  if (!isset($_SESSION["nombre"])) {
    $retorno = ['status'=>'login', 'message'=>'Tu sesion a terminado pe, inicia nuevamente', 'data' => [] ];
    echo json_encode($retorno);  //Validamos el acceso solo a los usuarios logueados al sistema.
  } else {

    //Validamos el acceso solo al usuario logueado y autorizado.
    if ($_SESSION['pago_trabajador'] == 1) {

      require_once "../modelos/Papelera.php";
      require_once "../modelos/Fechas.php";

      $papelera = new Papelera($_SESSION['idusuario']);

      date_default_timezone_set('America/Lima'); $date_now = date("d_m_Y__h_i_s_A");
      $imagen_error = "this.src='../dist/svg/user_default.svg'";
      $toltip = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';
      $scheme_host =  ($_SERVER['HTTP_HOST'] == 'localhost' ? $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/fun_route/admin/' :  $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/admin/');

      // DATA
      $nombre_tabla     = isset($_GET["nombre_tabla"])? limpiarCadena($_GET["nombre_tabla"]):"";
      $nombre_id_tabla 	= isset($_GET["nombre_id_tabla"])? limpiarCadena($_GET["nombre_id_tabla"]):""; 
      $id_tabla 		    = isset($_GET["id_tabla"])? limpiarCadena($_GET["id_tabla"]):""; 

      switch ($_GET["op"]){

        case 'listar_tbla_principal':

          $nube_idproyecto = $_GET["nube_idproyecto"];         

          $rspta=$papelera->tabla_principal($nube_idproyecto);
          //Vamos a declarar un array
          //echo json_encode($rspta);
          $data= Array();

          $cont=1;                          

          foreach ( $rspta as $key => $value) {            
            $info = '\''.$value['nombre_tabla'].'\', \''.$value['nombre_id_tabla'].'\', \''.$value['id_tabla'].'\'';
            
            $description = '';

            // Check if the description is an image URL
            $imgSize = @getimagesize($value['descripcion']);
            if ($imgSize !== false) {
                // If it's an image, create an img tag
                $description = '<img src="' . $value['descripcion'] . '" width="100px" height="auto" alt="Image">';
            } else {
                // If it's not an image, display the text
                $description = '<textarea class="textarea_datatable" readonly="" style="height: 45px;">' . $value['descripcion'] . '</textarea>';
            }

            $data[]=array(
              "0"=> $cont++,
              "1"=>'<button class="btn btn-success btn-sm" onclick="recuperar('.$info.')" data-toggle="tooltip" data-original-title="Recuperar"><i class="fas fa-redo-alt"></i></button>'.
              ' <button class="btn btn-danger btn-sm" onclick="eliminar_permanente('.$info.')" data-toggle="tooltip" data-original-title="Eliminar Permanente"><i class="far fa-trash-alt"></i></button>', 
              "2"=>'<span class="text-bold">'. $value['modulo'] .'</span>',  
              "3"=>'<div class="bg-color-242244245 " style="overflow: auto; resize: vertical; height: 45px;" >'. $value['nombre_archivo'] .'</div>',  
              "4"=> $description,
              "5"=> nombre_dia_semana( date("Y-m-d", strtotime($value['created_at'])) ) .', <br>'. date("d/m/Y", strtotime($value['created_at'])) .' - '. date("g:i a", strtotime($value['created_at'])) ,
              "6"=> nombre_dia_semana( date("Y-m-d", strtotime($value['updated_at'])) ) .', <br>'. date("d/m/Y", strtotime($value['updated_at'])) .' - '. date("g:i a", strtotime($value['updated_at'])).$toltip
            );
          }
          $results = array(
            "sEcho"=>1, //Información para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>1, //enviamos el total registros a visualizar
            "data"=>$data);
         echo json_encode($results);
        break;        

        case 'recuperar':

          $rspta=$papelera->recuperar($nombre_tabla, $nombre_id_tabla, $id_tabla);

          echo json_encode( $rspta, true) ;

        break;

        case 'eliminar_permanente':

          $rspta=$papelera->eliminar_permanente( $nombre_tabla, $nombre_id_tabla, $id_tabla );

          echo json_encode($rspta, true) ;

        break; 
        
        default: 
          $rspta = ['status'=>'error_code', 'message'=>'Te has confundido en escribir en el <b>swich.</b>', 'data'=>[]]; echo json_encode($rspta, true); 
        break;
        
      }

    } else {
      $retorno = ['status'=>'nopermiso', 'message'=>'Tu sesion a terminado pe, inicia nuevamente', 'data' => [] ];
      echo json_encode($retorno);
    }
  }

	ob_end_flush();

?>