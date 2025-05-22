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

<form class="form-inline formulariolinea" action="asignacionpuntoventa.php" method="get" id="formulario2" name="formulario2" onsubmit="return valida(this)" autocomplete="off" style="text-align: center;">

  <div class="form-group">
      <label>Asignacion a Puntos de venta y/o Dependencia (3):</label>&nbsp;&nbsp;
          <input type="hidden" readonly='readonly' value="<?php echo utf8_decode($rowuser['usuario']);?>" name="user" class=""/>
    	      <?php
    										
              $query5 = $mysqli -> query ("SELECT cod,nombre, responsable FROM ccostos WHERE responsable = '" . $userensqlzona . "'
    		                     AND estado ='1'
    							 GROUP BY cod");
    											
              while ($origen = mysqli_fetch_array($query5)) {
    												
                echo '<input type="hidden" value="'.$origen['cod'].'" name="origen" class=""/>';
    													
              }
            ?> 
          <input name="busqueda" id="busqueda" type="text" class="form-control" placeholder='Ingrese Activo fijo'>

            <div class="form-group">
    	        <button class="btn btn-default" type="submit" value="Buscar"><span class="glyphicon glyphicon-search"> </span></button>
            </div>

  </div>
	</form><br>

<?php  

    $busqueda = $_GET['busqueda'];
  	$user = $_GET['user'];
  	$Origen = $_GET['origen'];

      //comenzamos la consulta 
    $consulta ="SELECT empresas.empresa empresa,
    invti_responsables.clasificacion clasificacion,
    invti_tipoart.tipo tipo,
    invti_responsables.clase clase,
    invti_articulos.articulo articulo,
    invti_marca.marca marca,
    invti_responsables.activo activo,
    invti_responsables.serial serial,
    invti_responsables.estado estado,
    ccostos.NOMBRE ubicacion,
    invti_responsables.RESPONSABLE,
    invti_responsables.id
    FROM invti_responsables, ccostos, empresas, invti_tipoart, invti_articulos, invti_marca
    WHERE invti_responsables.activo = '" . $busqueda . "'
    AND invti_responsables.asigna = 'N' 
    AND ccostos.RESPONSABLE = invti_responsables.RESPONSABLE
    AND empresas.nit = invti_responsables.nit
    AND invti_tipoart.id = invti_responsables.TIPO
    AND invti_articulos.id = invti_responsables.ARTICULO
    AND invti_marca.id = invti_responsables.MARCA
    AND ccostos.cod = '" . $Origen . "'
    AND ccostos.estado = '1'
    GROUP BY id
    " ;
  
 
    $resultado=mysqli_query($mysqli,$consulta);
  
  
    while ($row = mysqli_fetch_row($resultado)){
?>
  
  <form action='Gasignacionpuntoventa.php' method='get' id='formulario' name='formulario' onsubmit='return checkSubmit();' >
   
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
				Traslado a Punto de Venta</dt></h2>	
		<br>

            <div class="form-row">
              <div class="col-md-5 mb-3" style="margin-top: 10px;"> 
                 <label>N° Registro</label>
                    <input readonly='readonly' name='id' id='id' value='<?php echo $row['11'] ?>' class='form-control' />
              </div>
              <div class="col-md-5 mb-3" style="margin-top: 10px;"> 
    	           <label>Articulo:</label>
                    <input disabled=disabled value='<?php echo $row['4'] ?>' class='form-control' />
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-5 mb-3" style="margin-top: 10px;">
    	           <label>Marca:</label>
                    <input disabled=disabled value='<?php echo $row['5'] ?>' class='form-control' />
              </div>
              <div class="col-md-5 mb-3" style="margin-top: 10px;"> 
    	           <label>Serial:</label>
                    <input disabled=disabled value='<?php echo $row['7'] ?>' class='form-control' />
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-5 mb-3" style="margin-top: 10px;">	
    	           <label>Estado:</label>
                    <input disabled=disabled value='<?php echo $row['8'] ?>' class='form-control' />
              </div>
              <div class="col-md-5 mb-3" style="margin-top: 10px;"> 
    	           <label>Ubicacion Actual:</label>
                    <input disabled=disabled value='<?php echo $row['9'] ?>' class='form-control' />
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-5 mb-3" style="margin-top: 10px;">
    	           <label>Codigo Responsable:</label>
                    <input readonly='readonly' value='<?php echo $row['10'] ?>' class='form-control' />	
              </div>
              <div class="col-md-5 mb-3" style="margin-top: 10px;">   
    	           <label>Seleccione donde trasladar activo:</label>
                    <select class="form-control" name='destino' required>
                      <option value=''>Selección:</option>	
                        <?php				
                          $query6 = $mysqli -> query ("SELECT cod,nombre,codccosto 
                          FROM puntosdeventa 
                          WHERE codccosto = '".$Origen ."' 
                          AND estado = 1
                          GROUP BY cod");										
                          while ($destino = mysqli_fetch_array($query6)) {									
                            echo '<option value="'.$destino['cod'].'" >'.$destino['nombre'].'</option>';												
                          }
                        ?>
    	              </select>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-5 mb-3" style="margin-top: 10px;"> 
    	           <label>Activo fijo:</label>
                    <input name='activo' id='activo' value='<?php echo $busqueda ?>' readonly='readonly' class='form-control' /> 
              </div> 
              <div class="col-md-5 mb-3" style="margin-top: 10px;"> 
    	           <label>Login:</label>
                    <input name='user' id='user' value='<?php echo $user ?>' readonly='readonly' class='form-control' />
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-10 mb-3" style="margin-bottom: 20px; margin-top: 10px;"> 
    	           <label>Obervacion:</label>
                    <input name='observacion' id='observacion' value='' class='form-control' required/> 
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-5 col-sm-10" style="margin-bottom: 20px;">
	               <button type='submit' name='enviar' id='enviar' value='Grabar' class='btn btn-primary' onclick='return confirmar()'><span class="glyphicon glyphicon-ok"></span> Asignar</button>
              </div>
            </div>

      </div><!-- fin div container dentro form-->

 </form>
 <?php } ?>
 <?php } ?>
 </div>
</div><!-- fin div container-->

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