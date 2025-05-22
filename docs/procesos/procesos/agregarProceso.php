<?php 

require_once "../../../funcs/Conexion.php";
	require_once "../../clases/Procesos.php";
	
	$Procesos = new Procesos();

	$iduser = '1121881424';

	$datos = array (
			"iduser" => $iduser,
			"id_mcproceso" => $_POST['mcprocesosArchivos'],
			"proceso" => $_POST['nombreProceso']
					);

	echo $Procesos->agregarProceso($datos);
?>

