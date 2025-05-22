<?php 
	require_once "../../../funcs/Conexion.php";
	require_once "../clases/Responsables.php";

	$id=$_POST['idcategoria'];
	$user=$_POST['responsableU'];
	$oldres=$_POST['oldres'];
	$login=$_POST['loginU'];

	$c= new conectar();
	$mysqli=$c->conexion();

	$sql1="UPDATE invti_bodegas 
	SET invti_bodegas.origen = '$user'
	WHERE invti_bodegas.origen = '$oldres' 
	AND invti_bodegas.ASIGNA = 'T';";
	$resultbod1 = $mysqli->query($sql1);
	
	$sql2="UPDATE invti_responsables
	SET  invti_responsables.RESPONSABLE = '$user'
	WHERE invti_responsables.RESPONSABLE = '$oldres';";
	$resultbod2 = $mysqli->query($sql2);
	
	$sql3="UPDATE invti_puntosventa 
	SET invti_puntosventa.ORIGEN = '$user'
	WHERE invti_puntosventa.ORIGEN = '$oldres';";
	$resultbod3 = $mysqli->query($sql3);
	
	$sql4="UPDATE puntosdeventa
	SET puntosdeventa.CODCCOSTO = '$user', puntosdeventa.LOGIN = '$login', puntosdeventa.FECHAREG = NOW()
	WHERE puntosdeventa.CODCCOSTO = '$oldres';";
	$resultbod4 = $mysqli->query($sql4);

	$sql5="UPDATE ccostos
	SET ccostos.RESPONSABLEOLD = '$oldres'
	WHERE ccostos.RESPONSABLE = '$user'
	AND ccostos.id = '$id';";
	$resultbod4 = $mysqli->query($sql5);

	$sql6="UPDATE ccostos
	SET ccostos.ESTADO = 0, ccostos.LOGIN = '$login', ccostos.FECHAREG = NOW()
	WHERE ccostos.RESPONSABLE = '$oldres'
	AND ccostos.ESTADO = 1;";
	$resultbod5 = $mysqli->query($sql6);

	$datos=array(
		$id,
		$user,
		$oldres,
		$login
			);

	$obj= new jerarquias();
	
	echo $obj->actualizaBodega($datos);

 ?>