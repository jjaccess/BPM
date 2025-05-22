<?php 
require_once "../../../funcs/Conexion.php";
require_once "../../clases/Usuarios.php";	
$Usuarios = new Usuarios();


$datos = array (
	"idCategoria" => $_POST['idCategoria'],
	"iduser" => $_POST['iduser'],
	"nombreU" => $_POST['nombreU'],
	"correoU" => $_POST['correoU'],
	"id_tipoU" => $_POST['id_tipoU'],
	"activacionU" => $_POST['activacionU']
			);

	echo $Usuarios->actualizarUsuario($datos);

 ?>