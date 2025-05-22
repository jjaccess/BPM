<?php
session_start();

if(!isset($_SESSION["id_usuario"])){
	header("Location: ../../index.php");
}
require '../../funcs/Conexion.php';
$conexion = new Conectar();
$mysqli = $conexion->conexion();
require '../../funcs/funcs.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>Control activos</title>
<?php require_once "../menu.php"; ?>
	<?php require_once "../librerias.php"; ?>
	<script src="../../js/datatables/dataTables.buttons.min.js"></script>
			<script src="../../js/datatables/jszip.min.js"></script>
			<script src="../../js/datatables/pdfmake.min.js"></script>
			<script src="../../js/datatables/vfs_fonts.js"></script>
			<script src="../../js/datatables/buttons.html5.min.js"></script>
</head>
<body>

<input type="hidden" value="<?php ($row['usuario']);?>" >

<div class="container">
	<div class="row">
        <div class="col-sm-12">
<form class="form-inline formulariolinea" action="reporte_usuarios.php" method="GET" style="text-align: center;">
<div class="form-group">
		<h2 class="text-primary">
				<dt>
				<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-upc-scan" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  				<path fill-rule="evenodd" d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
 				<path d="M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z"/>
				</svg>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</dt>
				</h2>
	</div>
</form><br>
	<!-- Motrar tabla-->
	<div class="row">
	<div class="col-sm-12">
		<div class="table-responsive-sm">
		<div class="row table-responsive">
			<table class='table table-striped table-bordered table-light' id='mitabla'>
		<thead class="thead-dark">
	<tr style="text-align: center;">
			 		<th>Usuario</th>				
					<th>Nombre</th>
					<th>Correo</th>
					<th>Ultima session</th>
					<th>Rol</th>
					<th>Estado</th>
				</tr>
			</thead>

		<tbody>
		<!--consulta filtra registros por responsable-->
			<?php
$set=mysqli_query($mysqli,"SET lc_time_names = 'es_ES'");
				$query = mysqli_query($mysqli,"
				SELECT 
usuario usuario,
nombre nombre,
correo correo,
last_session last_session,
tipo_usuario.tipo rol,
CASE activacion 
    WHEN 0 THEN 'Inactivo'
    WHEN 1 THEN 'Activo'
END AS estado
 FROM usuarios
 INNER JOIN tipo_usuario
 ON tipo_usuario.id = usuarios.id_tipo
				");

				mysqli_close($mysqli);?>

				<?php 
				$result = mysqli_num_rows($query);
				if($result > 0){

					while ($data = mysqli_fetch_array($query)) {
			?>
		
		<!-- Bucle while que recorre cada registro y muestra cada campo en la tabla.-->
		<tr style="text-align: center;">
				<td><?php echo $data['usuario']?></td>
				<td><?php echo $data['nombre']?></td>
				 <td><?php echo $data['correo']?></td>
				 <td><?php echo $data['last_session']?></td>
				 <td><?php echo $data['rol']?></td>
				 <td><?php echo $data['estado']?></td>
			</tr>
			
		 <?php } ?>
		<?php } ?>

		</tbody> 	
		</table> <!-- Fin de la tabla-->
	</div> <!-- Div tabla--><br><br>
	<!-- cerrar conexión de base de datos  -->
	</div> <!--Div container-->

<script>
		
		$(document).ready(function(){

			$('#mitabla').dataTable({
				dom: 'Bfrtip',
				buttons: [
				'copyHtml5',
				'excelHtml5',
				'csvHtml5',
			],

				language:{

					"lengthMenu": "Mostrar _MENU_ registros por página",
					"info": "Mostrando pagina _PAGE_ de _PAGES_",
						"infoEmpty": "No hay registros disponibles",
						"infoFiltered": "(filtrada de _MAX_ registros)",
						"loadingRecords": "Cargando...",
						"processing":     "Procesando...",
						"search": "Buscar:",
						"zeroRecords":    "No se encontraron registros que coincidan",
						"paginate": {
							"next":       "Siguiente",
							"previous":   "Anterior"
						}
				}

			});

		});

	</script>
<?php
require_once '../creditos.php';
?>
</body>
</html>