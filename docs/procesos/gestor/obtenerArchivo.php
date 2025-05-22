<?php 
require_once "../../../funcs/Conexion.php";
	require_once "../../clases/Gestor.php";

	$Gestor = new Gestor();
	$idArchivo = $_POST['idArchivo'];
	
	echo $Gestor->obtenerRutaArchivo($idArchivo);

 ?>