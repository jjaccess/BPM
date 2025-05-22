<?php 
	require_once "../../../funcs/Conexion.php";
	require_once "../clases/Categorias.php";

	

	$datos=array(
		$_POST['idcategoria'],
		$_POST['categoriaU']
			);

	$obj= new categorias();

	echo $obj->actualizaCategoria($datos);

 ?>