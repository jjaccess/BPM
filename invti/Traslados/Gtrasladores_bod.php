<?php
	session_start();

	if(!isset($_SESSION["id_usuario"])){
		header("Location: ../../index.php");
	}
	
	require '../../funcs/funcs.php';
	require '../../funcs/Conexion.php';
	$conexion = new Conectar();
	$mysqli = $conexion->conexion();
	  
 $action = $_GET['action'];
 $id = $_GET['id'];	//id_consecutivo para el update
 $origen = $_GET['origen'];	//origen para el update
 $destino = $_GET['destino'];	//destino para el update 
 $activo = $_GET['activo'];
 $user = $_GET['user']; //orgigen para el insert	
 $consecutivo = $_GET['consecutivo'];
 $observacion = $_GET['observacion'];

 $sqldesmail = "SELECT correo FROM usuarios WHERE usuario in (SELECT responsable FROM bodegas WHERE cod = '" . $destino . "' AND estado = 1)";
 $resultdesmail = $mysqli->query($sqldesmail);
 $desmail = $resultdesmail->fetch_assoc();

 $sqldesname = "SELECT nombre FROM usuarios WHERE usuario in (SELECT responsable FROM bodegas WHERE cod = '" . $destino . "' AND estado = 1)";
 $resultdesname = $mysqli->query($sqldesname);
 $desname = $resultdesname->fetch_assoc();

 $sqlorimail = "SELECT correo FROM usuarios WHERE usuario = '" . $origen . "'";
 $resultorimail = $mysqli->query($sqlorimail);
 $mail_ori = $resultorimail->fetch_assoc();

 $sqlname_ori = "SELECT nombre FROM usuarios WHERE usuario = '" . $origen . "'";
 $resultname_ori = $mysqli->query($sqlname_ori);
 $name_ori = $resultname_ori->fetch_assoc();
 
 $nombre_des = utf8_decode($desname['nombre']);
 $correo_des = utf8_decode($desmail['correo']);
 $nombre_ori = utf8_decode($name_ori['nombre']);
 $correo_ori = utf8_decode($mail_ori['correo']);
 $asunto = "Notificaciones BPM-Control activos";

 
 if($action=='aceptar'){
	$consulta1 =	"UPDATE invti_bodegas 
	                 SET asigna = 'N',
					 fecharegistro = NOW(),
					 bodega = '" . $destino . "',
					 user = '" . $user . "',
					 observacion = '" . $observacion . "'
					 WHERE activo = '" . $activo . "' 
					 AND id = '" . $id . "'
                     AND origen = '" . $origen . "'
					 AND consecutivo_dev = '" . $consecutivo . "'
															 ;";
	
    $consulta2 =   "UPDATE invti_responsables
	                SET asigna = 'P'
					WHERE activo= '" . $activo . "'
					AND id = '" . $consecutivo . "'
					AND responsable = '" . $origen . "'
				 ;";
				 

				 $cuerpo_A = "<p>Se&ntilde;or(a): $nombre_des,</p>  Se informa que usted ha CONFIRMADO un traslado a su bodega con activo fijo: $activo <p></p><p></p><p>Cordialmente,</p><p><p></p>Notificaciones BPM-Control activos</p>";
				 $enviamail_A = enviarEmail($correo_des, $nombre_des, $asunto, $cuerpo_A); 
			 
				 $cuerpo_A1 = "<p>Se&ntilde;or(a): $nombre_ori,</p>  Se informa que $nombre_des, ha CONFIRMADO la devolución realizada desde su bodega con activo fijo: $activo <p></p><p></p><p>Cordialmente,</p><p><p></p>Notificaciones BPM-Control activos</p>";
				 $enviamail_A1 = enviarEmail2($correo_ori, $nombre_ori, $asunto, $cuerpo_A1);			 
		
	if (!$resultado1 = mysqli_query($mysqli,$consulta1)) {
    // ¡Oh, no! La consulta falló. 
    echo "Lo sentimos, este sitio web está experimentando problemas.";

    // De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
    // cómo obtener información del error
    echo "Error: La ejecución de la consulta falló debido a: \n";
    echo "Query: " . $consulta1 . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}		
   $resultado2 = mysqli_query($mysqli,$consulta2);
	
	$mensaje = "Se acepto el traslado con éxito";
      echo "<script>";
      echo "confirm('$mensaje');";  
      echo "window.location = 'consulta_trasladosres_bod.php';";
      echo "</script>";
		mysqli_close($mysqli);
		//echo "Traslado aceptado exitosamente";
        //echo "<meta http-equiv='Refresh' content='5;url=consulta_trasladosbod_res.php'>";	
		
 }
 else{
    $consulta3 =	"UPDATE invti_bodegas
	                 SET asigna = 'R',
					 fecharegistro = NOW(),
					 user = '" . $user . "',
					 observacion = '" . $observacion . "'
					 WHERE activo= '" . $activo . "' 
					 AND id = '" . $id . "'
                     AND origen = '" . $origen . "'
					 AND consecutivo_dev = '" . $consecutivo . "'
															 ;";	
															 
			 $cuerpo_R = "<p>Se&ntilde;or(a): $nombre_des,</p>  Se informa que usted ha RECHAZADO un traslado con activo fijo: $activo <p></p><p></p><p>Cordialmente,</p><p><p></p>Notificaciones BPM-Control activos</p>";				 
			 $enviamail_R = enviarEmail($correo_des, $nombre_des, $asunto, $cuerpo_R); 
												 
			$cuerpo_R1 = "<p>Se&ntilde;or(a): $nombre_ori,</p>  Se informa que $nombre_des, ha RECHAZADO la devolución realizada desde su bodega con activo fijo: $activo <p></p><p></p><p>Cordialmente,</p><p><p></p>Notificaciones BPM-Control activos</p>";
			$enviamail_R1 = enviarEmail2($correo_ori, $nombre_ori, $asunto, $cuerpo_R1);													 
															 
 } 
    		
	if (!$resultado = mysqli_query($mysqli,$consulta3)) {
    // ¡Oh, no! La consulta falló. 
    echo "Lo sentimos, este sitio web está experimentando problemas.";

    // De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
    // cómo obtener información del error
    echo "Error: La ejecución de la consulta falló debido a: \n";
    echo "Query: " . $consulta3 . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}		
   $resultado3 = mysqli_query($mysqli,$consulta3);
	
	
	  $mensaje = "El traslado se rechazó exitosamente";
      echo "<script>";
      echo "confirm('$mensaje');";  
      echo "window.location = 'consulta_trasladosres_bod.php';";
      echo "</script>"; 
		mysqli_close($mysqli);
		//echo "Traslado rechazado exitosamente";
        //echo "<meta http-equiv='Refresh' content='5;url=consulta_trasladosbod_res.php'>";	
	 
?>