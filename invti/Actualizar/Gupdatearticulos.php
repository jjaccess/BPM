<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<?php

session_start();

if(!isset($_SESSION["id_usuario"])){
	header("Location: ../../index.php");
}
	
	require '../../funcs/funcs.php';
	require '../../funcs/Conexion.php';
	$conexion = new Conectar();
	$mysqli = $conexion->conexion();
	

	$nit = $_POST['nit'];
	$clasificacion = $_POST['clasificacion'];
	$tipo = $_POST['tipo'];
	$clase = $_POST['clase'];
	$articulo = $_POST['articulo'];
	$marca = $_POST['marca'];
	$imei = $_POST['imei'];
	$simcard = $_POST['simcard'];
	$estado = $_POST['estado'];
	$factura = $_POST['factura'];
	$proveedor = $_POST['proveedor'];
	$valor = $_POST['valor'];
	$fecha = $_POST['fecha'];
	$activo = $_POST['activo'];
    $ubc = $_POST['ubc'];
	$observacion = $_POST['observacion'];
	$user = $_POST['user'];
	$email = $_POST['email'];
	$name = $_POST['nombre'];


	
		    $consulta ="UPDATE invti_bodegas 
			SET nit = '" . $nit . "', clasificacion = '" . $clasificacion . "', tipo = '" . $tipo . "', clase = '" . $clase . "',
			articulo = '" . $articulo . "', marca = '" . $marca . "', imei = '" . $imei . "', simcard = '" . $simcard . "',
			estado = '" . $estado . "', factura = '" . $factura . "', proveedor = '" . $proveedor . "', valor = '" . $valor . "',fechacompra = '" . $fecha . "',
			fecharegistro = NOW(), user = '" . $user . "', observacion = '" . $observacion . "'
			WHERE activo= '" . $activo . "'
			AND asigna = 'N'
			AND bodega = '" . $ubc . "';";
		
		$resultado= $mysqli-> query($consulta);

		$nombre = "$name";
		$asunto = "Notificaciones BPM-Control activos";
		$cuerpo = "<p>Se&ntilde;or(a): $nombre,</p>  Se ha actualizado informaci&oacute;n de un art&iacute;culo en su bodega con activo fijo: $activo <p></p><p>Cordialmente,</p><p>Notificaciones BPM-Control activos</p>";
		

		$enviamail = enviarEmail($email, $nombre, $asunto, $cuerpo); 

	if ($resultado) {

			$mensaje = "El registro fue actualizado con éxito";
			echo "<script>";
			echo "confirm('$mensaje');";  
			echo "window.location = 'updatearticulos.php';";
			echo "</script>"; 


	}
	else{
		echo "<script>";
		echo "alert('no fue posible modificar el registro');";
		echo "window.location = 'updatearticulos.php';";
		echo "</script>"; 

    						
	}
        
		
	?>	