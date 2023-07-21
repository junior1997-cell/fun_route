<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion_v2.php";

Class Hotel
{
	//Implementamos nuestro variable global
  public $id_usr_sesion;

  //Implementamos nuestro constructor
  public function __construct($id_usr_sesion = 0)
  {
    $this->id_usr_sesion = $id_usr_sesion;
  }

	//Implementamos un método para insertar registros
	public function insertar($nombre_hotel, $nro_estrellas)
	{
		$sql="INSERT INTO hoteles (nombre, estrellas, user_created)VALUES ('$nombre_hotel', '$nro_estrellas','$this->id_usr_sesion')";
		$insertar =  ejecutarConsulta_retornarID($sql); 
		if ($insertar['status'] == false) {  return $insertar; } 
		
		//add registro en nuestra bitacora
		$sql_d = $nombre_hotel.', '.$nro_estrellas;
		$sql_bit = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (5, 'hoteles','".$insertar['data']."','$sql_d','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }    
		
		return $insertar;
	}

	//Implementamos un método para editar registros
	public function editar($idhoteles,$nombre_hotel,$nro_estrellas)
	{
		$sql="UPDATE hoteles SET nombre='$nombre_hotel', estrellas= '$nro_estrellas', user_updated= '$this->id_usr_sesion' WHERE idhoteles='$idhoteles'";
		$editar =  ejecutarConsulta($sql);
		if ( $editar['status'] == false) {return $editar; } 
	
		//add registro en nuestra bitacora
		$sql_d = $idhoteles.', '.$nombre_hotel.', '.$nro_estrellas;

		$sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (6,'hoteles','$idhoteles','$sql_d','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
				

		return $editar;
	}

	//Implementamos un método para desactivar 
	public function desactivar($idhoteles)
	{
		$sql="UPDATE hoteles SET estado='0',user_trash= '$this->id_usr_sesion' WHERE idhoteles='$idhoteles'";
		$desactivar= ejecutarConsulta($sql);

		if ($desactivar['status'] == false) {  return $desactivar; }
		
      $sql_d = $idhoteles;
      //add registro en nuestra bitacora
      $sql = "INSERT INTO bitacora_bd(idcodigo,nombre_tabla, id_tabla, sql_d, id_user) VALUES (2,'hoteles','.$idhoteles.','$sql_d','$this->id_usr_sesion')";
      $bitacora = ejecutarConsulta($sql); if ( $bitacora['status'] == false) {return $bitacora; }  

		return $desactivar;
	}

	//Implementamos un método para activar 
	public function activar($idhoteles)
	{
		$sql="UPDATE hoteles SET estado='1' WHERE idhoteles='$idhoteles'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar 
	public function eliminar($idhoteles)
	{
		$sql="UPDATE hoteles SET estado_delete='0',user_delete= '$this->id_usr_sesion' WHERE idhoteles='$idhoteles'";
		$eliminar =  ejecutarConsulta($sql);
		if ( $eliminar['status'] == false) {return $eliminar; }  
		
		//add registro en nuestra bitacora
		$sql_d = $idhoteles;
		$sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (4,'hoteles','$idhoteles','$sql_d','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  

		return $eliminar;
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idhoteles)
	{
		$sql="SELECT * FROM hoteles WHERE idhoteles='$idhoteles'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar_hotel()
	{
		$sql="SELECT * FROM hoteles WHERE estado=1 AND estado_delete=1 ORDER BY idhoteles ASC";
		return ejecutarConsulta($sql);		
	}

	//==========================HABITACIONES========================
	//==========================HABITACIONES========================
	//==========================HABITACIONES========================
	//Implementamos un método para insertar registros
	public function insertar_habitacion($idhoteles_G, $nombre_habitacion)
	{
		$sql="INSERT INTO habitacion(idhoteles, nombre) VALUES ('$idhoteles_G','$nombre_habitacion')";
		$insertar =  ejecutarConsulta_retornarID($sql); 
		if ($insertar['status'] == false) {  return $insertar; } 
		
		//add registro en nuestra bitacora
		$sql_d = $idhoteles_G.', '.$nombre_habitacion;
		$sql_bit = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (5, 'habitacion','".$insertar['data']."','$sql_d','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }    
		
		return $insertar;
	}

	//Implementamos un método para editar registros
	public function editar_habitacion($idhabitacion,$idhoteles_G, $nombre_habitacion)
	{
		$sql="UPDATE habitacion SET nombre='$nombre_habitacion', idhoteles= '$idhoteles_G', user_updated= '$this->id_usr_sesion' WHERE idhabitacion='$idhabitacion'";
		$editar =  ejecutarConsulta($sql);
		if ( $editar['status'] == false) {return $editar; } 
	
		//add registro en nuestra bitacora
		$sql_d = $idhabitacion.', '.$idhoteles_G.', '.$nombre_habitacion;

		$sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (6,'habitacion','$idhabitacion','$sql_d','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
				
		return $editar;
	}

	//Implementamos un método para desactivar 
	public function desactivar_habitacion($idhabitacion)
	{
		$sql="UPDATE habitacion SET estado='0',user_trash= '$this->id_usr_sesion' WHERE idhabitacion='$idhabitacion'";
		$desactivar= ejecutarConsulta($sql);

		if ($desactivar['status'] == false) {  return $desactivar; }
		
      $sql_d = $idhabitacion;
      //add registro en nuestra bitacora
      $sql = "INSERT INTO bitacora_bd(idcodigo,nombre_tabla, id_tabla, sql_d, id_user) VALUES (2,'habitacion','.$idhabitacion.','$sql_d','$this->id_usr_sesion')";
      $bitacora = ejecutarConsulta($sql); if ( $bitacora['status'] == false) {return $bitacora; }  

		return $desactivar;
	}

	//Implementamos un método para eliminar 
	public function eliminar_habitacion($idhabitacion)
	{
		$sql="UPDATE habitacion SET estado_delete='0',user_delete= '$this->id_usr_sesion' WHERE idhabitacion='$idhabitacion'";
		$eliminar =  ejecutarConsulta($sql);
		if ( $eliminar['status'] == false) {return $eliminar; }  
		
		//add registro en nuestra bitacora
		$sql_d = $idhabitacion;
		$sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (4,'habitacion','$idhabitacion','$sql_d','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  

		return $eliminar;
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar_habitacion($idhabitacion)
	{
		$sql="SELECT * FROM habitacion WHERE idhabitacion='$idhabitacion'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listar_habitacion($idhoteles){
		$sql ="SELECT * FROM habitacion WHERE idhoteles='$idhoteles' AND estado=1 and estado_delete=1 ORDER BY idhabitacion ASC;";
		return ejecutarConsulta($sql);	
	}
	//==========================FIN HABITACIONES========================

	//==========================CARACTERISTICAS========================
	//==========================CARACTERISTICAS========================
		//Implementamos un método para insertar registros
		public function insertar_caracteristicas_h($idhabitacion_G, $nombre_caracteristica_h, $estado_si_no)
		{
			$sql="INSERT INTO detalle_habitacion(idhabitacion, nombre, estado_si_no) VALUES ('$idhabitacion_G','$nombre_caracteristica_h','$estado_si_no')";
			$insertar =  ejecutarConsulta_retornarID($sql); 
			if ($insertar['status'] == false) {  return $insertar; } 
			
			//add registro en nuestra bitacora
			$sql_d = $idhabitacion_G.', '.$nombre_caracteristica_h.', '.$estado_si_no;
			$sql_bit = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (5, 'detalle_habitacion','".$insertar['data']."','$sql_d','$this->id_usr_sesion')";
			$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }    
			
			return $insertar;
		}
	
		//Implementamos un método para editar registros
		public function editar_caracteristicas_h($iddetalle_habitacion,$idhabitacion_G, $nombre_caracteristica_h, $estado_si_no)
		{
			$sql="UPDATE detalle_habitacion SET nombre='$nombre_caracteristica_h', idhabitacion= '$idhabitacion_G', estado_si_no= '$estado_si_no', user_updated= '$this->id_usr_sesion' WHERE iddetalle_habitacion='$iddetalle_habitacion'";
			$editar =  ejecutarConsulta($sql);
			if ( $editar['status'] == false) {return $editar; } 
		
			//add registro en nuestra bitacora
			$sql_d = $iddetalle_habitacion.', '.$idhabitacion_G.', '.$nombre_caracteristica_h.', '.$estado_si_no;
	
			$sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (6,'detalle_habitacion','$iddetalle_habitacion','$sql_d','$this->id_usr_sesion')";
			$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
					
			return $editar;
		}
	
		//Implementamos un método para desactivar 
		public function desactivar_caracteristicas_h($iddetalle_habitacion)
		{
			$sql="UPDATE detalle_habitacion SET estado='0',user_trash= '$this->id_usr_sesion' WHERE iddetalle_habitacion='$iddetalle_habitacion'";
			$desactivar= ejecutarConsulta($sql);
	
			if ($desactivar['status'] == false) {  return $desactivar; }
			
				$sql_d = $iddetalle_habitacion;
				//add registro en nuestra bitacora
				$sql = "INSERT INTO bitacora_bd(idcodigo,nombre_tabla, id_tabla, sql_d, id_user) VALUES (2,'detalle_habitacion','.$iddetalle_habitacion.','$sql_d','$this->id_usr_sesion')";
				$bitacora = ejecutarConsulta($sql); if ( $bitacora['status'] == false) {return $bitacora; }  
	
			return $desactivar;
		}
	
		//Implementamos un método para eliminar 
		public function eliminar_caracteristicas_h($iddetalle_habitacion)
		{
			$sql="UPDATE detalle_habitacion SET estado_delete='0',user_delete= '$this->id_usr_sesion' WHERE iddetalle_habitacion='$iddetalle_habitacion'";
			$eliminar =  ejecutarConsulta($sql);
			if ( $eliminar['status'] == false) {return $eliminar; }  
			
			//add registro en nuestra bitacora
			$sql_d = $iddetalle_habitacion;
			$sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (4,'detalle_habitacion','$iddetalle_habitacion','$sql_d','$this->id_usr_sesion')";
			$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
	
			return $eliminar;
		}
	
		//Implementar un método para mostrar los datos de un registro a modificar
		public function mostrar_caracteristicas_h($iddetalle_habitacion)
		{
			$sql="SELECT * FROM detalle_habitacion WHERE iddetalle_habitacion='$iddetalle_habitacion'";
			return ejecutarConsultaSimpleFila($sql);
		}
	
		public function listar_caracteristicas_h($idhabitacion){
			$sql ="SELECT * FROM detalle_habitacion WHERE idhabitacion='$idhabitacion' AND estado=1 and estado_delete=1 ORDER BY iddetalle_habitacion ASC;";
			return ejecutarConsulta($sql);	
		}
	//==========================FIN CARACTERISTICAS========================
	//==========================FIN CARACTERISTICAS========================

	//==========================CARACTERISTICAS HOTEL======================
	//Implementamos un método para insertar registros
	public function insertar_caract_hotel($idhoteles_GN, $nombre_c_hotel, $estado_si_no2)
	{
		$sql="INSERT INTO instalaciones_hotel (idhoteles, nombre, estado_si_no) VALUES ('$idhoteles_GN','$nombre_c_hotel','$estado_si_no2');";
		$insertar =  ejecutarConsulta_retornarID($sql); 
		if ($insertar['status'] == false) {  return $insertar; } 
		
		//add registro en nuestra bitacora
		$sql_d = $idhoteles_GN.', '.$nombre_c_hotel.','.$estado_si_no2;
		$sql_bit = "INSERT INTO bitacora_bd( idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (5, 'instalaciones_hotel','".$insertar['data']."','$sql_d','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }    
		
		return $insertar;
	}

	//Implementamos un método para editar registros
	public function editar_caract_hotel($idinstalaciones_hotel,$idhoteles_GN, $nombre_c_hotel, $estado_si_no2)
	{
		$sql="UPDATE instalaciones_hotel SET nombre='$nombre_c_hotel', idhoteles= '$idhoteles_GN', estado_si_no= '$estado_si_no2', user_updated= '$this->id_usr_sesion' WHERE idinstalaciones_hotel='$idinstalaciones_hotel'";
		$editar =  ejecutarConsulta($sql);
		if ( $editar['status'] == false) {return $editar; } 
	
		//add registro en nuestra bitacora
		$sql_d = $idinstalaciones_hotel.', '.$idhoteles_GN.', '.$nombre_c_hotel.', '.$estado_si_no2;

		$sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (6,'instalaciones_hotel','$idinstalaciones_hotel','$sql_d','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  
				
		return $editar;
	}

		//Implementamos un método para desactivar 
	public function desactivar_caract_hotel($idinstalaciones_hotel)
	{
		$sql="UPDATE instalaciones_hotel SET estado='0',user_trash= '$this->id_usr_sesion' WHERE idinstalaciones_hotel='$idinstalaciones_hotel'";
		$desactivar= ejecutarConsulta($sql);

		if ($desactivar['status'] == false) {  return $desactivar; }
		
      $sql_d = $idinstalaciones_hotel;
      //add registro en nuestra bitacora
      $sql = "INSERT INTO bitacora_bd(idcodigo,nombre_tabla, id_tabla, sql_d, id_user) VALUES (2,'instalaciones_hotel','.$idinstalaciones_hotel.','$sql_d','$this->id_usr_sesion')";
      $bitacora = ejecutarConsulta($sql); if ( $bitacora['status'] == false) {return $bitacora; }  

		return $desactivar;
	}

	//Implementamos un método para eliminar 
	public function eliminar_caract_hotel($idinstalaciones_hotel)
	{
		$sql="UPDATE instalaciones_hotel SET estado_delete='0',user_delete= '$this->id_usr_sesion' WHERE idinstalaciones_hotel='$idinstalaciones_hotel'";
		$eliminar =  ejecutarConsulta($sql);
		if ( $eliminar['status'] == false) {return $eliminar; }  
		
		//add registro en nuestra bitacora
		$sql_d = $idinstalaciones_hotel;
		$sql_bit = "INSERT INTO bitacora_bd(idcodigo, nombre_tabla, id_tabla, sql_d, id_user) VALUES (4,'instalaciones_hotel','$idinstalaciones_hotel','$sql_d','$this->id_usr_sesion')";
		$bitacora = ejecutarConsulta($sql_bit); if ( $bitacora['status'] == false) {return $bitacora; }  

		return $eliminar;
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar_caract_hotel($idinstalaciones_hotel)
	{
		$sql="SELECT * FROM instalaciones_hotel WHERE idinstalaciones_hotel='$idinstalaciones_hotel'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listar_caract_hotel($idhoteles){
		$sql ="SELECT * FROM instalaciones_hotel WHERE idhoteles='$idhoteles' AND estado=1 and estado_delete=1 ORDER BY idinstalaciones_hotel ASC;";
		return ejecutarConsulta($sql);	
	}


	//======================FIN CARACTERISTICAS HOTEL======================
	//======================FIN CARACTERISTICAS HOTEL======================
	//======================FIN CARACTERISTICAS HOTEL======================


	//======================== GALERIA DEL HOTEL ==========================
	//======================== GALERIA DEL HOTEL ==========================
	function insertar_galeria_hotel($idhotelesG,$descripcion_G,$imagen) {
			$sql="INSERT INTO galeria_hotel(idhoteles, imagen, descripcion) 
			VALUES ('$idhotelesG','$imagen','$descripcion_G')";
			return ejecutarConsulta($sql);
	}

	function listar_galeria_hotel($idhoteles){
		$sql = "SELECT * FROM galeria_hotel WHERE idhoteles='$idhoteles';";
		return ejecutarConsultaArray($sql);
		
	}

	function eliminar_imagen_hotel($idgaleria_hotel){
      
		$sql="SELECT imagen FROM galeria_hotel WHERE idgaleria_hotel = '$idgaleria_hotel'; ";
		$datos =ejecutarConsultaSimpleFila($sql); if ( $datos['status'] == false) {return $datos_; }
		if (!empty($datos)) { unlink("../dist/docs/galeria_hotel/" . $datos['data']['imagen']); }

		$sql1="DELETE FROM galeria_hotel WHERE idgaleria_hotel='$idgaleria_hotel';";
		return ejecutarConsulta($sql1);

	}
	//====================== FIN GALERIA DEL HOTEL ========================
	//====================== FIN GALERIA DEL HOTEL ========================
	//====================== FIN GALERIA DEL HOTEL ========================


	
}
