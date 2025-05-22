<?php

require '../funcs/Conexion.php';
$conexion = new Conectar();
$mysqli = $conexion->conexion();
        require '../funcs/funcs.php';

	$id=$_GET['id'];
/*	$nombre=$_POST['NOMBRE_LOTERIA'];
	$nombre=$_POST['FECHA_SORTEO'];
	$nombre=$_POST['RESULTADO'];
	$nombre=$_POST['FECHAREGISTRO'];
	$nombre=$_POST['USUARIOREGISTRO'];
	$nombre=$_POST['DIA'];*/

			

		$query= "DELETE FROM resultv_resultados WHERE ID = '$id'";
		$resultado= $mysqli->query($query);
			
			

	if($resultado){
		header("Location: eliminar.php");
		}
		else{
			echo "No se eliminó";
		}
?>
