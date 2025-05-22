<?php 

$require=array(
    '1'=>'funcs/conexion1.php',
    '2'=>'funcs/conexion2.php',
    '3'=>'funcs/conexion3.php'
    );

if(isset($_POST['empresa']) && array_key_exists($_POST['empresa'], $require)) :
   include($require[$_POST['empresa']]);
   endif;
    ?>