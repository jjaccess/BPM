  <?php
  
  session_start();

if(!isset($_SESSION["id_usuario"])){
	header("Location: ../../index.php");
}
  
  include "header.php";

?>

  <div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-6">Subprocesos</h1>
    <a href=""><span class="fas fa-address-card"></span> <?php echo ''.($row['nombre']); ?></a>
    <hr>
    <div class="row">
      <div class="col-sm-4">
        <span class="btn btn-primary" data-toggle="modal" data-target="#modalAgregaProceso">
          <span class="fas fa-plus-circle"></span> Agregar nuevo subproceso
        </span>
      </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12">
            <div id="tablaProcesos"></div>
          </div>
        </div>

<!-- Modal -->
<div class="modal fade" id="modalAgregaProceso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo subproceso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmProcesos">
            <label>Proceso</label>
  			  	<div id="procesosLoad"></div>
            <label>Nombre del subproceso</label>
            <input type="text" name="nombreProceso" id="nombreProceso" class="form-control">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnGuardarProceso">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="modalActualizarProceso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar subproceso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <form id="frmActualizarProceso">
                <input type="text" id="idProceso" name="idProceso" hidden="">
                <label>Subproceso</label>
                <input type="text" id="procesoU" name="procesoU" class="form-control">
           </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCerrarUpdateProceso">Cerrar</button>
        <button type="button" class="btn btn-warning" id="btnActualizaProceso">Actualizar</button>
      </div>
    </div>
  </div>
</div>

<?php 
        include ("footer.php");
?>
    <!--Dependencia de categorias, todas las funciones js de categorias-->
  <script src="../js/subprocesos.js"></script> 
  <script type="text/javascript">
    $(document).ready(function(){
        $('#tablaProcesos').load("subprocesos/tablaSubproceso.php");
        $('#procesosLoad').load("procesos/selectProcesos.php")

        $('#btnGuardarProceso').click(function(){
           agregarProceso();
        });    
        $('#btnActualizaProceso').click(function(){
          actualizaProceso();
        });    

    });
  </script>


 