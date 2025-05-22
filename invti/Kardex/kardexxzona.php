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
</head>
<body>
<input type="hidden" value="<?php ($rowuser['usuario']);?>" >
	<?php
										
		  	$sql2 = "SELECT cod,nombre, responsable FROM bodegas WHERE responsable = '$userensqlzona'
			 AND estado = '1'";

	$result2 = $mysqli->query($sql2);
	
	$rowbodega = $result2->fetch_assoc();
	$bodega = utf8_decode($rowbodega['cod']);
		  
        ?> 

<div class="container">
	<div class="row">
        <div class="col-sm-12">
<form class="form-inline formulariolinea" action="kardexxzona.php" method="GET" style="text-align: center;">

		<div class="form-group">
    		<input name="busqueda" id="busqueda" type="hidden" class="form-control" value="<?php echo utf8_decode($rowbodega['cod']);?>" readonly='readonly'>&nbsp;&nbsp;
			<h2 class="text-primary">
				<dt>
				<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-upc-scan" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  				<path fill-rule="evenodd" d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
 				<path d="M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z"/>
				</svg>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</dt>
				</h2>
			<button type="submit" value="Buscar" class="btn btn-primary">Consultar mi bodega</button>
		
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<div class="form-group">
			<a href="kardexxzona_1.php" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-list-alt" ></span> <span>Disponible x cantidad</span></a>
		</div>	
					<script src="../../js/datatables/dataTables.buttons.min.js"></script>
			<script src="../../js/datatables/jszip.min.js"></script>
			<script src="../../js/datatables/pdfmake.min.js"></script>
			<script src="../../js/datatables/vfs_fonts.js"></script>
			<script src="../../js/datatables/buttons.html5.min.js"></script>
	</div>

  </form><br>
 <?php  
    $busqueda = $_GET['busqueda'];
 ?>
	<!-- Motrar tabla-->
	<div class="row">
	<div class="col-sm-12">
		<div class="table-responsive-sm">
		<div class="row table-responsive">
			<table class='table table-striped table-bordered table-light' id='mitabla'>
		<thead class="thead-dark">
	<tr style="text-align: center;">
					
						<th>Fecha Registro</th>
						<th>Clasificacion</th>
						<th>Tipo</th>
						<th>Clase</th>
						<th>Articulo</th>
						<th>Marca</th>
						<th>Activo Fijo</th>
						<th>Serial</th>
						<th>IMEI</th>	
						<th>SIMCARD</th>	
						<th>Estado</th>	
						<th>Ubicacion</th>
				    	<th>Sitio</th>
				    	<th>Observacion</th>
					</tr>
				</thead>

				<tbody>

					<!--Consulta SQL -->
					<?php
								$query = mysqli_query($mysqli,"
								SELECT invti_bodegas.fecharegistro fecharegistro,
								empresas.empresa empresa,
					clasificaciones.clasificacion clasificacion,
					invti_tipoart.tipo tipo,
					invti_bodegas.clase clase,
					invti_articulos.articulo articulo,
					invti_marca.marca marca,
					invti_bodegas.activo activo,
					invti_bodegas.serial serial,
					invti_bodegas.IMEI imei,
					invti_bodegas.SIMCARD simcard,
					invti_bodegas.estado estado,
					'1- Bodega' ubc,
					bodegas.NOMBRE ubicacion,
					invti_bodegas.OBSERVACION observacion
					FROM invti_bodegas, bodegas, empresas, invti_tipoart, invti_articulos, invti_marca, clasificaciones
					WHERE invti_bodegas.BODEGA = '" . $busqueda . "'
					AND invti_bodegas.asigna = 'N' 
					AND bodegas.estado = '1'
					AND bodegas.COD = invti_bodegas.BODEGA
					AND invti_tipoart.id = invti_bodegas.TIPO
					AND invti_articulos.id = invti_bodegas.ARTICULO
					AND invti_marca.id = invti_bodegas.MARCA
					and bodegas.estado = 1
					AND invti_bodegas.clasificacion = clasificaciones.id
											   
									");

								mysqli_close($mysqli);

								$result = mysqli_num_rows($query);
								if($result > 0){

									while ($data = mysqli_fetch_array($query)) {
					?>
	<!-- Bucle while que recorre cada registro y muestra cada campo en la tabla.-->
	<tr style="text-align: center;">
     
				<td><?php echo $data['fecharegistro']?></td>
				<td><?php echo $data['clasificacion']?></td>
			 	<td><?php echo $data['tipo']?></td>
			 	<td><?php echo $data['clase']?></td>
			 	<td><?php echo $data['articulo']?></td>
			 	<td><?php echo $data['marca']?></td>
			 	<td><?php echo $data['activo']?></td>
			 	<td><?php echo $data['serial']?></td>
			 	<td><?php echo $data['imei']?></td>
			 	<td><?php echo $data['simcard']?></td>
			 	<td><?php echo $data['estado']?></td>
			 	<td><?php echo $data['ubc']?></td>	 
			 	<td><?php echo $data	['ubicacion']?></td>
			 	<td><?php echo $data['observacion']?></td>
			</tr>
		
				 		<?php } ?>
					<?php } ?>

				</tbody>
			</table> <!-- Fin de la tabla-->
		</div><!--Fin div row-->
	<!-- cerrar conexión de base de datos -->

</div><!-- Fin Div container-->

<!--Script propiedades del dataTable-->
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