<?php
session_start();

if(!isset($_SESSION["id_usuario"])){
	header("Location: ../../index.php");
}
	
	require '../../funcs/Conexion.php';
	$conexion = new Conectar();
	$mysqli = $conexion->conexion();
	require '../../funcs/funcs.php';
	
	$usuariomail = $_SESSION['id_usuario'];
	$sqlusermail = "SELECT correo FROM usuarios WHERE id = '$usuariomail'";
	$resultmail = $mysqli->query($sqlusermail);
	$email = $resultmail->fetch_assoc();

	$usuarioname = $_SESSION['id_usuario'];
	$sqlusername = "SELECT nombre FROM usuarios WHERE id = '$usuarioname'";
	$resultname = $mysqli->query($sqlusername);
	$name = $resultname->fetch_assoc();

	
?>
<head>
<title>Control activos</title>
<?php require_once "../menu.php"; ?>
	<?php require_once "../librerias.php"; ?>
	<link rel="stylesheet" href="../../css/bootstrap-datepicker.css">
<script type="text/javascript" src="../../js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="../../js/bootstrap-datepicker.es.min.js"></script>
</head>
<body>

<script>
			   function obtenerTipos(val) 
			   {
				 $.ajax
				 ({
					type: "POST",
					url: "get_tipo.php",
					data:'id='+val,
					success: function(data)
					{
					   $("#lista_tipos").html(data);
					}
				 });
				}
			</script>	
	
			<script>
			   function obtenerArticulos(val) 
			   {
				 $.ajax
				 ({
					type: "POST",
					url: "get_art.php",
					data:'id='+val,
					success: function(data)
					{
					   $("#lista_articulos").html(data);
					}
				 });
				}
			</script>
		
			<script>
			   function obtenerClases(val) 
			   {
				 $.ajax
				 ({
					type: "POST",
					url: "get_clase.php",
					data:'id='+val,
					success: function(data)
					{
					   $("#lista_clases").html(data);
					}
				 });
				}
			</script>
		
			<script>
			   function obtenerMarcas(val) 
			   {
				 $.ajax
				 ({
					type: "POST",
					url: "get_marc.php",
					data:'id='+val,
					success: function(data)
					{
					   $("#lista_marcas").html(data);
					}
				 });
				}
			</script>	
			<?php
				$consulta_clasificacion   = $mysqli->query("select id as 'valor', clasificacion as 'descripcion' from clasificaciones order by clasificacion");
				$consulta_tipos   = $mysqli->query("select id as 'valor', tipo as 'descripcion' from invti_tipoart order by tipo");
				$consulta_articulos = $mysqli->query("select id as 'valor', articulo as 'descripcion' from invti_articulos order by articulo");
				$consulta_clases = $mysqli->query("select id as 'valor', clase as 'descripcion' from invti_clasearticulos order by clase");
				$consulta_marcas = $mysqli->query("select id as 'valor', marca as 'descripcion' from invti_marca order by marca")
			?>
	<input type="hidden" value="<?php ($rowuser['usuario']);?>" >
	<div class="container">
<div class="col-md-8 offset-md-3 mt-4">

<form class="form-inline formulariolinea" action="updatearticulos.php"  method="POST" id="formulario2" name="formulario2" style="text-align: center;" autocomplete="off">
		<div class="form-group">
    	<label>Actualizar Información:</label>&nbsp;&nbsp;
    		<input name="busqueda" id="busqueda" type="text" class="form-control" placeholder='Ingrese Activo fijo'>
	    <div class="form-group">
			<button type="submit" value="Buscar" class="btn btn-default"><span class="glyphicon glyphicon-search"> </span></button>
		</div>
	</div>
  </form><br>
 <?php  
   		$busqueda = $_POST['busqueda'];
  		//comenzamos la consulta 
		  $consulta ="SELECT invti_bodegas.nit nit,
		  invti_bodegas.clasificacion clasificacion,
		  invti_bodegas.tipo tipo,
		  invti_bodegas.clase clase,
		  invti_bodegas.articulo articulo,
		  invti_bodegas.marca marca,
		  invti_bodegas.serial serial,
		  invti_bodegas.imei imei,
		  invti_bodegas.simcard simcard,
		  invti_bodegas.activo activo,
		  invti_bodegas.estado estado,
		  invti_bodegas.factura factura,
		  invti_bodegas.proveedor proveedor,
		  invti_bodegas.fechacompra fechacompra,
		  invti_bodegas.BODEGA ubicacion,
		  invti_bodegas.observacion observacion,
		  invti_bodegas.valor valor
		FROM invti_bodegas, bodegas
		WHERE invti_bodegas.activo = '" . $busqueda . "'
		AND invti_bodegas.asigna = 'N'
		AND invti_bodegas.BODEGA = bodegas.COD
		AND bodegas.RESPONSABLE = '" . $userensqlzona . "'
		AND bodegas.ESTADO = 1
		";
  
  		$resultado=mysqli_query($mysqli,$consulta);
  
  
 		while ($rowtb = mysqli_fetch_row($resultado)){
 ?>
</div>
</div>


  <form class="needs-validation" action='Gupdatearticulos.php' method='POST' id='form' name='form'  autocomplete="off">
  
  	<div class="container-sm">
	  <div class="col-md-8 offset-md-2 mt-4">

   		
			<h2 class="text-primary"><dt>
			<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-upc-scan" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  				<path fill-rule="evenodd" d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
 				<path d="M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z"/>
				</svg>
			Actualizar Artículos</dt></h2>	
		<br>
		<input value="<?php echo utf8_decode($email['correo']);?>" name="email" type="hidden" />
	<input type="hidden" name="nombre" value="<?php echo utf8_decode($name['nombre']);?>" >
			<div class="form-row">

				<div class="col-md-4 mb-3" style="margin-top: 10px;">	
				<label><b>Empresa: <span class="glyphicon glyphicon-remove text-danger"></span></b></label>
			   	<input class="form-control" name='nit' id='nit' value='<?php echo $rowtb['0']?>' readonly='readonly' />
			   	</div>

				<div class="col-md-4 mb-3" style="margin-top: 10px;">
				<label><b>Clasificacion:</b></label>
					<select class="form-control" name='clasificacion'required onChange='obtenerTipos(this.value);'>";					
						<option value='<?php echo $rowtb['1']?>' required>No Actualizar</option>";	
							<?php
								while($row= $consulta_clasificacion->fetch_object())
										{
											echo '<option value="'.$row->valor.'">'.$row->descripcion.'</option>';
										}?>
				</select>
				</div>
				<div class="col-md-4 mb-3" style="margin-top: 10px;">
				<label><b>Tipo:</b></label>
				<select class="form-control" name='tipo' required id='lista_tipos' onChange='obtenerArticulos(this.value);'>";
									<option value='<?php echo $rowtb['2']?>' required>No Actualizar</option>";	
										<?php
										while($row= $consulta_tipos->fetch_object())
										{
											echo '<option value="'.$row->valor.'">'.$row->descripcion.'</option>';
										}?>
				</select>
				</div>
			
				<div class="col-md-4 mb-3" style="margin-top: 10px;">
			     <label><b>Articulo</b></label>
			     	<select class="form-control" name='articulo' required id='lista_articulos' onChange='obtenerMarcas(this.value); obtenerClases(this.value);'>";
									<option value='<?php echo $rowtb['4']?>' required>No Actualizar</option>";
									<?php	
										while($row= $consulta_articulos->fetch_object())
										{
											echo '<option value="'.$row->valor.'">'.$row->descripcion.'</option>';
										}?>
				</select>
				</div>
			
				<div class="col-md-4 mb-3" style="margin-top: 10px;">
				<label><b>Clase:</b></label>
			     <select class="form-control" required name='clase' id="lista_clases">
									<option value='<?php echo $rowtb['3']?>' required>No Actualizar</option>";
									<?php	
										while($row= $consulta_clases->fetch_object())
										{
											echo '<option value="'.$row->valor.'" required>'.$row->descripcion.'</option>';
										}?>
				</select>
				</div>

				<div class="col-md-4 mb-3" style="margin-top: 10px;">
			     <label><b>Marca</b></label>
				<select class="form-control" required name='marca' id='lista_marcas'>
									<option value='<?php echo $rowtb['5']?>' required>No Actualizar</option>
									<?php	
										while($row= $consulta_marcas->fetch_object())
										{
											echo '<option value="'.$row->valor.'">'.$row->descripcion.'</option>';
										}?>
				</select>
				</div>
				
			   	<div class="col-md-4 mb-3" style="margin-top: 10px;">
				<label><b>Estado:</b></label>
			    	<select class="form-control" required name='estado'>
					<option value='<?php echo $rowtb['10']?>' required>No Actualizar</option>
					
													<?php
																
						          $queryestado = $mysqli -> query ("SELECT * FROM estado_art");
																	
						          while ($estado = mysqli_fetch_array($queryestado)) {
																		
						            echo '<option value="'.$estado['estado'].'">'.$estado['estado'].'</option>';
																			
						          }
						        ?>
			    	?>
				</select>
				</div>				
				
				<div class="col-md-4 mb-3" required style="margin-top: 10px;">
				<label>Activo <span class="glyphicon glyphicon-remove text-danger"></span></label>
			   	 <input class="form-control" id='activo' readonly='readonly' name='activo' value='<?php echo $rowtb['9']?>' />
			   	</div>

			   	<div class="col-md-4 mb-3" style="margin-top: 10px;">
				<label><b>Serial <span class="glyphicon glyphicon-remove text-danger"></span></b></label>
			   	 <input class="form-control" readonly='readonly' id='serial' name='serial' value='<?php echo $rowtb['6']?>' />
			   	</div>

			   	<div class="col-md-4 mb-3" style="margin-top: 10px;">
				<label><b>IMEI:</b></label>
			   	 <input class="form-control" id='imei' name='imei' value='<?php echo $rowtb['7']?>' required/>
			   	</div>

			   	<div class="col-md-4 mb-3" style="margin-top: 10px;">
				<label><b>SIMCARD:</b></label>
			   	 <input class="form-control" id='simcard' name='simcard' value='<?php echo $rowtb['8']?>' required/>
			   	</div>

				<div class="col-md-4 mb-3" style="margin-top: 10px;">
				<label><b>Factura:</b></label>
			   	 <input class="form-control" id='factura' name='factura' value='<?php echo $rowtb['11']?>' required/>
			   	</div>

			   	<div class="col-md-4 mb-3" style="margin-top: 10px;">	
				<label><b>Proveedor:</b></label>
				 				<select class="form-control" required name='proveedor' id='proveedor'>
									<option value='<?php echo $rowtb['12']?>' required>No Actualizar</option>
									<?php
																
						          $queryproveedor = $mysqli -> query ("SELECT * FROM proveedores ORDER BY proveedor");
																	
						          while ($proveedor = mysqli_fetch_array($queryproveedor)) {
																		
						            echo '<option value="'.$proveedor['nit'].'">'.$proveedor['proveedor'].'</option>';
																			
						          }
						        ?>
				</select>
			   	</div>
				
				<div class="col-md-4 mb-3" style="margin-top: 10px;">
				<label><b>Valor:</b></label>
			     <input class="form-control" name='valor' type='number' value='<?php echo $rowtb['16'] ?>' required/>
			    </div>

		    	<div class="col-md-4 mb-3" id="fecha" style="margin-top: 10px;">
		    		<label class="">Fecha de compra:</label>
		    		<div class="input-group date">
		  				<input type="text" value="<?php echo $rowtb['13']?>" name="fecha" placeholder="dd/mm/yyyy" class="form-control" required>
		  					<span class="input-group-addon">
		  						<i class="glyphicon glyphicon-calendar"></i>
		  					</span>
					</div>
				</div>

			   	<div class="col-md-4 mb-3" style="margin-top: 10px;">
				<label><b>Ubicacion <span class="glyphicon glyphicon-remove text-danger"></span></b></label>
			   	<input class="form-control" name='ubc' id='ubc' value='<?php echo $rowtb['14']?>' readonly='readonly' />
			   	</div>

			   	<div class="col-md-4 mb-3" style="margin-top: 10px;">	
				<label><b>Login <span class="glyphicon glyphicon-remove text-danger"></span></b></label>
			   	<input class="form-control" name='user' id='user' value='<?php echo $userensqlzona ?>' readonly='readonly' />
			   	</div>

			   	<div class="col-md-4 mb-3" style="margin-top: 10px;">
				<label><b>Observación:</b></label>
			     <input class="form-control" id='observacion' name='observacion' value='<?php echo $rowtb['15']?>'/>
			    </div>

				<div class="form-group">
					<div class="col-sm-offset-5 col-sm-10" style="margin-top: 20px; margin-bottom: 20px;">
			    		<button type='submit' name='Actualizar' id='submit' class='btn btn-warning' 
						onclick='return confirmar()'>
						<span class="glyphicon glyphicon-pencil"></span> Actualizar</button>
			    	</div>
				</div>
 	</div><!--fin div container dentro de form-->

 </form>
 </div>
</div><!--Fin div container contiene form-->

 <?php } ?> 

    <script type="text/javascript">

		$('#fecha .input-group.date').datepicker({
		    format: "dd/mm/yyyy",
		    language: "es",
		    todayHighlight: true,
		    todayBtn: true
		});

		function confirmar()
{
	if(confirm('¿Estas seguro de actualizar el artículo?'))
		return true;
	else
		return false;
}	
    </script>

</form>
<?php
require_once '../creditos.php';
?>
</body>
</html>