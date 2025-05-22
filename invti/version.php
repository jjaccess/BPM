<?php
session_start();

if(!isset($_SESSION["id_usuario"])){
	header("Location: ../index.php");
}
?>
V2.5 RV:05042021