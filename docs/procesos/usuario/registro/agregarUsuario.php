<?php 
require_once "../../../funcs/Conexion.php";
	require_once "../../../clases/Usuario.php";
	$usuario = new Usuario();
	
	$password = sha1($_POST['password']);

	$datos = array (
				"usuario" => $_POST['usuario'], 
				"password" => $password,
				"nombre" => $_POST['nombre'], 
				"correo" => $_POST['correo']
	);
	
	echo $usuario->agregarUsuario($datos);
 ?>