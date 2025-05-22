<?php 
require_once "../../../funcs/Conexion.php";
	require_once "../../clases/Usuarios.php";	
	$Usuarios = new Usuarios();

	echo json_encode($Usuarios->obtenerUsuario($_POST['idCategoria']));

 ?> 