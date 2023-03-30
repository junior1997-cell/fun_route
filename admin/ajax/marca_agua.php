<?php
/**
 * Ejemplos de cómo poner marcas de agua con PHP y GD
 * 
 */
function marca_agua_($imagen)
{
    $rutaImagenOriginal ="../dist/img/proyecto/img_galeria/".$imagen;
    $rutaMarcaDeAgua = "../dist/img/marca.png";
    
    $marcaDeAgua = imagecreatefrompng($rutaMarcaDeAgua);
    
    $original = imagecreatefromstring( file_get_contents($rutaImagenOriginal) );
    if ($original === false) {
        die('Formato de imagen no soportado');
    }
    
    # Como vamos a centrar  necesitamos sacar antes las anchuras y alturas
    $anchuraOriginal = imagesx($original);
    $alturaOriginal = imagesy($original);
    $alturaMarcaDeAgua = imagesy($marcaDeAgua);
    $anchuraMarcaDeAgua = imagesx($marcaDeAgua);
    
    # En dónde poner la marca de agua sobre la original
    $xOriginal = $anchuraOriginal - $anchuraMarcaDeAgua;
    $yOriginal = 0;
    
    # Desde dónde comenzar a cortar la marca de agua (si son 0, se comienza desde el inicio)
    $xMarcaDeAgua = 0;
    $yMarcaDeAgua = 0;
    
    # Hasta dónde poner la marca de agua sobre la original
    
    $alturaMarcaDeAgua = $alturaMarcaDeAgua - $yMarcaDeAgua;
    $anchuraMarcaDeAgua = $anchuraMarcaDeAgua - $xMarcaDeAgua;
    
    
    imagecopy($original, $marcaDeAgua, $xOriginal, $yOriginal, $xMarcaDeAgua, $yMarcaDeAgua, $anchuraMarcaDeAgua, $alturaMarcaDeAgua);
    
    # Guardar y liberar recursos
    # Segundo argumento de imagepng es la ruta de la imagen de salida
    $resultado = imagepng($original, $imagen);
    var_dump($resultado);
    imagedestroy($original);
    imagedestroy($marcaDeAgua);

    // return $resultado;
}
