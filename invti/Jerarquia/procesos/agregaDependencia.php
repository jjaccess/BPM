<?php 

session_start();

	require_once "../clases/Dependencias.php";
	require_once "../../../funcs/Conexion.php";

	$cod=$_POST['cod'];
	$nombre=$_POST['nombre'];
	$padre=$_POST['codpadre'];
	$login=$_POST['login'];
	$estado= 0;

	$datos=array(
		$cod,
		$nombre,
		$padre,
		$login,
		$estado
				);

	$obj= new jerarquias();

	echo $obj->agregaDependencia($datos);

 ?>