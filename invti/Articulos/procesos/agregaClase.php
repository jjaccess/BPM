<?php 

session_start();

	require_once "../clases/clase.php";
	require_once "../../../funcs/Conexion.php";

	$categoria=$_POST['categoria'];
	$id_tipoart=$_POST['id_tipoart'];

	$datos=array(
		$categoria,
		$id_tipoart
				);

	$obj= new categorias();

	echo $obj->agregaCategoria($datos);


 ?>