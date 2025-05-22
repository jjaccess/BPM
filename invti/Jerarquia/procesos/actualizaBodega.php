<?php 
	require_once "../../../funcs/Conexion.php";
	require_once "../clases/Bodegas.php";

	$id=$_POST['idcategoria'];
	$cod=$_POST['categoriaU'];
	$user=$_POST['responsableU'];
	$login=$_POST['loginU'];

	$c= new conectar();
	$mysqli=$c->conexion();

	$sql1="UPDATE invti_bodegas 
	SET invti_bodegas.USER = '$user'
	WHERE invti_bodegas.USER = (SELECT RESPONSABLE FROM bodegas WHERE COD = '$cod' AND ESTADO = 1);";
	$resultbod1 = $mysqli->query($sql1);
	
	$sql2="UPDATE invti_responsables 
	SET invti_responsables.ORIGEN = '$user'
	WHERE invti_responsables.ASIGNA = 'T' 
	AND  invti_responsables.ORIGEN = (SELECT RESPONSABLE FROM bodegas WHERE COD = '$cod' AND ESTADO = 1);";
	$resultbod2 = $mysqli->query($sql2);
	
	$sql3="UPDATE bodegas
	JOIN (select RESPONSABLE as res FROM `bodegas` WHERE COD = '$cod' AND ESTADO = 1) AS bod
	SET RESPONSABLEOLD = bod.res, FECHAREG = NOW()
	WHERE ESTADO = 0
	AND COD = '$cod'
	AND id = '$id';";
	$resultbod3 = $mysqli->query($sql3);
	
	$sql4="UPDATE bodegas AS bodegas1
	SET bodegas1.ESTADO = 0, bodegas1.FECHAREG = NOW(), bodegas1.LOGIN = '$login'
	WHERE bodegas1.ESTADO = 1
	AND bodegas1.COD = '$cod';";
	$resultbod4 = $mysqli->query($sql4);

	$datos=array(
		$id,
		$cod,
		$user,
		$login
			);

	$obj= new jerarquias();
	
	echo $obj->actualizaBodega($datos);

 ?>