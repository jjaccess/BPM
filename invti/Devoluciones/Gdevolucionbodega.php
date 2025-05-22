<?php
session_start();

if(!isset($_SESSION["id_usuario"])){
	header("Location: ../../index.php");
}
	
	require '../../funcs/funcs.php';
	require '../../funcs/Conexion.php';
	$conexion = new Conectar();
	$mysqli = $conexion->conexion();
	
	$activo = $_GET['activo'];
    $destino = $_GET['destino']; //bodega
	$user = $_GET['user']; //orgigen para el insert
	$id = $_GET['id'];	//id_consecutivo para el insert
  $observacion = $_GET['observacion'];	//observacion para el insert
  $estado= $_GET['estado_2'];
	
		    $consulta ="INSERT
  INTO invti_bodegas
  (nit, clasificacion, tipo, clase, articulo, marca, serial, imei, simcard, activo, estado, factura, proveedor, valor, fechacompra)
  SELECT
    nit,
    clasificacion,
    tipo,
    clase,
    articulo,
    marca,
    serial,
    imei,
    simcard,
    activo,
    estado,
    factura,
    proveedor,
    valor,
    fechacompra
  FROM
    invti_responsables
  WHERE
    activo = '" . $activo . "'
		AND id = '" . $id . "';
";

$consulta3 =   "UPDATE invti_bodegas 
                SET bodega = '" . $destino . "', 
                       origen = '" . $user . "',
					   user = '" . $user . "',
					   consecutivo_dev = '" . $id . "',
					   asigna = 'T',
					   observacion = '" . $observacion . "',
             estado = '" . $estado . "'
  WHERE activo= '" . $activo . "' 
  AND asigna = ''
                 ;";
    
    $sqldesmail = "SELECT correo FROM usuarios WHERE usuario in (select responsable from bodegas where cod = '" . $destino . "' and estado = 1)";
    $resultdesmail = $mysqli->query($sqldesmail);
    $desmail = $resultdesmail->fetch_assoc();
     
    $sqldesname = "SELECT nombre FROM usuarios WHERE usuario in (select responsable from bodegas where cod = '" . $destino . "' and estado = 1)";
    $resultdesname = $mysqli->query($sqldesname);
    $desname = $resultdesname->fetch_assoc();
  
    $sqlorimail = "SELECT correo FROM usuarios WHERE usuario = '" . $user . "'";
    $resultorimail = $mysqli->query($sqlorimail);
    $mail_ori = $resultorimail->fetch_assoc();
     
    $sqlname_ori = "SELECT nombre FROM usuarios WHERE usuario = '" . $user . "'";
    $resultname_ori = $mysqli->query($sqlname_ori);
    $name_ori = $resultname_ori->fetch_assoc();
  
    $nombre_des = utf8_decode($desname['nombre']);
    $correo_des = utf8_decode($desmail['correo']);
    $nombre_ori = utf8_decode($name_ori['nombre']);
    $correo_ori = utf8_decode($mail_ori['correo']);
    $asunto = "Notificaciones BPM-Control activos";

    			//Destino
          $cuerpo_A = "<p>Se&ntilde;or(a): $nombre_des,</p>  Se informa que $nombre_ori, le ha TRASLADADO un artículo con activo fijo $activo <p></p><p></p><p>Cordialmente,</p><p><p></p>Notificaciones BPM-Control activos</p>";
          $enviamail_A = enviarEmail($correo_des, $nombre_des, $asunto, $cuerpo_A); 
       //Origen
          $cuerpo_A1 = "<p>Se&ntilde;or(a): $nombre_ori,</p>  Se informa que usted, ha realizado un TRASLADO a $nombre_des desde su bodega. - activo fijo $activo <p></p><p></p><p>Cordialmente,</p><p><p></p>Notificaciones BPM-Control activos</p>";
          $enviamail_A1 = enviarEmail2($correo_ori, $nombre_ori, $asunto, $cuerpo_A1);	
    
	if (!$resultado = mysqli_query($mysqli,$consulta)) {
    // ¡Oh, no! La consulta falló. 
    echo "Lo sentimos, este sitio web está experimentando problemas.";

    // De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
    // cómo obtener información del error
    echo "Error: La ejecución de la consulta falló debido a: \n";
    echo "Query: " . $consulta . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}		
 //  $resultado2 = mysqli_query($mysqli,$consulta2);
   $resultado3 = mysqli_query($mysqli,$consulta3);
	
		   $mensaje = "Datos ingresados correctamente";
	      echo "<script>";
	      echo "confirm('$mensaje');";  
	      echo "window.location = 'devolucion_a_bodega.php';";
	      echo "</script>";
		mysqli_close($mysqli);
		//echo "Datos ingresados correctamente";
        //echo "<meta http-equiv='Refresh' content='5;url=devolucion_a_bodega.php'>";	
		
	?>
