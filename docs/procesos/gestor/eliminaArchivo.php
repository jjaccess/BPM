<?php 
require_once "../../../funcs/Conexion.php";
	require_once "../../clases/Gestor.php";
	$Gestor = new Gestor();
	$idArchivo = $_POST['idArchivo'];


	$nombreArchivo = $Gestor->obtenNombreArchivo($idArchivo);
	$idCategoria = $Gestor->obtenidCategoria($idArchivo);

	$rutaEliminar = "../../archivos/" . $idCategoria . "/" . $nombreArchivo;

	if (unlink($rutaEliminar)) {
		echo $Gestor->eliminarRegistroArchivo($idArchivo);

	} else {
		echo 0;
	}
 ?>