<?php
session_start();

if(!isset($_SESSION["id_usuario"])){
	header("Location: ../../index.php");
}
	
	require '../../funcs/Conexion.php';
  require '../../funcs/funcs.php';

  $conexion = new Conectar();
  $mysqli = $conexion->conexion();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>Control activos</title>
<?php require_once "../menu.php"; ?>
	<?php require_once "../librerias.php"; ?>
</head>
<body>

<input type="hidden" value="<?php ($rowuser['usuario']);?>" >
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
				Mis Traslados
				</dt>
				</h2>	

<?php  
   //comenzamos la consulta 
  	  $consulta ="select invti_bodegas.id id,
	  invti_articulos.articulo articulo,
	  invti_bodegas.ACTIVO activo,
	  '1-Bodega' ubicacion,
	  invti_bodegas.BODEGA codubcn,
	  bodegas.NOMBRE sitio,
	  estados.nombre proceso,
	invti_bodegas.FECHAREGISTRO fecharegistro,
	invti_bodegas.user login
	from invti_bodegas,bodegas, estados, invti_articulos
	WHERE invti_bodegas.USER = '" . $userensqlzona . "'
	and bodegas.COD = invti_bodegas.BODEGA
	and estados.tipo = invti_bodegas.asigna
	and invti_articulos.id= invti_bodegas.articulo
    AND invti_bodegas.asigna = 'T'
	AND bodegas.estado = '1'
	UNION
    select invti_responsables.id id,
	invti_articulos.articulo articulo,
	invti_responsables.ACTIVO activo,
	'2-Responsable' ubicacion,
	invti_responsables.RESPONSABLE codubcn,
	ccostos.nombre sitio,
	estados.nombre proceso,
	invti_responsables.FECHAREGISTRO fecharegistro,
	invti_responsables.user login
	from invti_responsables,usuarios, estados, invti_articulos, ccostos
	WHERE invti_responsables.USER = '" . $userensqlzona . "'
	and ccostos.responsable = invti_responsables.responsable
	and estados.tipo = invti_responsables.asigna
	and invti_articulos.id= invti_responsables.articulo
	and ccostos.estado = '1'
    AND invti_responsables.asigna = 'T'";


  $resultado=mysqli_query($mysqli,$consulta);
?>

	<form action='Gmistraslados.php' method='get'>

	<div class="row">
	<div class="col-sm-12">
		<div class="table-responsive-sm">
		<div class="row table-responsive">
			<table class='table table-striped table-bordered table-light' id='mitabla'>
		<thead class="thead-dark">
	<tr style="text-align: center;">
				<th>N° Registro</th>
				<th>Articulo</th>
				<th>Activo</th>
				<th>Tipo</th>
				<th>Cod Destino</th>
				<th>Destino</th>
				<th>Proceso</th>
				<th>Fecha Registro</th>
			    <th>login</th>
				<th>Rechazar</th>
				</tr>
			</thead>
			<tbody>
		<?php
		// Bucle while que recorre cada registro y muestra cada campo en la tabla.
		while ($rowtb = mysqli_fetch_array($resultado))
		{
		?>
		<tr style="text-align: center;">
		  <td><?php echo $rowtb['id'] ?></td>
		  <td><?php echo $rowtb['articulo'] ?></td>
		  <td><?php echo $rowtb['activo'] ?></td>
		  <td><?php echo $rowtb['ubicacion'] ?></td>
		  <td><?php echo $rowtb['codubcn'] ?></td>
		  <td><?php echo $rowtb['sitio'] ?></td>
		  <td><?php echo $rowtb['proceso'] ?></td>
		  <td><?php echo $rowtb['fecharegistro'] ?></td>
		  <td><?php echo $rowtb['login'] ?></td>
		  
		<?php
		 echo "<td><center><a href='Gmistraslados.php?id=".$rowtb['id']."&codubcn=".$rowtb['codubcn']."&activo=".$rowtb['activo']."&login=".$rowtb['login']."'>
		 <span class='fas fa-prescription-bottle' style='color: #ff4d4d' onclick='return confirmar()'></span></button></td>";
		?>
			</tr>
		<?php } ?>
		</tbody>
		</table> <!-- Fin de la tabla-->
	</div><!--fin div table responsive-->
	<!-- cerrar conexión de base de datos-->
	<?php mysqli_close( $mysqli );  ?>

</div><!--fin div container-->

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

<script type="text/javascript">
function confirmar()
{
	if(confirm('¿Estas seguro de cancelar el traslado?'))
		return true;
	else
		return false;
}
</script> 
<?php
require_once '../creditos.php';
?>
</body>
</html>