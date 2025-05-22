<?php 
	
	require_once "../../../funcs/Conexion.php";
  
  $conexion = new Conectar();
  $conexion = $conexion->conexion();

  $sql = "SELECT * FROM dc_mcprocesos ";
  $result = mysqli_query($conexion, $sql);

?>

<select name="mcprocesosArchivos" id="mcprocesosArchivos" class="form-control">

	<?php 					
    	while ($mostrar=mysqli_fetch_array($result)){
		$idMcproceso = $mostrar['id_mcproceso'];                         
	?>
		<option value="<?php echo $idMcproceso ?>"><?php echo $mostrar['nombre']; ?></option>
	<?php 
	}
	 ?>
 
</select>	
 
	