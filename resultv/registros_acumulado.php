<?php
	session_start();
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
		<a class="volver"  href="config_acumulado.php" title="volver">Volver a Insertar</a>
		<table style="margin: 0 auto;">

			<tbody>
				
				<tr>
					<thead>
					<th>ID</th>
					<th>CODIGO</th>
					<th>NOMBRE PRODUCTO</th>
					<th>ACUMULADO</th>
					<th>FECHA REGISTRO</th>
					<th>USUARIO</th>			

					</thead>
				</tr>
			<?php
			


			$query= "SELECT msg_tv.id id, msg_tv.productocod cod, productos_msgtv.producto producto, FORMAT(msg_tv.acumulado, 0) acumulado, msg_tv.fechareg fechareg, msg_tv.loginuser user
FROM msg_tv, productos_msgtv
where productos_msgtv.cod = msg_tv.productocod ORDER BY msg_tv.fechareg DESC LIMIT 5";
			$resultado= $mysqli->query($query);
			while($row=$resultado->fetch_assoc()){
			?>

			<tr>
				
				<td><?php echo $row['id']; ?></td>
				<td><?php echo $row['cod']; ?></td>
				<td><?php echo $row['producto']; ?></td>
				<td><?php echo '$'.$row['acumulado']; ?></td>
				<td><?php echo $row['fechareg']; ?></td>
				<td><?php echo $row['user']; ?></td>
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
