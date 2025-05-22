<?php 
		
		require_once "../../../funcs/Conexion.php";
		$conexion = new Conectar();
		$conexion = $conexion->conexion();
		
 ?>
		<div class="table-responsive">
			<table class="table table-hover table-dark" id="tablaCategoriasDataTable">
				<thead>
					<tr style="text-align: center;">
						<th>Subproceso</th>	
						<th>Nombre</th>					
						<th>Fecha</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>	
				</thead>
				<tbody>

					<?php 

						$sql = "SELECT 
						categorias.id_categoria AS id_categoria,
						usuario.nombre AS nombreUsuario,
						categorias.id_subproceso AS id_proceso,
						subprocesos.nombre AS proceso,
						categorias.nombre AS nombre,
						categorias.fechaInsert AS fechaInsert
						FROM dc_categorias AS categorias
						INNER JOIN
						usuarios AS usuario
						ON categorias.id_user = usuario.usuario
						INNER JOIN
						dc_subprocesos AS subprocesos ON categorias.id_subproceso = subprocesos.id_subproceso ";
						 $result=mysqli_query($conexion, $sql);
               while ($mostrar=mysqli_fetch_array($result)){
				   $idCategoria = $mostrar['id_categoria'];
				   ?>
				   <tr style="text-align: center;">
				   <td><?php echo $mostrar['proceso'] ?></td>
                   <td><?php echo $mostrar['nombre'] ?></td>
				   <td><?php echo $mostrar['fechaInsert']; ?></td>
				   <td>
					<span class="btn btn-warning btn-sm" 
					onclick="obtenerDatosCategoria('<?php echo $idCategoria ?>')"
					data-toggle="modal" data-target="#modalActualizarCategoria"> 
					<span class="fas fa-edit"></span>
					</span>
					</td>
					<td>
					<span class="btn btn-danger btn-sm">							
					<span class="fas fa-trash-alt"
							onclick="eliminarCategoria('<?php echo $idCategoria ?>')"> 
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
		$('#tablaCategoriasDataTable').DataTable();
	});
</script>