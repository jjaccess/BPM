<?php
session_start();

if(!isset($_SESSION["id_usuario"])){
	header("Location: ../../index.php");
}
	
	require '../../funcs/Conexion.php';
	$conexion = new Conectar();
	$mysqli = $conexion->conexion();
  require '../../funcs/funcs.php';
  
  $errors = array();
  $creado = array();
  if(!empty($_POST))
  {
    $activo = $mysqli->real_escape_string($_POST['busqueda']);

    if(Tpendientebodbod($activo))
    {
        $errors[] = "El Artículo con activo fijo $activo, ya tiene un traslado pendiente por aceptar.";
	}
	if(Tpendientebodres($activo))
    {
        $errors[] = "El Artículo con activo fijo $activo, ya tiene un traslado pendiente por aceptar.";
    }
    if(count($errors) == 0)
		{
      $creado;
    }
    else
    {
      $erros[] = "No puede articulo: $activo";
    }
  }
	
	$usuariomail = $_SESSION['id_usuario'];
	$sqlusermail = "SELECT correo FROM usuarios WHERE id = '$usuariomail'";
	$resultmail = $mysqli->query($sqlusermail);
	$email = $resultmail->fetch_assoc();

	$usuarioname = $_SESSION['id_usuario'];
	$sqlusername = "SELECT nombre FROM usuarios WHERE id = '$usuarioname'";
	$resultname = $mysqli->query($sqlusername);
	$name = $resultname->fetch_assoc();

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>Control activos</title>
<?php require_once "../menu.php"; ?>
	<?php require_once "../librerias.php"; ?>
</head>
<body>

<input type="hidden" value="<?php ($row['usuario']);?>" >
<div class="container">
<div class="col-md-8 offset-md-3 mt-4">
<form class="form-inline formulariolinea" action="updatezona.php" method="POST" id="formulario2" name="formulario2" onsubmit="return valida(this)" autocomplete="off" style="text-align: center;">

  <div class="form-group">
    	<label>Asignacion a Otra Bodega:</label>

    		<input type='hidden' readonly='readonly' value="<?php echo utf8_decode($rowuser['usuario']);?>" name="user" /></label>
				<?php
										
         			$query5 = $mysqli -> query ("SELECT cod,nombre, responsable FROM bodegas WHERE responsable = '" . $userensqlzona . "'
		                                   AND estado = '1'
										   GROUP BY cod");
											
          			while ($origen = mysqli_fetch_array($query5)) {
												
            			echo '<input type="hidden" value="'.$origen['cod'].'" name="origen" class="redondeadonorelieve"/>';
													
          			}
        		?>
    		<input name="busqueda" id="busqueda" type="text" class="form-control" placeholder='Ingrese Activo fijo'>

		<div class="form-group">
			<button type="submit" value="Buscar" class="btn btn-default"><span class="glyphicon glyphicon-search"> </span></button>
		</div>
	</div>

</form><br>



<?php  
    $busqueda = $_POST['busqueda'];
	$user = $_POST['user'];
	$Origen = $_POST['origen'];
?>

<?php

  //comenzamos la consulta 
  $consulta ="SELECT empresas.empresa empresa,invti_bodegas.clasificacion clasificacion,invti_tipoart.tipo tipo,invti_bodegas.clase clase,invti_articulos.articulo articulo,
invti_marca.marca marca,invti_bodegas.activo activo, invti_bodegas.serial serial,invti_bodegas.estado estado,bodegas.NOMBRE ubicacion, invti_bodegas.BODEGA, invti_bodegas.id
FROM invti_bodegas, bodegas, empresas, invti_tipoart, invti_articulos, invti_marca
WHERE invti_bodegas.activo = '" . $busqueda . "'
AND invti_bodegas.asigna = 'N' 
AND bodegas.COD = invti_bodegas.BODEGA
AND empresas.nit = invti_bodegas.nit
AND invti_tipoart.id = invti_bodegas.TIPO
AND invti_articulos.id = invti_bodegas.ARTICULO
AND invti_marca.id = invti_bodegas.MARCA
AND invti_bodegas.BODEGA = '" . $Origen . "'
AND bodegas.estado = '1'
GROUP BY id
" ;
  
 
  $resultado=mysqli_query($mysqli,$consulta);
  
  
 while ($row = mysqli_fetch_row($resultado)){

 	?>
  
  <form action='Gupdatezona.php' method='get' id='formulario' name='formulario' onsubmit='return checkSubmit();' >
  
  <?php echo resultActivoError($errors); ?>
		<?php echo resultActivoSuccess($creado); ?>
    
    <?php if(count($errors) == 0)
   { ?>
      	<div class="container">


   <h2 class="text-primary"><dt>
			<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-upc-scan" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  				<path fill-rule="evenodd" d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
 				<path d="M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z"/>
				</svg>
				Traslado de Bodega</dt></h2>	
		<br>

	    <div class="form-row">
	    	<div class="col-md-5 mb-3">
	   			<label>N° Registro</label>
	    			<input readonly='readonly' name='id' id='id' value='<?php echo $row['11']?>' class='form-control'/>
			</div>
			<div class="col-md-5 mb-3">
	  			<label>Articulo:</label>
       				<input value='<?php echo $row['4']?>' class='form-control' readonly='readonly' />
          </div>
		</div>
    	<div class="form-row">
   			<div class="col-md-5 mb-3">
	  			<label>Marca:</label>
       				<input value='<?php echo $row['5']?>' class='form-control' readonly='readonly' />
   			</div>
       		<div class="col-md-5 mb-3">
	  			<label>Serial:</label>
       				<input value='<?php echo $row['7']?>' class='form-control' readonly='readonly' />
   			</div>
		</div>
    	<div class="form-row">
    		<div class="col-md-5 mb-3">	
	  			<label>Estado:</label>
       				<input value='<?php echo $row['8']?>' class='form-control' readonly='readonly'/>
   			</div>
   			<div class="col-md-5 mb-3">
	  			<label>Ubicacion Actual:</label>
       				<input value='<?php echo $row['9']?>' class='form-control' readonly='readonly'/>
   			</div>
		</div>
    	<div class="form-row">
    		<div class="col-md-5 mb-3">
	  			<label>Codigo bodega:</label>
       				<input name='origen' id='origen' readonly='readonly' value='<?php echo $row['10']?>' class='form-control' />
       		</div>	
       		<div class="col-md-5 mb-3">  
	 			<label>Seleccione Bodega:</label>
     				<select class="form-control" name='destino' required>
      					<option value=''>Selección:</option>	
     						<?php		
          						$query6 = $mysqli -> query ("SELECT cod,nombre,responsable FROM bodegas 
								  WHERE estado = '1'
								  AND cod not in ('$Origen')
									GROUP BY cod");										
          						while ($destino = mysqli_fetch_array($query6)) {									
           				echo '<option value="'.$destino['cod'].'" >'.$destino['nombre'].'</option>';												
          				} ?>
         
					</select>
			</div>
		</div>
    	<div class="form-row">
    		<div class="col-md-5 mb-3">
				<label>Activo fijo:</label>
    				<input name='activo' id='activo' value='<?php echo $busqueda ?>' readonly='readonly' class='form-control' />
			</div>
    		<div class="col-md-5 mb-3">  
				<label>Login:</label>
    				<input name='user' id='user' value='<?php echo $user ?>' readonly='readonly' class='form-control' />

			</div>
		</div>
		<div class="form-row">
			<div class="col-md-10 mb-3" style="margin-bottom: 20px; margin-top: 10px;">
				<label>Motivo del traslado:</label>
    				<input name='observacion' id='observacion' value='' class='form-control' required/> 
			</div>
		</div>
      	<div class="form-group">
        	<div class="col-sm-offset-5 col-sm-10"  style="margin-bottom: 20px">
				<button type='submit' name='enviar' id='enviar' value='Grabar' class='btn btn-primary' onclick='return confirmar()'><span class="glyphicon glyphicon-floppy-disk"></span> Asignar</button>
			</div>
    	</div>
    <?php } ?>
	</div>
 </form>
 </div>
 <?php } ?>
</div>
<script type="text/javascript">
function confirmar()
{
	if(confirm('¿Estas seguro de trasladar el articulo?'))
		return true;
	else
		return false;
}
</script>
<script type="text/javascript">
function checkSubmit() {
    document.getElementById("enviar").value = "Enviando...";
    document.getElementById("enviar").disabled = true;
    return true;
}
</script>
<?php
require_once '../creditos.php';
?>
</body>
</html>