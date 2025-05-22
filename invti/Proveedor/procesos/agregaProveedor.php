<?php 

session_start();

	require_once "../clases/Proveedores.php";
	require_once "../../../funcs/Conexion.php";

	$nit=$_POST['nit'];
	$proveedor=$_POST['proveedor'];

	$datos=array(
		$nit,
		$proveedor
				);

	$obj= new proveedores();

	echo $obj->agregaProveedor($datos);


 ?>