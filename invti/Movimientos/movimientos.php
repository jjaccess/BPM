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
				Histórico Movimientos
				</dt>
				</h2>
<div class="container">
<div class="col-md-8 offset-md-5 mt-4">
<form class="form-inline formulariolinea" action="movimientos.php" method="get" autocomplete="off" style="text-align: center;">

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
		  $consulta ="select invti_bodegas.id id, invti_articulos.articulo articulo,invti_bodegas.ACTIVO activo,'1- Bodega' ubicacion,invti_bodegas.BODEGA codubcn, bodegas.NOMBRE sitio, estados.nombre proceso,
		invti_bodegas.FECHAREGISTRO fecharegistro, invti_bodegas.user login, invti_bodegas.observacion observacion
		from invti_bodegas,bodegas, estados, invti_articulos
		WHERE invti_bodegas.ACTIVO = '" . $busqueda . "'
		and bodegas.COD = invti_bodegas.BODEGA
		and estados.tipo = invti_bodegas.asigna
		and invti_articulos.id= invti_bodegas.articulo
		UNION
	    select invti_responsables.consecutivo id, invti_articulos.articulo articulo,invti_responsables.ACTIVO activo,'2- Responsable' ubicacion,ccostos.cod codubcn, ccostos.NOMBRE sitio, estados.nombre proceso,
		invti_responsables.FECHAREGISTRO fecharegistro, invti_responsables.user login, invti_responsables.observacion observacion
		from invti_responsables,ccostos, estados, invti_articulos
		WHERE invti_responsables.ACTIVO = '" . $busqueda . "'
		and ccostos.responsable = invti_responsables.responsable
		and estados.tipo = invti_responsables.asigna
		and invti_articulos.id= invti_responsables.articulo
		and ccostos.ESTADO = 1
		UNION
		select invti_puntosventa.consecutivo id,
	    invti_articulos.articulo articulo,
	    invti_puntosventa.ACTIVO activo,
	    '3- Punto de venta' ubicacion,
	    invti_puntosventa.SUCURSAL codubcn,
	    puntosdeventa.NOMBRE sitio,
	    estados.nombre proceso,
		invti_puntosventa.FECHAREGISTRO fecharegistro,
	    invti_puntosventa.user login,
	    invti_puntosventa.observacion observacion
		from invti_puntosventa,puntosdeventa, estados, invti_articulos
		WHERE invti_puntosventa.ACTIVO = '" . $busqueda . "'
		and puntosdeventa.COD = invti_puntosventa.SUCURSAL
		and estados.tipo = invti_puntosventa.asigna
		and invti_articulos.id= invti_puntosventa.articulo
		
		ORDER BY fecharegistro DESC"
	  ;
		
	  $resultado=mysqli_query($mysqli,$consulta);

?>

<div class="row">
	<div class="col-sm-12">
		<div class="table-responsive-sm">
		<div class="row table-responsive">
		<table class="table table-hover table-condensed table-bordered" id="mitabla" style="text-align: center;" cellspacing="0" width="100%">
		<thead class="thead-dark">
	<tr style="text-align: center;">
					<th>Fecha Registro</th>					
					<th>N° Registro</th>
					<th>Articulo</th>
					<th>Activo</th>
					<th>Tipo</th>
					<th>Cod Destino</th>
					<th>Destino</th>
					<th>Proceso</th>
				    <th>login</th>
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
					<td><?php echo $rowtb['fecharegistro'] ?></td>					
		    		<td><?php echo $rowtb['id'] ?></td>
					<td><?php echo $rowtb['articulo'] ?></td>
					<td><?php echo $rowtb['activo'] ?></td>
					<td><?php echo $rowtb['ubicacion'] ?></td>
					<td><?php echo $rowtb['codubcn'] ?></td>
					<td><?php echo $rowtb['sitio'] ?></td>
					<td><?php echo $rowtb['proceso'] ?></td>
					<td><?php echo $rowtb['login'] ?></td>
					<td><?php echo $rowtb['observacion'] ?></td>
				</tr>
				<?php } ?>
		
			</tbody>
		</table> <!-- Fin de la tabla-->
	</div><!--fin div table-responsive-->
	<!-- cerrar conexión de base de datos-->
	<?php mysqli_close( $mysqli );  ?>
</div><!--fin div container-->
</div>
				</div>
				</div>
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