<?php
// CONSULTAS LOTERIAS SEMANALES
	$sLoteriesMon = "SELECT NOMBRE_LOTERIA,RESULTADO FROM resultados WHERE CODIGO IN (1,2) ORDER BY FECHA_SORTEO DESC LIMIT 2";
	$LoteriesMon = mysqli_query($conexion, $sLoteriesMon);

	$sLoteriesTue = "SELECT NOMBRE_LOTERIA,RESULTADO FROM resultados WHERE CODIGO IN (8,9) ORDER BY FECHA_SORTEO DESC LIMIT 2";
	$LoteriesTue = mysqli_query($conexion, $sLoteriesTue);

	$sLoteriesWeb = "SELECT NOMBRE_LOTERIA,RESULTADO FROM resultados WHERE CODIGO IN (14,15,52,27) ORDER BY FECHA_SORTEO DESC LIMIT 3";
	$LoteriesWeb = mysqli_query($conexion, $sLoteriesWeb);

	$sLoteriesThu = "SELECT NOMBRE_LOTERIA,RESULTADO FROM resultados WHERE CODIGO IN (17,18) ORDER BY FECHA_SORTEO DESC LIMIT 2";
	$LoteriesThu = mysqli_query($conexion, $sLoteriesThu);

	$sLoteriesFri = "SELECT NOMBRE_LOTERIA,RESULTADO FROM resultados WHERE CODIGO IN (20,21,53) ORDER BY FECHA_SORTEO DESC LIMIT 3";
	$LoteriesFri = mysqli_query($conexion, $sLoteriesFri);

	$sLoteriesSat = "SELECT NOMBRE_LOTERIA,RESULTADO FROM resultados WHERE CODIGO IN (22,23,26) ORDER BY FECHA_SORTEO DESC LIMIT 2";
	$LoteriesSat = mysqli_query($conexion, $sLoteriesSat);
	
	$sLoteriesSun = "SELECT NOMBRE_LOTERIA,RESULTADO FROM resultados WHERE CODIGO IN (27) ORDER BY FECHA_SORTEO DESC LIMIT 1";
	$LoteriesSun = mysqli_query($conexion, $sLoteriesSun);

//TOMANDO LA FECHA ACTUAL
	$today = date('Y-m-d');
	$sToday = "SELECT NOMBRE_LOTERIA,RESULTADO FROM resultados WHERE FECHA_SORTEO = '".$today."' ORDER BY NOMBRE_LOTERIA";
	$Today = mysqli_query($conexion, $sToday);
	
//TOMANDO LA FECHA DEL DÍA ANTERIOR
	function dia_anterior($fecha)
	{
	    $sol = (strtotime($fecha) - 3600);
	    return date('Y-m-d', $sol);
	}
	$yesterday = dia_anterior($today);

	$sYesterday = "SELECT NOMBRE_LOTERIA,RESULTADO FROM resultados WHERE FECHA_SORTEO = '".$yesterday."' ORDER BY NOMBRE_LOTERIA";
	$Yesterday = mysqli_query($conexion, $sYesterday);


//CONSULTAS DE LOS SORTEOS SEMANALES
	$sMon = "SELECT CODIGO,NOMBRE_LOTERIA,RESULTADO from resultados WHERE CODIGO IN (3,4,5,6,7,10,11,12,13,19,24,25,38,39,40,42,43,46,50,54,55,60,62,64,65,70,16,28,29,30,31,32,33,34,35,36,37,41) AND DIA = 'LUN' AND FECHA_SORTEO < '".$today."' ORDER BY FECHA_SORTEO DESC LIMIT 23";
	$Mon = mysqli_query($conexion, $sMon);

	$sTue = "SELECT CODIGO,NOMBRE_LOTERIA,RESULTADO from resultados WHERE CODIGO IN (3,4,5,6,7,10,11,12,13,19,24,25,38,39,40,42,43,46,50,54,55,60,62,64,65,70,16,28,29,30,31,32,33,34,35,36,37,41) AND DIA = 'MAR' AND FECHA_SORTEO < '".$today."' ORDER BY FECHA_SORTEO DESC LIMIT 23";
	$Tue = mysqli_query($conexion, $sTue);

	$sWed = "SELECT CODIGO,NOMBRE_LOTERIA,RESULTADO from resultados WHERE CODIGO IN (3,4,5,6,7,10,11,12,13,19,24,25,38,39,40,42,43,46,50,54,55,60,62,64,65,70,16,28,29,30,31,32,33,34,35,36,37,41) AND DIA = 'MIE' AND FECHA_SORTEO < '".$today."' ORDER BY FECHA_SORTEO DESC LIMIT 23";
	$Wed = mysqli_query($conexion, $sWed);

	$sThu = "SELECT CODIGO,NOMBRE_LOTERIA,RESULTADO from resultados WHERE CODIGO IN (3,4,5,6,7,10,11,12,13,19,24,25,38,39,40,42,43,46,50,54,55,60,62,64,65,70,16,28,29,30,31,32,33,34,35,36,37,41) AND DIA = 'JUE' AND FECHA_SORTEO < '".$today."' ORDER BY FECHA_SORTEO DESC LIMIT 23";
	$Thu = mysqli_query($conexion, $sThu);

	$sFri = "SELECT CODIGO,NOMBRE_LOTERIA,RESULTADO from resultados WHERE CODIGO IN (3,4,5,6,7,10,11,12,13,19,24,25,38,39,40,42,43,46,50,54,55,60,62,64,65,70,16,28,29,30,31,32,33,34,35,36,37,41) AND DIA = 'VIE' AND FECHA_SORTEO < '".$today."' ORDER BY FECHA_SORTEO DESC LIMIT 23";
	$Fri = mysqli_query($conexion, $sFri);

	$sSat = "SELECT CODIGO,NOMBRE_LOTERIA,RESULTADO from resultados WHERE CODIGO IN (3,4,5,6,7,10,11,12,13,19,24,25,38,39,40,42,43,46,50,54,55,60,62,64,65,70,16,28,29,30,31,32,33,34,35,36,37,41) AND DIA = 'SAB' AND FECHA_SORTEO < '".$today."' ORDER BY FECHA_SORTEO DESC LIMIT 23";
	$Sat = mysqli_query($conexion, $sSat);

	$sSun = "SELECT CODIGO,NOMBRE_LOTERIA,RESULTADO from resultados WHERE CODIGO IN (3,4,5,6,7,10,11,12,13,19,24,25,38,39,40,42,43,46,50,54,55,60,62,64,65,70,16,28,29,30,31,32,33,34,35,36,37,41,129) AND DIA = 'DOM' AND FECHA_SORTEO < '".$today."' ORDER BY FECHA_SORTEO DESC LIMIT 24";
	$Sun = mysqli_query($conexion, $sSun);
?>
