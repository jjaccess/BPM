  <?php  

session_start();

if(!isset($_SESSION["id_usuario"])){
	header("Location: ../../index.php");
}

  $dato = $_GET['idproceso'];
  $daton = $_GET['proceso'];

  include "header.php";
  require_once "../../funcs/Conexion.php";
  $conexion = new Conectar();
  $conexion = $conexion->conexion();

  $sql = "SELECT id_proceso, nombre FROM dc_procesos WHERE id_mcproceso= '$dato'";

  $result = mysqli_query($conexion, $sql);
?>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
  
  <button type="button" class="btn btn-outline-primary" onClick="history.go(-1);">
  <h1 class="display-6"><?php echo ''.$daton; ?>:</h1>
  </button>
  <p>
  <a href=""><span class="fas fa-address-card"></span> <?php echo ''.($row['nombre']); ?></a>
    <hr>
    <div class="row">
    <?php while($mostrar = mysqli_fetch_array($result)) {
      						$proceso = $mostrar['nombre'];
                  $idproceso = $mostrar['id_proceso'];
      ?>
     <div class="col-md-auto">
     <form id="frmCategorias" action="documentos_sp.php" method="GET">
     <input type="text" id="idproceso" name="idproceso" hidden="" value="<?php echo ''.$idproceso; ?>">
     <input type="text" id="proceso" name="proceso" hidden="" value="<?php echo ''.$proceso; ?>">
      <input type="submit" class="btn btn-primary btn-lg" value="<?php echo ''.$proceso; ?>">
        <p>  
      </form>
      </div>    
    <?php
    }
    ?>
    </div>
    </div>
    </div>

<?php
        include ("footer.php");
?>