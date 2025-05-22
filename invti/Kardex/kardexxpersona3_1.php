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
			<?php
				$consulta_bodega   = $mysqli->query("select cod as 'valor', nombre as 'descripcion' from bodegas where estado = '1' order by nombre");
				$consulta_clasificacion   = $mysqli->query("select id as 'valor', clasificacion as 'descripcion' from clasificaciones order by clasificacion");
				$consulta_tipos   = $mysqli->query("select id as 'valor', tipo as 'descripcion' from invti_tipoart order by tipo");
				$consulta_articulos = $mysqli->query("select id as 'valor', articulo as 'descripcion' from invti_articulos order by articulo");
				$consulta_marcas = $mysqli->query("select id as 'valor', marca as 'descripcion' from invti_marca order by marca");
			?>

<input type="hidden" value="<?php ($rowuser['usuario']);?>" >
<div class="container">
	<div class="row">
        <div class="col-sm-12">
 <form class="form-inline formulariolinea" action="kardexxpersona3_1.php" method="get" style="text-align: center;">
		
		<div class="form-group">
		<h2 class="text-primary">
		<dt>
				<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-upc-scan" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  				<path fill-rule="evenodd" d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
 				<path d="M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z"/>
				</svg>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</dt>
				</h2>
		 <select class="form-control" name="busqueda" id="busqueda">
        <option value="" class="redondeadonorelieve">Seleccione sub bodega:</option>
		        <?php
										
          $queryB = $mysqli -> query ("select ccostos.COD cod, ccostos.nombre nombre
										FROM bodegas, ccostos
										WHERE bodegas.cod = ccostos.CODBODEGA
										AND bodegas.RESPONSABLE = '" . $userensqlzona . "'
										AND bodegas.estado = '1'
										ORDER BY nombre;
								;");
											
          while ($bodega = mysqli_fetch_array($queryB)) {
												
            echo '<option value="'.$bodega['cod'].'">'.$bodega['nombre'].'</option>';
												
          }
        ?>
		</select>
		&nbsp;&nbsp;
		<select class="form-control" name="clasificacion" onChange="obtenerTipos(this.value);">
        <option value="<?php if(isset($clasificacion)) echo $clasificacion; ?>" required class="redondeadonorelieve">Seleccione Clasificacion:</option>
						<?php
						
							while($row= $consulta_clasificacion->fetch_object())
							{
								echo "<option value='".$row->valor."'>".$row->descripcion."</option>";
							}
						?>
		</select>
		&nbsp;&nbsp;
		<div class="form-group">
		<button type="submit" value="Buscar" class="btn btn-primary">Consultar</button>
		</div>
	</div>		
  </form><br>
  
  
 <?php  
    $busqueda = $_GET['busqueda'];
	$clasificacion = $_GET['clasificacion'];

	
	//Paginador

			$query = mysqli_query($mysqli,"
			select
'2- Responsable' ubc,
clasificaciones.clasificacion clasificacion,
invti_tipoart.tipo tipo,
invti_responsables.clase clase,
invti_articulos.articulo articulo,
count(invti_articulos.articulo) disponible
FROM invti_responsables, invti_articulos, clasificaciones, invti_marca, invti_tipoart
WHERE invti_responsables.responsable = '" . $busqueda . "'
AND invti_responsables.clasificacion = '" . $clasificacion . "'
AND invti_responsables.asigna = 'N' 
AND invti_tipoart.id = invti_responsables.TIPO
AND invti_articulos.id = invti_responsables.ARTICULO
AND invti_marca.id = invti_responsables.MARCA
AND invti_responsables.clasificacion = clasificaciones.id
GROUP BY ubc, clasificacion, tipo,articulo, clase 
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
	<th>Sitio</th>
	<th>Clasificacion</th>
	<th>Tipo</th>
	<th>Clase</th>
	<th>Articulo</th>
	<th>Cantidad Disponible</th>	
	</tr>
		</thead>

		<tbody>
			<?php
				while ($data = mysqli_fetch_array($query)) {
			?>
	
	<!-- Bucle while que recorre cada registro y muestra cada campo en la tabla.-->
	<tr style="text-align: center;">
     <td><?php echo $data['ubc'] ?></td>
	 <td><?php echo $data['clasificacion'] ?></td>
	 <td><?php echo $data['tipo'] ?></td>
	 <td><?php echo $data['clase'] ?></td>
	 <td><?php echo $data['articulo'] ?></td>
	 <td><?php echo $data['disponible'] ?></td>
		</tr>
		
	  <?php }?>
	<?php }?>


	</tbody>	
	</table> <!-- Fin de la tabla-->
	<!-- cerrar conexión de base de datos  -->
</div>

</div>
	
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
<br />
<!-- Modal  modalAcercaDe-->
<div class="modal fade" id="modalAcercaDe" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Acerca de</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <div id="principal">
<div class="container" >

<table width="100%" border="0" align="center">

  <tr>
    <td>&nbsp;</td>
    <td><div align="center"><h2><dt>
    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-upc-scan" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
  <path d="M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z"/>
</svg>
    </dt></h2></div></td>
    <td>&nbsp;</td>
  </tr>  
  <tr>
    <td>&nbsp;</td>
    <td><div align="center"><h4>Módulo Control de Activos Fijos - <?php include('../version.php');?></h4></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><div align="center"><h5>Red de servicios de la Orinoquia y el caribe SA</h5></div></td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
      
    </tr>
    <tr>
      <td>&nbsp;</td>
       <td><div align="center">Resolución óptima 1024 x 768 píxeles</div></td>
       <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td width="62%"><div align="center">Aplicación desarrollada por el proceso de tecnología</div></td>
        <td>&nbsp;</td>
    </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>  
    <tr>
      <td>&nbsp;</td>
      <td width="62%"><div align="center"><b>Proceso TIC RSOC - </b><a>tic@supergiroscasanare.co</a></div></td>
        <td>&nbsp;</td>
    </tr>	
</table>
</div>
</div>
</div>
</div>
</div>
</body>
</html>