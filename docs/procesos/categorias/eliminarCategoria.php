<?php 

require_once "../../../funcs/Conexion.php";
		require_once "../../clases/Categorias.php";
		$Categorias = new Categorias();

		echo $Categorias->eliminarCategoria($_POST['idCategoria']);

 ?> 