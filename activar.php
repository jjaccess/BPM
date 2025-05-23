<?php
	session_start();
	require 'funcs/conexion.php';
	require 'funcs/funcs.php';
	
	if(!isset($_SESSION["id_usuario"])){
		header("Location: index.php");
	}
	
	$idUsuario = $_SESSION['id_usuario'];
	
	$sql = "SELECT id, nombre FROM usuarios WHERE id = '$idUsuario'";
	$result = $mysqli->query($sql);
	
	$row = $result->fetch_assoc();
	
	if(isset($_GET["id"]) AND isset($_GET['val']))
	{
		
		$idUsuario = $_GET['id'];
		$token = $_GET['val'];
		
		$mensaje = validaIdToken($idUsuario, $token);	
	}
?>

<html>
	<head>
		<title>Registro</title>
		
		<link rel="icon" type="image/png" href="img/Bpm.ico" />
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
		<script src="js/bootstrap.min.js" ></script>
		
	</head>
	
	<body>
		<div class="container">
			<div class="jumbotron">
				
				<h1><?php echo $mensaje; ?></h1>
				
				<br />
				<p><a class="btn btn-primary btn-lg" href="index.php" role="button">Iniciar Sesi&oacute;n</a></p>
			</div>
		</div>
	</body>
</html>														