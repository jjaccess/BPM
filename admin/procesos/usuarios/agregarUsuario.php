<?php 
require_once "../../../funcs/Conexion.php";
require_once "../../clases/Usuarios.php";

$Usuarios = new Usuarios();

$password = 123456;
$hash = password_hash($password, PASSWORD_DEFAULT);
$activacion = 1;
$password_request = 1;

	$datos = array (
			"iduser" => $_POST['iduser'],
			"usuario" => $_POST['usuario'],
			"password" => $hash,
			"activacion" => $activacion,
			"password_request" => $password_request,
			"nombre" => $_POST['nombre'],
			"correo" => $_POST['correo'],
			"rol" => $_POST['rolesUsuarios']
					);


echo $Usuarios->agregarUsuario($datos);

?>

