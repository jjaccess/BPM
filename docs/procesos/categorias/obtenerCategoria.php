<?php 
require_once "../../../funcs/Conexion.php";
	require_once "../../clases/Categorias.php";	
	$Categorias = new Categorias();

	echo json_encode($Categorias->obtenerCategorias($_POST['idCategoria']));

 ?> 