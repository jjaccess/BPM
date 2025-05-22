<?php 
		
		require_once "../../../funcs/Conexion.php";
		$conexion = new Conectar();
		$conexion = $conexion->conexion();
		
 ?>
		<div class="table-responsive">
			<table class="table table-hover table-dark" id="tablaMcprocesosDataTable">
				<thead>
					<tr style="text-align: center;">
						<th>Nombre</th>					
						<th>Fecha</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>	
				</thead>
				<tbody>

					<?php 

						$sql = "SELECT * FROM dc_mcprocesos ";
						 $result=mysqli_query($conexion, $sql);
               while ($mostrar=mysqli_fetch_array($result)){
				   $idMcproceso = $mostrar['id_mcproceso'];
				   ?>
				   <tr style="text-align: center;">
                   <td><?php echo $mostrar['nombre'] ?></td>
				   <td><?php echo $mostrar['fechaInsert']; ?></td>
				   <td>
					<span class="btn btn-warning btn-sm" 
					onclick="obtenerDatosMcproceso('<?php echo $idMcproceso ?>')"
					data-toggle="modal" data-target="#modalActualizarMcproceso"> 
					<span class="fas fa-edit"></span>
					</span>
					</td>
					<td>
					<span class="btn btn-danger btn-sm">							
					<span class="fas fa-trash-alt"
							onclick="eliminarMcproceso('<?php echo $idMcproceso ?>')"> 
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
		$('#tablaMcprocesosDataTable').DataTable();
	});
</script>