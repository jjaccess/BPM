<?php 

session_start();

	require_once "../clases/Bodegas.php";
	require_once "../../../funcs/Conexion.php";

	$bodega=$_POST['bodega'];
	$usuario=$_POST['usuario'];
	$login=$_POST['login'];
	$estado= 0;

	$c= new conectar();
	$mysqli=$c->conexion();

	$querybod = "SELECT bodegas.NOMBRE NOMBRE
	FROM bodegas
	WHERE COD = '$bodega'
	GROUP BY NOMBRE
	";
	$resultbod = $mysqli->query($querybod);
	$rowbod = $resultbod->fetch_assoc();
	$nombre = $rowbod['NOMBRE'];

	$datos=array(
		$bodega,
		$nombre,
		$usuario,
		$estado,
		$login
				);

	$obj= new jerarquias();

	echo $obj->agregaBodega($datos);

 ?>