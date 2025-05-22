<?php 
require_once "../../../funcs/Conexion.php";
	require_once "../../clases/Mcprocesos.php";	
	$Mcprocesos = new Mcprocesos();

	echo json_encode($Mcprocesos->obtenerMcproceso($_POST['idMcproceso']));


 ?> 