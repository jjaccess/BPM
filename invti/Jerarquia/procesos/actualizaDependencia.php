<?php 
	require_once "../../../funcs/Conexion.php";
	require_once "../clases/Dependencias.php";

	$id=$_POST['idcategoria'];
	$estado=$_POST['categoriaU'];
	$login=$_POST['loginU'];

	$datos=array(
		$id,
		$estado,
		$login
			);

	$obj= new jerarquias();
	
	echo $obj->actualizaDependencia($datos);

	

 ?>