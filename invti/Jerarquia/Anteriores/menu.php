<?php
	session_start();

	require '../../funcs/connect.php';

	
	if(!isset($_SESSION["id_usuario"])){
		header("Location: ../../index.php");
	}
	
	$now = time();
	if($now > $_SESSION['expire']) {
	session_destroy();

	echo "Su sesion a terminado";
	header('Location: ../../index.php');
	exit;
	}
	
	$idempresa = $_SESSION['id_empresa'];
	
	$sqlempresa = "SELECT empresa, nit FROM empresas WHERE identificador = '$idempresa'";
	$resultempresa = $mysqli->query($sqlempresa);
	$rowempresa = $resultempresa->fetch_assoc();		
	
	$idUsuario = $_SESSION['id_usuario'];
	
	$sql = "SELECT id, usuario, nombre FROM usuarios WHERE id = '$idUsuario'";
	$result = $mysqli->query($sql);
	
	$rowuser = $result->fetch_assoc();
	$userensqlzona = utf8_decode($rowuser['usuario']);


?>
<link rel="icon" type="image/png" href="../../img/Supergiros.ico" />  
<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==4  || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==11 || $_SESSION['tipo_usuario']==12 || $_SESSION['tipo_usuario']==13 || $_SESSION['tipo_usuario']==17 || $_SESSION['tipo_usuario']==14 || $_SESSION['tipo_usuario']==15 || $_SESSION['tipo_usuario']==16) { ?>	
<body>
<!-- Encabezado -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  				<div class="container">
   						<a class="nav-link" href="#">
						   <img src="../../img/logoSG.png" alt="" width="170px"> 
						   <small><code style="color: #3333ff"><span class="fas fa-code-branch" style="color: #3333ff"></span> <?php include('../version.php');?></code></small>
						</a>
						<a class="nav-link" style="color: #ffffff"><span class="fas fa-user"></span> <?php echo $rowuser['nombre']; ?></a>
						<a class="nav-link"  style="color: #ffffff" ><span class="fas fa-database"></span> <?php echo $rowempresa['empresa']; ?></a>
  				</div>
</nav>	
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #FAFAFA;">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
	  <ul class="navbar-nav mr-auto">
	  <li class="nav-item active">
	 	 <a class="nav-link" href="../principal.php">
	  		<span class="fas fa-home"></span>Inicio</a>
		</li>

<!-- Menu jerarquias -->
<?php if($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==15) { ?>
			<li class="nav-item dropdown">
		 	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Jerarquía 
			 </a>
			 <span class="sr-only">(current)</span></a>
			 <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			<?php if($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==15) { ?>
			        <a class="dropdown-item" href="../Jerarquia/bodega.php">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  					<path fill-rule="evenodd" d="M4 1h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H4z"/>
  					<path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"/>
			</svg>&nbsp;Nueva bodega</a>
			<?php } ?>

			<?php if($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==15) { ?>
					<a class="dropdown-item" href="../Jerarquia/bodega2.php">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pen" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M5.707 13.707a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391L10.086 2.5a2 2 0 0 1 2.828 0l.586.586a2 2 0 0 1 0 2.828l-7.793 7.793zM3 11l7.793-7.793a1 1 0 0 1 1.414 0l.586.586a1 1 0 0 1 0 1.414L5 13l-3 1 1-3z"/>
  <path fill-rule="evenodd" d="M9.854 2.56a.5.5 0 0 0-.708 0L5.854 5.855a.5.5 0 0 1-.708-.708L8.44 1.854a1.5 1.5 0 0 1 2.122 0l.293.292a.5.5 0 0 1-.707.708l-.293-.293z"/>
  <path d="M13.293 1.207a1 1 0 0 1 1.414 0l.03.03a1 1 0 0 1 .03 1.383L13.5 4 12 2.5l1.293-1.293z"/>
</svg>&nbsp;Crear responsable</a>
			<?php } ?>

			<?php if($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==15) { ?>
					<a class="dropdown-item" href="../Jerarquia/bodega3.php">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bag-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M14 5H2v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5zM1 4v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4H1z"/>
  <path d="M8 1.5A2.5 2.5 0 0 0 5.5 4h-1a3.5 3.5 0 1 1 7 0h-1A2.5 2.5 0 0 0 8 1.5z"/>
  <path fill-rule="evenodd" d="M10.854 7.646a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 10.293l2.646-2.647a.5.5 0 0 1 .708 0z"/>
</svg>&nbsp;Crear dependencia</a>
			<?php } ?>

			<?php if($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==15) { ?>
					<a class="dropdown-item" href="../Jerarquia/cambiotitular1.php">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bag-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M14 5H2v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5zM1 4v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4H1z"/>
  <path d="M8 1.5A2.5 2.5 0 0 0 5.5 4h-1a3.5 3.5 0 1 1 7 0h-1A2.5 2.5 0 0 0 8 1.5z"/>
  <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z"/>
  <path fill-rule="evenodd" d="M7.5 10a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-2z"/>
</svg>&nbsp;Cambio titular bodega</a>
			<?php } ?>

			<?php if($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==15) { ?>
					<a class="dropdown-item" href="../Jerarquia/cambiotitular2.php">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-basket" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M10.243 1.071a.5.5 0 0 1 .686.172l3 5a.5.5 0 1 1-.858.514l-3-5a.5.5 0 0 1 .172-.686zm-4.486 0a.5.5 0 0 0-.686.172l-3 5a.5.5 0 1 0 .858.514l3-5a.5.5 0 0 0-.172-.686z"/>
  <path fill-rule="evenodd" d="M1 7v1h14V7H1zM.5 6a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 .5.5h15a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 0-.5-.5H.5z"/>
  <path fill-rule="evenodd" d="M14 9H2v5a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V9zM2 8a1 1 0 0 0-1 1v5a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V9a1 1 0 0 0-1-1H2z"/>
  <path fill-rule="evenodd" d="M4 10a.5.5 0 0 1 .5.5v3a.5.5 0 1 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 1 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 1 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 1 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 1 1-1 0v-3a.5.5 0 0 1 .5-.5z"/>
</svg>	&nbsp;Cambio titular responsable</a>
			<?php } ?>

			        </div>
			    </li>
			<?php } ?>	

		<!-- Menu Articulos -->
		<?php if($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==15) { ?>
			<li class="nav-item dropdown">
		 	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Articulos 
			 </a>
			 <span class="sr-only">(current)</span></a>
			 <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			<?php if($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==15) { ?>
			        <a class="dropdown-item" href="../Registros/registro.php">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  					<path fill-rule="evenodd" d="M4 1h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H4z"/>
  					<path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"/>
			</svg>&nbsp;Nuevo Articulo</a>
			<?php } ?>

			<?php if($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==15) { ?>
					<a class="dropdown-item" href="../Actualizar/updatearticulos.php">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pen" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M5.707 13.707a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391L10.086 2.5a2 2 0 0 1 2.828 0l.586.586a2 2 0 0 1 0 2.828l-7.793 7.793zM3 11l7.793-7.793a1 1 0 0 1 1.414 0l.586.586a1 1 0 0 1 0 1.414L5 13l-3 1 1-3z"/>
  <path fill-rule="evenodd" d="M9.854 2.56a.5.5 0 0 0-.708 0L5.854 5.855a.5.5 0 0 1-.708-.708L8.44 1.854a1.5 1.5 0 0 1 2.122 0l.293.292a.5.5 0 0 1-.707.708l-.293-.293z"/>
  <path d="M13.293 1.207a1 1 0 0 1 1.414 0l.03.03a1 1 0 0 1 .03 1.383L13.5 4 12 2.5l1.293-1.293z"/>
</svg>&nbsp;Actualizar Articulos</a>
			<?php } ?>

			<?php if($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==15) { ?>
					<a class="dropdown-item" href="../Articulos/articulos.php">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bag-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M14 5H2v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5zM1 4v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4H1z"/>
  <path d="M8 1.5A2.5 2.5 0 0 0 5.5 4h-1a3.5 3.5 0 1 1 7 0h-1A2.5 2.5 0 0 0 8 1.5z"/>
  <path fill-rule="evenodd" d="M10.854 7.646a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 10.293l2.646-2.647a.5.5 0 0 1 .708 0z"/>
</svg>&nbsp;Crear Articulos</a>
			<?php } ?>

			<?php if($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==15) { ?>
					<a class="dropdown-item" href="../Articulos/marcas.php">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bag-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M14 5H2v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5zM1 4v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4H1z"/>
  <path d="M8 1.5A2.5 2.5 0 0 0 5.5 4h-1a3.5 3.5 0 1 1 7 0h-1A2.5 2.5 0 0 0 8 1.5z"/>
  <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z"/>
  <path fill-rule="evenodd" d="M7.5 10a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-2z"/>
</svg>&nbsp;Crear Marca</a>
			<?php } ?>

			<?php if($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==15) { ?>
					<a class="dropdown-item" href="../Articulos/clase.php">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-basket" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M10.243 1.071a.5.5 0 0 1 .686.172l3 5a.5.5 0 1 1-.858.514l-3-5a.5.5 0 0 1 .172-.686zm-4.486 0a.5.5 0 0 0-.686.172l-3 5a.5.5 0 1 0 .858.514l3-5a.5.5 0 0 0-.172-.686z"/>
  <path fill-rule="evenodd" d="M1 7v1h14V7H1zM.5 6a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 .5.5h15a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 0-.5-.5H.5z"/>
  <path fill-rule="evenodd" d="M14 9H2v5a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V9zM2 8a1 1 0 0 0-1 1v5a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V9a1 1 0 0 0-1-1H2z"/>
  <path fill-rule="evenodd" d="M4 10a.5.5 0 0 1 .5.5v3a.5.5 0 1 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 1 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 1 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 1 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 1 1-1 0v-3a.5.5 0 0 1 .5-.5z"/>
</svg>	&nbsp;Crear Clase</a>
			<?php } ?>

			        </div>
			    </li>
			<?php } ?>	

			<!-- Menu Asignaciones -->
			<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==12 || $_SESSION['tipo_usuario']==13 || $_SESSION['tipo_usuario']==17 || $_SESSION['tipo_usuario']==11 || $_SESSION['tipo_usuario']==14 || $_SESSION['tipo_usuario']==15 || $_SESSION['tipo_usuario']==16) { ?>
				<li class="nav-item dropdown">
		 	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Asignaciones 
			 </a>
			 <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==15) { ?>
			        	<a class="dropdown-item" href="../Actualizar/updatezona.php">1- Traslado a otra Bodega</a>
			<?php } ?>
			<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==15) { ?>
						<a class="dropdown-item" href="../Traslados/consulta_trasladosbod_bod.php">1- Recibir de otra bodega</a>
			<?php } ?>
			<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==15) { ?>
			        	<a class="dropdown-item" href="../Asignaciones/asignacionresponsable.php">2- Traslado a responsable</a>
			<?php } ?>
			<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==12 || $_SESSION['tipo_usuario']==13 || $_SESSION['tipo_usuario']==17 || $_SESSION['tipo_usuario']==11 || $_SESSION['tipo_usuario']==14 || $_SESSION['tipo_usuario']==15 || $_SESSION['tipo_usuario']==16) { ?>
						<a class="dropdown-item" href="../Traslados/consulta_trasladosbod_res.php">2- Recibir de bodega</a>
			<?php } ?>
			<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==12 || $_SESSION['tipo_usuario']==13 || $_SESSION['tipo_usuario']==17 || $_SESSION['tipo_usuario']==11 || $_SESSION['tipo_usuario']==14 || $_SESSION['tipo_usuario']==15 || $_SESSION['tipo_usuario']==16) { ?>
						<a class="dropdown-item" href="../Asignaciones/asignacionpuntoventa.php">3- Traslado a Puntos de venta y/o Dependencia (3)</a>
			<?php } ?>
					</div>
			    </li>
			<?php } ?>

			<!-- Menu Devoluciones -->
			<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==12 || $_SESSION['tipo_usuario']==13 || $_SESSION['tipo_usuario']==17 || $_SESSION['tipo_usuario']==11 || $_SESSION['tipo_usuario']==14 || $_SESSION['tipo_usuario']==15 || $_SESSION['tipo_usuario']==16) { ?>
				<li class="nav-item dropdown">
		 	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Devoluciones 
			 </a>
			 <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==12 || $_SESSION['tipo_usuario']==13 || $_SESSION['tipo_usuario']==17 || $_SESSION['tipo_usuario']==11 || $_SESSION['tipo_usuario']==14 || $_SESSION['tipo_usuario']==15 || $_SESSION['tipo_usuario']==16) { ?>
			        <a class="dropdown-item" href="../Devoluciones/devolucion_a_responsable.php">3- Devolución a Responsable</a>
			<?php } ?>
			<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==12 || $_SESSION['tipo_usuario']==13 || $_SESSION['tipo_usuario']==17 || $_SESSION['tipo_usuario']==11 || $_SESSION['tipo_usuario']==14 || $_SESSION['tipo_usuario']==15 || $_SESSION['tipo_usuario']==16) { ?>
					<a class="dropdown-item" href="../Devoluciones/devolucion_a_bodega.php">2- Devolución a Bodega</a>
			<?php } ?>
			<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==3|| $_SESSION['tipo_usuario']==15) { ?>
					<a class="dropdown-item" href="../Traslados/consulta_trasladosres_bod.php">1- Recibir devolución de Responsable</a>
			<?php } ?>
			        </div>
			    </li>
			<?php } ?>

			<!-- Menu Consultas -->
			<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==4  || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==11 || $_SESSION['tipo_usuario']==12 || $_SESSION['tipo_usuario']==13 || $_SESSION['tipo_usuario']==17 || $_SESSION['tipo_usuario']==14 || $_SESSION['tipo_usuario']==15 || $_SESSION['tipo_usuario']==16) { ?>
			<li class="nav-item dropdown">
		 	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Consultas 
			 </a>
			 <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==12 || $_SESSION['tipo_usuario']==13 || $_SESSION['tipo_usuario']==17 || $_SESSION['tipo_usuario']==11 || $_SESSION['tipo_usuario']==14 || $_SESSION['tipo_usuario']==15 || $_SESSION['tipo_usuario']==16) { ?>
					<a class="dropdown-item" href="../Traslados/mistraslados.php">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-checklist" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
  <path fill-rule="evenodd" d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
</svg>&nbsp;Mis Traslados</a>
			<?php } ?>	  

			<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==4  || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==11 || $_SESSION['tipo_usuario']==12 || $_SESSION['tipo_usuario']==13 || $_SESSION['tipo_usuario']==17 || $_SESSION['tipo_usuario']==14 || $_SESSION['tipo_usuario']==15 || $_SESSION['tipo_usuario']==16) { ?>
				  <a class="dropdown-item" href="../Movimientos/movimientos.php">
				  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-book" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M3.214 1.072C4.813.752 6.916.71 8.354 2.146A.5.5 0 0 1 8.5 2.5v11a.5.5 0 0 1-.854.354c-.843-.844-2.115-1.059-3.47-.92-1.344.14-2.66.617-3.452 1.013A.5.5 0 0 1 0 13.5v-11a.5.5 0 0 1 .276-.447L.5 2.5l-.224-.447.002-.001.004-.002.013-.006a5.017 5.017 0 0 1 .22-.103 12.958 12.958 0 0 1 2.7-.869zM1 2.82v9.908c.846-.343 1.944-.672 3.074-.788 1.143-.118 2.387-.023 3.426.56V2.718c-1.063-.929-2.631-.956-4.09-.664A11.958 11.958 0 0 0 1 2.82z"/>
  <path fill-rule="evenodd" d="M12.786 1.072C11.188.752 9.084.71 7.646 2.146A.5.5 0 0 0 7.5 2.5v11a.5.5 0 0 0 .854.354c.843-.844 2.115-1.059 3.47-.92 1.344.14 2.66.617 3.452 1.013A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.276-.447L15.5 2.5l.224-.447-.002-.001-.004-.002-.013-.006-.047-.023a12.582 12.582 0 0 0-.799-.34 12.96 12.96 0 0 0-2.073-.609zM15 2.82v9.908c-.846-.343-1.944-.672-3.074-.788-1.143-.118-2.387-.023-3.426.56V2.718c1.063-.929 2.631-.956 4.09-.664A11.956 11.956 0 0 1 15 2.82z"/>
</svg>&nbsp;Ver Movimientos</a>
			<?php } ?>

			<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==4  || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==11 || $_SESSION['tipo_usuario']==12 || $_SESSION['tipo_usuario']==13 || $_SESSION['tipo_usuario']==17 || $_SESSION['tipo_usuario']==14 || $_SESSION['tipo_usuario']==15 || $_SESSION['tipo_usuario']==16) { ?>
					<a class="dropdown-item" href="../Buscar/buscar_art.php">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
  <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
</svg>&nbsp;Buscar Articulos por activo</a>
			<?php } ?>

			<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==4  || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==11 || $_SESSION['tipo_usuario']==12 || $_SESSION['tipo_usuario']==13 || $_SESSION['tipo_usuario']==17 || $_SESSION['tipo_usuario']==14 || $_SESSION['tipo_usuario']==15 || $_SESSION['tipo_usuario']==16) { ?>
					<a class="dropdown-item" href="../Buscar/buscar_art2.php">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-binoculars" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M3 2.5A1.5 1.5 0 0 1 4.5 1h1A1.5 1.5 0 0 1 7 2.5V5h2V2.5A1.5 1.5 0 0 1 10.5 1h1A1.5 1.5 0 0 1 13 2.5v2.382a.5.5 0 0 0 .276.447l.895.447A1.5 1.5 0 0 1 15 7.118V14.5a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 14.5v-3a.5.5 0 0 1 .146-.354l.854-.853V9.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v.793l.854.853A.5.5 0 0 1 7 11.5v3A1.5 1.5 0 0 1 5.5 16h-3A1.5 1.5 0 0 1 1 14.5V7.118a1.5 1.5 0 0 1 .83-1.342l.894-.447A.5.5 0 0 0 3 4.882V2.5zM4.5 2a.5.5 0 0 0-.5.5V3h2v-.5a.5.5 0 0 0-.5-.5h-1zM6 4H4v.882a1.5 1.5 0 0 1-.83 1.342l-.894.447A.5.5 0 0 0 2 7.118V13h4v-1.293l-.854-.853A.5.5 0 0 1 5 10.5v-1A1.5 1.5 0 0 1 6.5 8h3A1.5 1.5 0 0 1 11 9.5v1a.5.5 0 0 1-.146.354l-.854.853V13h4V7.118a.5.5 0 0 0-.276-.447l-.895-.447A1.5 1.5 0 0 1 12 4.882V4h-2v1.5a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V4zm4-1h2v-.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5V3zm4 11h-4v.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5V14zm-8 0H2v.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5V14z"/>
</svg>&nbsp;Buscar Articulos por serial</a>
			<?php } ?>
				 </div>
			    </li>
			<?php } ?>

			<!-- Menu Reportes -->
			<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==4  || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==11 || $_SESSION['tipo_usuario']==12 || $_SESSION['tipo_usuario']==13 || $_SESSION['tipo_usuario']==17 || $_SESSION['tipo_usuario']==14 || $_SESSION['tipo_usuario']==15 || $_SESSION['tipo_usuario']==16) { ?>
				<li class="nav-item dropdown">
		 	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Reportes 
			 </a>
			 <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==15  || $_SESSION['tipo_usuario']==3) { ?>
				    <a class="dropdown-item" href="../Kardex/kardexxzona.php">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-table" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
</svg>&nbsp;Reporte 5 - Consultar mi bodega</a>
			<?php } ?>

			<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==15  || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==11 || $_SESSION['tipo_usuario']==12 || $_SESSION['tipo_usuario']==13 || $_SESSION['tipo_usuario']==17 || $_SESSION['tipo_usuario']==14 || $_SESSION['tipo_usuario']==16) { ?>
					<a class="dropdown-item" href="../Kardex/kardexxpersona.php">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-table" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
</svg>&nbsp;Reporte 6 - Consultar Mis Registros</a>
			<?php } ?>

			<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==15  || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==11 || $_SESSION['tipo_usuario']==12 || $_SESSION['tipo_usuario']==13 || $_SESSION['tipo_usuario']==17 || $_SESSION['tipo_usuario']==14 || $_SESSION['tipo_usuario']==16) { ?>
					<a class="dropdown-item" href="../Kardex/kardexxpdv.php">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-table" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
</svg>&nbsp;Reporte 7 - Consultar mis puntos de venta (3)</a>
			<?php } ?>

			<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==15  || $_SESSION['tipo_usuario']==16) { ?>
				    <a class="dropdown-item" href="../Kardex/kardexxzona2.php">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-table" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
</svg>&nbsp;Reporte 8 - Consultar por codigo bodega</a>
			<?php } ?>

			<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==15  || $_SESSION['tipo_usuario']==16) { ?>
					<a class="dropdown-item" href="../Kardex/kardexxpersona2.php">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-table" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
</svg>&nbsp;Reporte 9 - Consultar por codigo responsable</a>
			<?php } ?>

			<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==15  || $_SESSION['tipo_usuario']==16) { ?>
					<a class="dropdown-item" href="../Kardex/kardexxpdv2.php">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-table" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
</svg>&nbsp;Reporte 10 - Consultar por codigo puntos de venta</a>
			<?php } ?>

			<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==15  || $_SESSION['tipo_usuario']==3) { ?>
					<a class="dropdown-item" href="../Kardex/kardexxpersona3.php">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-table" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
</svg>&nbsp;Reporte 11 - Consultar mis dependencias (2)</a>
			<?php } ?>
				 </div>
			    </li>
			<?php } ?>

			<!-- Menu Acerca de -->
			<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==4  || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==11 || $_SESSION['tipo_usuario']==12 || $_SESSION['tipo_usuario']==13 || $_SESSION['tipo_usuario']==17 || $_SESSION['tipo_usuario']==14 || $_SESSION['tipo_usuario']==15 || $_SESSION['tipo_usuario']==16) { ?>
				<li class="nav-item">
   				     <a class="nav-link" data-toggle="modal" data-target="#modalAcercaDe" href="#">Acerca De</a>
      			</li>
			<?php } ?>
    

			<!-- Menu Volver -->
			<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==4  || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==11 || $_SESSION['tipo_usuario']==12 || $_SESSION['tipo_usuario']==13 || $_SESSION['tipo_usuario']==17 || $_SESSION['tipo_usuario']==14 || $_SESSION['tipo_usuario']==15 || $_SESSION['tipo_usuario']==16) { ?>

				<li class="nav-item">
  			      <a class="nav-link" href="../../welcome.php"><span class="glyphicon glyphicon-repeat"></span>Volver</a>
   			   </li>
			<?php } ?>
			<li class="nav-item">
            <a class="nav-link" href="#" style="color: red" onclick="cerrar();">
			<span class="fas fa-power-off"></span> Salir
            </a>
          </li>


		</ul>
		</div>
		</nav>
		
		<script type="text/javascript">  
  function cerrar()
{

	swal({
  title: "Cerrar sesión",
  text: "Está seguro de salir del aplicativo?",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
window.location.href='../logout.php';
  } else {
  }
});


}
</script>
</body>
</html>
<?php } ?>