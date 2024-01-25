<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;

  ob_start();      

    //Load Composer's autoloader
    require '../vendor/autoload.php';

    require_once "../modelos/Tours.php";

    $tours = new Tours(0);

    date_default_timezone_set('America/Lima'); $date_now = date("d-m-Y h.i.s A");

    $imagen_error = "this.src='../dist/svg/user_default.svg'";
    $toltip       = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';
    
    $idtours		  = isset($_POST["id_tours"])? limpiarCadena($_POST["id_tours"]):"";

    // ::::::::::::::::::: DATOS CORREO ::::::::::::::::::::::::::
    $idtours_email		= isset($_POST["idtours_email"])? limpiarCadena($_POST["idtours_email"]):"";
    $nombre_email		= isset($_POST["nombre_email"])? limpiarCadena($_POST["nombre_email"]):"";
    $correo_email		= isset($_POST["correo_email"])? limpiarCadena($_POST["correo_email"]):"";
    $telefono_email	= isset($_POST["telefono_email"])? limpiarCadena($_POST["telefono_email"]):"";
    $mensaje_email  = isset($_POST["mensaje_email"])? limpiarCadena($_POST["mensaje_email"]):"";

    $nombre_tours_email  = isset($_POST["nombre_tours_email"])? limpiarCadena($_POST["nombre_tours_email"]):"";
    $costo_email      = isset($_POST["costo_email"])? limpiarCadena($_POST["costo_email"]):"";
    
    
    switch ($_GET["op"]) {     
      
      /* ══════════════════════════════════════ T O U R S  ══════════════════════════════════ */
      case 'mostrar_detalle':
        $rspta=$tours->mostrar_detalle($idtours);
        //Codificar el resultado utilizando json
        echo json_encode($rspta, true);
      break;

      case 'mostrar_todos':
        $rspta = $tours->mostrar_todos();
        echo json_encode($rspta, true);
      break;   

      case 'mostrar_empresa':
        $rspta = $tours->mostrar_empresa();
        echo json_encode($rspta, true);
      break;   

      /* ══════════════════════════════════════ G A L E R Í A  ══════════════════════════════════ */       
      case 'mostrar_galeria':
        $rspta = $tours->mostrar_galeria($_POST['idtours']);
        echo json_encode($rspta, true);
      break;
      
      /* ══════════════════════════════════════ C O R R E O   ══════════════════════════════════ */        
      
      case 'enviar_correo':
        
        $rspta = $tours->crear_pedido($idtours_email, $nombre_email, $correo_email, $telefono_email, $mensaje_email);

        if ($rspta['status'] == true) {         
        
          //Importar clases PHPMailer en el espacio de nombres global
          //Estos deben estar en la parte superior de su secuencia de comandos, no dentro de una función        

          //Crear una instancia; pasar `true` permite excepciones
          $mail = new PHPMailer(true);

          try {
            //Configuración del servidor
            $mail->SMTPDebug  = 0;                          // Habilitar salida de depuración detallada con: SMTP::DEBUG_SERVER | deshablita con: 0
            $mail->isSMTP();                                // Enviar usando SMTP
            $mail->CharSet    = 'UTF-8';                    // Habilita UTF-8
            $mail->Host       = 'smtp.gmail.com';          // Configurar el servidor SMTP para enviar a través
            $mail->SMTPAuth   = true;                       // Habilitar autenticación SMTP
            $mail->Username   = '75867189@pronabec.edu.pe'; // nombre de usuario SMTP
            $mail->Password   = 'kabfcoocedbalmeq';             // Contraseña SMTP
            $mail->SMTPSecure = 'tls';                      // Habilitar el cifrado TLS implícito
            $mail->Port       = 587;                        // Puerto TCP para conectarse; use 587 si ha configurado `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Destinatarios
            $mail->setFrom('75867189@pronabec.edu.pe', 'Fun Route'); // Correo y nombre de empresa
            // $mail->addAddress('funroute23@gmail.com', $nombre_email);// Agregar un destinatario, El nombre es opcional
            $mail->addAddress($correo_email, $nombre_email);               // Agregar un destinatario, El nombre es opcional
            // $mail->addReplyTo('info@example.com', 'Information'); // replicar envio
            // $mail->addCC('cc@example.com');                       // otros destinatarios en copia (CC) 
            // $mail->addBCC('bcc@example.com');                     // copia oculta (BCC)

            //Archivos adjuntos
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Agregar archivos adjuntos
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Nombre opcional

            // llamamos a la plantilla
            $message = file_get_contents('../recursos/correo/plantilla_correo_tours.html');
            $message = str_replace('%nombre_email%', $nombre_email, $message);
            $message = str_replace('%nombre_tours%', $nombre_tours_email, $message);
            $message = str_replace('%costo_email%', $costo_email, $message);
            $message = str_replace('%mensaje_email%', $mensaje_email, $message);
            $message = str_replace('%telefono_email%', $telefono_email, $message);
            $message = str_replace('%correo_email%', $correo_email, $message);

            //Content
            $mail->isHTML(true);                        //Establecer el formato de correo electrónico en HTML
            $mail->Subject = 'Consulta por el TOURS';   // Titulo del Correo
            $mail->Body    = $message;                  // Cargamos el mensaje
            // $mail->AltBody = $mensaje_email;         // Cuerpo alternativo

            $mail->send();
            $rspta = ['status'=> true, 'message'=>'Correo enviado con exito', 'data'=>[]];
            echo json_encode($rspta);
          } catch (Exception $e) {          
            $rspta = ['status'=> 'error_personalizado', 'user'=>$nombre_email, 'message'=>"El correo no se pudo enviar. Tenemos este error: {$mail->ErrorInfo}", 'data'=>[]];
            echo json_encode($rspta);
          }
        } else {
          echo json_encode($rspta);
        }
      break;

      default: 
        $rspta = ['status'=>'error_code', 'message'=>'Te has confundido en escribir en el <b>swich.</b>', 'data'=>[]]; echo json_encode($rspta, true); 
      break;

    }   

  ob_end_flush();

?>