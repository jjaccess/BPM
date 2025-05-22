<?php 

require_once "../../../funcs/Conexion.php";
	require_once "../../clases/Categorias.php";
	
	$Categorias = new Categorias();

	$iduser = '1121881424';

	$datos = array (
			"iduser" => $iduser,
			"id_subproceso" => $_POST['procesosArchivos'],
			"categoria" => $_POST['nombreCategoria']
					);

	echo $Categorias->agregarCategoria($datos);

?>

