<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion_v2.php";

class Escritorio
{

  //Implementamos nuestro variable global
  public $id_usr_sesion;

  //Implementamos nuestro constructor
  public function __construct($id_usr_sesion = 0)
  {
    $this->id_usr_sesion = $id_usr_sesion;
  }

  
  // optenemos el total de PROYECTOS, PROVEEDORES, TRABAJADORES, SERVICIO
  public function tablero()  {
    $sql = "SELECT COUNT(idtours) total_tours from tours where estado='1' and estado_delete='1';";
    $sql2 = "SELECT COUNT(idpaquete) total_paquete from paquete where estado='1' and estado_delete='1';;";
    $sql3 = "SELECT SUM(total) as total FROM venta_tours WHERE estado='1' AND estado_delete='1';";
    $sql4 = "SELECT SUM(total) as total FROM venta_paquete WHERE estado='1' AND estado_delete='1';";
    $sql5 = "SELECT nombre_vista, SUM(cantidad) as cantidad FROM visitas_pag GROUP BY nombre_vista HAVING SUM(cantidad) > 1 LIMIT 1;";

    $data1 = ejecutarConsultaSimpleFila($sql); if ($data1['status'] == false) { return $data1; }
    $data2 = ejecutarConsultaSimpleFila($sql2); if ($data2['status'] == false) { return $data2; }
    $data3 = ejecutarConsultaSimpleFila($sql3); if ($data3['status'] == false) { return $data3; }
    $data4 = ejecutarConsultaSimpleFila($sql4); if ($data4['status'] == false) { return $data4; }
    $data5 = ejecutarConsultaSimpleFila($sql5); if ($data5['status'] == false) { return $data5; }

    $total_tours = (empty($data3['data']) ? 0 : (empty($data3['data']['total']) ? 0 : floatval($data3['data']['total']) ) );
    $total_paquete = (empty($data4['data']) ? 0 : (empty($data4['data']['total']) ? 0 : floatval($data4['data']['total'])  ) );
    
    $results = [
      "status" => true,
      "data" => [
        "total_tours"  => (empty($data1['data']) ? 0 : (empty($data1['data']['total_tours']) ? 0 : floatval($data1['data']['total_tours']) ) ),
        "total_paquete" => (empty($data2['data']) ? 0 : (empty($data2['data']['total_paquete']) ? 0 : floatval($data2['data']['total_paquete']) ) ),
        "total_ventas"=> ($total_tours+$total_paquete),
        "visitas_pag"=> $data5['data'],
      ],
      "message"=> 'Todo oka'
    ];
    
    return $results;
  }

  //visitas a la pagina web
  function vistas_pagina_web(){
    $data_barra = Array(); $data_radar = Array();
    $total_barra = 0;

    $sql ="SELECT SUM(cantidad) AS total, nombre_vista FROM visitas_pag GROUP BY nombre_vista;";
    $char_donut = ejecutarConsultaArray($sql);	if ($char_donut['status'] == false) { return $char_donut; }

    for ($i=1; $i <= 12 ; $i++) { 
      $sql_1 = "SELECT nombre_vista, SUM(cantidad) as cantidad , nombre_month as mes_name_abreviado, nombre_month as mes_name, fecha 
      FROM visitas_pag  WHERE MONTH(fecha)='$i'  AND estado='1' AND estado_delete='1';";
      $mes = ejecutarConsultaSimpleFila($sql_1); if ($mes['status'] == false) { return $mes; }
      array_push($data_barra, (empty($mes['data']) ? 0 : (empty($mes['data']['cantidad']) ? 0 : floatval($mes['data']['cantidad']) ) )); 
      $total_barra += (empty($mes['data']) ? 0 : (empty($mes['data']['cantidad']) ? 0 : floatval($mes['data']['cantidad']) ) );
    }

    foreach ($char_donut['data'] as $key => $val) {
      $data_radar_x_vista = []; $vista_all = [];
      for ($i=0; $i <= 6 ; $i++) { 
        $sql_1 = "SELECT SUM(cantidad) as cantidad, nombre_day, nombre_month, nombre_year
        FROM visitas_pag  WHERE WEEKDAY(fecha)='$i'  AND estado='1' AND estado_delete='1' AND nombre_vista ='".$val['nombre_vista']."' GROUP BY  nombre_day;";
        $dia = ejecutarConsultaSimpleFila($sql_1); if ($dia['status'] == false) { return $dia; }
        array_push($data_radar_x_vista, (empty($dia['data']) ? 0 : (empty($dia['data']['cantidad']) ? 0 : floatval($dia['data']['cantidad']) ) ));         
        array_push($vista_all, $dia['data'] );         
      }
      $data_radar[] = [ 'nombre_vista'  =>$val['nombre_vista'], 'total'  =>$val['total'], 'dia'  => $data_radar_x_vista, 'vista_all'  => $vista_all  ];
    }
    

    $char_donut_vacio = [
      0 => ['nombre_vista'  => 'Detalle paquetes',  'total' =>  0], 
      1 => ['nombre_vista'  => 'Detalle Tours',  'total' =>  0], 
      2 => ['nombre_vista'  => 'Home',  'total' =>  0], 
      3 => ['nombre_vista'  => 'Nosotros', 'total' =>  0], 
      4 => ['nombre_vista'  => 'Paquete', 'total' =>  0], 
      5 => ['nombre_vista'  => 'Tours', 'total' =>  0], 
      6 => ['nombre_vista'  => 'Viaje a medida',  'total' =>  0], 
    ];
    $results = [
      "status" => true,
      "data" => [
        "chart_radar" =>   $data_radar ,
        "chart_barra" => ["total" => $total_barra, "mes" => $data_barra,  ] ,
        "char_donut"  => (empty($char_donut['data']) ? $char_donut_vacio : $char_donut['data'] ),
      ],
      "message"=> 'Todo oka'
    ];
    return $results;
  }

  public function chart_producto( ) {

    $data_venta = Array(); $data_pagos = Array();
    $data_compra = Array(); $data_pagos = Array(); $data_kilos_pergamino = Array(); $data_kilos_coco = Array();

    for ($i=1; $i <= 12 ; $i++) { 
      $sql_1 = "SELECT idpersona, SUM(total) as total_gasto, month_name  as mes_name_abreviado, month_name as mes_name, fecha_venta 
      FROM venta_tours  WHERE MONTH(fecha_venta)='$i'  AND estado='1' AND estado_delete='1' ;";
      $mes = ejecutarConsultaSimpleFila($sql_1); if ($mes['status'] == false) { return $mes; }
      array_push($data_venta, (empty($mes['data']) ? 0 : (empty($mes['data']['total_gasto']) ? 0 : floatval($mes['data']['total_gasto']) ) ));

      $sql_2 = "SELECT SUM(pg.monto) as total_deposito  
      FROM venta_tours_pago as pg, venta_tours as cpp 
      WHERE pg.idventa_tours = cpp.idventa_tours AND MONTH(pg.fecha_pago)='$i' AND cpp.estado='1' AND cpp.estado_delete='1' AND pg.estado='1' AND pg.estado_delete='1';";
      $mes = ejecutarConsultaSimpleFila($sql_2); if ($mes['status'] == false) { return $mes; }
      array_push($data_pagos, (empty($mes['data']) ? 0 : (empty($mes['data']['total_deposito']) ? 0 : floatval($mes['data']['total_deposito']) ) ));       

    }

    for ($i=1; $i <= 12 ; $i++) { 
      $sql_1 = "SELECT idpersona, SUM(total) as total_gasto , month_name as mes_name_abreviado, month_name as mes_name, fecha_venta 
      FROM venta_paquete  WHERE MONTH(fecha_venta)='$i' AND estado='1' AND estado_delete='1' ;";
      $mes = ejecutarConsultaSimpleFila($sql_1); if ($mes['status'] == false) { return $mes; }
      array_push($data_compra, (empty($mes['data']) ? 0 : (empty($mes['data']['total_gasto']) ? 0 : floatval($mes['data']['total_gasto']) ) ));
      
      $sql_1 = "SELECT  SUM(pcg.monto) as total_pago
      FROM venta_paquete_pago AS pcg, venta_paquete AS pg
      WHERE pcg.idventa_paquete = pg.idventa_paquete AND MONTH(pcg.fecha_pago)='$i' AND pg.estado='1' AND pg.estado_delete='1' AND pcg.estado='1' AND pcg.estado_delete='1';";
      $mes = ejecutarConsultaSimpleFila($sql_1); if ($mes['status'] == false) { return $mes; }
      array_push($data_pagos, (empty($mes['data']) ? 0 : (empty($mes['data']['total_pago']) ? 0 : floatval($mes['data']['total_pago']) ) ));

    }

    return $retorno = [
      'status'=> true, 'message' => 'Salió todo ok,', 
      'data' => [
        'tours_venta'=>$data_venta, 
        'tours_pagos'=>$data_pagos,

        'paquete_venta'=>$data_compra, 
        'paquete_pagos'=>$data_pagos,  
      ]
    ];   
  }
  
}

?>
