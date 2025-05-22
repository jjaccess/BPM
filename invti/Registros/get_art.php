<?php

session_start();

if(!isset($_SESSION["id_usuario"])){
	header("Location: ../../index.php");
}

	
	require '../../funcs/funcs.php';
	require '../../funcs/Conexion.php';
	$conexion = new Conectar();
	$mysqli = $conexion->conexion();

	
	$sqlempresa = "SELECT empresa FROM empresas WHERE identificador = '$idempresa'";
	$resultempresa = $mysqli->query($sqlempresa);
	$rowempresa = $resultempresa->fetch_assoc();

//pasamos id del país
if(!empty($_POST["id"])) 
{
   $sql ="SELECT id, articulo FROM invti_articulos WHERE id_tipoart = '" . $_POST["id"] . "' order by articulo";
   
   	$consulta_articulos = $mysqli->query($sql);
 
   //construimos lista nueva dependiente
   ?>
     <option value="">Selección:</option>
   <?php
   
   while($articulo= $consulta_articulos->fetch_object())
   {
	   ?>
		  <option value="<?php echo $articulo->id; ?>"><?php echo $articulo->articulo; ?></option>
	   <?php
   }
}
?>