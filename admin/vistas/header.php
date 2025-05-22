<?php 

session_start();
	
require_once '../../funcs/Conexion.php';
$conexion = new Conectar();
$mysqli = $conexion->conexion();

	
if(!isset($_SESSION["id_usuario"])){
  header("Location: ../../index.php");
}

$idempresa = $_SESSION['id_empresa'];
	
	$sqlempresa = "SELECT empresa FROM empresas WHERE codempresa = '$idempresa'";
	$resultempresa = $mysqli->query($sqlempresa);
	$rowempresa = $resultempresa->fetch_assoc();	
	
	$idUsuario = $_SESSION['id_usuario'];
	
	$sql = "SELECT id, usuario, nombre FROM usuarios WHERE id = '$idUsuario'";
	$result = $mysqli->query($sql);
	$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Administración</title>
  <link rel="stylesheet" type="text/css" href="../librerias/bootstrap4/bootstrap.min.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="../librerias/fontawesome/css/all.css">
  <link rel="stylesheet" type="text/css" href="../librerias/datatable/dataTables.bootstrap4.min.css">
  <link rel="icon" type="image/png" href="../../img/Supergiros.ico" />
<head>
<body style="background-color: #e9ecef">
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="../../img/logoSG.png" alt="" width="170px">
        <small><code style="color: #ffffff"><span class="fas fa-code-branch" style="color: #FFFFFF"></span> 
        <?php include('../../invti/version.php');?></code></small></a>
            <a class="nav-link" style="color: #ffffff"><span class="fas fa-user"></span> <?php echo $row['nombre']; ?></a>
						<a class="nav-link"  style="color: #ffffff" ><span class="fas fa-database"></span> <?php echo $rowempresa['empresa']; ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="../../welcome.php" style="color: white"><span class="far fa-arrow-alt-circle-left"></span> Volver
            </a>
          </li>          
          <li class="nav-item">
            <a class="nav-link" href="#" style="color: red" onclick="valida();"><span class="fas fa-power-off"></span> Salir
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
window.location.href='../../logout.php';
  } else {
  }
});


}
</script>
