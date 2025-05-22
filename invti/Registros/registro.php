<?php
	session_start();

	if(!isset($_SESSION["id_usuario"])){
		header("Location: ../../index.php");
	}
	
	require '../../funcs/Conexion.php';
	require '../../funcs/funcs.php';

	$conexion = new Conectar();
	$mysqli = $conexion->conexion();


	$errors = array();
	$creado = array();


	$usuariomail = $_SESSION['id_usuario'];
	$sqlusermail = "SELECT correo FROM usuarios WHERE id = '$usuariomail'";
	$resultmail = $mysqli->query($sqlusermail);
	$email = $resultmail->fetch_assoc();

	$usuarioname = $_SESSION['id_usuario'];
	$sqlusername = "SELECT nombre FROM usuarios WHERE id = '$usuarioname'";
	$resultname = $mysqli->query($sqlusername);
	$name = $resultname->fetch_assoc();
	
    if(!empty($_POST))
    {
        $nit = $mysqli->real_escape_string($_POST['nit']);    
        $clasificacion = $mysqli->real_escape_string($_POST['clasificacion']);  
        $tipo = $mysqli->real_escape_string($_POST['tipo']);    
        $clase = $mysqli->real_escape_string($_POST['clase']);    
        $articulo = $mysqli->real_escape_string($_POST['articulo']);
		$marca = $mysqli->real_escape_string($_POST['marca']); 
        $serial = $mysqli->real_escape_string($_POST['serial']);
        $imei = $mysqli->real_escape_string($_POST['imei']);    
        $sim = $mysqli->real_escape_string($_POST['sim']);
        $activo = $mysqli->real_escape_string($_POST['activo']);     
        $estado = $mysqli->real_escape_string($_POST['estado']);
		$factura = $mysqli->real_escape_string($_POST['factura']);
        $proveedor = $mysqli->real_escape_string($_POST['proveedor']);  
		$valor = $mysqli->real_escape_string($_POST['valor']);
        $fecha = $mysqli->real_escape_string($_POST['fecha']);
		$asigna = 'N';		
        $zona = $mysqli->real_escape_string($_POST['zona']);
		$user = $mysqli->real_escape_string($_POST['user']);
		$email = $mysqli->real_escape_string($_POST['email']);
		$name = $mysqli->real_escape_string($_POST['nombre']);
		$observacion = $mysqli->real_escape_string($_POST['observacion']);	
			
		$nombre = "$name";
		$asunto = "Notificaciones BPM-Control activos";
		$cuerpo = "<p>Se&ntilde;or(a): $nombre,</p>  Se ha creado un nuevo art&iacute;culo en su bodega con activo fijo: $activo <p></p><p>Cordialmente,</p><p>Notificaciones BPM-Control activos</p>";
		$nombre = "$name";
        
        if(isNullNuevArt($nit, $clasificacion, $tipo, $clase, $articulo, $marca, $serial, $imei, $sim, $activo, $estado, $factura, $proveedor, $fecha, $asigna, $zona, $user, $valor))
        {
            $errors[] = "Debe llenar todos los campos";
        }
                
        if(activoExiste($activo))
        {
            $errors[] = "El codigo de activo fijo: $activo ya existe";
		}
		
		if(serialExiste($serial))
        {
            $errors[] = "El serial ingresado: $serial ya existe";
        }
        
		if(count($errors) == 0)
		{
		$registro = registraActivo($nit, $clasificacion, $tipo, $clase, $articulo, $marca, $serial, $imei, $sim, $activo, $estado, $factura, $proveedor, $valor, $fecha, $asigna, $zona, $user, $observacion);      
        if($registro > 0 )
            {	

				$creado[] = "Datos insertados correctamente - articulo: $activo";
				$enviamail = enviarEmail($email, $nombre, $asunto, $cuerpo);    
            } else {
                        $erros[] = "Error al crear articulo: $activo";
                    }
		}
    }
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
<p></p>
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
				$consulta_marcas = $mysqli->query("select id as 'valor', marca as 'descripcion' from invti_marca order by marca");
			?>

<div class="container">
<div class="col-md-8 offset-md-2 mt-4">
	<form class="needs-validation" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" name="formulario" id="formulario"  autocomplete="off">

		<?php echo resultActivoError($errors); ?>
		<?php echo resultActivoSuccess($creado); ?>
		
		<div class="container-sm">

				<h2 class="text-primary">
				<dt>
				<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-upc-scan" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  				<path fill-rule="evenodd" d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
 				<path d="M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z"/>
				</svg>
				Nuevo Artículo
				</dt>
				</h2>	

			<div class="form-row">

				<div class="col-md-4 mb-3">
					<label class="">Clasificación:</label>
					
						<select class="form-control" name="clasificacion" onChange="obtenerTipos(this.value);">
					        <option value="<?php if(isset($clasificacion)) echo $clasificacion; ?>" required >Selección:</option>
											<?php
											
												while($row= $consulta_clasificacion->fetch_object())
												{
													echo "<option value='".$row->valor."'>".$row->descripcion."</option>";
												}
											?>
						</select>
					

				</div>
				<div class="col-md-4 mb-3">
					<label class="">Tipo:</label>
						
							<select class="form-control" name="tipo" id="lista_tipos" onChange="obtenerArticulos(this.value);">
					        	<option value="<?php if(isset($tipo)) echo $tipo; ?>" required >Selección:</option>
											<?php
											
												while($row= $consulta_tipos->fetch_object())
												{
													echo "<option value='".$row->valor."'>".$row->descripcion."</option>";
												}
											?>
							</select>
						
				</div>
					
			<div class="col-md-4 mb-3">
					<label class="">Artículo:</label>
						
					        <select class="form-control" name="articulo" id="lista_articulos" onChange="obtenerMarcas(this.value); obtenerClases(this.value);">
					        	<option value="<?php if(isset($articulo)) echo $articulo; ?>" required>Selección:</option>
											<?php
												while($row= $consulta_articulos->fetch_object())
											   {
												  echo "<option value='".$row->valor."'>".$row->descripcion."</option>";
											   }
											?>
							</select>
						
				</div>			
			
				<div class="col-md-4 mb-3" style="margin-top: 10px;">
					<label class="">Clase:</label>

						 <select class="form-control" name="clase" id="lista_clases">
					        <option value="<?php if(isset($clase)) echo $clase; ?>" required >Selección:</option>
																		<?php
												while($row= $consulta_clases->fetch_object())
											   {
												  echo "<option value='".$row->descripcion."'>".$row->descripcion."</option>";
											   }
											?>
							</select>
				</div>
				
				
				<div class="col-md-4 mb-3" style="margin-top: 10px;">
				   <label class="">Marca:</label>
					   
						    <select class="form-control" name="marca" id="lista_marcas">
					        	<option value="<?php if(isset($marca)) echo $marca; ?>" required>Selección:</option>
											<?php
												while($row= $consulta_marcas->fetch_object())
											   {
												  echo "<option value='".$row->valor."'>".$row->descripcion."</option>";
											   }
											?>
							</select>
						
				</div>
			
				<div class="col-md-4 mb-3" style="margin-top: 10px;">
					<label class="">Estado:</label>
						
							<select class="form-control" name="estado">
						        <option value="<?php if(isset($estado)) echo $estado; ?>" required>Selección:</option>
								<?php
																
						          $queryestado = $mysqli -> query ("SELECT * FROM estado_art");
																	
						          while ($estado = mysqli_fetch_array($queryestado)) {
																		
						            echo '<option value="'.$estado['estado'].'">'.$estado['estado'].'</option>';
																			
						          }
						        ?>
							</select>
						
				</div>
				<div class="col-md-4 mb-3" style="margin-top: 10px;">
					<label class="">Zona:</label>
						
					        <select class="form-control" name="zona">
						        <option value="<?php if(isset($zona)) echo $zona; ?>" required>Selección:</option>
								        <?php
																
						          $query5 = $mysqli -> query ("SELECT cod,nombre, responsable FROM bodegas WHERE responsable = '" . $userensqlzona . "'
								                                 and estado ='1'");
																	
						          while ($zona = mysqli_fetch_array($query5)) {
																		
						            echo '<option value="'.$zona['cod'].'">'.$zona['nombre'].'</option>';
																			
						          }
						        ?>
							</select>
						
				</div>	
				<div class="col-md-4 mb-3" style="margin-top: 10px;">	
			       <label class="">Activo fijo:</label>
			       		
			     			<input class="form-control" value="<?php if(isset($activo)) echo $activo; ?>" required name="activo"  id="activo" type="text"/>
		   		
		   	</div>
		   		<div class="col-md-4 mb-3" style="margin-top: 10px;">
		       		<label class="">Serial:</label>
			       		
			    	   		<input class="form-control" value="<?php if(isset($serial)) echo $serial; ?>" required name="serial" id="serial" type="text" />
			    	   	
		       </div>
		       <div class="col-md-4 mb-3" style="margin-top: 10px;">	   
		       		<label class="">Imei:</label>
			       		
							<input class="form-control" value="<?php if(isset($imei)) echo $imei; ?>" required name="imei" type="text"/>
						
				</div>
				<div class="col-md-4 mb-3" style="margin-top: 10px;">
					<label class="">SIMCARD:</label>
						
							<input class="form-control" value="<?php if(isset($sim)) echo $sim; ?>" required name="sim" type="text" />
						
				</div>

				<div class="col-md-4 mb-3" style="margin-top: 10px;">
					<label class="">Factura:</label>
						
			        		<input class="form-control" value="<?php if(isset($factura)) echo $factura; ?>" required name="factura" type=
			        		"text"/>
			        	
		    	</div>
				
				<div class="col-md-4 mb-3" style="margin-top: 10px;">
					<label class="">Proveedor:</label>
						
							<select class="form-control" name="proveedor">
						        <option value="<?php if(isset($proveedor)) echo $proveedor; ?>" required>Selección:</option>
								<?php
																
						          $queryproveedor = $mysqli -> query ("SELECT * FROM proveedores ORDER BY proveedor");
																	
						          while ($proveedor = mysqli_fetch_array($queryproveedor)) {
																		
						            echo '<option value="'.$proveedor['nit'].'">'.$proveedor['proveedor'].'</option>';
																			
						          }
						        ?>
							</select>
						
				</div>				
										
				<div class="col-md-4 mb-3" style="margin-top: 10px;" id="currency_col" >
					<label class="">Valor:</label>
						
			        		<input class="form-control" value="<?php if(isset($valor)) echo $valor; ?>" required name="valor" type="number" placeholder="$"/>
			        	
		    	</div>				

		    	<div class="col-md-4 mb-3" id="fecha" style="margin-top: 10px;">
		    		<label class="">Fecha de compra:</label>
		    		<div class="input-group date ">
						  <input type="text" value="<?php if(isset($fecha)) echo $fecha; ?>" name="fecha" placeholder="dd/mm/yyyy" class="form-control" required>
		  					<span class="input-group-addon">
		  					</span>
					</div>
				</div>

		    	<div class="col-md-4 mb-3" style="margin-top: 10px; margin-bottom: 10px">
					<label class=""><b>Observacion:</b></label>
						
			       			<input class="form-control" value="<?php if(isset($observacion)) echo $observacion; ?>" name="observacion" type="text" />
			       		
		    	</div>
		       	<input readonly='readonly' value="<?php echo ($rowuser['usuario']);?>" name="user" type="hidden" />
				<input readonly='readonly' value="<?php echo ($email['correo']);?>" name="email" type="hidden" />
				<input readonly='readonly' value="<?php echo ($name['nombre']);?>" name="nombre" type="hidden" />
				<input readonly='readonly' value="<?php echo $rowempresa['nit'];?>" name="nit" type="hidden">
		    	<input type="hidden" name="MM_insert" value="formulario" />

			<div class="col-sm-offset-5 col-sm-10" style="margin-bottom: 20px">
				<button class="btn btn-primary" type="submit" name="enviar" id="enviar" value="Grabar"  onclick='return confirmar()'><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
        		<a href="registro.php"><span class="btn btn-warning"><span class="glyphicon glyphicon-erase"></span> Limpiar</button></a>

		</div><br>	
</form><br>
</div>
</div><!--Fin div container-->

    <script type="text/javascript">

		$('#fecha .input-group.date').datepicker({
		    format: "dd/mm/yyyy",
		    language: "es",
		    todayHighlight: true
		});

    </script>

<script type="text/javascript">
function confirmar()
{
	if(confirm('¿Estas seguro de ingresar el artículo?'))
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