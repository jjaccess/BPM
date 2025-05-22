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
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Control activos</title>
<?php require_once "../menu.php"; ?>
	<?php require_once "../librerias.php"; ?>
</head>

<body>
<div class="container">
	<div class="row">
        <div class="col-sm-12">
	
		<br>
<h2 class="text-primary">
				<dt>
				<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-upc-scan" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  				<path fill-rule="evenodd" d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
 				<path d="M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z"/>
				</svg>
				Buscar activo fijo
				</dt>
				</h2>
<div class="container">
<div class="col-md-8 offset-md-5 mt-4">
<form class="form-inline formulariolinea" action="buscar_art.php" method="get" style="text-align: center;" autocomplete="off">
    	<div class="form-group">
    		<input name="busqueda" id="busqueda" type="text" class="form-control" placeholder='Ingrese Activo fijo'>
    	<div class="form-group">
			<button class="btn btn-default" type="submit" value="Buscar"><span class="glyphicon glyphicon-search"></span></button>
		</div>
		</div>
  </form>
  </div>
  </div> 

 <?php  

    $busqueda = $_GET['busqueda'];

	  //comenzamos la consulta 
		  $consulta ="SELECT empresas.empresa empresa,clasificaciones.clasificacion clasificacion,invti_tipoart.tipo tipo,invti_bodegas.clase clase,invti_articulos.articulo articulo,
	invti_marca.marca marca,invti_bodegas.activo activo, invti_bodegas.serial serial,invti_bodegas.estado estado,'1- Bodega' ubc,bodegas.NOMBRE ubicacion, invti_bodegas.OBSERVACION observacion
	FROM invti_bodegas, bodegas, empresas, invti_tipoart, invti_articulos, invti_marca, clasificaciones
	WHERE invti_bodegas.activo = '" . $busqueda . "'
	AND invti_bodegas.asigna = 'N' 
	AND bodegas.COD = invti_bodegas.BODEGA
	AND empresas.nit = invti_bodegas.nit
	AND invti_tipoart.id = invti_bodegas.TIPO
	AND invti_articulos.id = invti_bodegas.ARTICULO
	AND invti_marca.id = invti_bodegas.MARCA
	AND invti_bodegas.clasificacion = clasificaciones.id
	AND bodegas.estado = 1
	UNION
	SELECT empresas.empresa empresa,clasificaciones.clasificacion clasificacion,invti_tipoart.tipo tipo,invti_responsables.clase clase,invti_articulos.articulo articulo,
	invti_marca.marca marca,invti_responsables.activo activo, invti_responsables.serial serial,invti_responsables.estado estado,'2- Responsable' ubc,ccostos.nombre ubicacion, invti_responsables.OBSERVACION observacion
	FROM invti_responsables, empresas, invti_tipoart, invti_articulos, invti_marca,usuarios, clasificaciones,ccostos
	WHERE invti_responsables.activo = '" . $busqueda . "'
	AND invti_responsables.asigna = 'N' 
	AND invti_responsables.responsable = ccostos.responsable
	AND empresas.nit = invti_responsables.nit
	AND invti_tipoart.id = invti_responsables.TIPO
	AND invti_articulos.id = invti_responsables.ARTICULO
	AND invti_marca.id = invti_responsables.MARCA
	AND invti_responsables.clasificacion = clasificaciones.id
	AND ccostos.estado = 1
	UNION
	SELECT empresas.empresa empresa,clasificaciones.clasificacion clasificacion,invti_tipoart.tipo tipo,invti_puntosventa.clase clase,invti_articulos.articulo articulo,
	invti_marca.marca marca,invti_puntosventa.activo activo, invti_puntosventa.serial serial,invti_puntosventa.estado estado,'3- Punto de Venta' ubc,puntosdeventa.nombre ubicacion, invti_puntosventa.OBSERVACION observacion
	FROM invti_puntosventa, empresas, invti_tipoart, invti_articulos, invti_marca,puntosdeventa, clasificaciones
	WHERE invti_puntosventa.activo = '" . $busqueda . "'
	AND invti_puntosventa.asigna = 'N' 
	AND invti_puntosventa.sucursal = puntosdeventa.cod
	AND empresas.nit = invti_puntosventa.nit
	AND invti_tipoart.id = invti_puntosventa.TIPO
	AND invti_articulos.id = invti_puntosventa.ARTICULO
	AND invti_marca.id = invti_puntosventa.MARCA
	AND invti_puntosventa.clasificacion = clasificaciones.id
	"
	  ;
		
  		$resultado=mysqli_query($mysqli,$consulta);
?>

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
					<th>Estado</th>	
					<th>Ubicacion</th>
				    <th>Sitio</th>
				    <th>Observacion</th>
				</tr>

			</thead>
		
		<tbody>
			<?php
			// Bucle while que recorre cada registro y muestra cada campo en la tabla.
			while ($rowtb = mysqli_fetch_array($resultado))
			{
			?>
			<tr style="text-align: center;">
					<td><?php echo $rowtb['clasificacion'] ?></td>
					<td><?php echo $rowtb['tipo'] ?></td>
					<td><?php echo $rowtb['clase'] ?></td>
					<td><?php echo $rowtb['articulo'] ?></td>
					<td><?php echo $rowtb['marca'] ?></td>
					<td><?php echo $rowtb['activo'] ?></td>
					<td><?php echo $rowtb['serial'] ?></td>
					<td><?php echo $rowtb['estado'] ?></td>
					<td><?php echo $rowtb['ubc'] ?></td>	 
					<td><?php echo $rowtb['ubicacion'] ?></td>
					<td><?php echo $rowtb['observacion'] ?></td>
				</tr>
				
			<?php } ?>
		
		</tbody>
		</table> <!-- Fin de la tabla-->

	</div><!-- fin div table-responsive-->
	<!-- cerrar conexión de base de datos-->
	<?php mysqli_close( $mysqli );  ?>

</div><!--fin div container general-->

<script>
		
		$(document).ready(function(){

			$('#mitabla').dataTable({

				"language":{

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