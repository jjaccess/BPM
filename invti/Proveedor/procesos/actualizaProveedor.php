<?php 
	require_once "../../../funcs/Conexion.php";
	require_once "../clases/Proveedores.php";

	

	$datos=array(
		$_POST['idU'],
		$_POST['proveedorU']
			);

	$obj= new proveedores();

	echo $obj->actualizaProveedor($datos);

 ?>