<?php 
	require_once "../../../funcs/Conexion.php";
	require_once "../clases/Responsables.php";

	$id=$_POST['idcategoriaU2'];
	$estado=$_POST['categoriaU2'];
	$login=$_POST['loginU2'];

	$c= new conectar();
	$mysqli=$c->conexion();

	$datos=array(
		$id,
		$estado,
		$login
			);

	$obj= new jerarquias();
	
	echo $obj->actualizaBodega2($datos);

	

 ?>