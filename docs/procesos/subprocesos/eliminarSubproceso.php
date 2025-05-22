<?php 

require_once "../../../funcs/Conexion.php";
		require_once "../../clases/Subprocesos.php";
		$Procesos = new Procesos();

		echo $Procesos->eliminarProceso($_POST['idProceso']);

 ?> 