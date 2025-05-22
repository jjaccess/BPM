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
   $sql ="SELECT id, marca FROM invti_marca WHERE id_articulo = '" . $_POST["id"] . "' order by marca";
   
   	$consulta_marcas = $mysqli->query($sql);
 
   //construimos lista nueva dependiente
   ?>
     <option value="">Selección:</option>
   <?php
   
   while($marca= $consulta_marcas->fetch_object())
   {
	   ?>
		  <option value="<?php echo $marca->id; ?>"><?php echo $marca->marca; ?></option>
	   <?php
   }
}
?>