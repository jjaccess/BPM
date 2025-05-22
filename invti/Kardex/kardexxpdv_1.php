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

<div class="container">
<?php
				$consulta_bodega   = $mysqli->query("select cod as 'valor', nombre as 'descripcion' from bodegas where estado = '1' order by nombre");
				$consulta_clasificacion   = $mysqli->query("select id as 'valor', clasificacion as 'descripcion' from clasificaciones order by clasificacion");
				$consulta_tipos   = $mysqli->query("select id as 'valor', tipo as 'descripcion' from invti_tipoart order by tipo");
				$consulta_articulos = $mysqli->query("select id as 'valor', articulo as 'descripcion' from invti_articulos order by articulo");
				$consulta_marcas = $mysqli->query("select id as 'valor', marca as 'descripcion' from invti_marca order by marca");
			?>
 <form class="form-inline" action="kardexxpdv_1.php" method="get" style="text-align: center;">
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
									GROUP BY nombre
									;");
												
	          				while ($responsable = mysqli_fetch_array($queryR)) {
													
	            				echo '<option value="'.$responsable['cod'].'">'.$responsable['nombre'].'</option>';
													
	          				}
	        			?>
				</select>&nbsp;&nbsp;
			<select class="form-control" name="clasificacion" onChange="obtenerTipos(this.value);">
        		<option value="<?php if(isset($clasificacion)) echo $clasificacion; ?>" required class="redondeadonorelieve">Seleccione Clasificacion:</option>
						<?php
						
							while($row= $consulta_clasificacion->fetch_object())
							{
								echo "<option value='".$row->valor."'>".$row->descripcion."</option>";
							}
						?>
			</select></label>&nbsp;&nbsp;
		<div class="form-group">
		<button type="submit" value="Buscar" class="btn btn-primary">Consultar</button>
			&nbsp;&nbsp;
			</div>
	</div>

	</form><br>
  <?php  
    $busqueda = $_GET['busqueda'];
    $clasificacion = $_GET['clasificacion'];
 ?>

	<!-- Motrar tabla-->
	<div class="row">
	<div class="col-sm-12">
		<div class="table-responsive-sm">
		<div class="row table-responsive">
			<table class='table table-striped table-bordered table-light' id='mitabla'>
		<thead class="thead-dark">
	<tr style="text-align: center;">
			<th>Sitio</th>
			<th>Clasificacion</th>
			<th>Tipo</th>
			<th>Clase</th>
			<th>Articulo</th>
			<th>Cantidad Disponible</th>	
			</tr>
			</thead>

			<tbody>
			<!--consulta tabla-->

<?php
		$query = mysqli_query($mysqli,"
		select
		'3- Puntos de Venta' ubc,
		clasificaciones.clasificacion clasificacion,
		invti_tipoart.tipo tipo,
		invti_puntosventa.clase clase,
		invti_articulos.articulo articulo,
		count(invti_articulos.articulo) disponible
		FROM invti_puntosventa, invti_articulos, clasificaciones, invti_marca, invti_tipoart
		WHERE invti_puntosventa.sucursal = '" . $busqueda . "'
		AND invti_puntosventa.clasificacion = '" . $clasificacion . "'
		AND invti_puntosventa.asigna = 'N' 
		AND invti_tipoart.id = invti_puntosventa.TIPO
		AND invti_articulos.id = invti_puntosventa.ARTICULO
		AND invti_marca.id = invti_puntosventa.MARCA
		AND invti_puntosventa.clasificacion = clasificaciones.id
		GROUP BY ubc, clasificacion, tipo,articulo, clase 
						");

					mysqli_close($mysqli);

					$result = mysqli_num_rows($query);
					if($result > 0){

						while ($data = mysqli_fetch_array($query)) {
?>
	
	<!-- Bucle while que recorre cada registro y muestra cada campo en la tabla.-->
	<tr style="text-align: center;">
		     <td><?php echo $data['ubc']?></td>
			 <td><?php echo $data['clasificacion']?></td>
			 <td><?php echo $data['tipo']?></td>
			 <td><?php echo $data['clase']?></td>
			 <td><?php echo $data['articulo']?></td>
			 <td><?php echo $data['disponible']?></td>
		</tr>
		
	 <?php } ?>
	<?php } ?>

			</tbody>
		</table> <!-- Fin de la tabla-->
	</div> <!--Fin div responsive-->
	<!-- cerrar conexión de base de datos  -->

<br />

</div><!--Fin div container-->

<div id="formulario" style="display:none;"></div>
<div id="resultado"></div>

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