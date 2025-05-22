<?php
	
	
	$mysqli=new mysqli("localhost","admrsoc","7637ba32d1c3c5673b9fc5a35fb91182","BPMSSN"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
$mysqli->set_charset("utf8");
	
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
	
?>
