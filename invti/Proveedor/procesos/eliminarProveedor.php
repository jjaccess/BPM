<?php 
	require_once "../clases/Proveedores.php";
	require_once "../../../funcs/Conexion.php";
	$id=$_POST['idcategoria'];

	$obj= new proveedores();
	echo $obj->eliminaProveedor($id);

 ?>