<?php

session_start();

if(!isset($_SESSION["id_usuario"])){
	header("Location: ../../index.php");
}

include "header.php";


?>	
 		<div class="conatiner">
 			<div class="row">
 				<div class="col-sm-12">
				 <h5><center>
				 <p></p>
				 <p>Bienvenid@: </p>
 				<a href=""><span class="fas fa-address-card"></span> <?php echo ''.($row['nombre']); ?></a></center>
 				</h5>
				 </div>
 			</div>
 		</div>
<?php include "footer.php"; ?>