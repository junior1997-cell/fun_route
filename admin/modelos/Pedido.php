<?php
  //Incluímos inicialmente la conexión a la base de datos
  require "../config/Conexion_v2.php";
  // global $total;
  class Pedido
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
    public function vendido($idpedido){
      $sql="UPDATE pedido_paquete SET estado_vendido='1', user_updated= '$this->id_usr_sesion' WHERE idpedido='$idpedido'";
      $eliminar =  ejecutarConsulta($sql); if ( $eliminar['status'] == false) {return $eliminar; }  

      //add registro en nuestra bitacora
      $sql_d = $idpedido;
      $sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (4,'pedido','$idpedido','$sql_d','$this->id_usr_sesion')";
		  $bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
		
		  return $eliminar;
    }
    //mostrar en un arrary los datos para pasar al html
    public function mostrar($idpaquete,$idpedido)
    {
      $data = [];

      $sql_1="SELECT p.idpaquete, p.nombre, p.cant_dias, p.cant_noches, p.descripcion, p.imagen FROM paquete as p WHERE p.idpaquete='$idpaquete';";
      $datospaquete = ejecutarConsultaSimpleFila($sql_1); if ($datospaquete['status'] == false) { return  $datospaquete;}
      
      //$sql_2="UPDATE pedido_paquete SET estado_visto='1' WHERE idpedido='$idpedido';";
      //$visto = ejecutarConsulta($sql_2); if ($visto['status'] == false) { return  $visto;}

      $sql_3="SELECT i.iditinerario, i.mapa, i.incluye, i.no_incluye,i.recomendaciones FROM itinerario as i WHERE i.idpaquete='$idpaquete';";
      $datositinerario = ejecutarConsultaSimpleFila($sql_3); if ($datositinerario['status'] == false) { return  $datositinerario;}

      $sql_4="SELECT gp.idgaleria_paquete, gp.imagen,gp.descripcion FROM galeria_paquete as gp WHERE gp.idpaquete='$idpaquete';";
      $datosgaleria = ejecutarConsultaArray($sql_4); if ($datosgaleria['status'] == false) { return  $datosgaleria;}

      foreach ($datosgaleria['data'] as $key => $value) {
        
        $data[] = array(
          'orden'               => $key+1,
          'idgaleria_paquete'   => $value['idgaleria_paquete'],  
          'imagen'              => $value['imagen'], 
          'descripcion'         => $value['descripcion'], 
           
        );
      }
        $paquete = [
          'idpaquete'         => $datospaquete['data']['idpaquete'],
          'nombre'            => $datospaquete['data']['nombre'],
          'cant_dias'         => $datospaquete['data']['cant_dias'],
          'cant_noches'       => $datospaquete['data']['cant_noches'],
          'descripcion'       => $datospaquete['data']['descripcion'],
          'imagen'            => $datospaquete['data']['imagen'],
          'iditinerario'      => $datositinerario['data']['iditinerario'],
          'mapa'              => $datositinerario['data']['mapa'],
          'incluye'           => $datositinerario['data']['incluye'],
          'no_incluye'        => $datositinerario['data']['no_incluye'],
          'recomendaciones'   => $datositinerario['data']['recomendaciones'],
        ];
      
      return $retorno=['status'=>true, 'message'=>'todo oka ps', 'data'=>$data,'paquete'=>$paquete];
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
