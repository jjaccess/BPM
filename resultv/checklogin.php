<html>
<head>
	<title>Ingreso de Resultados</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="icon" type="image/png" href="Supergiros.ico" />
    <meta name="title" content="Demo de jQuery Data Picker" />
	<meta name="description" content="Demo de jQuery Data Picker" />
	<meta name="keywords" content="Demo, calendario, Data Picker" />
	<meta name="author" content="Emenia" />
	<link href="style.css" tyoe="text/css" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.2.custom.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
    </head>
<body>
	<div id="header">
		<h1>LOGO</h1>
	</div>
    <div id="board-container">
<div id="board-weekly">
          <p>&nbsp;</p>
          <p>&nbsp;</p>
		  <p>&nbsp;</p>

	<div>
	<?php
session_start();
?>

<?php

$host_db = "10.28.28.148";
$user_db = "admrsoc";


$pass_db = "admrsoc";
$db_name = "resultadostv";
$tbl_name = "login";

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];
 
$sql = "SELECT * FROM $tbl_name WHERE user = '$username' and password = '$password'";

$result = $conexion->query($sql);


if ($result->num_rows > 0) {     
 
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (10 * 60);

    echo "Bienvenido! " . $_SESSION['username'];
    echo "<br><br><a class='registrar' href=insert.php>Registrar Datos</a>"; 

 } else { 
   echo "Username o Password estan incorrectos.";

   echo "<br><a href='login.php'>Volver a Intentarlo</a>";
 }
 mysqli_close($conexion); 
 ?>
	</div>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<br><br>
</div>
</div>
</body>
</html>
