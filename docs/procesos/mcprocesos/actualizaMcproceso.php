<?php 
require_once "../../../funcs/Conexion.php";
	require_once "../../clases/Mcprocesos.php";
	$Mcprocesos = new Mcprocesos();


	$datos = array (

				"idMcproceso" => $_POST['idMcproceso'],
				"mcproceso" => $_POST['mcprocesoU']
					);

	echo $Mcprocesos->actualizarMcproceso($datos);

 ?>