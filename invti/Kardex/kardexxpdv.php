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
<form class="form-inline" action="kardexxpdv.php" method="GET" style="text-align: center;">

		<div class="form-group">
		<h2 class="text-primary">
				<dt>
				<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-upc-scan" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  				<path fill-rule="evenodd" d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
 				<path d="M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z"/>
				</svg>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</dt>
				</h2>
	    		<select name="busqueda" id="busqueda" class="form-control">
	        		<option value="" >Seleccione dependencia:</option>
			        	<?php
											
	          				$queryR = $mysqli -> query ("select puntosdeventa.COD cod, puntosdeventa.nombre nombre
									FROM puntosdeventa, ccostos
									WHERE ccostos.cod = puntosdeventa.CODCCOSTO
									AND ccostos.RESPONSABLE = '" . $userensqlzona . "'
									AND ccostos.estado ='1'
									AND puntosdeventa.estado = '1'
									GROUP BY nombre
									;");
												
	          				while ($responsable = mysqli_fetch_array($queryR)) {
													
	            				echo '<option value="'.$responsable['cod'].'">'.$responsable['nombre'].'</option>';
													
	          				}
	        			?>
				</select>&nbsp;&nbsp;
		    <div class="form-group">
			<button type="submit" value="Buscar" class="btn btn-primary">Consultar</button>
			&nbsp;&nbsp;
			</div>
			<div class="form-group">
			<a href="kardexxpdv_1.php" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-list-alt" ></span> <span>Disponible x cantidad</span></a>			
						</div>
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
					<th>Fecha Regitro</th>					
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
	<!--consulta filtra info por responsable-->

		<?php
					$query = mysqli_query($mysqli,"
					SELECT invti_puntosventa.FECHAREGISTRO fechareg,
					empresas.empresa empresa,
			clasificaciones.clasificacion clasificacion,
			invti_tipoart.tipo tipo,
			invti_puntosventa.clase clase,
			invti_articulos.articulo articulo,
			invti_marca.marca marca,
			invti_puntosventa.activo activo,
			invti_puntosventa.serial serial,
			invti_puntosventa.IMEI imei,
			invti_puntosventa.SIMCARD simcard,
			invti_puntosventa.estado estado,
			'3- Puntos de Venta' ubc,
			puntosdeventa.NOMBRE ubicacion,
			invti_puntosventa.OBSERVACION observacion
			FROM invti_puntosventa, puntosdeventa, empresas, invti_tipoart, invti_articulos, invti_marca, clasificaciones
			WHERE invti_puntosventa.sucursal = '" . $busqueda . "'
			AND invti_puntosventa.asigna = 'N' 
			AND puntosdeventa.cod = invti_puntosventa.sucursal
			AND empresas.nit = invti_puntosventa.nit
			AND invti_tipoart.id = invti_puntosventa.TIPO
			AND invti_articulos.id = invti_puntosventa.ARTICULO
			AND invti_marca.id = invti_puntosventa.MARCA
			AND invti_puntosventa.clasificacion = clasificaciones.id
									    
							");

			mysqli_close($mysqli);

			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
		?>
			<!-- Bucle while que recorre cada registro y muestra cada campo en la tabla.-->
			<tr style="text-align: center;">
					 <td><?php echo $data['fechareg']?></td>
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
					 <td><?php echo $data['ubicacion']?></td>
					 <td><?php echo $data['observacion']?></td>
				
				</tr>
				
			 <?php } ?>
			<?php } ?>

		</tbody>
	</table> <!-- Fin de la tabla-->
	</div><!--fin div row-->
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
