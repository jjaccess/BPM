<?php
	require '../funcs/Conexion.php';
	$conexion = new Conectar();
	$mysqli = $conexion->conexion();
	require '../funcs/funcs.php';
	
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
<html>
<head>
	<title>BPM</title>
	<link rel="icon" type="image/png" href="Supergiros.ico" />
	<link href="css/tabla.css" type="text/css" rel="stylesheet"/>
	<!script rel="javascript" type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>

	<h1>LOGO</h1>

	<H2>REGISTROS</H2>

	<!tabla con datos....>
	<div class="datagrid">
		<a class="volver"  href="principal.php" title="volver">Volver a Insertar</a>
		<table style="margin: 0 auto;">

			<tbody>
				
				<tr>
					<thead>

					<th>CODIGO</th>
					<th>NOMBRE LOTERIA</th>
					<th>FECHA SORTEO</th>
					<th>RESULTADO</th>
					<th>FECHA REGISTRO</th>
					<th>USUARIO</th>
					<th>DIA</th>
					<th>OPERACION</th>					

					</thead>
				</tr>
			<?php
			


			$query= "SELECT * FROM resultv_resultados ORDER BY FECHAREGISTRO DESC LIMIT 20";
			$resultado= $mysqli->query($query);
			while($row=$resultado->fetch_assoc()){
			?>

			<tr>
				
				<td><?php echo $row['CODIGO']; ?></td>
				<td><?php echo $row['NOMBRE_LOTERIA']; ?></td>
				<td><?php echo $row['FECHA_SORTEO']; ?></td>
				<td><?php echo $row['RESULTADO']; ?></td>
				<td><?php echo $row['FECHAREGISTRO']; ?></td>
				<td><?php echo $row['USUARIOREGISTRO']; ?></td>
				<td><?php echo $row['DIA']; ?></td>
				<td><a class = eliminar href="proceso_borrar.php?id=<?php echo $row['ID']; ?>" onclick='return confirmar()'>Eliminar</td>

			</tr>
<script type="text/javascript">

function confirmar()
{
	if(confirm('¿Estas seguro de eliminar el registro?'))
		return true;
	else
		return false;
}
</script>
			<?php
				}
			?>

			</tbody>

		</table>

		</div>

</body>
</html>
<?php } ?>
