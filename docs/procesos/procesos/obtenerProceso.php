<?php 
require_once "../../../funcs/Conexion.php";
	require_once "../../clases/Procesos.php";	
	$Procesos = new Procesos();

	echo json_encode($Procesos->obtenerProceso($_POST['idProceso']));

 ?> 