<?php 
require_once "../../../funcs/Conexion.php";
	
	require_once "../../clases/Mcprocesos.php";
	
	$Mcprocesos = new Mcprocesos();

	$iduser = '1121881424';

	$datos = array (
			"iduser" => $iduser,
			"mcproceso" => $_POST['mcproceso'],
					);

	echo $Mcprocesos->agregarMcproceso($datos);
?>

