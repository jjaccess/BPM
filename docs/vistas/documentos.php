  <?php
  
  session_start();

  if(!isset($_SESSION["id_usuario"])){
    header("Location: ../../index.php");
  }

  include "header.php";

  require_once "../../funcs/Conexion.php";
  $conexion = new Conectar();
  $conexion = $conexion->conexion();
  
  $sql = "SELECT id_mcproceso, nombre FROM dc_mcprocesos";

  $result = mysqli_query($conexion, $sql);

?>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
  
    <h1 class="display-6">Seleccione un proceso:</h1>
    <a href=""><span class="fas fa-address-card"></span> <?php echo ''.($row['nombre']); ?></a>
    <hr>
    <div class="row">
    <?php while($mostrar = mysqli_fetch_array($result)) {
      						$proceso = $mostrar['nombre'];
                  $idproceso = $mostrar['id_mcproceso'];
      ?>
     <div class="col-md-auto">
     <form id="frmCategorias" action="documentosp.php" method="GET">
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

 