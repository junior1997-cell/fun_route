<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";
require "../config/Conexion_admin.php";

Class Proveedores
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}
	//Implementamos un método para insertar registros
	public function insertar($id_proveedor_adm,$descripcion,$imagen_perfil)
	{
    //var_dump($id_pryecto_adm,$descripcion,$imagen_perfil);die();
		//Realizamos la consulta a la bd admin sevens
		$sql_1="SELECT idproveedor,razon_social,tipo_documento,ruc FROM proveedor WHERE idproveedor='$id_proveedor_adm';";
		$proveedor_adm= ejecutarConsultaSimpleFila_admin($sql_1);

    if ($proveedor_adm['status']) {

			if (!empty($proveedor_adm['data']['idproveedor'])) { 

				$sql_2="INSERT INTO proveedor(id_proveedor_admin, razon_social, tipo_documento, num_documento, descripcion, img_perfil) 
				VALUES ( '".$proveedor_adm['data']['idproveedor']."', '".$proveedor_adm['data']['razon_social']."', '".$proveedor_adm['data']['tipo_documento']."', 
				        '".$proveedor_adm['data']['ruc']."', '$descripcion', '$imagen_perfil') ";

        return	ejecutarConsulta($sql_2);
			}
  
	  }else{

      return	$proveedor_adm;

    }
	//	return $sw;		
	}

	//Implementamos un método para editar registros
	public function editar($idproveedor,$id_proveedor_adm_edith,$descripcion,$imagen_perfil)
	{

        $sql_2="UPDATE proveedor SET id_proveedor_admin ='$id_proveedor_adm_edith', descripcion ='$descripcion', img_perfil ='$imagen_perfil'
              
              WHERE idproveedor='$idproveedor'";

        return	ejecutarConsulta($sql_2);

	}

    //Implementamos un método para desactivar categorías
	public function eliminar($idproveedor)
	{
		$sql="DELETE FROM proveedor WHERE idproveedor ='$idproveedor';";
		return ejecutarConsulta($sql);
	}
	

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idproveedor )
	{
		$sql="SELECT * FROM proveedor WHERE idproveedor ='$idproveedor'";

		return ejecutarConsultaSimpleFila($sql);
	}


	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT*FROM proveedor ORDER BY idproveedor DESC";
		return ejecutarConsulta($sql);		
	}

  //Seleccionar un comprobante
	public function reg_img($idproveedor)
	{
		$sql="SELECT img_perfil FROM proveedor WHERE idproveedor='$idproveedor'";
		return ejecutarConsultaSimpleFila($sql);		
	}

	//Select2 proveedor
	public function select2_proveedor()
	{
      $data_select = Array(); 
		//bd-admin
		$sql_1="SELECT idproveedor, razon_social, ruc  FROM proveedor  WHERE idproveedor!=1 AND estado!=2 AND estado_delete=1;";
		$proveedor_admin= ejecutarConsultaArray_admin($sql_1);

		if ($proveedor_admin['status']) {

			foreach ($proveedor_admin['data'] as $key => $value) {

				$id=$value['idproveedor'];

        //bd-front
        $sql_2 = "SELECT idproveedor, id_proveedor_admin FROM proveedor WHERE id_proveedor_admin='$id'";
        $proveedor_front= ejecutarConsultaSimpleFila($sql_2);
        //$conexion->close();
        if ($proveedor_front['status']) {

            if (empty($proveedor_front['data']['id_proveedor_admin'])) {

              $data_select[] = array(
              "idproveedor"   => $value['idproveedor'],
              "razon_social"  => $value['razon_social'],
              "ruc"           => $value['ruc'],
              );

            }

        }

			}

		}
      return $data_select;
	}

	
	//Implementar un método para listar los registros en la web
	public function listar_proveedores_web()
	{
		$sql="SELECT*FROM proveedor ORDER BY idproveedor DESC";
		return ejecutarConsultaArray($sql);		
	}

	
}

?>