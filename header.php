<?php 

session_start();

if(!isset($_SESSION["id_usuario"])){
  header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - ▂ : BPM : ▂</title>
    <link rel="stylesheet" type="text/css" href="admin/librerias/bootstrap4/bootstrap.min.css">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" type="text/css" href="admin/librerias/fontawesome/css/all.css">
		<link rel="stylesheet" type="text/css" href="admin/librerias/datatable/dataTables.bootstrap4.min.css">
		<link rel="icon" type="image/png" href="img/Supergiros.ico" />
</head>
<body>
<?php
require 'funcs/dssesion.php';
?>
</body>
</html>