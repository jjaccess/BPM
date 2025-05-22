<?php 
		
		require_once "../../../funcs/Conexion.php";
		$conexion = new Conectar();
		$conexion = $conexion->conexion();
		
 ?>
		<div class="table-responsive">
			<table class="table table-hover table-dark" id="tablaProcesosDataTable">
				<thead>
					<tr style="text-align: center;">
						<th>Macro Proceso</th>	
						<th>Nombre</th>					
						<th>Fecha</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>	
				</thead>
				<tbody>

					<?php 

						$sql = "SELECT 
						procesos.id_proceso id_proceso,
						procesos.nombre nombre,
						mcp.nombre macroproceso,
						procesos.fechaInsert fechaInsert
						FROM dc_procesos AS procesos 
						INNER JOIN dc_mcprocesos AS mcp
						ON mcp.id_mcproceso = procesos.id_mcproceso";
						 $result=mysqli_query($conexion, $sql);
               while ($mostrar=mysqli_fetch_array($result)){
				   $idProceso = $mostrar['id_proceso'];
				   ?>
				   <tr style="text-align: center;">
				   <td><?php echo $mostrar['macroproceso'] ?></td>
                   <td><?php echo $mostrar['nombre'] ?></td>
				   <td><?php echo $mostrar['fechaInsert']; ?></td>
				   <td>
					<span class="btn btn-warning btn-sm" 
					onclick="obtenerDatosProceso('<?php echo $idProceso ?>')"
					data-toggle="modal" data-target="#modalActualizarProceso"> 
					<span class="fas fa-edit"></span>
					</span>
					</td>
					<td>
					<span class="btn btn-danger btn-sm">							
					<span class="fas fa-trash-alt"
							onclick="eliminarProceso('<?php echo $idProceso ?>')"> 
					</span>
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
		$('#tablaProcesosDataTable').DataTable();
	});
</script>