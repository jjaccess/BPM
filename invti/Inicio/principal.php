<?php
session_start();

if(!isset($_SESSION["id_usuario"])){
	header("Location: ../../index.php");
}
?>
<title>Control activos</title>
	<?php require_once "../menu.php"; ?>
	<?php require_once "../librerias.php"; ?>
</head>
<body>
<?php
require_once '../creditos.php';
?>
</body>
</html>