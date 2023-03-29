<?php 

require "../config/Conexion.php";

Class Escritorio{
	//Implementamos nuestro constructor
	public function __construct()
	{}

	public function grafico_barras($fecha_1,$fecha_2)	{
    
    $data_barras = Array(); $filtro_fecha = "";

		if ( !empty($fecha_1) && !empty($fecha_2) ) {
		  $filtro_fecha = "AND fecha BETWEEN '$fecha_1' AND '$fecha_2'";
		} else if (!empty($fecha_1)) {      
		  $filtro_fecha = "AND fecha = '$fecha_1'";
		}else if (!empty($fecha_2)) {        
		  $filtro_fecha = "AND fecha = '$fecha_2'";
		} 

    $name_page =  [ 
                "inicio"        => "Home",  
                "Servicios"     => "Servicios", 
                "Proveedores"   => "Proveedores",  
                "Obras"         => "Nuestras Obras",  
                "Contactos"     => "Contactos"
              ];

    foreach ($name_page as $key => $value) {

      $sql_1="SELECT SUM(cantidad) as total_cantidad FROM visitas_pag WHERE nombre_vista='$value' AND estado=1 AND estado_delete=1 $filtro_fecha";

      $can_visitas = ejecutarConsultaSimpleFila($sql_1);

      if ($can_visitas['status'] == false) { return $can_visitas; }

      array_push($data_barras, (empty($can_visitas['data']) ? 0 : (empty($can_visitas['data']['total_cantidad']) ? 0 : floatval($can_visitas['data']['total_cantidad']) ) ));       

    }
 
    return $retorno = ['status' => true, 'message' => 'todo oka bro', 'data' => $data_barras];
		
	}

  public function grafico_radar($fecha_1,$fecha_2)
  {
    $data_select = []; $filtro_fecha = "";

		if ( !empty($fecha_1) && !empty($fecha_2) ) {
		  $filtro_fecha = "AND fecha BETWEEN '$fecha_1' AND '$fecha_2'";
		} else if (!empty($fecha_1)) {      
		  $filtro_fecha = "AND fecha = '$fecha_1'";
		}else if (!empty($fecha_2)) {        
		  $filtro_fecha = "AND fecha = '$fecha_2'";
		} 

    $name_page =  [ 
      "inicio"        => "Home",  
      "Servicios"     => "Servicios", 
      "Proveedores"   => "Proveedores",  
      "Obras"         => "Nuestras Obras",  
      "Contactos"     => "Contactos"
    ];

    foreach ($name_page as $key => $value) {
      
      $dia_semana =  [ ];
      // AND fecha='2022-08-30'
      for ($i=1; $i <=7 ; $i++) { 

        $sql = "SELECT SUM(cantidad) as total_cantidad FROM visitas_pag WHERE nombre_vista='$value' AND DAYOFWEEK(fecha)='$i' AND estado=1 AND estado_delete=1 $filtro_fecha;";
        $total_visitas = ejecutarConsultaSimpleFila($sql);
        // return $total_visitas;
        // var_dump($total_visitas);die();
        if ($total_visitas['status'] == false) { return $total_visitas; }

        Array_push($dia_semana,empty($total_visitas['data']) ? 0 : (empty($total_visitas['data']['total_cantidad']) ? 0 : floatval($total_visitas['data']['total_cantidad']) ));
      }

      $data_select[quitar_espacio($value)]= $dia_semana;

      // array_push($data_select[$value],$data_bd);       

    }

    return $retorno = ['status' => true, 'message' => 'todo oka bro', 'data' => $data_select];

  }
}

?>