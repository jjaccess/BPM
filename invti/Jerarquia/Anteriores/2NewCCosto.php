<?php
	session_start();
	
	require '../../../funcs/connect.php';
  require '../../../funcs/funcs.php';

	if(!isset($_SESSION["id_usuario"])){
	header("Location: ../../../index.php");
	}

	$now = time();
	if($now > $_SESSION['expire']) {
	session_destroy();

	echo "Su sesion a terminado";
	header('Location: ../../../index.php');
	exit;
	}	
	
			$idempresa = $_SESSION['id_empresa'];

	$idUsuario = $_SESSION['id_usuario'];
	
	$sqluser = "SELECT id, usuario, nombre FROM usuarios WHERE id = '$idUsuario'";
	$resultuser = $mysqli->query($sqluser);
	$rowuser = $resultuser->fetch_assoc();

 	// seleccion de usuario para RESPONSABLE
    function selectNewResp($mysqli){  
        $output = '';  
        $sql = "SELECT * FROM usuarios  WHERE id_tipo in (1,3,11,12,13,14,15,16) and activacion = 1 order by nombre" ;  
        $result = mysqli_query($mysqli, $sql);  
        while($row = mysqli_fetch_array($result))  
        {  
            $output .= '<option value="'.$row["usuario"].'">'.$row["nombre"].'</option>';  
        }  
        return $output;  
    }
	
	 	// seleccion de bodega para RESPONSABLE
    function selectCodBod($mysqli){  
        $outputbod = '';  
        $sqlbod = "SELECT * FROM bodegas where estado = 1 group by COD order by nombre" ;  
        $resultbod = mysqli_query($mysqli, $sqlbod);  
        while($rowbod = mysqli_fetch_array($resultbod))  
        {  
            $outputbod .= '<option value="'.$rowbod["COD"].'">'.$rowbod["NOMBRE"].'</option>';  
        }  
        return $outputbod;  
    }
	
	$errors = array();
	$creado = array();
	
	   if(!empty($_POST))
    {
	$cod = $mysqli->real_escape_string($_POST['COD']);
	$nombre = $mysqli->real_escape_string($_POST['NOMBRE']);
	$codbodega = $mysqli->real_escape_string($_POST['CODBODEGA']);
	$responsable = $mysqli->real_escape_string($_POST['RESPONSABLE']);
        
        $estado = 0;		
        
        if(isNullCrearResponsable($cod, $nombre, $codbodega, $responsable))
        {
            $errors[] = "Debe llenar todos los campos";
        }
               
		if(count($errors) == 0)
		{
			$registro = registraResponsable($cod, $nombre, $codbodega, $responsable, $estado);      
			if($registro > 0 )
            {	

				$creado[] = "Responsable creado exitosamente";		
                    
            } else {
                    $errors[] = "Error al crear Responsable";
					}
		}
    }
	
	$sqlempresa = "SELECT empresa FROM empresas WHERE identificador = '$idempresa'";
	$resultempresa = $mysqli->query($sqlempresa);
	$rowempresa = $resultempresa->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>▂ : BPM : ▂ New Responsable</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- CSS -->
        <link rel="icon" type="image/png" href="../../../img/Supergiros.ico" />
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Oleo+Script:400,700'>
        <link rel="stylesheet" href="../../../css/bootstrap.min.css">
        <link rel="stylesheet" href="../../../css/style.css">
</head>
<body>
<script type="text/javascript">
function confirmarEditar()
{
	if(confirm('¿Estás seguro de crear este responsable?'))
		return true;
	else
		return false;
}
</script>

        <div class="register-container container">
            <div class="row">
                <center><a href="2asigna.php" ><img src="../../../img/regresar.png"  style="cursor:pointer; " width="50px"></a></center>

            </div>

        </div>
        <center>
        <div id="Mensaje2" width="200px"></div><br/>
                <div class="register" style="width: 570px;">
                   
                    <form class="form-horizontal" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" autocomplete="off">
				
				<h2>Nuevo <span class="blue"><strong>Responsable</strong></span></h2>
														<ul class="nav navbar-nav navbar-left">
			<li><a href=""><span class="glyphicon glyphicon-mail"></span> <?php echo "@" .utf8_decode($rowempresa['empresa']); ?></a></li>
        </ul>
														<?php echo resultBlock($errors); ?>
						<?php echo resultCrear($creado); ?>
                        <table width="250px" border=0> 
				
				<tr>
                     <td align="right">Codigo:</td>
						<td><input type="text"  name="COD" id="COD" class="form-control" required style="width:350px;height: 30px;"></td>
				</tr>
				
				<tr>
                     <td align="right">Nombre:</td>
						<td><input type="text"  name="NOMBRE" id="NOMBRE" class="form-control" required style="width:350px;height: 30px;"></td>
				</tr>

<tr>
                     <td align="right">Codigo Bodega:</td>
                        <td>
                        <select name="CODBODEGA" id="CODBODEGA" style="width:350px;height: 30px;">
                        <option value="" disabled selected>---Seleccione Perfil---</option>
                         <?php echo selectCodBod($mysqli);  

                         ?>
                        </select>
                     </td>
				</tr>

                <tr>
                     <td align="right">Responsable:</td>
                        <td>
                        <select name="RESPONSABLE" id="RESPONSABLE" style="width:350px;height: 30px;">
                        <option value="" disabled selected>---Seleccione Perfil---</option>
                         <?php echo selectNewResp($mysqli);  

                         ?>
                        </select>
                     </td>
                </tr>
				
				
					
				<tr>
                     <td colspan=2><button type="submit" onclick='return confirmarEditar()'>Guardar Información</button></td>
                </tr>
					</form>

</body>
</html>