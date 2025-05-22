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
    $destino = $_GET['destino'];
	$user = $_GET['user']; //orgigen para el insert
	$id = $_GET['id'];	//id_consecutivo para el insert
	$observacion = $_GET['observacion'];	//observacion para el insert
  $origen = $_GET['origen'];
  $estado= $_GET['estado_2'];
	
		    $consulta ="INSERT
  INTO invti_responsables
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
    invti_puntosventa
  WHERE
    activo = '" . $activo . "'
		AND id = '" . $id . "';
";

$consulta2 =   "UPDATE invti_responsables 
                SET responsable = '" . $destino . "', 
                       origen = '" . $origen . "',
					   user = '" . $user . "',
					   consecutivo = '" . $id . "',
					   asigna = 'N',
					   observacion = '" . $observacion . "',
             estado = '" . $estado . "'
  WHERE activo= '" . $activo . "' 
  AND asigna = ''
                 ;";

$consulta3 =   "UPDATE invti_puntosventa
	                SET asigna = 'P'
					WHERE activo= '" . $activo . "'
					AND id = '" . $id . "'
					AND sucursal = '" . $origen . "'
					AND asigna = 'N'
                 ;";
    
    $sqldesmail = "SELECT correo FROM usuarios WHERE usuario = '" . $user . "'";
    $resultdesmail = $mysqli->query($sqldesmail);
    $desmail = $resultdesmail->fetch_assoc();
     
    $sqldesname = "SELECT nombre FROM usuarios WHERE usuario = '" . $user . "'";
    $resultdesname = $mysqli->query($sqldesname);
    $desname = $resultdesname->fetch_assoc();
    
    $sqldependencia = "SELECT nombre from puntosdeventa where COD = '" . $origen . "'";
    $resultdependencia = $mysqli->query($sqldependencia);
    $dependencia = $resultdependencia->fetch_assoc();
    
    $nombre_des = utf8_decode($desname['nombre']);
    $correo_des = utf8_decode($desmail['correo']);
    $ndependencia = utf8_decode($dependencia['nombre']);
    $asunto = "Notificaciones BPM-Control activos";
          //Destino
          $cuerpo_A = "<p>Se&ntilde;or(a): $nombre_des,</p>  Se informa que usted, ha realizado un TRASLADO a su bodega, desde la dependencia $ndependencia. - activo fijo $activo <p></p><p></p><p>Cordialmente,</p><p><p></p>Notificaciones BPM-Control activos</p>";
          $enviamail_A = enviarEmail($correo_des, $nombre_des, $asunto, $cuerpo_A);       

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
   $resultado2 = mysqli_query($mysqli,$consulta2);
   $resultado3 = mysqli_query($mysqli,$consulta3);
	
	
	$mensaje = "Datos ingresados correctamente";
	      echo "<script>";
	      echo "confirm('$mensaje');";  
	      echo "window.location = 'devolucion_a_responsable.php';";
	      echo "</script>";
		mysqli_close($mysqli);
		//echo "Datos ingresados correctamente";
        //echo "<meta http-equiv='Refresh' content='5;url=devolucion_a_responsable.php'>";	
		
	?>
