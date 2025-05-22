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

    $sql = "SELECT * FROM usuarios WHERE id = '$id'";
    $resultado = $mysqli->query($sql);
    $row = $resultado->fetch_array(MYSQLI_ASSOC);
	

 	// seleccion de usuario para RESPONSABLE
    function selectNewResp($mysqli){  
        $output = '';  
        $sql = "SELECT * FROM usuarios  WHERE id_tipo in (1,3)" ;  
        $result = mysqli_query($mysqli, $sql);  
        while($row = mysqli_fetch_array($result))  
        {  
            $output .= '<option value="'.$row["usuario"].'">'.$row["nombre"].'</option>';  
        }  
        return $output;  
    }
	
	$errors = array();
	$creado = array();
	
	
    if(!empty($_POST))
    {
        $cod = $mysqli->real_escape_string($_POST['COD']);    
        $nombre = $mysqli->real_escape_string($_POST['NOMBRE']);  
        $responsable = $mysqli->real_escape_string($_POST['responsable']);    
		$login = $mysqli->real_escape_string($_POST['login']); 
        
        $estado = 0;		
        
        if(isNullCrearBodega($cod, $nombre, $responsable))
        {
            $errors[] = "Debe llenar todos los campos";
        }
        
        if(CodBodegaNoExiste($cod))
        {
            $errors[] = "El codigo de bodega no existe";
        }
		if(NomBodegaNoExiste($nombre))
        {
            $errors[] = "El nombre de bodega no existe";
        }
        
		if(count($errors) == 0)
		{
			$registro = registraBodega($cod, $nombre, $responsable, $estado);      
			if($registro > 0 )
            {	

				$creado[] = "Bodega creada exitosamente";		
                    
            } else {
                    $errors[] = "Error al crear bodega";
					}
		}
    }
    
	
?>
<?php if($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==14) { ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>▂ : BPM : ▂ Nueva Bodega</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- CSS -->
        <link rel="icon" type="image/png" href="../../img/Supergiros.ico" />
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Oleo+Script:400,700'>
        <link rel="stylesheet" href="../../css/bootstrap.min.css">
        <link rel="stylesheet" href="../../css/style.css">
</head>
<script type="text/javascript">
  function carga(id){
    
    window.location.href="1NewBodega.php?COD="+ document.getElementById(id).value;
  }
function confirmarEditar()
{
    if(confirm('¿Estas seguro de actualizar el registro?'))
        return true;
    else
        return false;
}
</script>
<body>
<script type="text/javascript">
function confirmarEditar()
{
	if(confirm('¿Estás seguro de editar este usuario?'))
		return true;
	else
		return false;
}

  </script>
          <div class="register-container container">
            <div class="row">
                <center><a href="1asigna.php" ><img src="../../img/regresar.png"  style="cursor:pointer; " width="50px"></a></center>

            </div>

        </div>
        <center>
        <div id="Mensaje2" width="200px"></div><br/>
                <div class="register" style="width: 570px;">
                   
                    <form class="form-horizontal" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" autocomplete="off">
				
				<h2>Nueva <span class="blue"><strong>Bodega</strong></span></h2>
				<ul class="nav navbar-nav navbar-left">
			<li><a href=""><span class="glyphicon glyphicon-mail"></span> <?php echo "@" .utf8_decode($rowempresa['empresa']); ?></a></li>
        </ul>
						<?php echo resultBlock($errors); ?>
						<?php echo resultCrear($creado); ?>

                            <div id="signupalert" style="display:none" class="alert alert-danger">
                                <p>Error:</p>
                                <span></span>
                            </div>
                            <div id="signupalert" style="display:none" class="alert alert-success">
                                <p>Notificación:</p>
                                <span></span>
                            </div>
					    <input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>" />
						<input type="hidden" id="login" name="login" value="<?php echo $rowuser['usuario']; ?>" />
                        <table width="250px" border=0> 
				
				<tr>
                     <td align="right">Codigo:</td>
						<td><input type="text"  onchange="carga(this.id)" name="COD" id="COD" value="<?php if(isset($_GET['COD'])){traer($_GET['COD'],'COD');} ?>" class="form-control" required style="width:350px;height: 30px;"></td>
				</tr>
				
				<tr>
                     <td align="right">Nombre:</td>
					<td><input type="text"  name="NOMBRE" id="NOMBRE" value="<?php if(isset($_GET['COD'])){traer($_GET['COD'],'NOMBRE');} ?>" class="form-control" required style="width:350px;height: 30px;"></td>
				</tr>

                <tr>
                     <td align="right">Responsable:</td>
                        <td>
                        <select name="responsable" id="responsable" style="width:350px;height: 30px;">
                        <option value="" disabled selected>---Seleccione Usuario---</option>
                         <?php echo selectNewResp($mysqli);  

                         ?>
                        </select>
                     </td>
                </tr>
				
				
					
				<tr>
                     <td colspan=2><button type="submit">Crear</button></td>
                </tr>
					</form>

</body>
</html>
<?php } ?>   