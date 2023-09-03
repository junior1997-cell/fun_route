<?php
  //Incluímos inicialmente la conexión a la base de datos
  require "../config/Conexion_v2.php";
  // global $total;
  class Inicio {

    //Implementamos nuestro constructor
    public function __construct(){}   
    
    public function oferta_semanal(){
      $array_pt = [];
      $sql_1 = "SELECT nombre, imagen, cant_dias, cant_noches, costo, estado_descuento, porcentaje_descuento, monto_descuento
      FROM paquete WHERE estado_descuento = '1' AND estado = '1' AND estado_delete = '1';";
      $paquete = ejecutarConsultaArray($sql_1); if ( $paquete['status'] == false) {return $paquete; }

      $sql_2 = "SELECT  nombre,  imagen,  duracion,  costo, estado_descuento, porcentaje_descuento, monto_descuento 
      FROM tours WHERE estado_descuento = '1' AND estado = '1' AND estado_delete = '1';";
      $tours = ejecutarConsultaArray($sql_2); if ( $tours['status'] == false) {return $tours; }

      $color = [
        '0' =>['nombre' => 'aguaje', 'hexadecimal' => '#FFB866'],
        '1' =>['nombre' => 'plomo', 'hexadecimal' => '#252E33'],
        '2' =>['nombre' => 'azul', 'hexadecimal' => '#2A86BA'],
        '3' =>['nombre' => 'rojo', 'hexadecimal' => '#FD3555'],
        '4' =>['nombre' => 'verde', 'hexadecimal' => '#008e3b'],
        '5' =>['nombre' => 'morado', 'hexadecimal' => '#35047a'],
        '6' =>['nombre' => 'DarkRed', 'hexadecimal' => '#8B0000'],
        '7' =>['nombre' => 'Teal', 'hexadecimal' => '#008080'],
        '8' =>['nombre' => 'MidnightBlue', 'hexadecimal' => '#191970'],
        '9' =>['nombre' => 'CadetBlue', 'hexadecimal' => '#5F9EA0'],
        '10' =>['nombre' => 'SteelBlue', 'hexadecimal' => '#4682B4'],
        '11' =>['nombre' => 'Maroon', 'hexadecimal' => '#800000'],
        '12' =>['nombre' => 'SaddleBrown', 'hexadecimal' => '#8B4513'],
        '13' =>['nombre' => 'DarkSlateGray', 'hexadecimal' => '#2F4F4F'],
        '14' =>['nombre' => 'SlateGray', 'hexadecimal' => '#708090'],
      ];

      // ofertas de paquete
      foreach ($paquete['data'] as $key => $val) {
        $array_pt[] = [
          'tipo_pt'       => 'PAQUETE',
          'color'         => $color[random_int(0, 14)],
          'nombre'        => $val['nombre'],          
          'imagen'        => $val['imagen'],
          'duracion'      => $val['cant_dias'] . ' días y '. $val['cant_noches'] . ' noches',          
          'costo'         => empty($val['costo']) ? 0 : floatval($val['costo']),        
          'estado_descuento'    => $val['estado_descuento'],        
          'porcentaje_descuento'=> empty($val['porcentaje_descuento']) ? 0 : floatval($val['porcentaje_descuento']),       
          'monto_descuento'     => empty($val['monto_descuento']) ? 0 : floatval($val['monto_descuento']), 
        ];
      }

      // ofertas de tours
      foreach ($tours['data'] as $key => $val) {
        $array_pt[] = [
          'tipo_pt'       => 'TOURS',
          'color'         => $color[random_int(0, 14)],
          'nombre'        => $val['nombre'],          
          'imagen'        => $val['imagen'],
          'duracion'      => $val['duracion'],          
          'costo'         => empty($val['costo']) ? 0 : floatval($val['costo']),        
          'estado_descuento'    => $val['estado_descuento'],        
          'porcentaje_descuento'=> empty($val['porcentaje_descuento']) ? 0 : floatval($val['porcentaje_descuento']),       
          'monto_descuento'     => empty($val['monto_descuento']) ? 0 : floatval($val['monto_descuento']), 
        ];
      }

      return $retorno=[ 'status'=>true, 'message'=>'todo okey','data'=>$array_pt ];
      
    } 

    public function mostrar_tours_paquete(){
      $sql="SELECT nombre, descripcion, imagen, duracion, costo FROM tours WHERE estado='1' and estado_delete='1';";
      $tours = ejecutarConsultaArray($sql); if ( $tours['status'] == false) {return $tours; }

      $sql = "SELECT nombre, descripcion, cant_dias, cant_noches, imagen, costo FROM paquete WHERE estado=1 and estado_delete='1';";
      $paquete = ejecutarConsultaArray($sql);  if ( $paquete['status'] == false) {return $paquete; }

      return $retorno=[ 'status'=>true, 'message'=>'todo okey','data'=>[ 'tours'=> $tours['data'], 'paquete'=> $paquete['data'],] ];
    }

    public function mostrar_testimonio_ceo(){
      $sql = "SELECT * FROM experiencias WHERE estado = '1' AND estado_delete = '1';";
      $experiencia =  ejecutarConsultaArray($sql);  if ( $experiencia['status'] == false) {return $experiencia; }

      $sql = "SELECT palabras_ceo, perfil_ceo, nombre_ceo FROM nosotros WHERE estado = '1' AND estado_delete = '1';";
      $nosotros = ejecutarConsultaSimpleFila($sql); if ( $nosotros['status'] == false) {return $nosotros; }

      return $retorno=[ 'status'=>true, 'message'=>'todo okey','data'=> [ 'experiencia'=>$experiencia['data'], 'nosotros'=>$nosotros['data'] ] ];
    }    

  }

?>