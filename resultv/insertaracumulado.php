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
  <?php 

    $producto = $_POST['producto'];
	$acumulado = $_POST['acumulado'];
    $user = $_POST['user'];	
	
    $insert ="insert into msg_tv SET productocod='$producto',acumulado='$acumulado',loginuser='$user'";
		
		//$resultado=mysqli_query($con,$insert);

		if (!$result = mysqli_query($mysqli,$insert)) {
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
		mysqli_close($mysqli);
		echo 'Los datos han sido insertados en la base de datos';
		        echo "<meta http-equiv='Refresh' content='2;url=config_acumulado.php'>";

?>
<?php } ?>