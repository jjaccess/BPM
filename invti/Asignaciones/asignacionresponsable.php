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
  if(!empty($_GET))
  {
    $activo = $mysqli->real_escape_string($_GET['busqueda']);

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
<div class="col-md-8 offset-md-3 mt-4">
  <form class="form-inline formulariolinea" action="asignacionresponsable.php" method="get" id="formulario2" name="formulario2" onsubmit="return valida(this)" autocomplete="off" style="text-align: center;">

<div class="form-group">
    <label>Asignacion a responsable: </label>
      <input type="hidden" readonly='readonly' value="<?php echo utf8_decode($rowuser['usuario']);?>" name="user"/></label>
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
  $busqueda = $_GET['busqueda'];
	$user = $_GET['user'];
	$Origen = $_GET['origen'];
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
    AND bodegas.estado = '1'
    AND invti_bodegas.BODEGA = '" . $Origen . "'
    GROUP BY id
    " ;
  
 
    $resultado=mysqli_query($mysqli,$consulta);
  
  
      while ($row = mysqli_fetch_row($resultado)){
        ?>
  
  <form  action='Gasignacionccosto.php' method='get' id='formulario' name='formulario' onsubmit='return checkSubmit();' autocomplete='off'>
 
    <div class="container">
    <?php echo resultActivoError($errors); ?>
		<?php echo resultActivoSuccess($creado); ?>
    
    <?php if(count($errors) == 0)
   { ?>

    <h2 class="text-primary"><dt>
			<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-upc-scan" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  				<path fill-rule="evenodd" d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
 				<path d="M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z"/>
				</svg>
				Traslado de Responsable</dt></h2>	
		<br>
  <div class="form-row">
    <div class="col-md-5 mb-3">
      <label><b>N° Registro</b></label>
        <input readonly='readonly' name='id' id='id' value='<?php echo $row['11']?>' class='form-control' />
    </div>
    <div class="col-md-5 mb-3">
	<label><b>Articulo:</b></label>
   <input disabled=disabled value='<?php echo $row['4']?>' class='form-control' />
 </div>
 </div>
 <div class="form-row">
  <div class="col-md-5 mb-3" style="margin-top: 10px;">
	<label><b>Marca:</b></label>
   <input disabled=disabled value='<?php echo $row['5']?>' class='form-control' />
 </div>
   <div class="col-md-5 mb-3" style="margin-top: 10px;">
	<label><b>Serial:</b></label>
   <input disabled=disabled value='<?php echo $row['7']?>' class='form-control' />
 </div>
   </div>
   <div class="form-row">
   <div class="col-md-5 mb-3" style="margin-top: 10px;">	
	<label><b>Estado:</b></label>
   <input readonly value='<?php echo $row['8']?>' class='form-control' name='estado' id='estado'/>
 </div>
 <div class="col-md-5 mb-3" style="margin-top: 10px;">
	<label><b>Ubicacion Actual:</b></label>
   <input disabled=disabled value='<?php echo $row['9']?>' class='form-control' />
 </div>
 </div>
 <div class="form-row">
 <div class="col-md-5 mb-3" style="margin-top: 10px;">
	<label><b>Codigo bodega:</b></label>
   <input readonly='readonly' value='<?php echo $row['10']?>' class='form-control' />
 </div>
   <div class="col-md-5 mb-3" style="margin-top: 10px;">	  
	<p><b>Seleccione donde trasladar activo:</b></p>
  <select class="form-control" name='destino' required>
   <option value=''>Selección:</option>		
        <?php
         if($row['10']==20  || $row['10']==10) {	
		 
		  $query7 = $mysqli -> query ("SELECT cod,nombre,responsable FROM ccostos WHERE codbodega = '".$row['10']."'
		                                       AND estado = '1'
											   AND cod > '9999'
											   GROUP BY cod
											   ORDER BY nombre");										
          while ($destino2 = mysqli_fetch_array($query7)) {									
            echo '<option value="'.$destino2['responsable'].'" >'.$destino2['nombre'].'</option>';												
          }
		 
		 }
			else{
          $query6 = $mysqli -> query ("SELECT cod,nombre,responsable FROM ccostos WHERE codbodega = '".$row['10']."'
		                                       AND estado = '1'
											   GROUP BY cod
											   ORDER BY nombre");										
          while ($destino = mysqli_fetch_array($query6)) {									
            echo '<option value="'.$destino['responsable'].'" >'.$destino['nombre'].'</option>';												
          }
			}?>
	</select>
</div>
</div>
<div class="form-row">
  <div class="col-md-5 mb-3" style="margin-top: 10px;">
	<label><b>Activo fijo:</b></label>
  <input name='activo' id='activo' value='<?php echo $busqueda ?>' readonly='readonly' class='form-control' />
</div>
  <div class="col-md-5 mb-3" style="margin-top: 10px;">   
	<label><b>Login:</b></label>
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
	         <button type='submit' name='enviar' id='enviar' value='Grabar'class="btn btn-primary" onclick='return confirmar()'><span class="glyphicon glyphicon-ok"></span> Asignar</button>
	       </div>
      </div>
    </div><!-- Fin div container form-->
</form>
<?php } ?>
 <?php } ?>
 </div>
</div><!--Fin div container-->

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
