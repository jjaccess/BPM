<?php 
	require_once "../clases/Bodegas.php";
	require_once "../../../funcs/Conexion.php";
	$id=$_POST['idcategoria'];

	$obj= new jerarquias();
	echo $obj->eliminaBodega($id);

 ?>