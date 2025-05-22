<?php 
		
		require_once "../../../funcs/Conexion.php";
		$conexion = new Conectar();
		$conexion = $conexion->conexion();
		
 ?>
		<div class="table-responsive">
			<table class="table table-hover table-dark" id="tablaProcesosDataTable">
				<thead>
					<tr style="text-align: center;">
						<th>Proceso</th>
						<th>Nombre</th>					
						<th>Fecha</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>	
				</thead>
				<tbody>

					<?php 

						$sql = "SELECT 
						subp.id_subproceso id_subproceso,
						subp.nombre nombre,
						pr.nombre proceso,
						subp.fechaInsert fechaInsert
						FROM dc_subprocesos AS subp 
						INNER JOIN dc_procesos AS pr
						ON pr.id_proceso = subp.id_proceso";
						 $result=mysqli_query($conexion, $sql);
               while ($mostrar=mysqli_fetch_array($result)){
				   $idProceso = $mostrar['id_subproceso'];
				   ?>
				   <tr style="text-align: center;">
				   <td><?php echo $mostrar['proceso'] ?></td>
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