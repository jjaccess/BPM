<?php
	session_start();

	require '../funcs/funcs.php';
	require '../funcs/Conexion.php';
	$conexion = new Conectar();
	$mysqli = $conexion->conexion();
	
	if(!isset($_SESSION["id_usuario"])){
		header("Location: ../index.php");
	}
	
	$now = time();
	if($now > $_SESSION['expire']) {
	session_destroy();

	echo "Su sesion a terminado";
	header('Location: ../index.php');
	exit;
	}
	
	$idUsuario = $_SESSION['id_usuario'];
	
	$sql = "SELECT id, usuario, nombre FROM usuarios WHERE id = '$idUsuario'";
	$result = $mysqli->query($sql);
	
	$row = $result->fetch_assoc();
?>
<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==11) { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BPM</title>
<link rel="icon" type="image/png" href="../img/Supergiros.ico" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="title" content="Demo de jQuery Data Picker" />
	<meta name="description" content="Demo de jQuery Data Picker" />
	<meta name="keywords" content="Demo, calendario, Data Picker" />
	<meta name="author" content="Emenia" />
	<link href="style.css" tyoe="text/css" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.2.custom.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
 	<script type="text/javascript">
jQuery(function($){
	$.datepicker.regional['es'] = {
		closeText: 'Cerrar',
		prevText: '&#x3c;Ant',
		nextText: 'Sig&#x3e;',
		currentText: 'Hoy',
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
		'Jul','Ago','Sep','Oct','Nov','Dic'],
		dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
		dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
		weekHeader: 'Sm',
		dateFormat: 'yy/mm/dd',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['es']);
});    

        $(document).ready(function() {
           $("#datepicker").datepicker();
        });
    </script>
    </head>
<body>
	<div id="header">
		<h1>LOGO</h1>
	</div>
    <div id="board-container">
<div id="board-weekly">
          <p>&nbsp;</p>
          <p>&nbsp;</p>
		  <p>&nbsp;</p>
<?php echo 'Bienvenid@ '.($row['nombre']); echo'  - Business Processes Module'?>
<br><?php echo 'Login:  '.($row['usuario']);?>
		  <p>&nbsp;</p>
<form action='insertar.php' method='POST' onsubmit="return valida()" autocomplete="off">
	<div><input type='text' autocomplete="off" onchange='carga(this.id)' id="codigo" name='codigo' 
			value="<?php if(isset($_GET['codigo'])){traerLot($_GET['codigo'],'CODIGO');} ?>"
	/> Codigo Loteria</div>
	<div><input type='text' autocomplete="off" name='nombre' value="<?php if(isset($_GET['codigo'])){traerLot($_GET['codigo'],'NOMBRE_LOTERIA');} ?>" /> Nombre Loteria</div>
    <div><input type="text" autocomplete="off" name="datepicker" id="datepicker" readonly="readonly" name='fecha'/> Fecha Sorteo</div>
    <div><input type='text' autocomplete="off" required name='resultado' id="result" /> Resultado</div>
    <div><input type='text' name='user'/ value="<?php echo $row['usuario']?>" readonly="readonly"> Usuario Registro</div>
  <div><select name="Dia">
<optgroup label="Dia" name= 'Dia'>
<option value="LUN">Lunes</option>
<option value="MAR">Martes</option>
<option value="MIE">Miercoles</option>
<option value="JUE">Jueves</option>
<option value="VIE">Viernes</option>
<option value="SAB">Sabado</option>
<option value="DOM">Domingo</option>
</optgroup>
</select>
<br>
<br>
  </div>
	<div><input type='submit' name='insert' value='Insertar registro' onclick='return confirmar()' /></div>
</form>
<p>
<script type="text/javascript">
    
  function valida(){
    
    console.log();
    if ($('#datepicker').val() == "") {
        alert('El campo FECHA SORTEO no puede estar vacio');
        return false;
    }  

}
</script>
<script type="text/javascript">
  function carga(id){
    
    window.location.href="principal.php?codigo="+ document.getElementById(id).value;
  }
function confirmar()
{
	if(confirm('�Estas seguro de actualizar el registro?'))
		return true;
	else
		return false;
}
</script>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><a class="boton" href="../welcome.php" title="volver">Volver</a>
<a class="boton" href="eliminar.php"  title="eliminar">Eliminar Registros</a>
<a class="boton" href="config_acumulado.php" title="Acumulado">Config Acumulado</a>
<a class="boton" href="logout.php" title="cerrar">Cerrar Sesi&oacute;n</a>

<br><br>
</div>
</div>
</body>
</html>
<?php } ?>