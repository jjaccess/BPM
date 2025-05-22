<?php 
		
		session_start();
	
		require '../../../funcs/Conexion.php';
		$conexion = new Conectar();
		$mysqli = $conexion->conexion();
		
	
	

	$idempresa = $_SESSION['id_empresa'];
	
	$sqlempresa = "SELECT empresa FROM empresas WHERE identificador = '$idempresa'";
	$resultempresa = $mysqli->query($sqlempresa);
	$rowempresa = $resultempresa->fetch_assoc();	
	
	$idUsuario = $_SESSION['id_usuario'];
	
	$sql = "SELECT id, usuario, nombre FROM usuarios WHERE id = '$idUsuario'";
	$result = $mysqli->query($sql);
	$row = $result->fetch_assoc();

		
 ?>
		<div class="table-responsive">
			<table class="table table-hover table-bordered" id="tablaCategoriasDataTable">
				<thead class="table-dark">
					<tr style="text-align: center;">
						<td>Usuario</td>
						<td>Nombre</td>
						<td>Role</td>
						<td>Estado</td>
						<?php if($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==15) { ?>
						<td>Editar</td>
						<?php } ?>

						<?php if($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==14 || $_SESSION['tipo_usuario']==15) { ?>
						<td>Reset password</td>
						<?php } ?>

						<?php if($_SESSION['tipo_usuario']==1) { ?>
						<td>Eliminar</td>
						<?php } ?>
					</tr>	
				</thead>
				<tbody>

					<?php 

						$sql = "SELECT usuarios.id id,usuarios.usuario usuario,usuarios.nombre nombre,usuarios.correo correo,tipo_usuario.tipo tipo,status.status estado
						FROM usuarios, tipo_usuario, status
						WHERE usuario LIKE '%'
								   AND usuarios.id_tipo = tipo_usuario.id
								   AND usuarios.activacion = status.id
								   ORDER BY id  ";
						 $result=mysqli_query($mysqli, $sql);
               while ($mostrar=mysqli_fetch_array($result)){
				   $idCategoria = $mostrar['id'];
				   ?>
				   <tr style="text-align: center;">
						<td><?php echo $mostrar['usuario']; ?></td>
						<td><?php echo $mostrar['nombre']; ?></td>
						<td><?php echo $mostrar['tipo']; ?></td>
						<td><?php echo $mostrar['estado']; ?></td>
						<?php if($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==15) { ?>
				   <td>
					<span class="btn btn-warning btn-sm" 
					onclick="obtenerDatosUsuario('<?php echo $idCategoria ?>')"
					data-toggle="modal" data-target="#modalActualizarCategoria"> 
					<span class="fas fa-edit"></span>
					</span>
					</td>
					<?php } ?>
					<td>
					<span class="btn btn-success btn-sm"
					onclick="obtenerDatosUsuarioR('<?php echo $idCategoria ?>')"
					data-toggle="modal" data-target="#modalResetUsuario">							
					<span class="fas fa-cog"></span>
					</span>
					</td>
					<?php if($_SESSION['tipo_usuario']==1) { ?>
					<td>
					<span class="btn btn-danger btn-sm">							
					<span class="fas fa-trash-alt"
							onclick="eliminarUsuario('<?php echo $idCategoria ?>')"> 
					</span>
					</span>
					</td>
					<?php } ?>					
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