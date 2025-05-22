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
   $sql ="SELECT id, clase FROM invti_clasearticulos WHERE id_art = '" . $_POST["id"] . "' order by clase";
   
   	$consulta_clases = $mysqli->query($sql);
 
   //construimos lista nueva dependiente
   ?>
     <option value="">Selección:</option>
   <?php
   
   while($clase= $consulta_clases->fetch_object())
   {
	   ?>
		  <option value="<?php echo $clase->clase; ?>"><?php echo $clase->clase; ?></option>
	   <?php
   }
}
?>