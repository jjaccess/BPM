<?php 
	
  require_once "../../../funcs/Conexion.php";
  
  $conexion = new Conectar();
  $conexion = $conexion->conexion();

  $sql = "SELECT 
  categorias.id_categoria AS id_categoria,
  categorias.nombre AS nombre,
  subprocesos.nombre subproceso
  FROM dc_categorias AS categorias
  INNER JOIN
  dc_subprocesos AS subprocesos ON categorias.id_subproceso = subprocesos.id_subproceso
  ORDER BY subproceso";
  $result = mysqli_query($conexion, $sql);

?>

<select name="categoriasArchivos" id="categoriasArchivos" class="form-control">

	<?php 					
    	while ($mostrar=mysqli_fetch_array($result)){
		$idCategoria = $mostrar['id_categoria'];       
		$subproceso = $mostrar['subproceso'];
		$categoria = $mostrar['nombre'];                  
	?>
			<option value="<?php echo $idCategoria ?>"><?php echo '' . $subproceso . ' - '. $categoria . '' ?></option>
	<?php 
	}
	 ?>
 
</select>	
 
	