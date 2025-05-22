<?php
session_start();

if(!isset($_SESSION["id_usuario"])){
	header("Location: ../../index.php");
}
	
  require '../../funcs/funcs.php';
	require '../../funcs/Conexion.php';
	$conexion = new Conectar();
	$mysqli = $conexion->conexion();


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
<form class="form-inline formulariolinea" action="devolucion_a_responsable.php" method="get" id="formulario2" name="formulario2" autocomplete="off" onsubmit="return valida(this)" style="text-align: center;">

  <div class="form-group">
    <label>Devolucion a responsable:</label>
        <input type="hidden" readonly='readonly' value="<?php echo utf8_decode($rowuser['usuario']);?>" name="user" class=""/>
        <input name="busqueda" id="busqueda" type="text" class="form-control" placeholder='Ingrese Activo fijo'>
      <div class="form-group">
  	     <button class="btn btn-default" type="submit" value="Buscar"><span class="glyphicon glyphicon-search"></span></button>
      </div>
  </div>

	</form><br>

<?php  
    $busqueda = $_GET['busqueda'];
	  $user = $_GET['user'];
  //comenzamos la consulta 
      $consulta ="SELECT empresas.empresa empresa,
    invti_puntosventa.clasificacion clasificacion,
    invti_tipoart.tipo tipo,
    invti_puntosventa.clase clase,
    invti_articulos.articulo articulo,
    invti_marca.marca marca,
    invti_puntosventa.activo activo,
    invti_puntosventa.serial serial,
    invti_puntosventa.estado estado,
    puntosdeventa.NOMBRE ubicacion,
    invti_puntosventa.sucursal,
    invti_puntosventa.id
    FROM invti_puntosventa, puntosdeventa, empresas, invti_tipoart, invti_articulos, invti_marca
    WHERE invti_puntosventa.activo = '" . $busqueda . "'
    AND invti_puntosventa.asigna = 'N' 
    AND puntosdeventa.cod = invti_puntosventa.sucursal
    AND empresas.nit = invti_puntosventa.nit
    AND invti_tipoart.id = invti_puntosventa.TIPO
    AND invti_articulos.id = invti_puntosventa.ARTICULO
    AND invti_marca.id = invti_puntosventa.MARCA
    GROUP BY id
    " ;
      
     
      $resultado=mysqli_query($mysqli,$consulta);
      
      
     while ($row = mysqli_fetch_row($resultado)){

?>
  
  <form action='Gdevolucionccosto.php' method='get' id='formulario' name='formulario' onsubmit='return checkSubmit();' >

          <div class="container">
          <?php echo resultActivoError($errors); ?>
		<?php echo resultActivoSuccess($creado); ?>
    
    <?php if(count($errors) == 0)
   { ?>

         	  <h3><dt>Devolución a Responsable</dt></h3>

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
                  	  <label>Estado Actual:</label>
                         <input disabled=disabled value='<?php echo $row['8'] ?>' class='form-control' />
                    </div>
                    <div class="col-md-5 mb-3" style="margin-top: 10px;">
                  	  <label>Ubicacion Actual:</label>
                         <input disabled=disabled value='<?php echo $row['9'] ?>' class='form-control' />
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-5 mb-3" style="margin-top: 10px;">
                  	  <label>Codigo Punto de Venta:</label>
                         <input readonly='readonly' id='origen' name='origen' value='<?php echo $row['10'] ?>' class='form-control' />
                    </div>
                    <div class="col-md-5 mb-3" style="margin-top: 10px;">	  
                  	  <label>Seleccione Responsable:</label>
                        <select class="form-control" name='destino' required>
                          <option value=''>Selección:</option>	
                            <?php				
                              $query6 = $mysqli -> query ("
                          		  select ccostos.RESPONSABLE cod, usuarios.nombre nombre FROM puntosdeventa,ccostos,usuarios 
                          		  WHERE ccostos.RESPONSABLE = '".$user ."'
                          		  and puntosdeventa.CODCCOSTO = ccostos.COD
                          		  and puntosdeventa.COD = '".$row['10']."'
                          		  and ccostos.responsable = usuarios.usuario
                          		  and ccostos.estado = '1'
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
                  <div class="col-md-5 mb-3" style="margin-top: 10px;">	  
                  	  <label>Confirme el estado del artículo:</label>
                        <select class="form-control" name='estado_2' required>
                          <option value=''>Selección:</option>	
                            <?php				
                              $query6 = $mysqli -> query ("
                          		  SELECT * FROM estado_art");										
                                  while ($destino = mysqli_fetch_array($query6)) {									
                                    echo '<option value="'.$destino['estado'].'" >'.$destino['estado'].'</option>';												
                              }
                            ?>
                  	    </select>
                    </div>   
                    </div>
                 <div class="form-row">
                    <div class="col-md-10 mb-3" style="margin-top: 10px; margin-bottom: 20px">
                  	<label>Motivo de la devolución:</label>
                        <input name='observacion' id='observacion' value='' class='form-control' required /> 
                    </div>
                  </div>

                <div class="form-group">
                  <div class="col-sm-offset-5 col-sm-10" style="margin-bottom: 20px;">
                  	<button type='submit' name='enviar' id='enviar' value='Grabar' class='btn btn-primary' onclick='return confirmar()'><span class="glyphicon glyphicon-floppy-disk"></span> Aceptar</button>
                  </div>
                </div>

          </div><!--fin div container form-->       

 </form>

<?php } ?>
<?php } ?>
</div><!--fin div container-->
<script type="text/javascript">
function confirmar()
{
	if(confirm('¿Estas seguro de trasladar el artículo?'))
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