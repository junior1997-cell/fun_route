<?php 
  //Incluímos inicialmente la conexión a la base de datos
  require "../config/Conexion_v2.php";

  Class Ajax_general
  {
    //Implementamos nuestro variable global
    public $id_usr_sesion;

    //Implementamos nuestro constructor
    public function __construct($id_usr_sesion = 0)
    {
      $this->id_usr_sesion = $id_usr_sesion;
    }

    //CAPTURAR PERSONA  DE RENIEC 
    public function datos_reniec($dni) { 

      $url = "https://dniruc.apisperu.com/api/v1/dni/".$dni."?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Imp1bmlvcmNlcmNhZG9AdXBldS5lZHUucGUifQ.bzpY1fZ7YvpHU5T83b9PoDxHPaoDYxPuuqMqvCwYqsM";
      //  Iniciamos curl
      $curl = curl_init();
      // Desactivamos verificación SSL
      curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, 0 );
      // Devuelve respuesta aunque sea falsa
      curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
      // Especificamo los MIME-Type que son aceptables para la respuesta.
      curl_setopt( $curl, CURLOPT_HTTPHEADER, [ 'Accept: application/json' ] );
      // Establecemos la URL
      curl_setopt( $curl, CURLOPT_URL, $url );
      // Ejecutmos curl
      $json = curl_exec( $curl );
      // Cerramos curl
      curl_close( $curl );

      $respuestas = json_decode( $json, true );

      return $respuestas;
    }

    //CAPTURAR PERSONA  DE RENIEC
    public function datos_sunat($ruc)	{ 
      $url = "https://dniruc.apisperu.com/api/v1/ruc/".$ruc."?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Imp1bmlvcmNlcmNhZG9AdXBldS5lZHUucGUifQ.bzpY1fZ7YvpHU5T83b9PoDxHPaoDYxPuuqMqvCwYqsM";
      //  Iniciamos curl
      $curl = curl_init();
      // Desactivamos verificación SSL
      curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, 0 );
      // Devuelve respuesta aunque sea falsa
      curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
      // Especificamo los MIME-Type que son aceptables para la respuesta.
      curl_setopt( $curl, CURLOPT_HTTPHEADER, [ 'Accept: application/json' ] );
      // Establecemos la URL
      curl_setopt( $curl, CURLOPT_URL, $url );
      // Ejecutmos curl
      $json = curl_exec( $curl );
      // Cerramos curl
      curl_close( $curl );

      $respuestas = json_decode( $json, true );

      return $respuestas;    	

    }   

    /* ══════════════════════════════════════ DATOS EMPRESA ══════════════════════════════════════ */

    public function datos_empresa(){
      $sql = "SELECT * FROM nosotros WHERE idnosotros = '1';";
      return ejecutarConsultaSimpleFila($sql);
    }    

    /* ══════════════════════════════════════ T R A B A J A D O R ══════════════════════════════════════ */

    public function select2_trabajador(){
      $sql = "SELECT t.idtrabajador as id, t.nombres as nombre, t.tipo_documento as documento, t.sueldo_mensual, t.numero_documento, t.imagen_perfil, ct.nombre as cargo_trabajador
      FROM trabajador as t, cargo_trabajador as ct WHERE ct.idcargo_trabajador = t.idcargo_trabajador AND t.estado = '1' AND t.estado_delete = '1' ORDER BY t.nombres ASC;";
      return ejecutarConsultaArray($sql);
    }

    public function select2_cargo_trabajador() {
      $sql = "SELECT * FROM cargo_trabajador WHERE estado='1' AND estado_delete = '1' ORDER BY nombre ASC";
      return ejecutarConsulta($sql);
    }
    
    /* ══════════════════════════════════════ C L I E N T E  ══════════════════════════════════════ */
    public function select2_cliente() {
      $sql = "SELECT p.idpersona, p.idtipo_persona, p.idbancos, p.nombres, p.tipo_documento,  p.numero_documento, p.foto_perfil, tp.nombre as tipo_persona
      FROM persona AS p, tipo_persona as tp
      WHERE p.idtipo_persona = tp.idtipo_persona and p.idtipo_persona = 2 and p.estado='1' AND p.estado_delete = '1' AND p.idpersona > 1 ORDER BY p.nombres ASC;";
      return ejecutarConsulta($sql);
    }

    /* ══════════════════════════════════════ TIPO PERSONA  ══════════════════════════════════════ */
    public function select2_tipo_persona() {
      $sql = "SELECT idtipo_persona, nombre, descripcion FROM tipo_persona WHERE estado='1' AND estado_delete = '1' ORDER BY nombre ASC;";
      return ejecutarConsulta($sql);
    }
    /* ══════════════════════════════════════ TIPO Paquete  ══════════════════════════════════════ */
    public function select2_paquete() {
      $sql = "SELECT idpaquete, nombre, cant_dias, cant_noches, descripcion, imagen, estado FROM paquete WHERE estado='1' AND estado_delete = '1' ORDER BY nombre ASC;";
      return ejecutarConsulta($sql);
    }

    /* ══════════════════════════════════════ P R O V E E D O R -- C L I E N T E S  ══════════════════════════════════════ */

    public function select2Persona_por_tipo($tipo) {
      $filtro = "";
      if ($tipo != 'todos') { $filtro = "p.idtipo_persona ='$tipo' AND";  }
      
      $sql = "SELECT p.idpersona, p.nombres, p.tipo_documento, p.numero_documento, p.foto_perfil, tper.nombre as tipo_persona 
      FROM persona as p, tipo_persona as tper
      WHERE tper.idtipo_persona = p.idtipo_persona AND $filtro p.estado='1' AND p.estado_delete ='1' AND p.idpersona > 1";

      return ejecutarConsulta($sql);
      // var_dump($return);die();
    }

    /* ══════════════════════════════════════ B A N C O ══════════════════════════════════════ */

    public function select2_banco() {
      $sql = "SELECT idbancos as id, nombre, alias, icono FROM bancos WHERE estado='1' AND estado_delete = '1' AND idbancos > 1 ORDER BY nombre ASC;";
      return ejecutarConsulta($sql);
    }

    public function formato_banco($idbanco){
      $sql="SELECT nombre, formato_cta, formato_cci, formato_detracciones FROM bancos WHERE estado='1' AND idbancos = '$idbanco';";
      return ejecutarConsultaSimpleFila($sql);		
    }

    /* ══════════════════════════════════════ F I L T R O   X   V E N T A S ══════════════════════════════════════ */

    public function select2_cliente_x_venta_tours() {
      $sql = "SELECT p.*, t.nombre as tipo_persona
      FROM persona as p 
      INNER JOIN venta_tours as vt ON vt.idpersona = p.idpersona
      INNER JOIN tipo_persona as t ON t.idtipo_persona = p.idtipo_persona
      WHERE vt.estado = '1' AND vt.estado_delete = '1' AND p.estado = '1' AND p.estado_delete = '1' ORDER BY p.nombres ASC;";
      return ejecutarConsulta($sql);
    }

    /* ══════════════════════════════════════ C O L O R ══════════════════════════════════════ */

    public function select2_color() {
      $sql = "SELECT idcolor AS id, nombre_color AS nombre, hexadecimal FROM color WHERE idcolor > 1 AND estado='1' AND estado_delete = '1' ORDER BY nombre_color ASC;";
      return ejecutarConsulta($sql);
    }

    /* ══════════════════════════════════════ U N I D A D   D E   M E D I D A ══════════════════════════════════════ */

    public function select2_unidad_medida() {
      $sql = "SELECT idunidad_medida AS id, nombre, abreviatura FROM unidad_medida WHERE estado='1' AND estado_delete = '1' ORDER BY nombre ASC;";
      return ejecutarConsulta($sql);
    }

    /* ══════════════════════════════════════ C A T E G O R I A ══════════════════════════════════════ */

    public function select2_categoria() {
      $sql = "SELECT idcategoria_producto as id, nombre FROM categoria_producto WHERE estado='1' AND estado_delete = '1' AND idcategoria_producto > 1 ORDER BY nombre ASC;";
      return ejecutarConsulta($sql);
    }

    public function select2_categoria_all() {
      $sql = "SELECT idcategoria_producto as id, nombre FROM categoria_producto WHERE estado='1' AND estado_delete = '1' ORDER BY nombre ASC;";
      return ejecutarConsulta($sql);
    }

    /* ══════════════════════════════════════ T I P O   T I E R R A   C O N C R E T O ══════════════════════════════════════ */

    public function select2_tierra_concreto() {
      $sql = "SELECT idtipo_tierra_concreto as id, nombre, modulo FROM tipo_tierra_concreto  WHERE estado='1' AND estado_delete = '1' AND idtipo_tierra_concreto > 1  ORDER BY modulo ASC;";
      return ejecutarConsulta($sql);
    }

    /* ══════════════════════════════════════ P R O D U C T O   T O U R S ══════════════════════════════════════ */
    //funcion para mostrar registros de prosuctos
    public function mostrar_producto_tours($idtours) {
      $sql = "SELECT idtours, t.idtipo_tours, t.nombre, t.descripcion, t.imagen, t.actividad, t.incluye, t.no_incluye, t.recomendaciones, t.duracion, t.alojamiento, 
      t.resumen_actividad, t.resumen_comida, t.mapa, t.costo, t.estado_descuento, t.porcentaje_descuento, t.monto_descuento, tp.nombre as tipo_tours 
      FROM tours as t, tipo_tours as tp 
      WHERE t.idtipo_tours = tp.idtipo_tours AND t.estado='1' and t.estado_delete='1' AND t.idtours = '$idtours';";
      return ejecutarConsultaSimpleFila($sql);
    }
    //funcion para mostrar registros de prosuctos
    public function tblaProductoTours() {
      $sql = "SELECT t.idtours,t.alojamiento,t.nombre, t.descripcion, t.imagen, t.costo, t.estado_descuento, t.mapa, 
      t.porcentaje_descuento, tp.nombre as tipo_tours 
      FROM tours as t, tipo_tours as tp 
      WHERE t.idtipo_tours = tp.idtipo_tours AND t.estado='1' and t.estado_delete='1';";
      return ejecutarConsulta($sql);
    }

    /* ══════════════════════════════════════ P R O D U C T O   P A Q U E T E ══════════════════════════════════════ */
    //funcion para mostrar registros de prosuctos
    public function mostrar_producto_paquete($idpaquete) {
      $sql = "SELECT idpaquete, nombre, descripcion, imagen, incluye, no_incluye, recomendaciones, alojamiento, 
      mapa, costo, estado_descuento, porcentaje_descuento, monto_descuento
      FROM paquete 
      WHERE estado='1' and estado_delete='1' AND idpaquete = '$idpaquete';";
      return ejecutarConsultaSimpleFila($sql);
    }
    //funcion para mostrar registros de prosuctos
    public function tblaProductoPaquete() {
      $sql = "SELECT idpaquete, alojamiento, nombre,  descripcion,  imagen,  costo,  estado_descuento,  mapa, porcentaje_descuento
      FROM paquete 
      WHERE  estado='1' and  estado_delete='1';";
      return ejecutarConsulta($sql);
    }

    /* ══════════════════════════════════════ T I P O    D E   C O M P R O B A N T E S  ════════════════════════════ */
    public function select2TipoComprobante($tipos) {
      $sql = "SELECT idsunat_correlacion_comprobante as id, codigo, nombre, abreviatura, serie, numero, un1001
      FROM sunat_correlacion_comprobante 
      WHERE estado ='1' AND estado_delete = '1' AND idsunat_correlacion_comprobante > 1 AND codigo IN ($tipos)";
      return ejecutarConsultaArray($sql);
    }    

    //Implementamos un método para activar categorías
    public function autoincrement_comprobante($codigo) {
      $update_producto = "SELECT * FROM sunat_correlacion_comprobante WHERE codigo = '$codigo'";
      $val =  ejecutarConsultaSimpleFila($update_producto); if ( $val['status'] == false) {return $val; }   

      $idcorrelacion= $val['data']['idsunat_correlacion_comprobante']; 
      $nombre       = empty($val['data']) ? '' : ( $val['data']['nombre'] ? '' : $val['data']['nombre'] );
      $abreviatura  = empty($val['data']) ? '' : (empty($val['data']['abreviatura']) ? '' : $val['data']['abreviatura'] );
      $serie        = empty($val['data']) ? '' : (empty($val['data']['serie']) ? '' : $val['data']['serie']);
      $numero       = empty($val['data']) ? 1 : (empty($val['data']['numero']) ? 1 : (intval($val['data']['numero']) +1));

      

      return $sw = array( 'status' => true, 'message' => 'todo okey bro', 
        'data' => [
          'idcorrelacion'=> $idcorrelacion, 
          'nombre'      => $nombre, 
          'abreviatura' => $abreviatura,      
          'serie'       => $serie,      
          'numero'      => zero_fill($numero, 5),          
        ] 
      );      
    }
    

    /* ══════════════════════════════════════ N O T I F I C A C I O N   P E D I D O S ════════════════════════════ */
    public function notificacion_pedido() {
      $data = [];
      $sql_1 = "SELECT * FROM pedido_tours WHERE estado_visto = '0' AND estado = '1' AND estado_delete = '1' ORDER BY idpedido_tours ASC LIMIT 3";
      $data1 = ejecutarConsultaArray($sql_1); if ( $data1['status'] == false) {return $data1; }  

      $sql_2 = "SELECT * FROM pedido_paquete WHERE estado_visto = '0' AND estado = '1' AND estado_delete = '1' ORDER BY idpedido_paquete ASC LIMIT 3";
      $data2 = ejecutarConsultaArray($sql_2); if ( $data2['status'] == false) {return $data2; }  

      $sql_3 = "SELECT * FROM paquete_a_medida WHERE estado_visto = '0' AND estado = '1' AND estado_delete = '1' ORDER BY idpaquete_a_medida ASC LIMIT 3";
      $data3 = ejecutarConsultaArray($sql_3); if ( $data3['status'] == false) {return $data3; }  

      foreach ($data1['data'] as $key => $val) {  $data[] = [ 'nombre'  =>$val['nombre'], 'tipo'  =>"Pedido-Tours", 'created_at'  =>$val['created_at'],  ];  }
      foreach ($data2['data'] as $key => $val) {  $data[] = [ 'nombre'  =>$val['nombre'], 'tipo'  =>"Pedido-Paquete", 'created_at'  =>$val['created_at'], ];  }
      foreach ($data3['data'] as $key => $val) {  $data[] = [ 'nombre'  =>$val['p_nombre'], 'tipo'  =>"Pedido-Paquete-a-medida", 'created_at'  =>$val['created_at'], ];  }

      return $retorno=[
        'status'=>true, 
        'message'=>'todo oka ps', 
        'data'=> [
          'cant'=>count($data1['data']) + count($data2['data']) + count($data3['data']),
          'pedido'=> $data 
        ] 
      ];
    }

  }

?>