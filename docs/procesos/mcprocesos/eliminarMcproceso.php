<?php 

require_once "../../../funcs/Conexion.php";
		require_once "../../clases/Mcprocesos.php";
		$Mcprocesos = new Mcprocesos();

		echo $Mcprocesos->eliminarMcproceso($_POST['idMcproceso']);

 ?> 