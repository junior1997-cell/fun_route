<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";
require "../config/Conexion_admin.php";
//require_once "../dist/img/proyecto/img_galeria/marca_agua.php";
class Proyecto
{
  //Implementamos nuestro constructor
  public function __construct()
  {
  }
  //------------------------------------------------------------------------
  //-----------------------P R O Y E C T O ---------------------------------
  //------------------------------------------------------------------------
  public function insertar($id_pryecto_adm, $descripcion, $imagen_perfil)
  {
    //Realizamos la consulta a la bd admin sevens
    $sql_1 = "SELECT idproyecto,nombre_proyecto,nombre_codigo,fecha_inicio,fecha_fin,dias_habiles,plazo,actividad_trabajo,ubicacion,estado FROM proyecto WHERE idproyecto=$id_pryecto_adm;";
    $proyecto_admin = ejecutarConsultaSimpleFila_admin($sql_1);

    if ($proyecto_admin['status']) {
    } else {
      return $proyecto_admin;
    }

    if (!empty($proyecto_admin['data']['idproyecto'])) {
      $sql_2 =
        "INSERT INTO proyecto_front(id_proyecto_admin, nombre_proyecto,codigo_proyecto, fecha_inicio, fecha_fin, 
      dias_habiles, dias_calendario, actividad_trabajo, ubicacion, descripcion, img_perfil, estado_proyecto) 
      VALUES ( '" .  $proyecto_admin['data']['idproyecto'] . "', '" .  $proyecto_admin['data']['nombre_proyecto'] . "', '" .
        $proyecto_admin['data']['nombre_codigo'] . "', '" . $proyecto_admin['data']['fecha_inicio'] . "', '" .
        $proyecto_admin['data']['fecha_fin'] . "', '" . $proyecto_admin['data']['dias_habiles'] . "', '" .
        $proyecto_admin['data']['plazo'] . "', '" . $proyecto_admin['data']['actividad_trabajo'] . "', '" .
        $proyecto_admin['data']['ubicacion'] . "', '$descripcion', '$imagen_perfil', '" . $proyecto_admin['data']['estado'] . "' ) ";

      return ejecutarConsulta($sql_2);
    }
  }

  public function editar($idproyecto, $id_pryecto_adm_edith, $descripcion, $imagen_perfil)
  {
    $sql_2 = "UPDATE proyecto_front SET id_proyecto_admin ='.$id_pryecto_adm_edith.', descripcion ='$descripcion', img_perfil ='$imagen_perfil' WHERE idproyecto='$idproyecto'";

    return ejecutarConsulta($sql_2);
  }

  public function eliminar($idproyecto)
  {
    $sql = "DELETE FROM proyecto_front WHERE idproyecto ='$idproyecto';";
    return ejecutarConsulta($sql);
  }

  public function mostrar($idproyecto)
  {
    $sql = "SELECT*FROM proyecto_front WHERE idproyecto ='$idproyecto'";
    return ejecutarConsultaSimpleFila($sql);
  }

  public function listar()
  {
    $sql = "SELECT*FROM proyecto_front ORDER BY idproyecto DESC";
    return ejecutarConsulta($sql);
  }

  //reg img para borrar
  public function reg_img($idproyecto)
  {
    $sql = "SELECT img_perfil FROM proyecto_front WHERE idproyecto='$idproyecto'";
    return ejecutarConsultaSimpleFila($sql);
  }

  //Select2 proyecto
  public function select2_proyecto()
  {
    $data_select = [];
    //bd-admin
    $sql_1 = "SELECT idproyecto,nombre_codigo,nombre_proyecto FROM proyecto WHERE estado!=2 AND estado_delete=1;";
    $proyecto_admin = ejecutarConsultaArray_admin($sql_1);

    if ($proyecto_admin['status'] == false) {  return $proyecto_admin;  }

    foreach ($proyecto_admin['data'] as $key => $value) {
      $id = $value['idproyecto'];
      //bd-front
      $sql_2 = "SELECT*FROM proyecto_front WHERE id_proyecto_admin='$id'";
      $proyecto_front = ejecutarConsultaSimpleFila($sql_2);

      if ($proyecto_front['status'] == false) { return $proyecto_front; }

      if (empty($proyecto_front['data']['id_proyecto_admin'])) {
        $data_select[] = [
          "idproyecto" => $value['idproyecto'],
          "nombre_proyecto" => $value['nombre_proyecto'],
          "codigo_proyecto" => $value['nombre_codigo'],
        ];
      }
    }

    return $retorno = ['status' => true, 'message' => 'todo oka bro', 'data' => $data_select];
  }

  //------------------------------------------------------------------------
  //-----------------------G A L E R I A------------------------------------
  //------------------------------------------------------------------------

  public function insertar_galeria($id_fase_select, $nombre_img, $host, $url, $flat_img_g, $img_galeria)
  {
    if ($flat_img_g == true) {
      $marca_state = marca_agua( $img_galeria);
      if ($marca_state['status'] == false) { return $marca_state;}
    }

    $sql = "INSERT INTO galeria_proyecto(idfase_proyecto,nombre_imagen,imagen) VALUES ('$id_fase_select','$nombre_img','$img_galeria')";
    $new_data = ejecutarConsulta($sql);
    if ($new_data['status'] == false) { return $new_data;}

    return $retorno = ['status'=> true, 'data'=> $marca_state, 'message'=>'todo oka ps' ];
  }

  public function editar_galeria($idgaleria_proyecto, $id_fase_select, $nombre_img, $host, $url, $flat_img_g, $img_galeria)
  {
    if ($flat_img_g == true) {     
      $marca_state = marca_agua( $img_galeria);
      if ($marca_state['status'] == false) { return $marca_state;}
    }

    $sql = "UPDATE galeria_proyecto SET idfase_proyecto='$id_fase_select',nombre_imagen='$nombre_img', imagen='$img_galeria' WHERE idgaleria_proyecto='$idgaleria_proyecto'";
    $edit_data = ejecutarConsulta($sql);
    if ($edit_data['status'] == false) { return $edit_data;}
    return $retorno = ['status'=> true, 'data'=> $marca_state, 'message'=>'todo oka ps' ];
  }

  public function listar_galeria($idproyecto)
  {
    $sql_1 = "SELECT fp.idfase_proyecto, fp.nombre as fase, gp.idgaleria_proyecto as idgaleria_proyecto, gp.nombre_imagen,  gp.imagen, gp.nombre_imagen
		FROM fase_proyecto as fp, galeria_proyecto as gp
		WHERE gp.idfase_proyecto = fp.idfase_proyecto AND fp.estado =1 AND fp.idproyecto='$idproyecto'";
    return ejecutarConsultaArray($sql_1);
  }

  //Implementamos un método para desactivar categorías
  public function eliminar_galeria($idgaleria_proyecto)
  {
    $sql = "DELETE FROM galeria_proyecto WHERE idgaleria_proyecto ='$idgaleria_proyecto';";
    return ejecutarConsulta($sql);
  }

  //Seleccionar la imagen
  public function reg_img_galeria($idgaleria_proyecto)
  {
    $sql = "SELECT imagen FROM galeria_proyecto WHERE idgaleria_proyecto='$idgaleria_proyecto'";
    return ejecutarConsultaSimpleFila($sql);
  }

  //--------------------------------------------------------------------------
  //-----------------------F A S E S -----------------------------------------
  //--------------------------------------------------------------------------

  public function insertar_fase($idproyecto_fase, $n_fase, $nombre_f)
  {
    $sql = "INSERT INTO fase_proyecto(idproyecto, nombre, numero_fase) VALUES ('$idproyecto_fase','$nombre_f','$n_fase')";
    return ejecutarConsulta($sql);
  }

  public function editar_fase($idfase, $idproyecto_fase, $n_fase, $nombre_f)
  {
    $sql = "UPDATE fase_proyecto SET idproyecto='$idproyecto_fase',nombre='$nombre_f',numero_fase='$n_fase' WHERE idfase_proyecto=$idfase";
    return ejecutarConsulta($sql);
  }

  public function listar_fase($idproyecto_fase)
  {
    $sql = "SELECT*FROM fase_proyecto WHERE idproyecto='$idproyecto_fase' AND estado='1'  ORDER BY idfase_proyecto DESC";
    return ejecutarConsulta($sql);
  }

  public function mostrar_fase($idfase)
  {
    $sql = "SELECT idfase_proyecto, idproyecto, nombre, numero_fase, estado FROM fase_proyecto WHERE idfase_proyecto ='$idfase'";
    return ejecutarConsultaSimpleFila($sql);
  }

  public function eliminar_fase($idfase)
  {
    $sql = "UPDATE fase_proyecto SET estado='0' WHERE idfase_proyecto ='$idfase';";
    return ejecutarConsulta($sql);
  }

  public function select2_fases($idproyecto_fase)
  {
    $sql = "SELECT*FROM fase_proyecto WHERE idproyecto='$idproyecto_fase' AND estado='1'  ORDER BY idfase_proyecto DESC";
    return ejecutarConsulta($sql);
  }

  //--------------------------------------------------------------------------
  //-----------------------L I S T A R  W E B  -------------------------------
  //--------------------------------------------------------------------------

  //Implementar un método para listar en la web
  public function listar_proyecto_web()
  {
    $sql = "SELECT*FROM proyecto_front ORDER BY idproyecto DESC";
    return ejecutarConsultaArray($sql);
  }

  //Implementar un método para listar 1 proyecto en la web
  public function detalle_proyecto_web($idproyecto, $opcion, $fase_selec)
  {
    $data_proyecto = [];
    $rpta_galeria = [];
    $galeria_fases = [];

    $sql_1 = "SELECT idproyecto,id_proyecto_admin,nombre_proyecto,codigo_proyecto,fecha_inicio,fecha_fin,
		dias_habiles,dias_calendario,actividad_trabajo,ubicacion,descripcion,estado_proyecto,img_perfil 
		FROM proyecto_front WHERE id_proyecto_admin='$idproyecto'";

    $datosproyecto = ejecutarConsultaSimpleFila($sql_1);

    if ($datosproyecto['status'] = false) {
      return $datosproyecto;
    }

    $id = $datosproyecto['data']['idproyecto'];

    $limite = "";
    $filtrar_fase = "";

    if ($fase_selec != '0') {
      $filtrar_fase = 'AND idfase_proyecto=' . $fase_selec . '';
    }

    $sql_1_5 = "SELECT idfase_proyecto, nombre, numero_fase FROM fase_proyecto WHERE estado=1 $filtrar_fase  AND idproyecto ='$id'";
    $fase_proyecto = ejecutarConsultaArray($sql_1_5);

    if ($fase_proyecto['status'] == false) {
      return $fase_proyecto;
    }

    if ($opcion == 'resumido') {
      $limite = "LIMIT 3";
    }

    foreach ($fase_proyecto['data'] as $key => $value) {
      $id_fase = $value['idfase_proyecto'];

      $sql_2 = "SELECT * FROM galeria_proyecto WHERE idfase_proyecto='$id_fase' ORDER BY idgaleria_proyecto DESC $limite ";
      $img_fase = ejecutarConsultaArray($sql_2);

      if ($img_fase['status'] == false) {
        return $img_fase;
      }

      $galeria_fases[] = [
        "idfase" => $value['idfase_proyecto'],
        "nombre_fase" => $value['nombre'],
        "numero_fase" => $value['numero_fase'],
        "imagenes" => $img_fase['data'],
      ];
    }

    $data_proyecto = [
      "status" => true,
      "data" => [
        "idproyecto" => $datosproyecto['data']['idproyecto'],
        "nombre_proyecto" => $datosproyecto['data']['nombre_proyecto'],
        "codigo_proyecto" => $datosproyecto['data']['codigo_proyecto'],
        "fecha_inicio" => $datosproyecto['data']['fecha_inicio'],
        "fecha_fin" => $datosproyecto['data']['fecha_fin'],
        "dias_habiles" => $datosproyecto['data']['dias_habiles'],
        "dias_calendario" => $datosproyecto['data']['dias_calendario'],
        "actividad_trabajo" => $datosproyecto['data']['actividad_trabajo'],
        "ubicacion" => $datosproyecto['data']['ubicacion'],
        "descripcion" => $datosproyecto['data']['descripcion'],
        "estado_proyecto" => $datosproyecto['data']['estado_proyecto'],
        "img_perfil" => $datosproyecto['data']['img_perfil'],
        "galeria" => $galeria_fases,
      ],
      "message" => 'Data sin errores',
    ];

    return $data_proyecto;
  }

  public function select2_view_fase($idproyecto_fase)
  {
    $sql = "SELECT*FROM fase_proyecto WHERE idproyecto='$idproyecto_fase' AND estado='1'  ORDER BY idfase_proyecto DESC";
    return ejecutarConsulta($sql);
  }
}

function marca_agua($img_galeria) {
  $scheme_host=  ($_SERVER['HTTP_HOST'] == 'localhost' ? 'http://localhost/page_amazon_lab/' :  $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/');

  // if (validar_url($host,$url,$img_galeria)==true) {

    $rutaImagenOriginal = "../dist/img/proyecto/img_galeria/".$img_galeria;
    $rutaMarcaDeAgua = "361x265_marca.png";
    // $rutaMarcaDeAgua = "../dist/img/marca.png";
    
    // extraemos los datos de la imagen Original
    $original = imagecreatefromstring(file_get_contents($rutaImagenOriginal));
    if ($original === false) { return $retorno = ['status'=> false, 'message'=> 'Formato de imagen no soportado' ]; }
    $anchuraOriginal = imagesx($original);
    $alturaOriginal = imagesy($original);
  
    // calcularmos los tamaños por porcentaje
    $width_m =floatval($anchuraOriginal) * 0.25; 
    $height_m = floatval($alturaOriginal) * 0.25; 
  
    // cambiamos el tamaño a escala
    $new_marca =   img_resize($rutaMarcaDeAgua, $width_m, $height_m, '../dist/img/');
    if ($new_marca['status'] === false) { imagedestroy($original); return $new_marca; }
  
    $marcaDeAgua = imagecreatefrompng( "../dist/img/".$new_marca['name_img']);  
    
  
    # Como vamos a centrar  necesitamos sacar antes las anchuras y alturas  
    $alturaMarcaDeAgua = imagesy($marcaDeAgua);
    $anchuraMarcaDeAgua = imagesx($marcaDeAgua);
  
    # En dónde poner la marca de agua sobre la original
    $xOriginal = $anchuraOriginal - $anchuraMarcaDeAgua - 0;
    $yOriginal = 0;
  
    # Desde dónde comenzar a cortar la marca de agua (si son 0, se comienza desde el inicio)
    $xMarcaDeAgua = 0;
    $yMarcaDeAgua = 0;
  
    # Hasta dónde poner la marca de agua sobre la original
    $alturaMarcaDeAgua = $alturaMarcaDeAgua - $yMarcaDeAgua;
    $anchuraMarcaDeAgua = $anchuraMarcaDeAgua - $xMarcaDeAgua;  
  
    // hacemos Merge a las 2 imagenes
    imagecopy($original, $marcaDeAgua, $xOriginal, $yOriginal, $xMarcaDeAgua, $yMarcaDeAgua, $anchuraMarcaDeAgua, $alturaMarcaDeAgua);
  
    # Guardar: Segundo argumento de imagepng es la ruta de la imagen de salida
    $resultado = imagepng($original, $img_galeria);
    //liberamos recursos
    imagedestroy($original); imagedestroy($marcaDeAgua);
  
    return $retorno = ['status'=> $resultado, 'message'=> 'todo oka bro!!', 'imagen_con_marca'=> $img_galeria, 'marca_agua'=> $new_marca['name_img'],
      'w_o'=> $anchuraOriginal, 'h_o'=> $alturaOriginal,
      'w_m'=> $new_marca['w_m'], 'h_m'=> $new_marca['h_m'],
    ];
  // }
}

function img_resize($imagen_name, $width, $height, $carpeta) {
  //error_reporting( E_ALL ); ini_set( "display_errors", true );
  $scheme_host = ($_SERVER['HTTP_HOST'] == 'localhost' ? $_SERVER['DOCUMENT_ROOT'].'/page_amazon_lab/' :  $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].'/');

	// creamos el nombre
	date_default_timezone_set('America/Lima'); $date_now = date("d-m-Y h.i.s A");  
  $imagenNueva = $date_now.' '.rand(0, 20) . round(microtime(true)) . rand(21, 41) . '.png';

  $nAncho = $width; //Nuevo ancho
  $nAlto = $height; //Nuevo alto

  $imagen = imagecreatefrompng( $carpeta.$imagen_name);
  // Obtenemos el tamaño
  $x = imagesx($imagen);
  $y = imagesy($imagen);

  // si el tamaño es mayor al que tiene no los reducimos
  if ($width >= $x) { imagedestroy($imagen);	return $retorno = ['status'=> true,  'name_img'=> $imagen_name, 'w_m'=> $width, 'h_m'=> $height ]; }
  
  // //Validamos los tamaños y calculamos la relación de aspecto
  if ($x >= $y) { $nAncho = $nAncho; $nAlto = ($nAncho * $y) / $x; } else { $nAlto = $nAlto; $nAncho = ($x / $y) * $nAlto; }

  // liberamos recuros
  imagedestroy($imagen); 

  $image = new Imagick($scheme_host .'admin/dist/img/'.$imagen_name);
  $image->cropThumbnailImage(floor($nAncho), floor($nAlto));
  $image->writeImage( $scheme_host .'admin/dist/img/'. $imagenNueva );
  $image->clear();  

  //retornamos los resultados
  return $retorno = ['status'=> true, 'name_img'=> $imagenNueva, 'w_m'=> $width, 'h_m'=> $height,  ] ;
}


?>
