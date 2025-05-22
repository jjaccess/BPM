<?php 
		
		require_once "../../../funcs/Conexion.php";
		

		$c = new Conectar();
		$conexion = $c->conexion();
		$sql = "SELECT 
		archivos.id_archivo as idArchivo,
		archivos.id_categoria AS idCategoria,
		mcprocesos.nombre mcproceso,
		procesos.nombre proceso,
		subprocesos.nombre AS subproceso,
		categorias.nombre as categoria,
		archivos.nombre as nombreArchivo,
		archivos.tipo as tipoArchivo,
		archivos.ruta as rutaArchivo,
		archivos.fecha as fecha
		FROM dc_archivos AS archivos
		INNER JOIN
		dc_categorias AS categorias
		ON archivos.id_categoria = categorias.id_categoria
		INNER JOIN
		dc_subprocesos AS subprocesos
		ON categorias.id_subproceso = subprocesos.id_subproceso
		INNER JOIN
		dc_procesos AS procesos
		ON subprocesos.id_proceso = procesos.id_proceso
		INNER JOIN
		dc_mcprocesos AS mcprocesos
		ON procesos.id_mcproceso = mcprocesos.id_mcproceso";

		$result = mysqli_query($conexion, $sql);
		
 ?>
<img src="" width="50%">

<div class="row">
	<div class="col-sm-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-dark" id="tablaGestorDataTable">
				<thead>
					<tr style="text-align: center;">
						<th>Macro Proceso</th>
						<th>Proceso</th>
						<th>Subproceso</th>
						<th>Categoría</th>
						<th>Nombre</th>
						<th>Extensión Archivo</th>
						<th>Descargar</th>
						<th>Visualizar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>
				<?php 

					/*
						Arreglo de extensiones validas
					*/
					$extensionesValidas = array('png','jpg','pdf','mp3','mp4','jpeg');

					while($mostrar = mysqli_fetch_array($result)) {
						$rutaDescarga = "../archivos/".$mostrar['idCategoria']."/".$mostrar['nombreArchivo'];
						$nombreArchivo = $mostrar['nombreArchivo'];
						$idArchivo = $mostrar['idArchivo'];

				 ?>
					<tr style="text-align: center;">
					<td><?php echo $mostrar['mcproceso']; ?></td>
					<td><?php echo $mostrar['proceso']; ?></td>										
					<td><?php echo $mostrar['subproceso']; ?></td>
					<td><?php echo $mostrar['categoria']; ?></td>
					<td><?php echo $mostrar['nombreArchivo']; ?></td>
					<td><?php echo $mostrar['tipoArchivo']; ?></td>
					<td>
						<a href="<?php echo $rutaDescarga; ?>" 
								download="<?php echo $nombreArchivo; ?>" class="btn btn-success btn-sm">
								<span class="fas fa-download"></span>
						</a>
					</td>
					<td>
						<?php 
							for ($i=0; $i < count($extensionesValidas); $i++){
								if($extensionesValidas[$i] == $mostrar['tipoArchivo']){
						?>
						<span class="btn btn-primary btn-sm" 
								data-toggle="modal" 
								data-target="#visualizarArchivo"
								onclick="obtenerArchivoPorId('<?php echo $idArchivo ?>')">
						<span class="fas fa-eye"></span>
						</span>
						<?php
								}
							}
						?>
					</td>
					<td>
						<span class="btn btn-danger btn-sm" 
							onclick="eliminarArchivo('<?php echo $idArchivo ?>')">
							<span class="fas fa-trash-alt"></span>
						</span>	
					</td>
					</tr>
				<?php 
					}
				 ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#tablaGestorDataTable').DataTable();
	});
</script>