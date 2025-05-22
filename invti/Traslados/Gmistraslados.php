<?php

session_start();

if(!isset($_SESSION["id_usuario"])){
	header("Location: ../../index.php");
}
	
require '../../funcs/funcs.php';
require '../../funcs/Conexion.php';
$conexion = new Conectar();
$mysqli = $conexion->conexion();

 $id = $_GET['id'];	//id_consecutivo para el update
 $codubcn = $_GET['codubcn'];	//bodega origen para el update
 $activo = $_GET['activo'];
 $user = $_GET['login']; //orgigen para el insert

 ///Origen
 $sqlorimail = "SELECT correo FROM usuarios WHERE usuario = '" . $user . "'";
 $resultorimail = $mysqli->query($sqlorimail);
 $mail_ori = $resultorimail->fetch_assoc();

 $sqlname_ori = "SELECT nombre FROM usuarios WHERE usuario = '" . $user . "'";
 $resultname_ori = $mysqli->query($sqlname_ori);
 $name_ori = $resultname_ori->fetch_assoc();
 
 $nombre_ori = utf8_decode($name_ori['nombre']);
 $correo_ori = utf8_decode($mail_ori['correo']);
 $asunto = "Notificaciones BPM-Control activos";

 
 if($codubcn >99991 )
 {
		$consulta =	"UPDATE invti_responsables
	                SET invti_responsables.asigna = 'R',
					invti_responsables.fecharegistro = NOW(),
					invti_responsables.user = '" . $user . "'
					WHERE invti_responsables.activo = '" . $activo . "' 
					AND invti_responsables.id = '" . $id . "'
                    AND invti_responsables.responsable = '" . $codubcn . "'
					AND invti_responsables.user = '" . $user . "'
					AND invti_responsables.asigna = 'T';"
					; 

 		// destinatario
		 $sqldesmail = "SELECT correo from usuarios where usuario in (SELECT responsable from invti_responsables where activo = '" . $activo . "' and id = '" . $id . "' and responsable = '" . $codubcn . "')";
		 $resultdesmail = $mysqli->query($sqldesmail);
		 $desmail = $resultdesmail->fetch_assoc();
  
		 $sqldesname = "SELECT nombre from usuarios where usuario in (SELECT responsable from invti_responsables where activo = '" . $activo . "' and id = '" . $id . "' and responsable = '" . $codubcn . "')";
		 $resultdesname = $mysqli->query($sqldesname);
		 $desname = $resultdesname->fetch_assoc();
  
		 $nombre_des = utf8_decode($desname['nombre']);
		 $correo_des = utf8_decode($desmail['correo']);
		 
		$cuerpo = "<p>Se&ntilde;or(a): $nombre_des,</p>  Se informa que $nombre_ori, ha RECHAZADO el traslado que hizo a su bodega con activo fijo: $activo <p></p><p></p><p>Cordialmente,</p><p><p></p>Notificaciones BPM-Control activos</p>";
		$enviamail = enviarEmail($correo_des, $nombre_des, $asunto, $cuerpo); 

		$cuerpo_1 = "<p>Se&ntilde;or(a): $nombre_ori,</p>  Se informa que usted, ha RECHAZADO el traslado para $nombre_des con activo fijo: $activo <p></p><p></p><p>Cordialmente,</p><p><p></p>Notificaciones BPM-Control activos</p>";
		$enviamail_1 = enviarEmail2($correo_ori, $nombre_ori, $asunto, $cuerpo_1);

						if (!$resultado1 = mysqli_query($mysqli,$consulta)) {
						echo "Lo sentimos, este sitio web está experimentando problemas.";
						echo "Error: La ejecución de la consulta falló debido a: \n";
						echo "Query: " . $consulta . "\n";
						echo "Errno: " . $mysqli->errno . "\n";
						echo "Error: " . $mysqli->error . "\n";
						exit;
						}			
						mysqli_close($mysqli);
						$mensaje = "Traslado Cancelado exitosamente";
						echo "<script>";
						echo "confirm('$mensaje');";  
						echo "window.location = 'mistraslados.php';";
						echo "</script>";	
 }
 else{

	 	$consulta1 ="UPDATE invti_bodegas 
	                 SET invti_bodegas.asigna = 'R',
					 invti_bodegas.fecharegistro = NOW(),
					 invti_bodegas.user = '" . $user . "'
					 WHERE invti_bodegas.activo = '" . $activo . "' 
					 AND invti_bodegas.id = '" . $id . "'
                     AND invti_bodegas.bodega = '" . $codubcn . "'
					 AND invti_bodegas.user = '" . $user . "'
					 AND invti_bodegas.asigna = 'T';";

 		// destinatario
		 $sqldesmail = "SELECT correo from usuarios where usuario in (select responsable from bodegas where cod in (SELECT bodega from invti_bodegas where activo = '" . $activo . "' and id = '" . $id . "' and bodega = '" . $codubcn . "')and estado = 1)";
		 $resultdesmail = $mysqli->query($sqldesmail);
		 $desmail = $resultdesmail->fetch_assoc();
  
		 $sqldesname = "SELECT nombre from usuarios where usuario in (select responsable from bodegas where cod in (SELECT bodega from invti_bodegas where activo = '" . $activo . "' and id = '" . $id . "' and bodega = '" . $codubcn . "')and estado = 1)";
		 $resultdesname = $mysqli->query($sqldesname);
		 $desname = $resultdesname->fetch_assoc();
  
		 $nombre_des = utf8_decode($desname['nombre']);
		 $correo_des = utf8_decode($desmail['correo']);
		 
		$cuerpo = "<p>Se&ntilde;or(a): $nombre_des,</p>  Se informa que $nombre_ori, ha RECHAZADO el traslado realizado a su bodega con activo fijo $activo <p></p><p></p><p>Cordialmente,</p><p><p></p>Notificaciones BPM-Control activos</p>";
		$enviamail = enviarEmail($correo_des, $nombre_des, $asunto, $cuerpo); 

		$cuerpo_1 = "<p>Se&ntilde;or(a): $nombre_ori,</p>  Se informa que usted, ha RECHAZADO el traslado enviado a, $nombre_des con activo fijo $activo <p></p><p></p><p>Cordialmente,</p><p><p></p>Notificaciones BPM-Control activos</p>";
		$enviamail_1 = enviarEmail2($correo_ori, $nombre_ori, $asunto, $cuerpo_1);

				if (!$resultado1 = mysqli_query($mysqli,$consulta1)) 
			{
				echo "Lo sentimos, este sitio web está experimentando problemas.";
				echo "Error: La ejecución de la consulta falló debido a: \n";
				echo "Query: " . $consulta1 . "\n";
				echo "Errno: " . $mysqli->errno . "\n";
				echo "Error: " . $mysqli->error . "\n";
				exit;
			}			
				mysqli_close($mysqli);
				$mensaje = "Traslado Cancelado exitosamente";
				echo "<script>";
				echo "confirm('$mensaje');";  
				echo "window.location = 'mistraslados.php';";
				echo "</script>";						
 }

	
?>