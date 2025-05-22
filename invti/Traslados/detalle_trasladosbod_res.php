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

<?php  
    $id = $_GET['id'];
	$origen = $_GET['origen'];
	$destino = $_GET['destino'];
	$activo = $_GET['activo'];

  //comenzamos la consulta 
  $consulta ="SELECT 
		     invti_responsables.id id,
                     invti_responsables.ORIGEN ORIGEN,
                     bodegas.COD codbodega,
                     bodegas.NOMBRE Bodega,
                     invti_responsables.RESPONSABLE destino,
					 invti_articulos.articulo articulo,
					 invti_marca.marca marca,
					 invti_responsables.activo activo,
					 invti_responsables.serial serial,
                     invti_responsables.IMEI imei,
                     invti_responsables.SIMCARD SIMCARD,
					 invti_responsables.estado estado,
					 invti_responsables.CONSECUTIVO consecutivo,
                     invti_responsables.OBSERVACION OBSERVACION
					 
FROM invti_responsables, empresas, invti_tipoart, invti_articulos, invti_marca,bodegas
WHERE invti_responsables.activo = '" . $activo . "'
AND invti_responsables.asigna = 'T' 
AND empresas.nit = invti_responsables.nit
and invti_responsables.id = '" . $id . "'
AND invti_tipoart.id = invti_responsables.TIPO
AND invti_articulos.id = invti_responsables.ARTICULO
AND invti_marca.id = invti_responsables.MARCA
AND invti_responsables.ORIGEN = '" . $origen . "'
AND bodegas.RESPONSABLE = invti_responsables.ORIGEN
AND bodegas.estado = '1'
GROUP BY id
" ;
  
 
  $resultado=mysqli_query($mysqli,$consulta);
  
  
 while ($row = mysqli_fetch_row($resultado)){

  ?>
  
    <form action='Gtrasladobod_res.php' method='get' id='formulario' name='formulario' onsubmit='return valida(this)' >
	
    <div class="container">
<div class="col-md-8 offset-md-3 mt-4">
   
          <a class="btn btn-primary" href='consulta_trasladosbod_res.php' style=' margin: 10px -90px 0px;'>
          <span class="fas fa-arrow-circle-left"></span></a>

          <h2 class="text-primary">
				<dt>
				<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-upc-scan" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  				<path fill-rule="evenodd" d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
 				<path d="M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z"/>
				</svg>
				Detalle traslado
				</dt>
				</h2>

            <div class="form-row">
              <div class="col-md-5 mb-3">
                <label>N° Registro</label>
                  <input readonly='readonly' name='id' id='id' value='<?php echo $row['0'] ?>' class='form-control'/>
                  </div> 
                  <div class="col-md-5 mb-3">
                <label>Origen</label>
                  <input readonly='readonly' name='origen' id='origen' value='<?php echo $row['1'] ?>'class='form-control' />
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-5 mb-3">
                <label>N° bodega</label>
                  <input readonly='readonly' name='codbodega' id='codbodega' value='<?php echo $row['2'] ?>'class='form-control' />
              </div>
              <div class="col-md-5 mb-3">
                <label>Bodega</label>
                  <input readonly='readonly' name='bodega' id='bodega' value='<?php echo $row['3'] ?>'class='form-control' />	
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-5 mb-3">
                <label>Destino</label>
                  <input readonly='readonly' name='destino' id='destino' value='<?php echo $row['4'] ?>' class='form-control' />	
              </div>
              <div class="col-md-5 mb-3">
        	      <label>Articulo:</label>
                  <input readonly='readonly' value='<?php echo $row['5'] ?>'class='form-control' />
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-5 mb-3">
                <label>Marca:</label>
                  <input readonly='readonly' value='<?php echo $row['6'] ?>'class='form-control' />
              </div>
              <div class="col-md-5 mb-3">
                <label>Activo fijo:</label>
                  <input name='activo' id='activo' value='<?php echo $row['7'] ?>' readonly='readonly'class='form-control' />   
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-5 mb-3">
        	      <label>Serial:</label>
                  <input readonly='readonly' value='<?php echo $row['8'] ?>'class='form-control' />
              </div>
              <div class="col-md-5 mb-3">
        	      <label>IMEI:</label>
                  <input readonly='readonly' value='<?php echo $row['9'] ?>'class='form-control' />
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-5 mb-3">
        	      <label>SIMCARD:</label>
                  <input readonly='readonly' value='<?php echo $row['10'] ?>'class='form-control' />
              </div>
              <div class="col-md-5 mb-3">
        	      <label>Estado:</label>
                  <input readonly='readonly' value='<?php echo $row['11'] ?>'class='form-control' />
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-5 mb-3">
        	      <label>Consecutivo:</label>
                  <input readonly='readonly' name='consecutivo' id='consecutivo' value='<?php echo $row['12'] ?>'class='form-control' />
              </div>
              <div class="col-md-5 mb-3">
                <label>Login:</label>
                  <input name='user' id='user' value='<?php echo $userensqlzona ?>' readonly='readonly'class='form-control' /> 		
              </div>
            </div>
            
            <div class="form-row">
              <div class="col-md-10 mb-3" style="margin-top: 10px; margin-bottom: 20px;">
                <label>Observacion:</label>
                  <input value='<?php echo $row['13'] ?>'class='form-control' name='observacion' id='observacion' required/>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-10"  style="margin-bottom: 20px">
                <button type='submit' name='action' id='aceptar' value='aceptar' class='btn btn-primary uno' onclick='return confirmar()'><span class="glyphicon glyphicon-ok"></span> Aceptar</button>
                <button type='submit' name='action' id='rechazar' value='rechazar' class='btn btn-danger uno' onclick='return confirmar2()'><span class="glyphicon glyphicon-remove"></span> Rechazar</button>
              </div>
            </div>
	
        </div><!--Fin div container dentro form-->
 </form>

 <?php } ?>
 </div>
</div><!--Fin div container -->

<script type="text/javascript">
function confirmar()
{
	if(confirm('¿Estás seguro de aceptar el traslado?'))
		return true;
	else
		return false;
}

function confirmar2()
{
	if(confirm('¿Estás seguro de rechazar el traslado?'))
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