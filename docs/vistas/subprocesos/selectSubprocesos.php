<?php 
	
  require_once "../../../funcs/Conexion.php";
  
  $conexion = new Conectar();
  $conexion = $conexion->conexion();

  $sql = "SELECT 
  subprocesos.id_subproceso id_subproceso,
  procesos.nombre proceso,
  subprocesos.nombre nombre
  FROM dc_subprocesos AS subprocesos
  INNER JOIN
  dc_procesos AS procesos ON procesos.id_proceso = subprocesos.id_proceso
  ORDER BY proceso";
  $result = mysqli_query($conexion, $sql);

?>

<select name="procesosArchivos" id="procesosArchivos" class="form-control">

	<?php 					
    	while ($mostrar=mysqli_fetch_array($result)){
			$idProceso = $mostrar['id_subproceso'];          
			$proceso = $mostrar['proceso'];
			$subproceso = $mostrar['nombre'];                          
	?>
			<option value="<?php echo $idProceso ?>"><?php echo '' . $proceso . ' - '. $subproceso . '' ?></option>
	<?php 
	}
	 ?>
 
</select>	
 
	