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
<form class="form-inline formulariolinea" action="kardexxpersona2_2.php" method="GET" style="text-align: center;">

    	<div class="form-group ">
		<h2 class="text-primary">
				<dt>
				<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-upc-scan" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  				<path fill-rule="evenodd" d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
 				<path d="M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z"/>
				</svg>
				Detallado factura código&nbsp;&nbsp;</dt>
				</h2>
    		<input name="busqueda" id="busqueda" type="text" class="form-control" value="" placeholder="Ingrese codigo">&nbsp;&nbsp;
	    <div class="form-group">
		<button type="submit" value="Buscar" class="btn btn-primary">Consultar</button>
		</div>				
	</div>
  </form><br>

 <?php  

    $busqueda = $_GET['busqueda'];
		
	
		//Paginador
			$query = mysqli_query($mysqli,"
			SELECT 
			clasificaciones.clasificacion clasificacion,
			invti_tipoart.tipo tipo,
			invti_responsables.clase clase,
			invti_articulos.articulo articulo,
			invti_marca.marca marca,
			invti_responsables.activo activo,
			invti_responsables.serial serial,
			invti_responsables.FACTURA factura,
			invti_responsables.FECHACOMPRA fechacompra,
			invti_responsables.valor valor,
			invti_responsables.PROVEEDOR nit,
			proveedores.proveedor proveedor,
			'2- Responsable' ubc,
			ccostos.NOMBRE ubicacion,
			invti_responsables.OBSERVACION observacion
			FROM invti_responsables, ccostos, empresas, invti_tipoart, invti_articulos, invti_marca, clasificaciones, proveedores
			WHERE invti_responsables.responsable = '" . $busqueda . "'
			AND invti_responsables.asigna = 'N' 
			AND ccostos.responsable = invti_responsables.responsable
			AND empresas.nit = invti_responsables.nit
			AND invti_tipoart.id = invti_responsables.TIPO
			AND invti_articulos.id = invti_responsables.ARTICULO
			AND invti_marca.id = invti_responsables.MARCA
			and ccostos.estado = 1
			AND invti_responsables.clasificacion = clasificaciones.id
			AND proveedores.nit = invti_responsables.PROVEEDOR
			UNION
			SELECT 
			clasificaciones.clasificacion clasificacion,
			invti_tipoart.tipo tipo,
			invti_puntosventa.clase clase,
			invti_articulos.articulo articulo,
			invti_marca.marca marca,
			invti_puntosventa.activo activo,
			invti_puntosventa.serial serial,
			invti_puntosventa.FACTURA factura,
			invti_puntosventa.FECHACOMPRA fechacompra,
			invti_puntosventa.valor valor,
			invti_puntosventa.PROVEEDOR nit,
			proveedores.proveedor proveedor,
			'3- Puntos de Venta' ubc,
			puntosdeventa.NOMBRE ubicacion,
			invti_puntosventa.OBSERVACION observacion
			FROM invti_puntosventa, puntosdeventa, empresas, invti_tipoart, invti_articulos, invti_marca, ccostos, clasificaciones, proveedores
			WHERE ccostos.RESPONSABLE = '" . $busqueda . "'
			AND invti_puntosventa.asigna = 'N' 
			AND puntosdeventa.cod = invti_puntosventa.sucursal
			AND ccostos.COD = puntosdeventa.CODCCOSTO
			AND empresas.nit = invti_puntosventa.nit
			AND invti_tipoart.id = invti_puntosventa.TIPO
			AND invti_articulos.id = invti_puntosventa.ARTICULO
			AND invti_marca.id = invti_puntosventa.MARCA
			AND invti_puntosventa.clasificacion = clasificaciones.id
			AND ccostos.estado = 1
			AND proveedores.nit = invti_puntosventa.PROVEEDOR
									   ORDER BY activo
							");

			mysqli_close($mysqli);

			$result = mysqli_num_rows($query);
			if($result > 0){
?>

	<!-- Motrar tabla-->
	<div class="row">
	<div class="col-sm-12">
		<div class="table-responsive-sm">
		<div class="row table-responsive">
			<table class='table table-striped table-bordered table-light' id='mitabla'>
		<thead class="thead-dark">
	<tr style="text-align: center;">
					<th>Clasificacion</th>
					<th>Tipo</th>
					<th>Clase</th>
					<th>Articulo</th>
					<th>Marca</th>
					<th>Activo Fijo</th>	
					<th>Serial</th>
					<th>Factura</th>
					<th>Fecha de compra</th>
					<th>Valor</th>
					<th>Nit</th>
					<th>Proveedor</th>
					<th>Ubicacion</th>
				    <th>Sitio</th>
				    <th>Observacion</th>
			</tr>
		</thead>

		<tbody>
					<?php
						while ($data = mysqli_fetch_array($query)) {
					?>
			
			<!-- Bucle while que recorre cada registro y muestra cada campo en la tabla.-->
			<tr style="text-align: center;">
					<td><?php echo $data['clasificacion'] ?></td>
					<td><?php echo $data['tipo'] ?></td>
					<td><?php echo $data['clase'] ?></td>
					<td><?php echo $data['articulo'] ?></td>
					<td><?php echo $data['marca'] ?></td>
					<td><?php echo $data['activo'] ?></td>
					<td><?php echo $data['serial'] ?></td>
					<td><?php echo $data['factura'] ?></td>
					<td><?php echo $data['fechacompra'] ?></td>
					<td><?php echo $data['valor'] ?></td>
					<td><?php echo $data['nit'] ?></td>
					<td><?php echo $data['proveedor'] ?></td>
					<td><?php echo $data['ubc'] ?></td>	 
					<td><?php echo $data['ubicacion'] ?></td>
					<td><?php echo $data['observacion'] ?></td>	
			</tr>
				
			 <?php }?>
			<?php }?>
		</tbody>
	
	</table> <!-- Fin de la tabla-->
	</div><!-- fin div responsive  --><br><br>

</div><!-- fin div container  -->

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