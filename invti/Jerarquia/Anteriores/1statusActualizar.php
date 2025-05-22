<?php
	session_start();
	
	require '../../funcs/connect.php';
  require '../../funcs/funcs.php';

	if(!isset($_SESSION["id_usuario"])){
	header("Location: ../../index.php");
	}

	$now = time();
	if($now > $_SESSION['expire']) {
	session_destroy();

	echo "Su sesion a terminado";
	header('Location: ../../index.php');
	exit;
	}	
	
	$idempresa = $_SESSION['id_empresa'];
	
	
	$sqlempresa = "SELECT empresa FROM empresas WHERE identificador = '$idempresa'";
	$resultempresa = $mysqli->query($sqlempresa);
	$rowempresa = $resultempresa->fetch_assoc();	
	
	$idUsuario = $_SESSION['id_usuario'];
	
	$sqluser = "SELECT id, usuario, nombre FROM usuarios WHERE id = '$idUsuario'";
	$resultuser = $mysqli->query($sqluser);
	$rowuser = $resultuser->fetch_assoc();
    
    $id = $_GET['id'];
    
    $sql = "SELECT * FROM bodegas WHERE id = '$id'";
    $resultado = $mysqli->query($sql);
    $row = $resultado->fetch_array(MYSQLI_ASSOC);
    
    
	    function selectStatusUser($mysqli){  
        $output = '';  
        $sql = "SELECT * FROM status" ;  
        $result = mysqli_query($mysqli, $sql);  
        while($row = mysqli_fetch_array($result))  
        {  
            $output .= '<option value="'.$row["id"].'">'.$row["status"].'</option>';  
        }  
        return $output;  
    }
	
	
	$errors = array();
	$creado = array();
	
    if(!empty($_POST))
    {
        $id = $mysqli->real_escape_string($_POST['id']);    
        $status = $mysqli->real_escape_string($_POST['status']);
		$cod = $mysqli->real_escape_string($_POST['cod']); 
        	
        
        if(isNullActualizaEstadoBodega($id, $status, $cod))
        {
            $errors[] = "Debe Elegir una opcion";
        }
        
		if(!empty($_POST['status'])){
				if(EstadoBodegaExiste($cod))
				{
					$errors[] = "La bodega ya tiene un otro responsable";
				}			
		}
        
		if(count($errors) == 0)
		{
			$registro = ActualizaEstadoBodega($status, $id);      
			if($registro > 0 )
            {	

				$creado[] = "Estado Bodega actualizado exitosamente";		
                    
            } else {
                    $errors[] = "Error al actualizar estado";
					}
		}
    }	
	
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>▂ : BPM : ▂ Editar Estado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- CSS -->
        <link rel="icon" type="image/png" href="../../img/Supergiros.ico" />
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Oleo+Script:400,700'>
        <link rel="stylesheet" href="../../css/bootstrap.min.css">
        <link rel="stylesheet" href="../../css/style.css">

<script type="text/javascript">
function confirmarEditar()
{
    if(confirm('¿Estás seguro de editar este usuario?'))
        return true;
    else
        return false;
}
</script>

</head>
<body>


        <div class="register-container container">
            <div class="row">
                <center><a href="1asigna.php" ><img src="../../img/regresar.png" style="cursor:pointer; " width="50px"  ></a></center>
            </div>
        </div>

        <center>
        <div id="Mensaje2" width="200px"></div><br/>
                <div class="register" style="width: 570px;">
                   
                    <form class="form-horizontal" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" autocomplete="off">
                        <input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>" />
                        <input type="hidden" id="cod" name="cod" value="<?php echo $row['COD']; ?>" />
                        
                        <h2>Modificar Estado <span class="blue"><strong><?php echo $row['NOMBRE']." "; ?></strong></span></h2>
										<ul class="nav navbar-nav navbar-left">
			<li><a href=""><span class="glyphicon glyphicon-mail"></span> <?php echo "@" .utf8_decode($rowempresa['empresa']); ?></a></li>
        </ul>
						<?php echo resultBlock($errors); ?>
						<?php echo resultCrear($creado); ?>
                        <table width="250px" border=0>

                           <tr>
                                <td align="right">Estado:</td>
                                <td>
                                    <select name="status" id="status" style="width:350px;height: 30px;">
                                        <option value="" disabled selected>---Seleccione Estado---</option>
                                        <?php echo selectStatusUser($mysqli);  

                                    ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td colspan=2><button type="submit" onclick='return confirmarEditar()'>Guardar Información</button></td>
                            </tr>


                        </table>
                    </form>
                </div>
                

</body>
</html>