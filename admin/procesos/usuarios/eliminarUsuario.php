<?php 

require_once "../../../funcs/Conexion.php";
	require_once "../../clases/Usuarios.php";	
	$Usuarios = new Usuarios();


		echo $Usuarios->eliminarUsuario($_POST['idCategoria']);

 ?> 