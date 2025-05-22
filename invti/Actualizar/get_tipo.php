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
   $sql ="SELECT id, tipo FROM invti_tipoart WHERE id_clasificacion = '" . $_POST["id"] . "' order by tipo";
   
   	$consulta_tipos = $mysqli->query($sql);
 
   //construimos lista nueva dependiente
   ?>
     <option value="">Selección:</option>
   <?php
   
   while($tipo= $consulta_tipos->fetch_object())
   {
	   ?>
		  <option value="<?php echo $tipo->id; ?>"><?php echo $tipo->tipo; ?></option>
	   <?php
   }
}
?>