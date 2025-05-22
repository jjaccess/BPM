<?php 

require_once "../../../funcs/Conexion.php";
	require_once "../../clases/Subprocesos.php";
	
	$Procesos = new Procesos();

	$iduser = '1121881424';

	$datos = array (
			"iduser" => $iduser,
			"id_proceso" => $_POST['procesosArchivos'],
			"subproceso" => $_POST['nombreProceso']
					);

	echo $Procesos->agregarProceso($datos);

?>

