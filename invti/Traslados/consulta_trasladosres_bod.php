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
				Devoluciones pendientes por aceptar
				</dt>
				</h2>	


<?php  
   //comenzamos la consulta 
  $consulta ="SELECT invti_bodegas.id id,
				invti_bodegas.ACTIVO activo,
				invti_bodegas.ORIGEN origen,
				usuarios.nombre nomorigen,
				invti_bodegas.FECHAREGISTRO fecha,
				invti_bodegas.CONSECUTIVO_DEV,
				invti_bodegas.BODEGA destino,
				bodegas.NOMBRE nomdestino
			  FROM invti_bodegas, bodegas, usuarios
WHERE invti_bodegas.ASIGNA = 'T'
and bodegas.COD = invti_bodegas.BODEGA
and invti_bodegas.origen >= '10000'
AND bodegas.RESPONSABLE = '" . $userensqlzona	 . "'
AND bodegas.estado = '1'
AND usuarios.usuario = invti_bodegas.ORIGEN
" ;
  

  $resultado=mysqli_query($mysqli,$consulta);
  ?>

  <form action='detalle_trasladosres_bod.php' method='get' id='formulario' name='formulario' onsubmit='return valida(this)' >

  <div class="row">
	<div class="col-sm-12">
		<div class="table-responsive-sm">
		<div class="row table-responsive">
			<table class='table table-striped table-bordered table-light' id='mitabla'>
		<thead class="thead-dark">
	<tr style="text-align: center;">
	<th>N° de registro</th>	
	<th>Origen</th>
	<th>Destino</th>
	<th>Activo</th>
	<th>Fecha Registro</th>
	<th>Detalle</th>
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
	<td><?php echo $rowtb['nomorigen'] ?></td>
	<td><?php echo $rowtb['nomdestino'] ?></td>
	<td><?php echo $rowtb['activo'] ?></td>
	<td><?php echo $rowtb['fecha'] ?></td>
	<?php
	echo "<td><a href='detalle_trasladosres_bod.php?id=".$rowtb['id']."&origen=".$rowtb['origen']."&destino=".$rowtb['destino']."&activo=".$rowtb['activo']."'>
	<span class='fas fa-book'></span></button></td>"
	?>
	</tr>
	<?php } 
	mysqli_close( $mysqli ); 
	?>
	
	</tbody>
	</table> <!-- Fin de la tabla-->
	<!-- cerrar conexión de base de datos-->
 </div><!--fin div table-responsiva-->



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
function valida(f) {
  var ok = true;
  var msg = "Debes escribir en los campos:\n";

    if(f.elements["pers"].value == "")
  {
    msg += "- Seleccionar un Ccosto\n";
    ok = false;
}
  
  if(f.elements["activo"].value == "")
  {
    msg += "- Ingresar un codigo de activo fijo\n";
    ok = false;
}

  if(ok == false)
    alert(msg);
  return ok;
}
</script>
<script type="text/javascript">
function confirmar()
{
	if(confirm('¿Estas seguro de trasladar el articulo?'))
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