<?php 
	require_once "../clases/Dependencias.php";
	require_once "../../../funcs/Conexion.php";
	$id=$_POST['idcategoria'];

	$obj= new jerarquias();
	echo $obj->eliminaDependencia($id);

 ?>