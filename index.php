<?php
	session_start();
	require 'funcs/funcs.php';	
	require 'funcs/loginempresas.php';
		
	$errors = array();
	
	$id_empresa = $_POST['empresa'];
	$_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (10 * 360);
	$_SESSION['id_empresa'] = $id_empresa;
	



	if(!empty($_POST))
	{
				
		$usuario = $mysqli->real_escape_string($_POST['usuario']);	
		$password = $mysqli->real_escape_string($_POST['password']);
		$nit = $mysqli->real_escape_string($_POST['nit']);
		
		if(isNullLogin($usuario, $password))
		{
			$errors[] = "Debe llenar todos los campos";
		}
		
		$errors[] = login($usuario, $password);
		
	}
	

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login - BPM</title>
		<link rel="stylesheet" type="text/css" href="css/login.css">
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="icon" type="image/png" href="img/Bpm.ico" />		
		<script src="js/sweetalert.min.js"></script>
		<script src="js/jquery-3.4.1.min.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
		<script src="js/bootstrap.min.js" ></script>
	</head>
	<body>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

     <!-- Icon -->
	 <div class="fadeIn first">
	<br>
      <img src="img/super.jpg" id="icon" alt="User Icon" />
	  <div class="panel-title">
			<p>
			
    </div>
<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
    <!-- Login Form -->
    <form method="post" id="frmLogin" action="<?php $_SERVER['PHP_SELF'] ?>" >
      <input type="text" id="usuario" class="fadeIn second" name="usuario" autocomplete="off" placeholder="Usuario" required="">    
      <input type="password" id="password" class="fadeIn third" name="password" autocomplete="off" placeholder="Contraseña" required="">
	  <select name="empresa" id="empresa" type="text" class="fadeIn third" required>
	<option value ="" hidden  selected required="">Seleccione empresa:</option>
    <option value ="1">Empresa 1</option>
	<option value ="2">Empresa 2</option>
	<option value ="3">Empresa 3</option>
    </select>
	  <input class="btn btn-secondary active" style="background-color:#000000;"type="submit" name="fadeIn fourth" value="Ingresar" href="#">
    </form>
    <?php echo resultBlock($errors); ?>
  </div>
</div>
</body>
</html>						
