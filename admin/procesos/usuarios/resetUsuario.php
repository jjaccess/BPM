<?php 
require_once "../../../funcs/Conexion.php";
require_once "../../clases/Usuarios.php";	
$Usuarios = new Usuarios();

$password = 123456;
$hash = password_hash($password, PASSWORD_DEFAULT);

$datos = array (
	"idR" => $_POST['idR'],
	"iduser" => $_POST['iduser'],
	"password" => $hash
			);

	echo $Usuarios->resetUsuario($datos);
 ?>