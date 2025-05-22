<?php 

session_start();

	require_once "../clases/Responsables.php";
	require_once "../../../funcs/Conexion.php";

	$login=$_POST['login'];
	$cod=$_POST['cod'];
	$nombre=$_POST['nombre'];
	$codpadre=$_POST['codpadre'];
	$usuario=$_POST['usuario'];
	$estado= 0;

	$datos=array(
		$login,
		$cod,
		$nombre,
		$codpadre,
		$usuario,
		$estado
				);

	$obj= new jerarquias();

	echo $obj->agregaResponsable($datos);

 ?>