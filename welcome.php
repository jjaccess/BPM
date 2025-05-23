<?php
session_start();

if(!isset($_SESSION["id_usuario"])){
	header("Location: index.php");
}

require_once 'funcs/Conexion.php';
$conexion = new Conectar();
$mysqli = $conexion->conexion();

	require 'funcs/funcs.php';
	include "header.php";
	

	$tipousuario = $_SESSION['tipo_usuario'];
	$idempresa = $_SESSION['id_empresa'];
	$idUsuario = $_SESSION['id_usuario'];
	
	$sql = "SELECT id, usuario, nombre, password_request FROM usuarios WHERE id = '$idUsuario'";
	$result = $mysqli->query($sql);
	$row = $result->fetch_assoc();
	$idCategoria = $row['id'];
	$password_request = $row['password_request'];
	$usuario = $row['usuario'];

	$sqlca = "SELECT MONTH(fechareg) AS mes,YEAR(fechareg) AS year FROM confir_activos WHERE usuario = '$usuario' 
					ORDER BY fechareg DESC LIMIT 1";
	$resultca = $mysqli->query($sqlca);
	$rowca= $resultca->fetch_assoc();
	$mesca = $rowca['mes'];
	$yearca = $rowca['year'];
	
	$sqlempresa = "SELECT empresa FROM empresas WHERE codempresa = '$idempresa'";
	$resultempresa = $mysqli->query($sqlempresa);
	$rowempresa = $resultempresa->fetch_assoc();	

	$date = getdate();
	$hoy = $date['mday'];
	$mes = $date['mon'];
	$year = $date['year'];
	
	
	if($mesca==$mes && $yearca==$year){
		$dayini = 0;
		$dayfin = 0;
	}
	else{
		$dayini = 15;
		$dayfin = 20;
	}
?>

<html>
<head>
		<title>Bienvenido - ▂ : BPM : ▂</title>
		<link rel="stylesheet" type="text/css" href="admin/librerias/bootstrap4/bootstrap.min.css">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" type="text/css" href="admin/librerias/fontawesome/css/all.css">
		<link rel="stylesheet" type="text/css" href="admin/librerias/datatable/dataTables.bootstrap4.min.css">
		<link rel="icon" type="image/png" href="img/Bpm.ico" />
	</head>
	<body>
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  				<div class="container">
   						<a class="nav-link" href="#">
						   <img src="img/logoSG.png" alt="" width="170px"> 
						   <small><code style="color: white"><span class="fas fa-code-branch" style="color: #D3D3D3"></span> <?php include('invti/version.php');?></code></small>
						</a>
						<a class="nav-link" href="#" style="color: white"><span class="fas fa-user"></span> <?php echo $row['nombre']; ?></a>
						<a class="nav-link" href="#" style="color: white"><span class="fas fa-database" style="color: #D3D3D3"></span> <?php echo $rowempresa['empresa']; ?></a>
  				</div>
		    </nav>		

<!-- Navigation -->

<!-- Confirma activos -->
<?php if($hoy>=$dayini && $hoy<=$dayfin)  { ?>
	<div class="container">
		<div class="alert alert-warning" role="alert">
			<div class="row align-items-center">
    			<div class="col"> 
				<a class="nav-link" href="invti/Kardex/kardexxpersona_ca.php?busqueda=<?php echo $row['usuario']; ?>" style="color: #9A9411">
				<i class="far fa-check-square"></i>				
				Debe confirmar sus activos.</div></a>
			</div>
		</div>
	</div>
		<?php }?>

<!-- Cambia Password -->
<?php if($password_request=='1'){ ?>
	<div class="container">
		<div class="alert alert-danger" role="alert">
			<div class="row align-items-center">
    			<div class="col">
				Debe cambiar su contraseña de ingreso, para poder usar el aplicativo.
				</div>
			</div>
		</div>
	</div>
		<?php }?>

<nav class="navbar navbar-expand-lg navbar-light static-top">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav">
		<?php if($hoy <= $dayini || $hoy >= $dayfin || $mesca==$mes)  { ?>
		<?php if($password_request=='0'){ ?>
        <li class="nav-item">
		<?php if($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==14 || $_SESSION['tipo_usuario']==15) { ?>
  			<a class="nav-link" href="admin/vistas/usuarios.php" style="color:  #000000;">
			  <P>
  			  <img src="img/new/users.png" width="70" height="70" alt="">				
   				 Administración
			</a>
		<?php } ?>
		</li>

		<li class="nav-item">
		<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==18 || $_SESSION['tipo_usuario']==4|| $_SESSION['tipo_usuario']==10  || $_SESSION['tipo_usuario']==11  || $_SESSION['tipo_usuario']==12  || $_SESSION['tipo_usuario']==13 || $_SESSION['tipo_usuario']==14 || $_SESSION['tipo_usuario']==15 || $_SESSION['tipo_usuario']==16 || $_SESSION['tipo_usuario']==17) { ?>
			<a class="nav-link" href="invti/Inicio/principal.php" style="color:  #000000;">
				<P>
    			<img src="img/new/inv1.png" width="70" height="70" alt="">				
   				 Control Activos Fijos
			</a>
		<?php } ?>
		</li>

		
		<li class="nav-item">
		<?php if($_SESSION['tipo_usuario']==1  || $_SESSION['tipo_usuario']==3  || $_SESSION['tipo_usuario']==4|| $_SESSION['tipo_usuario']==10  || $_SESSION['tipo_usuario']==11  || $_SESSION['tipo_usuario']==12  || $_SESSION['tipo_usuario']==13 || $_SESSION['tipo_usuario']==14 || $_SESSION['tipo_usuario']==15 || $_SESSION['tipo_usuario']==16 || $_SESSION['tipo_usuario']==17) { ?>
	
			<a class="nav-link" href="docs/vistas/inicio.php" style="color:  #000000;">
			<p style="line-height: 70%">
   				<img src="img/new/docs.png" width="70" height="70" alt="">
    				Docs
			</a>
		<?php } ?>

		</li>

		<?php } ?>

		</li>
		<li class="nav-item">
				  <a class="nav-link" href="cambia_passusr.php" style="color:  #000000;">
				  
				  <p style style="line-height: 120%"> 
				  <img src="img/new/passwd.png" width="70" height="70" alt="">Cambiar Password 
				  </a>
				  </li>
		<?php } ?>		  
		<li class="nav-item">
			<a class="nav-link" href="#" onclick="valida();" style="color:  #000000;">
			<p>
			<p style style="line-height: 150%"><p>
			
			<img src="img/new/LOGOUT.png" width="35" height="35" alt="35">
				
			Salir
            </a>
          </li>
		</ul>
		</div>
	</div>
</nav>
<script type="text/javascript">  
  function valida()
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
window.location.href='logout.php';
  } else {
  }
});


}
</script>

	<script src="admin/librerias/jquery-3.4.1.min.js"></script>
	<script src="admin/librerias/bootstrap4/popper.min.js"></script>
	<script src="admin/librerias/bootstrap4/bootstrap.min.js"></script>
	<script src="admin/librerias/sweetalert.min.js"></script>		
	<script src="admin/librerias/datatable/jquery.dataTables.min.js"></script>
	<script src="admin/librerias/datatable/dataTables.bootstrap4.min.js"></script>
	</body>
</html>
