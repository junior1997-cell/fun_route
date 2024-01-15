<?php

require '../../vendor/autoload.php';
use Luecano\NumeroALetras\NumeroALetras;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\ValidationException;

ob_start(); //Activamos el almacenamiento en el buffer

if (strlen(session_id()) < 1) { session_start(); }   

if (!isset($_SESSION["nombre"])) {
  echo 'Debe ingresar al sistema correctamente para visualizar el reporte';
} else {
  
    date_default_timezone_set('America/Lima'); $date_now = date("d_m_Y__h_i_s_A");
    $imagen_error = "this.src='../dist/svg/404-v2.svg'";
    $toltip = '<script> $(function () { $(\'[data-toggle="tooltip"]\').tooltip(); }); </script>';    
    $scheme_host =  ($_SERVER['HTTP_HOST'] == 'localhost' ? 'http://localhost/venta_romero/' :  $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/');
  ?>

  <html>

  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="../dist/css/ticket.css" rel="stylesheet" type="text/css">
  </head>

  <body onload="window.print();">
    <?php

    if (empty($_GET)) { header("Location: ../vistas/login.html"); } //Validamos el acceso solo a los usuarios logueados al sistema.

    //Incluímos la clase Venta
    require_once "../modelos/Venta_paquete.php";
    require_once "../modelos/Ajax_general.php";

    $venta_paquete  = new Venta_paquete();
    $ajax_general   = new Ajax_general();    
    $numero_a_letra = new NumeroALetras();
    

    $rspta        = $venta_paquete->mostrar_detalle_venta($_GET['id']);
    $rspta2       = $ajax_general->datos_empresa();

    if (empty($rspta['data']['venta'])) {    echo "Comprobante no existe"; die();  } // validamos la existencia del comprobante

    //Establecemos los datos de la empresa
    $empresa    = $rspta2['data']['nombre_empresa'];
    $documento  = $rspta2['data']['ruc'];
    $direccion  = $rspta2['data']['direccion'];
    $telefono   = $rspta2['data']['celular'];;
    $email      = $rspta2['data']['correo'];;
    $web        = "https://funroute.jdl.pe";

    ?>    

    <br>
    <!-- Detalle de empresa -->
    <table border="0" align="center" width="230px">
      <tbody>
        <tr>
          <td align="center"><img src="../../assets/images/logo_nombre.svg" width="100"></td>
        </tr>
        <tr align="center">
          <td style="font-size: 14px">.::<strong> <?php echo mb_convert_encoding(htmlspecialchars_decode($empresa),"UTF-8", mb_detect_encoding($empresa)) ?> </strong>::.</td>
        </tr>        
        <tr align="center">
          <td style="font-size: 14px"> <strong> R.U.C. <?php echo $documento; ?> </strong> </td>
        </tr>
        <tr align="center">
          <td style="font-size: 10px"> <?php echo mb_convert_encoding(htmlspecialchars_decode($direccion),"UTF-8", mb_detect_encoding($direccion)) . ' <br> ' . $telefono; ?> </td>
        </tr>
        <tr align="center">
          <td style="font-size: 10px"> <?php echo mb_convert_encoding(strtolower($email),"UTF-8", mb_detect_encoding($email)); ?> </td>
        </tr>
        <tr align="center">
          <td style="font-size: 10px"> <?php echo mb_convert_encoding(strtolower($web),"UTF-8", mb_detect_encoding($web)); ?> </td>
        </tr>
        <tr>
          <td style="text-align: center;">--------------------------------------------------------</td>
        </tr>
        <tr>
          <td align="center"> <strong> <?php echo $rspta['data']['venta']['tipo_comprobante']; ?> ELECTRÓNICO </strong> <br> 
          <b style="font-size: 14px"><?php echo $rspta['data']['venta']['serie_comprobante'] .'-'.$rspta['data']['venta']['numero_comprobante']; ?> </b></td>
        </tr>
        <tr>
          <td style="text-align: center;">--------------------------------------------------------</td>
        </tr>
      </tbody>
    </table>

    <!-- Datos cliente -->
    <table border="0" align="center" width="230px">
      <tbody>
        <tr align="left">
          <td><strong>Cliente:</strong> <?php echo $rspta['data']['venta']['nombres']; ?> </td>
        </tr>
        <tr align="left">
          <td><strong><?php echo $rspta['data']['venta']['tipo_documento']; ?>:</strong> <?php echo $rspta['data']['venta']['numero_documento']; ?></td>
        </tr>
        <tr align="left">
          <td><strong>Dirección:</strong> <?php echo $rspta['data']['venta']['direccion']; ?></td>
        </tr>
        <tr align="left">
          <td><strong>Fecha de emisión:</strong> <?php echo  $rspta['data']['venta']['fecha_venta']; ?> </td>
        </tr>
        <tr align="left">
          <td><strong>Moneda:</strong> SOLES</td>
        </tr>
        <!-- <tr align="left">
          <td><strong>Atención:</strong> <?php echo $rspta['data']['venta']['usuario']; ?> </td>
        </tr> -->
        <tr>
          <td><strong>Tipo de pago:</strong> Efectivo </td>
        </tr>        
        <tr>
          <td><strong>Observación:</strong> <?php echo $rspta['data']['venta']['descripcion']; ?> </td>
        </tr>
      </tbody>
    </table>

    <br>    

    <!-- Mostramos los detalles de la venta en el documento HTML -->
    <table border="0" align="center" width="230px" style="font-size: 12px">
      <tr>
        <td colspan="5">--------------------------------------------------------</td>
      </tr>
      <tr>
        <td>Cant.</td>
        <td>Producto</td>
        <td>P.u.</td>
        <td>Importe</td>
      </tr>
      <tr>
        <td colspan="5">--------------------------------------------------------</td>
      </tr>

      <?php     

      //processing form input
      $dataTxt = $rspta['data']['venta']['numero_documento'] . "|" . 
      $rspta['data']['venta']['tipo_documento'] . "|" . $rspta['data']['venta']['tipo_comprobante'] . "|" .
      $rspta['data']['venta']['serie_comprobante'] . "|" . $rspta['data']['venta']['numero_comprobante'] . "|0.00|" . 
      $rspta['data']['venta']['total'] . "|" . $rspta['data']['venta']['fecha_venta'] ;
      
      // user data
      $errorCorrectionLevel = 'H';
      $matrixPointSize = '2';
      $filename = $rspta['data']['venta']['serie_comprobante'] .'-'.$rspta['data']['venta']['numero_comprobante']. '.png';

      $qr_code = QrCode::create($dataTxt)->setEncoding(new Encoding('UTF-8'))->setErrorCorrectionLevel(ErrorCorrectionLevel::Low)->setSize(900)->setMargin(10)->setRoundBlockSizeMode(RoundBlockSizeMode::Margin)->setForegroundColor(new Color(0, 0, 0))->setBackgroundColor(new Color(255, 255, 255));

      // Create generic label
      $label = Label::create( $rspta['data']['venta']['serie_comprobante'] .'-'.$rspta['data']['venta']['numero_comprobante'])->setTextColor(new Color(255, 0, 0));
      $writer = new PngWriter();
      $result = $writer->write($qr_code, label: $label);      
      $result->saveToFile(__DIR__.'/venta_paquete/qr-ticket/'.$filename);// Save it to a file      
      $dataUri = $result->getDataUri(); // Generate a data URI to include image data inline (i.e. inside an <img> tag)      

      //=============== PRODUCTOS =========================      
      $cantidad = 0;
      foreach ($rspta['data']['detalles'] as $key => $val) {
        
        echo "<tr>";
        echo "<td>" . $val['cantidad'] . "</td>";
        echo "<td>" . strtolower($val['nombre']) . "</td>";
        echo '<td style="text-align: right;">' . number_format($val['precio_con_igv'], 2) . "</td>";
        echo '<td style="text-align: right;">' . $val['subtotal'] . "</td>";
        echo "</tr>";
        
      }
      ?>
    </table>

    <!-- Division -->
    <table border='0' align='center' width='230px' style='font-size: 12px'>
      <tr>
        <td>--------------------------------------------------------</td>
      </tr>
      <tr></tr>
    </table>

    <!-- Detalles de totales sunat -->
    <table border='0' align="center" width='230px' style='font-size: 12px'>
      <!-- <tr>
        <td colspan='5'><strong>Descuento </strong></td>
        <td>:</td>
        <td style="text-align: right;"> <?php echo $rspta['data']['venta']['descuento']; ?> </td>
      </tr> -->
      <tr>
        <td colspan='5'><strong>Op. Gravada </strong></td>
        <td>:</td>
        <td style="text-align: right;"> 0 </td>
      </tr>
      <tr>
        <td colspan='5'><strong>Op. Exonerado </strong></td>
        <td>:</td>
        <td style="text-align: right;"> 0 </td>
      </tr>      
      <tr>
        <td colspan='5'><strong>ICBPER</strong></td>
        <td>:</td>
        <td style="text-align: right;"> 0 </td>
      </tr>
      <tr>
        <td colspan='5'><strong>I.G.V.</strong></td>
        <td>:</td>
        <td style="text-align: right;"> <?php echo $rspta['data']['venta']['igv']; ?> </td>
      </tr>
      <tr>
        <td colspan='5'><strong>Imp. Pagado</strong></td>
        <td>:</td>
        <td style="text-align: right;"> <?php echo $rspta['data']['venta']['total']; ?> </td>
      </tr>
      <tr>
        <td colspan='5'><strong>Vuelto</strong></td>
        <td>:</td>
        <td style="text-align: right;"> 0 </td>
      </tr>
      <!--<tr><td colspan='5'><strong>I.G.V. 18.00 </strong></td><td >:</td><td><?php echo $reg->sumatoria_igv_18_1; ?></td></tr>-->
    </table>

    <?php $num_total = $numero_a_letra->toInvoice($rspta['data']['venta']['total'], 2, " SOLES"); ?>

    <!-- Mostramos los totales de la venta en el documento HTML -->
    <table border='0' align="center" width='230px' style='font-size: 12px'>
      <tr>
        <td><strong>Importe a pagar </strong></td>
        <td>:</td>
        <td style="text-align: right;"><strong> <?php echo$rspta['data']['venta']['total']; ?> </strong></td>
      </tr>
      <tr>
        <td colspan="3">--------------------------------------------------------</td>
      </tr>
      <tr>
        <td colspan="3"><strong>Son: </strong> <?php echo $num_total; ?> </td>
      </tr>
      <tr>
        <td colspan="3">--------------------------------------------------------</td>
      </tr>
    </table>

    <br>

    <div style="text-align: center;">
      <img src=<?php echo $dataUri; ?> width="130" height="auto"><br>
      <!-- <label> <?php echo $dataUri; ?> </label> -->
      <br>
      <br>
      <label>Esta es una representación impresa del <br> comprobante, no valido para el Sistema <br> de SUNAT. Gracias por su compra, <br> vuelva pronto. <br>
        <?php echo mb_convert_encoding(htmlspecialchars_decode($web),"UTF-8", mb_detect_encoding($web)) ?>
      </label>
      <br>
      <br>
      <label><strong>::.GRACIAS POR SU COMPRA.::</strong></label>
    </div>
    <p>&nbsp;</p>
  </body>

  </html>
  <?php
  
}
ob_end_flush();
?>