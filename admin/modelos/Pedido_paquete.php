<?php
  //Incluímos inicialmente la conexión a la base de datos
  require "../config/Conexion_v2.php";
  // global $total;
  class Pedido_paquete
  {

    //Implementamos nuestro variable global
    public $id_usr_sesion;

    //Implementamos nuestro constructor
    public function __construct($id_usr_sesion = 0)
    {
      $this->id_usr_sesion = $id_usr_sesion;
    }
       //Implementamos un método para activar registros
    public function eliminar($idpedido) {
      $sql="UPDATE pedido_paquete SET estado_delete='0',user_delete= '$this->id_usr_sesion' WHERE idpedido='$idpedido'";
      $eliminar =  ejecutarConsulta($sql); if ( $eliminar['status'] == false) {return $eliminar; }  

      //add registro en nuestra bitacora
      $sql_d = $idpedido;
      $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (4,'pedido_paquete','$idpedido','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $eliminar;
    }
    public function vendido($idpedido_paquete){
      $sql="UPDATE pedido_paquete SET estado_vendido='1', user_updated= '$this->id_usr_sesion' WHERE idpedido_paquete='$idpedido_paquete'";
      $eliminar =  ejecutarConsulta($sql); if ( $eliminar['status'] == false) {return $eliminar; }  

      //add registro en nuestra bitacora
      $sql_d = $idpedido_paquete;
      $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (4,'pedido_paquete','$idpedido_paquete','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $eliminar;
    }
    //mostrar en un arrary los datos para pasar al html
    public function mostrar($idpaquete,$idpedido_paquete)
    {
      $data = [];

      $sql_1="SELECT p.idpaquete, p.nombre, p.cant_dias, p.cant_noches, p.descripcion, p.imagen,p.incluye,p.no_incluye,
      p.recomendaciones,p.mapa,p.costo,p.estado_descuento,p.porcentaje_descuento,monto_descuento 
      FROM paquete as p WHERE p.idpaquete='$idpaquete';";
      $datospaquete = ejecutarConsultaSimpleFila($sql_1); if ($datospaquete['status'] == false) { return  $datospaquete;}
      
      $sql_2="UPDATE pedido_paquete SET estado_visto='1' WHERE idpedido_paquete='$idpedido_paquete';";
      $visto = ejecutarConsulta($sql_2); if ($visto['status'] == false) { return  $visto;}

      //$sql_4="UPDATE pedido_paquete SET estado_vendido='1' WHERE idpedido_paquete='$idpedido_paquete';";
      //$vendido = ejecutarConsulta($sql_4); if ($vendido['status'] == false) { return  $vendido;}


      $sql_3="SELECT i.iditinerario, i.idpaquete, i.idtours, i.actividad, i.numero_orden, t.nombre as tours 
      FROM itinerario as i, tours as t WHERE i.idtours=t.idtours and i.idpaquete='$idpaquete' order by i.numero_orden asc;";
      $datositinerario = ejecutarConsultaArray($sql_3); if ($datositinerario['status'] == false) { return  $datositinerario;}

      foreach ($datositinerario['data'] as $key => $value) {
        
        $data[] = array(
          'orden'               => $key+1,
          'iditinerario'        => $value['iditinerario'],  
          'idpaquete'           => $value['idpaquete'], 
          'idtours'             => $value['idtours'], 
          'actividad'           => $value['actividad'], 
          'numero_orden'        => $value['numero_orden'], 
          'tours'               => $value['tours'], 
           
        );
      }
        $paquete = [
          'idpaquete'                     => $datospaquete['data']['idpaquete'],
          'nombre'                        => $datospaquete['data']['nombre'],
          'cant_dias'                     => $datospaquete['data']['cant_dias'],
          'cant_noches'                   => $datospaquete['data']['cant_noches'],
          'descripcion'                   => $datospaquete['data']['descripcion'],
          'imagen'                        => $datospaquete['data']['imagen'],
          'incluye'                       => $datospaquete['data']['incluye'],
          'no_incluye'                    => $datospaquete['data']['no_incluye'],
          'recomendaciones'               => $datospaquete['data']['recomendaciones'],
          'mapa'                          => $datospaquete['data']['mapa'],
          'costo'                         => $datospaquete['data']['costo'],
          'estado_descuento'              => $datospaquete['data']['estado_descuento'],
          'porcentaje_descuento'          => $datospaquete['data']['porcentaje_descuento'],
          'monto_descuento'               => $datospaquete['data']['monto_descuento'],
          
        ];
      
      return $retorno=['status'=>true, 'message'=>'todo oka ps', 'data'=>['itinerario'=>$data,'paquete'=>$paquete]];
    }

    //Implementamos un método para listar los registros
    public function tbla_principal()
    {
      $sql="SELECT pd.idpedido_paquete, pd.idpaquete, pd.nombre, pd.correo, pd.telefono, pd.descripcion as descripcionpedido,pd.estado_visto,pd.estado_vendido,  
      p.nombre as paquete, p.cant_dias,p.cant_noches, p.descripcion , p.imagen as imgpaquete 
      FROM pedido_paquete AS pd, paquete AS p
      WHERE pd.idpaquete=p.idpaquete AND pd.estado=1 AND p.estado=1 AND pd.estado_delete=1 AND p.estado_delete=1;";
      return ejecutarConsultaArray($sql);		
    }
    
  
  }

?>
