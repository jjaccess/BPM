<?php 
require_once "../../../funcs/Conexion.php";
	require_once "../../clases/Subprocesos.php";
	$Procesos = new Procesos();


	$datos = array (

				"idProceso" => $_POST['idProceso'],
				"proceso" => $_POST['procesoU']
					);

	echo $Procesos->actualizarProceso($datos);

 ?>