  <?php
  
  session_start();

if(!isset($_SESSION["id_usuario"])){
	header("Location: ../../index.php");
}
  
  include "header.php";

?>

  <div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-6">Macro Procesos</h1>
    <a href=""><span class="fas fa-address-card"></span> <?php echo ''.($row['nombre']); ?></a>
    <hr>
    <div class="row">
      <div class="col-sm-4">
        <span class="btn btn-primary" data-toggle="modal" data-target="#modalAgregaMacroproceso">
          <span class="fas fa-plus-circle"></span> Agregar nuevo M proceso
        </span>
      </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12">
            <div id="tablaMcprocesos"></div>
          </div>
        </div>

<!-- Modal -->
<div class="modal fade" id="modalAgregaMacroproceso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo M proceso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmMcprocesos">
            <label>Nombre del Macro proceso</label>
            <input type="text" name="nombreMcproceso" id="nombreMcproceso" class="form-control">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnGuardarMcproceso">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="modalActualizarMcproceso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar M proceso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <form id="frmActualizarMcproceso">
                <input type="text" id="idMcproceso" name="idMcproceso" hidden="" >
                <label>M Proceso</label>
                <input type="text" id="mcprocesoU" name="mcprocesoU" class="form-control">
           </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCerrarUpdateMcproceso">Cerrar</button>
        <button type="button" class="btn btn-warning" id="btnActualizaMcproceso">Actualizar</button>
      </div>
    </div>
  </div>
</div>

<?php 
        include ("footer.php");
?>
    <!--Dependencia de categorias, todas las funciones js de categorias-->
  <script src="../js/mcprocesos.js"></script> 
  <script type="text/javascript">
    $(document).ready(function(){
        $('#tablaMcprocesos').load("mcprocesos/tablaMcproceso.php");

        $('#btnGuardarMcproceso').click(function(){
           agregarMcproceso();
        });    
        $('#btnActualizaMcproceso').click(function(){
          actualizaMcproceso();
        });    

    });
  </script>


 