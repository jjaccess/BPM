<?php 
	
  require_once "../../../funcs/Conexion.php";
  
  $conexion = new Conectar();
  $conexion = $conexion->conexion();

  $sql = "SELECT 
  procesos.id_proceso id_proceso,
  mcp.nombre mcproceso,
  procesos.nombre nombre
  FROM dc_procesos AS procesos
  INNER JOIN
  dc_mcprocesos AS mcp ON mcp.id_mcproceso = procesos.id_mcproceso
  ORDER BY mcproceso";
  $result = mysqli_query($conexion, $sql);

?>

<select name="procesosArchivos" id="procesosArchivos" class="form-control">

	<?php 					
    	while ($mostrar=mysqli_fetch_array($result)){
		$idProceso = $mostrar['id_proceso'];          
		$mcproceso = $mostrar['mcproceso'];
		$proceso = $mostrar['nombre'];                      
	?>
		<option value="<?php echo $idProceso ?>"><?php echo '' . $mcproceso . ' - '. $proceso . '' ?></option>
	<?php 
	}
	 ?>
 
</select>	
 
	