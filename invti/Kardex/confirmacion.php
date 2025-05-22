<?php
session_start();

if(!isset($_SESSION["id_usuario"])){
	header("Location: ../../index.php");
}
require '../../funcs/Conexion.php';
$conexion = new Conectar();
$mysqli = $conexion->conexion();
require '../../funcs/funcs.php';
	

	$tipousuario = $_SESSION['tipo_usuario'];
	$idempresa = $_SESSION['id_empresa'];
	$idUsuario = $_SESSION['id_usuario'];
	
	$sql = "SELECT id, usuario, nombre, correo FROM usuarios WHERE id = '$idUsuario'";
	$result = $mysqli->query($sql);
	$row = $result->fetch_assoc();
    $usuario = $row['usuario'];
    $email = $row['correo'];
    $nombre = $row['nombre'];

	$sqldata = "select CURDATE() AS now";
	$resultdata = $mysqli->query($sqldata);
	$rowdata= $resultdata->fetch_assoc();
    $data = $rowdata['now'];
    $asunto = "Notificaciones BPM-Control activos";
    
	
	$sqlempresa = "SELECT empresa FROM empresas WHERE codempresa = '$idempresa'";
	$resultempresa = $mysqli->query($sqlempresa);
    $rowempresa = $resultempresa->fetch_assoc();	
    
    $insert ="INSERT INTO confir_activos (usuario, fechareg) values ('$usuario','$data')";
    if (!$resultado = mysqli_query($mysqli,$insert)) {
        // ¡Oh, no! La consulta falló. 
        echo "Lo sentimos, este sitio web está experimentando problemas.";
    
        // De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
        // cómo obtener información del error
        echo "Error: La ejecución de la consulta falló debido a: \n";
        echo "Query: " . $insert . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        exit;
    }	
    else {
            			//Notificacion
                        $cuerpo = "<p><strong>Se&ntilde;or(a): $nombre,</strong></p>  Se informa que usted ha confirmado sus activos exitosamente. <p></p><p></p><p>Cordialmente,</p><p><p></p>Notificaciones BPM-Control activos</p>";
                        $enviamail = enviarEmail($email, $nombre, $asunto, $cuerpo); 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../img/Supergiros.ico" /> 
    <?php require_once "../librerias.php"; ?>
    <title>Confirma Ok</title>
</head>
<body onload="confirm()">
<script type="text/javascript">  
  function confirm()
{
swal("Ok confirmado!", "Registro exitoso!", "success");

var delay = 2000; // time in milliseconds
setTimeout(function(){
  window.location = "../../welcome.php";
 },delay);
}
</script>
</body>
</html>