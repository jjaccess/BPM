<?php 
	require_once "../clases/clase.php";
	require_once "../../../funcs/Conexion.php";
	$id=$_POST['idcategoria'];

	$obj= new categorias();
	echo $obj->eliminaCategoria($id);

 ?>