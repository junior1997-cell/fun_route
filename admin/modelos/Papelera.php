<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion_v2.php";

class Papelera
{
  //Implementamos nuestro variable global
  public $id_usr_sesion;

  //Implementamos nuestro constructor
  public function __construct($id_usr_sesion = 0)
  {
    $this->id_usr_sesion = $id_usr_sesion;
  }

  public function tabla_principal($nube_idproyecto) {
    $data = Array();   

    $sql_1 = "SELECT idbancos,  nombre, formato_cta, formato_cci, formato_detracciones, alias, created_at, updated_at, estado FROM bancos 
    WHERE estado = '0' AND estado_delete= '1';";
    $banco = ejecutarConsultaArray($sql_1);

    if ($banco['status'] == false) { return $banco; }

    if (!empty($banco['data'])) {
      foreach ($banco['data'] as $key => $value1) {
        $data[] = array(
          'nombre_tabla'    => 'bancos',
          'nombre_id_tabla' => 'idbancos',
          'id_tabla'        => $value1['idbancos'],
          'modulo'          => 'BANCOS',
          'nombre_archivo'  => '<b>Banco: </b>'.$value1['nombre'].'<br>'. 
          '<b>Alias: </b>'.$value1['alias'].'<br>'.
          '<b>Formato Cta: </b>'.$value1['formato_cta'].'<br>'. 
          '<b>Formato Cci: </b>'.$value1['formato_cci'].'<br>'. 
          '<b>Formato Dtrac: </b>'.$value1['formato_detracciones'].'<br>' ,
          'descripcion'     => '- - -',
          'created_at'      => $value1['created_at'],
          'updated_at'      => $value1['updated_at'],
        );
      }
    }


    //sql para mostrar los datos de tipo_persona
    $sql2 = "SELECT idtipo_persona, nombre, descripcion, created_at, updated_at FROM tipo_persona WHERE estado='0' AND estado_delete=1;";
    $tipo_persona = ejecutarConsultaArray($sql2); if ($tipo_persona['status'] == false) { return $tipo_persona; }
    
    if (!empty($tipo_persona['data'])) {
      foreach ($tipo_persona['data'] as $key => $value2) {
        $data[] = array(
          'nombre_tabla'    => 'tipo_persona',
          'nombre_id_tabla' => 'idtipo_persona',
          'modulo'          => 'TIPO PERSONA',
          'id_tabla'        => $value2['idtipo_persona'],
          'nombre_archivo'  => $value2['nombre'],
          'descripcion'     => ' - - - ',
          'created_at'      => $value2['created_at'],
          'updated_at'      => $value2['updated_at'],
        );
      }
    }


    //sql para mostrar los datos de cargos
    $sql3 = "SELECT idcargo_trabajador, nombre, created_at, updated_at, estado, estado_delete FROM cargo_trabajador WHERE estado='0' AND estado_delete=1;";
    $cargo_trabajador = ejecutarConsultaArray($sql3); if ($cargo_trabajador['status'] == false) { return $cargo_trabajador; }

    if (!empty($cargo_trabajador['data'])) {
      foreach ($cargo_trabajador['data'] as $key => $value3) {
        $data[] = array(
          'nombre_tabla'    => 'cargo_trabajador',
          'nombre_id_tabla' => 'idcargo_trabajador',
          'modulo'          => 'CARGO TRABAJADOR',
          'id_tabla'        => $value3['idcargo_trabajador'],
          'nombre_archivo'  => $value3['nombre'],
          'descripcion'     => ' - - - ',
          'created_at'      => $value3['created_at'],
          'updated_at'      => $value3['updated_at'],
        );
      }
    }


    //sql para mostrar los datos de persona
    $sql4 = "SELECT p.idpersona, p.nombres, p.numero_documento, p.correo, p.created_at, p.updated_at, tp.nombre tipo_persona 
    FROM persona as p, tipo_persona as tp 
    WHERE p.idtipo_persona = tp.idtipo_persona AND p.estado='0' AND p.estado_delete=1;";
    $persona = ejecutarConsultaArray($sql4); if ($persona['status'] == false) { return $persona; }

    if (!empty($persona['data'])) {
      foreach ($persona['data'] as $key => $value4) {
        $data[] = array(
          'nombre_tabla'    => 'persona',
          'nombre_id_tabla' => 'idpersona',
          'modulo'          => 'PERSONA',
          'id_tabla'        => $value4['idpersona'],
          'nombre_archivo'  => $value4['nombres'],
          'descripcion'     => $value4['tipo_persona']."\n"."N° Doc : ".$value4['numero_documento']."\n"."Correo : ".$value4['correo'],
          'created_at'      => $value4['created_at'],
          'updated_at'      => $value4['updated_at'],
        );
      }
    }


    //sql para mostrar los datos de usuruio
    $sql5 = "SELECT u.idusuario, u.login, u.created_at, u.updated_at, p.nombres as persona 
    FROM usuario as u, persona as p 
    WHERE u.idpersona=p.idpersona AND u.estado='0' AND u.estado_delete=1;";
    $usuario = ejecutarConsultaArray($sql5); if ($usuario['status'] == false) { return $usuario; }

    if (!empty($usuario['data'])) {
      foreach ($usuario['data'] as $key => $value5) {
        $data[] = array(
          'nombre_tabla'    => 'usuario',
          'nombre_id_tabla' => 'idusuario',
          'modulo'          => 'USUARIO',
          'id_tabla'        => $value5['idusuario'],
          'nombre_archivo'  => 'Usuario :'.$value5['login'],
          'descripcion'     => 'Nombre : '.$value5['persona'],
          'created_at'      => $value5['created_at'],
          'updated_at'      => $value5['updated_at'],
        );
      }
    } 

    
    //sql para mostrar los datos de pago_trabajador
    $sql6 = "SELECT idpago_trabajador,nombre_mes,monto,descripcion,created_at,updated_at FROM pago_trabajador WHERE estado='0' AND estado_delete='1';";
    $pago_trabajador = ejecutarConsultaArray($sql6); if ($pago_trabajador['status'] == false) { return $pago_trabajador; };
    
    if (!empty($pago_trabajador['data'])) {
      foreach ($pago_trabajador['data'] as $key => $value6) {
        $data[] = array(
          'nombre_tabla'    => 'pago_trabajador',
          'nombre_id_tabla' => 'idpago_trabajador',
          'modulo'          => 'PAGO TRABAJADOR',
          'id_tabla'        => $value6['idpago_trabajador'],
          'nombre_archivo'  => 'Pago del mes '.$value6['nombre_mes'].' : '.$value6['monto'],
          'descripcion'     => $value6['descripcion'],
          'created_at'      => $value6['created_at'],
          'updated_at'      => $value6['updated_at'],
        );
      }
    }


    //sql para mostrar los datos de otro_ingreso
    $sql7 = "SELECT idotro_ingreso,precio_con_igv,tipo_comprobante,numero_comprobante,forma_de_pago,descripcion,created_at,updated_at 
    FROM otro_ingreso 
    WHERE estado='0' AND estado_delete='1';";
    $otro_ingreso = ejecutarConsultaArray($sql7); if ($otro_ingreso['status'] == false) { return $otro_ingreso; };
       
    if (!empty($otro_ingreso['data'])) {
      foreach ($otro_ingreso['data'] as $key => $value7) {
        $data[] = array(
          'nombre_tabla'    => 'otro_ingreso',
          'nombre_id_tabla' => 'idotro_ingreso',
          'modulo'          => 'OTROS INGRESOS',
          'id_tabla'        => $value7['idotro_ingreso'],
          'nombre_archivo'  => $value7['tipo_comprobante'].' : '.$value7['numero_comprobante'],
          'descripcion'     => $value7['forma_de_pago'].' : '.$value7['precio_con_igv'],
          'created_at'      => $value7['created_at'],
          'updated_at'      => $value7['updated_at'],
        );
      }
    }


    //sql para mostrar los datos de hoteles
    $sql8 = "SELECT idhoteles, nombre, estrellas, imagen_perfil, check_in, check_out, created_at, updated_at FROM hoteles WHERE estado='0' AND estado_delete=1;";
    $hoteles = ejecutarConsultaArray($sql8); if ($hoteles['status'] == false) { return $hoteles; }
    
    if (!empty($hoteles['data'])) {
      foreach ($hoteles['data'] as $key => $value8) {
        $data[] = array(
          'nombre_tabla'    => 'hoteles',
          'nombre_id_tabla' => 'idhoteles',
          'modulo'          => 'RECURSOS',
          'id_tabla'        => $value8['idhoteles'],
          'nombre_archivo'  => $value8['nombre'],
          'descripcion'     => "N° Estrellas : ".$value8['estrellas'],
          'created_at'      => $value8['created_at'],
          'updated_at'      => $value8['updated_at'],
        );
      }
    }

    
    //sql para mostrar los datos de instalaciones_hotel
    $sql9 = "SELECT ih.idinstalaciones_hotel, ih.nombre, ih.icono_font, ih.created_at, ih.updated_at, h.nombre habitacion 
    FROM instalaciones_hotel as ih, hoteles as h 
    WHERE ih.idhoteles = h.idhoteles AND ih.estado='0' AND ih.estado_delete=1;";
    $instalaciones_hotel = ejecutarConsultaArray($sql9); if ($instalaciones_hotel['status'] == false) { return $instalaciones_hotel; }

    if (!empty($instalaciones_hotel['data'])) {
      foreach ($instalaciones_hotel['data'] as $key => $value9) {
        $data[] = array(
          'nombre_tabla'    => 'instalaciones_hotel',
          'nombre_id_tabla' => 'idinstalaciones_hotel',
          'modulo'          => 'RECURSOS',
          'id_tabla'        => $value9['idinstalaciones_hotel'],
          'nombre_archivo'  => $value9['nombre'],
          'descripcion'     => '- - - - ',
          'created_at'      => $value9['created_at'],
          'updated_at'      => $value9['updated_at'],
        );
      }
    }


    //sql para mostrar los datos de HABITACION
    $sql10 = "SELECT ha.idhabitacion, ha.nombre, ha.created_at, ha.updated_at, ho.nombre hoteles 
    FROM habitacion as ha, hoteles as ho 
    WHERE ha.idhoteles = ho.idhoteles AND ha.estado='0' AND ha.estado_delete=1;";
    $habitacion = ejecutarConsultaArray($sql10); if ($habitacion['status'] == false) { return $habitacion; }

    if (!empty($habitacion['data'])) {
      foreach ($habitacion['data'] as $key => $value10) {
        $data[] = array(
          'nombre_tabla'    => 'habitacion',
          'nombre_id_tabla' => 'idhabitacion',
          'modulo'          => 'RECURSOS',
          'id_tabla'        => $value10['idhabitacion'],
          'nombre_archivo'  => $value10['nombre'],
          'descripcion'     => '- - - - ',
          'created_at'      => $value10['created_at'],
          'updated_at'      => $value10['updated_at'],
        );
      }
    }


    //sql para mostrar los datos de detalles_habitacion
    $sql11 = "SELECT dh.iddetalle_habitacion, dh.nombre, dh.icono_font, dh.created_at, dh.updated_at, h.nombre habitacion 
    FROM detalle_habitacion as dh, habitacion as h 
    WHERE dh.idhabitacion = h.idhabitacion AND dh.estado='0' AND dh.estado_delete=1;";
    $detalle_habitacion = ejecutarConsultaArray($sql11); if ($detalle_habitacion['status'] == false) { return $detalle_habitacion; }

    if (!empty($detalle_habitacion['data'])) {
      foreach ($detalle_habitacion['data'] as $key => $value11) {
        $data[] = array(
          'nombre_tabla'    => 'detalle_habitacion',
          'nombre_id_tabla' => 'iddetalle_habitacion',
          'modulo'          => 'RECURSOS',
          'id_tabla'        => $value11['iddetalle_habitacion'],
          'nombre_archivo'  => $value11['nombre'],
          'descripcion'     => '- - - - ',
          'created_at'      => $value11['created_at'],
          'updated_at'      => $value11['updated_at'],
        );
      }
    }


    //sql para mostrar los datos de paquete
    $sql12 = "SELECT idpaquete, nombre, descripcion, created_at, updated_at FROM paquete WHERE estado='0' AND estado_delete=1;";
    $paquete = ejecutarConsultaArray($sql12); if ($paquete['status'] == false) { return $paquete; }
    
    if (!empty($paquete['data'])) {
      foreach ($paquete['data'] as $key => $value12) {
        $data[] = array(
          'nombre_tabla'    => 'paquete',
          'nombre_id_tabla' => 'idpaquete',
          'modulo'          => 'PAQUETE',
          'id_tabla'        => $value12['idpaquete'],
          'nombre_archivo'  => $value12['nombre'],
          'descripcion'     => $value12['descripcion'],
          'created_at'      => $value12['created_at'],
          'updated_at'      => $value12['updated_at'],
        );
      }
    }


    //sql para mostrar los datos de pedido_paquete
    $sql13 = "SELECT pp.idpedido_paquete, pp.nombre, pp.descripcion, pp.created_at, pp.updated_at, p.nombre paquete 
    FROM pedido_paquete as pp, paquete as p 
    WHERE pp.idpaquete = p.idpaquete AND pp.estado='0' AND pp.estado_delete=1;";
    $pedido_paquete = ejecutarConsultaArray($sql13); if ($pedido_paquete['status'] == false) { return $pedido_paquete; }

    if (!empty($pedido_paquete['data'])) {
      foreach ($pedido_paquete['data'] as $key => $value13) {
        $data[] = array(
          'nombre_tabla'    => 'pedido_paquete',
          'nombre_id_tabla' => 'idpedido_paquete',
          'modulo'          => 'PEDIDO PAQUETE',
          'id_tabla'        => $value13['idpedido_paquete'],
          'nombre_archivo'  => $value13['nombre'],
          'descripcion'     => $value13['descripcion'],
          'created_at'      => $value13['created_at'],
          'updated_at'      => $value13['updated_at'],
        );
      }
    }


    //sql para mostrar los datos de tipo tours
    $sql14 = "SELECT idtipo_tours, nombre, descripcion, created_at, updated_at FROM tipo_tours WHERE estado='0' AND estado_delete=1;";
    $tipo_tours = ejecutarConsultaArray($sql14); if ($tipo_tours['status'] == false) { return $tipo_tours; }
    
    if (!empty($tipo_tours['data'])) {
      foreach ($tipo_tours['data'] as $key => $value14) {
        $data[] = array(
          'nombre_tabla'    => 'tipo_tours',
          'nombre_id_tabla' => 'idtipo_tours',
          'modulo'          => 'TIPO TOURS',
          'id_tabla'        => $value14['idtipo_tours'],
          'nombre_archivo'  => $value14['nombre'],
          'descripcion'     => $value14['descripcion'],
          'created_at'      => $value14['created_at'],
          'updated_at'      => $value14['updated_at'],
        );
      }
    }


    //sql para mostrar los datos de tours
    $sql15 = "SELECT t.idtours, t.nombre, t.descripcion, t.created_at, t.updated_at, tt.nombre tipo_tours 
    FROM tours as t, tipo_tours as tt 
    WHERE t.idtipo_tours = t.idtipo_tours AND t.estado='0' AND t.estado_delete=1;";
    $tours = ejecutarConsultaArray($sql15); if ($tours['status'] == false) { return $tours; }

    if (!empty($tours['data'])) {
      foreach ($tours['data'] as $key => $value15) {
        $data[] = array(
          'nombre_tabla'    => 'tours',
          'nombre_id_tabla' => 'idtours',
          'modulo'          => 'TOURS',
          'id_tabla'        => $value15['idtours'],
          'nombre_archivo'  => $value15['nombre'],
          'descripcion'     => $value15['descripcion'],
          'created_at'      => $value15['created_at'],
          'updated_at'      => $value15['updated_at'],
        );
      }
    }


    //sql para mostrar los datos de pedido_tours
    $sql16 = "SELECT pt.idpedido_tours, pt.nombre, pt.descripcion, pt.created_at, pt.updated_at, t.nombre tours 
    FROM pedido_tours as pt, tours as t 
    WHERE pt.idtours = t.idtours AND pt.estado='0' AND pt.estado_delete=1;";
    $pedido_tours = ejecutarConsultaArray($sql16); if ($pedido_tours['status'] == false) { return $pedido_tours; }

    if (!empty($pedido_tours['data'])) {
      foreach ($pedido_tours['data'] as $key => $value16) {
        $data[] = array(
          'nombre_tabla'    => 'pedido_tours',
          'nombre_id_tabla' => 'idpedido_tours',
          'modulo'          => 'PEDIDO TOURS',
          'id_tabla'        => $value16['idpedido_tours'],
          'nombre_archivo'  => $value16['nombre'],
          'descripcion'     => $value16['descripcion'],
          'created_at'      => $value16['created_at'],
          'updated_at'      => $value16['updated_at'],
        );
      }
    }


    //sql para mostrar los datos de permiso
    $sql17 = "SELECT idpermiso, nombre, created_at, updated_at FROM permiso WHERE estado='0' AND estado_delete=1;";
    $permiso = ejecutarConsultaArray($sql17); if ($permiso['status'] == false) { return $permiso; }
    
    if (!empty($permiso['data'])) {
      foreach ($permiso['data'] as $key => $value17) {
        $data[] = array(
          'nombre_tabla'    => 'permiso',
          'nombre_id_tabla' => 'idpermiso',
          'modulo'          => 'PERMISO',
          'id_tabla'        => $value17['idpermiso'],
          'nombre_archivo'  => $value17['nombre'],
          'descripcion'     => '- - - -',
          'created_at'      => $value17['created_at'],
          'updated_at'      => $value17['updated_at'],
        );
      }
    }

 
    //sql para mostrar los datos de mes_pago_trabajador
    $sql18 = "SELECT mp.idmes_pago_trabajador, mp.mes_nombre, mp.created_at, mp.updated_at
    FROM mes_pago_trabajador as mp, persona as p
    WHERE mp.idpersona = p.idpersona AND mp.estado='0' AND mp.estado_delete=1;";
    $mes_pago_trabajador = ejecutarConsultaArray($sql18); if ($mes_pago_trabajador['status'] == false) { return $mes_pago_trabajador; }

    if (!empty($mes_pago_trabajador['data'])) {
      foreach ($mes_pago_trabajador['data'] as $key => $value18) {
        $data[] = array(
          'nombre_tabla'    => 'mes_pago_trabajador',
          'nombre_id_tabla' => 'idmes_pago_trabajador',
          'modulo'          => 'MES PAGO',
          'id_tabla'        => $value18['idmes_pago_trabajador'],
          'nombre_archivo'  => $value18['mes_nombre'],
          'descripcion'     => '- - - -',
          'created_at'      => $value18['created_at'],
          'updated_at'      => $value18['updated_at'],
        );
      }
    }


    //sql para mostrar los datos de experiencias
    $sql19 = "SELECT idexperiencia, nombre, lugar, comentario, created_at, updated_at FROM experiencias WHERE estado='0' AND estado_delete=1;";
    $experiencia = ejecutarConsultaArray($sql19); if ($experiencia['status'] == false) { return $experiencia; }
    
    if (!empty($experiencia['data'])) {
      foreach ($experiencia['data'] as $key => $value19) {
        $data[] = array(
          'nombre_tabla'    => 'experiencias',
          'nombre_id_tabla' => 'idexperiencia',
          'modulo'          => 'EXPERIENCIAS',
          'id_tabla'        => $value19['idexperiencia'],
          'nombre_archivo'  => $value19['nombre'],
          'descripcion'     => "Lugar: ".$value19['lugar']."\n"."Comentario : ".$value19['comentario'],
          'created_at'      => $value19['created_at'],
          'updated_at'      => $value19['updated_at'],
        );
      }
    }


    //sql para mostrar los datos de galeria_hotel
    $sql20 = "SELECT gh.idgaleria_hotel, gh.imagen, gh.descripcion, gh.created_at, gh.updated_at, h.nombre hoteles
    FROM galeria_hotel as gh, hoteles as h
    WHERE gh.idhoteles = h.idhoteles AND gh.estado='0' AND gh.estado_delete=1;";
    $galeria_hotel = ejecutarConsultaArray($sql20); if ($galeria_hotel['status'] == false) { return $galeria_hotel; }

    if (!empty($galeria_hotel['data'])) {
      foreach ($galeria_hotel['data'] as $key => $value20) {
        $data[] = array(
          'nombre_tabla'    => 'galeria_hotel',
          'nombre_id_tabla' => 'idgaleria_hotel',
          'modulo'          => 'GALERÍA HOTEL',
          'id_tabla'        => $value20['idgaleria_hotel'],
          'nombre_archivo'  => '../dist/docs/hotel/galeria/'.$value20['imagen'],
          'descripcion'     => "Título: ".$value20['descripcion']."\n"."Hotel: ".$value20['hoteles'],
          'created_at'      => $value20['created_at'],
          'updated_at'      => $value20['updated_at'],
        );
      }
    }


    //sql para mostrar los datos de galeria_paquete
    $sql21 = "SELECT gp.idgaleria_paquete, gp.imagen, gp.descripcion, gp.created_at, gp.updated_at, p.nombre paquete
    FROM galeria_paquete as gp, paquete as p
    WHERE gp.idpaquete = p.idpaquete AND gp.estado='0' AND gp.estado_delete=1;";
    $galeria_paquete = ejecutarConsultaArray($sql21); if ($galeria_paquete['status'] == false) { return $galeria_paquete; }

    if (!empty($galeria_paquete['data'])) {
      foreach ($galeria_paquete['data'] as $key => $value21) {
        $data[] = array(
          'nombre_tabla'    => 'galeria_paquete',
          'nombre_id_tabla' => 'idgaleria_paquete',
          'modulo'          => 'GALERÍA PAQUETE',
          'id_tabla'        => $value21['idgaleria_paquete'],
          'nombre_archivo'  => '../dist/docs/paquete/galeria/'.$value21['imagen'],
          'descripcion'     => "Título: ".$value21['descripcion']."\n"."Paquete: ".$value21['paquete'],
          'created_at'      => $value21['created_at'],
          'updated_at'      => $value21['updated_at'],
        );
      }
    }


    //sql para mostrar los datos de galeria_tours
    $sql22 = "SELECT gt.idgaleria_tours, gt.imagen, gt.descripcion, gt.created_at, gt.updated_at, t.nombre tours
    FROM galeria_tours as gt, tours as t
    WHERE gt.idtours = t.idtours AND gt.estado='0' AND gt.estado_delete=1;";
    $galeria_tours = ejecutarConsultaArray($sql22); if ($galeria_tours['status'] == false) { return $galeria_tours; }

    if (!empty($galeria_tours['data'])) {
      foreach ($galeria_tours['data'] as $key => $value22) {
        $img3 = '../dist/docs/tours/galeria/'.$value22['imagen'];
        $data[] = array(
          'nombre_tabla'    => 'galeria_tours',
          'nombre_id_tabla' => 'idgaleria_tours',
          'modulo'          => 'GALERÍA TOURS',
          'id_tabla'        => $value22['idgaleria_tours'],
          'nombre_archivo'  => '../dist/docs/tours/galeria/'.$value22['imagen'],
          'descripcion'     => "Título: ".$value22['descripcion']."\n"."Tours: ".$value22['tours'],
          'created_at'      => $value22['created_at'],
          'updated_at'      => $value22['updated_at'],
        );
      }
    }


    //sql para mostrar los datos de sunat_correlacion_comprobante
    $sql23 = "SELECT idsunat_correlacion_comprobante, nombre, abreviatura, serie, numero, created_at, updated_at FROM sunat_correlacion_comprobante WHERE estado='0' AND estado_delete=1;";
    $sunat_correlacion_comprobante = ejecutarConsultaArray($sql23); if ($sunat_correlacion_comprobante['status'] == false) { return $sunat_correlacion_comprobante; }
    
    if (!empty($sunat_correlacion_comprobante['data'])) {
      foreach ($sunat_correlacion_comprobante['data'] as $key => $value23) {
        $data[] = array(
          'nombre_tabla'    => 'sunat_correlacion_comprobante',
          'nombre_id_tabla' => 'idsunat_correlacion_comprobante',
          'modulo'          => 'OTROS ',
          'id_tabla'        => $value23['idsunat_correlacion_comprobante'],
          'nombre_archivo'  => $value23['nombre'],
          'descripcion'     => "Abreviatura: ".$value23['abreviatura']."\n"."Serie : ".$value23['serie']."\n"."Número : ".$value23['numero'],
          'created_at'      => $value23['created_at'],
          'updated_at'      => $value23['updated_at'],
        );
      }
    }


    //sql para mostrar los datos de visitas_pag
    $sql24 = "SELECT idvisitas_pag, nombre_vista, created_at, updated_at FROM visitas_pag WHERE estado='0' AND estado_delete=1;";
    $visitas_pag = ejecutarConsultaArray($sql24); if ($visitas_pag['status'] == false) { return $visitas_pag; }
    
    if (!empty($visitas_pag['data'])) {
      foreach ($visitas_pag['data'] as $key => $value24) {
        $data[] = array(
          'nombre_tabla'    => 'visitas_pag',
          'nombre_id_tabla' => 'idvisitas_pag',
          'modulo'          => 'VISITAS DE LA PÁGINA',
          'id_tabla'        => $value24['idvisitas_pag'],
          'nombre_archivo'  => $value24['nombre_vista'],
          'descripcion'     => '- - - - -',
          'created_at'      => $value24['created_at'],
          'updated_at'      => $value24['updated_at'],
        );
      }
    }


    //sql para mostrar los datos de viaje_a_medida
    $sql25 = "SELECT vm.idviaje_a_medida, vm.nombres, vm.created_at, vm.updated_at, t.nombre tours, h.nombre hotel
    FROM viaje_a_medida as vm, hoteles as h, tours as t
    WHERE vm.idhoteles = h.idhoteles AND vm.idtours = t.idtours AND vm.estado='0' AND vm.estado_delete=1;";
    $viaje_a_medida = ejecutarConsultaArray($sql25); if ($viaje_a_medida['status'] == false) { return $viaje_a_medida; }

    if (!empty($viaje_a_medida['data'])) {
      foreach ($viaje_a_medida['data'] as $key => $value25) {
        $data[] = array(
          'nombre_tabla'    => 'viaje_a_medida',
          'nombre_id_tabla' => 'idviaje_a_medida',
          'modulo'          => 'VIAJE A MEDIDA',
          'id_tabla'        => $value25['idviaje_a_medida'],
          'nombre_archivo'  => $value25['nombres'],
          'descripcion'     => '- - - -',
          'created_at'      => $value25['created_at'],
          'updated_at'      => $value25['updated_at'],
        );
      }
    }


    //sql para mostrar los datos de venta_paquete
    $sql26 = "SELECT vp.idventa_paquete, vp.numero_comprobante, vp.serie_comprobante, vp.tipo_comprobante, vp.created_at, vp.updated_at, p.nombres persona
    FROM venta_paquete as vp, persona as p
    WHERE vp.idpersona = p.idpersona AND vp.estado='0' AND vp.estado_delete=1;";
    $venta_paquete = ejecutarConsultaArray($sql26); if ($venta_paquete['status'] == false) { return $venta_paquete; }

    if (!empty($venta_paquete['data'])) {
      foreach ($venta_paquete['data'] as $key => $value26) {
        $data[] = array(
          'nombre_tabla'    => 'venta_paquete',
          'nombre_id_tabla' => 'idventa_paquete',
          'modulo'          => 'VENTA PAQUETE',
          'id_tabla'        => $value26['idventa_paquete'],
          'nombre_archivo'  => '<b>N° Comprobante: </b>'.$value26['numero_comprobante'],
          'descripcion'     => "Tipo Comprobante: ".$value26['tipo_comprobante']."\n"."Serie : ".$value26['serie_comprobante'],
          'created_at'      => $value26['created_at'],
          'updated_at'      => $value26['updated_at'],
        );
      }
    }


    //sql para mostrar los datos de venta_tours
    $sql27 = "SELECT vt.idventa_tours, vt.numero_comprobante, vt.serie_comprobante, vt.tipo_comprobante, vt.created_at, vt.updated_at, p.nombres persona
    FROM venta_tours as vt, persona as p
    WHERE vt.idpersona = p.idpersona AND vt.estado='0' AND vt.estado_delete=1;";
    $venta_tours = ejecutarConsultaArray($sql27); if ($venta_tours['status'] == false) { return $venta_tours; }

    if (!empty($venta_tours['data'])) {
      foreach ($venta_tours['data'] as $key => $value27) {
        $data[] = array(
          'nombre_tabla'    => 'venta_tours',
          'nombre_id_tabla' => 'idventa_tours',
          'modulo'          => 'VENTA TOURS',
          'id_tabla'        => $value27['idventa_tours'],
          'nombre_archivo'  => '<b>N° Comprobante: </b>'.$value27['numero_comprobante'],
          'descripcion'     => "Tipo Comprobante: ".$value27['tipo_comprobante']."\n"."Serie : ".$value27['serie_comprobante'],
          'created_at'      => $value27['created_at'],
          'updated_at'      => $value27['updated_at'],
        );
      }
    }


    //sql para mostrar los datos de venta_paquete_pago
    $sql28 = "SELECT vpp.idventa_paquete_pago, vpp.numero_operacion, vpp.monto, vpp.forma_pago, vpp.descripcion, vpp.created_at, vpp.updated_at, vp.numero_comprobante venta_paquete
    FROM venta_paquete_pago as vpp, venta_paquete as vp
    WHERE vpp.idventa_paquete = vp.idventa_paquete AND vpp.estado='0' AND vpp.estado_delete=1;";
    $venta_paquete_pago = ejecutarConsultaArray($sql28); if ($venta_paquete_pago['status'] == false) { return $venta_paquete_pago; }

    if (!empty($venta_paquete_pago['data'])) {
      foreach ($venta_paquete_pago['data'] as $key => $value28) {
        $data[] = array(
          'nombre_tabla'    => 'venta_paquete_pago',
          'nombre_id_tabla' => 'idventa_paquete_pago',
          'modulo'          => 'PAQUETE PAGO',
          'id_tabla'        => $value28['idventa_paquete_pago'],
          'nombre_archivo'  => '<b>N° Operación: </b>'.$value28['numero_operacion'],
          'descripcion'     => $value28['descripcion']."\n"."Forma de pago: ".$value28['forma_pago']."\n"."Monto : ".$value28['monto'],
          'created_at'      => $value28['created_at'],
          'updated_at'      => $value28['updated_at'],
        );
      }
    }


    //sql para mostrar los datos de venta_tours_pago
    $sql29 = "SELECT vtp.idventa_tours_pago, vtp.numero_operacion, vtp.monto, vtp.forma_pago, vtp.descripcion, vtp.created_at, vtp.updated_at, vt.numero_comprobante venta_tours
    FROM venta_tours_pago as vtp, venta_tours as vt
    WHERE vtp.idventa_tours = vt.idventa_tours AND vtp.estado='0' AND vtp.estado_delete=1;";
    $venta_tours_pago = ejecutarConsultaArray($sql29); if ($venta_tours_pago['status'] == false) { return $venta_tours_pago; }

    if (!empty($venta_tours_pago['data'])) {
      foreach ($venta_tours_pago['data'] as $key => $value29) {
        $data[] = array(
          'nombre_tabla'    => 'venta_tours_pago',
          'nombre_id_tabla' => 'idventa_tours_pago',
          'modulo'          => 'TOURS PAGO',
          'id_tabla'        => $value29['idventa_tours_pago'],
          'nombre_archivo'  => '<b>N° Operación: </b>'.$value29['numero_operacion'],
          'descripcion'     => $value29['descripcion']."\n"."Forma de pago: ".$value29['forma_pago']."\n"."Monto : ".$value29['monto'],
          'created_at'      => $value29['created_at'],
          'updated_at'      => $value29['updated_at'],
        );
      }
    }


    //sql para mostrar los datos de ITINERARIO
    $sql30 = "SELECT it.iditinerario, it.actividad, it.created_at, it.updated_at, t.nombre tours, p.nombre paquete
    FROM itinerario as it, paquete as p, tours as t 
    WHERE it.idtours = t.idtours AND it.idpaquete = p.idpaquete AND it.estado='0' AND it.estado_delete=1;";
    $itinerario = ejecutarConsultaArray($sql30); if ($itinerario['status'] == false) { return $itinerario; }

    if (!empty($itinerario['data'])) {
      foreach ($itinerario['data'] as $key => $value30) {
        $data[] = array(
          'nombre_tabla'    => 'itinerario',
          'nombre_id_tabla' => 'iditinerario',
          'modulo'          => 'ITINERARIO',
          'id_tabla'        => $value30['iditinerario'],
          'nombre_archivo'  => $value30['actividad'],
          'descripcion'     => '- - - - -',
          'created_at'      => $value30['created_at'],
          'updated_at'      => $value30['updated_at'],
        );
      }
    }

    //sql para mostrar los datos de PAQUETE_A_MEDIDA
    $sql31 = "SELECT idpaquete_a_medida, ocacion_viaje, p_nombre, p_descripcion, presupuesto, created_at, updated_at
    FROM paquete_a_medida 
    WHERE estado='0' AND estado_delete=1;";
    $paquete_a_medida = ejecutarConsultaArray($sql31); if ($paquete_a_medida['status'] == false) { return $paquete_a_medida; }

    if (!empty($paquete_a_medida['data'])) {
      foreach ($paquete_a_medida['data'] as $key => $value31) {
        $data[] = array(
          'nombre_tabla'    => 'paquete_a_medida',
          'nombre_id_tabla' => 'idpaquete_a_medida',
          'modulo'          => 'PEDIDOS',
          'id_tabla'        => $value31['idpaquete_a_medida'],
          'nombre_archivo'  => 'Viaje a Medida',
          'descripcion'     => "Cliente: ".$value31['p_nombre']."\n"."Viaje: ".$value31['ocacion_viaje']."\n"."Motivo: ".$value31['p_descripcion'],
          'created_at'      => $value31['created_at'],
          'updated_at'      => $value31['updated_at'],
        );
      }
    }




    return $data;
  }
  /*----------------------------------------------------------------
  ----------F I N  M O D U L O   P E R S O N A S--------------------
  ----------------------------------------------------------------*/
   //sql para mostrar los datos de producto



  //Desactivar 
  public function recuperar($nombre_tabla, $nombre_id_tabla, $id_tabla)
  {
    $sql = "UPDATE $nombre_tabla SET estado='1',user_updated= '$this->id_usr_sesion' WHERE $nombre_id_tabla ='$id_tabla'";

		$recuperar= ejecutarConsulta($sql);

		if ($recuperar['status'] == false) {  return $recuperar; }
		
		//add registro en nuestra bitacora
    $sql_d ="Archivo recuperado desde papelera";
		$sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (1,'$nombre_tabla','$id_tabla','$sql_d','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }   
		
		return $recuperar;
  }

  //eliminar
  public function eliminar_permanente($nombre_tabla, $nombre_id_tabla, $id_tabla)
  {
    $sql = "UPDATE $nombre_tabla SET estado_delete='0',user_delete= '$this->id_usr_sesion' WHERE $nombre_id_tabla ='$id_tabla'";
		$eliminar =  ejecutarConsulta($sql);
		if ( $eliminar['status'] == false) {return $eliminar; }  
		
		//add registro en nuestra bitacora
    $sql_d ="Archivo eliminado desde papelera";
		$sql = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (4,'$nombre_tabla','$id_tabla','$sql_d', '$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		return $eliminar;
  }
}

?>
