<?php 	
       session_start();

       if(!isset($_SESSION["id_usuario"])){
         header("Location: ../../index.php");
       }
       
  include "header.php";
?>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-6">Gestor de Archivos</h1>
    <a href=""><span class="fas fa-address-card"></span> <?php echo ''.($row['nombre']); ?></a>
    <hr>
    <span class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarArchivos">
    	 <span class="fas fa-plus-circle"></span> Agregar Archivos
    </span>
    <hr>
    <div class="row">
        <div class="col-sm-12">
        <div id="tablaGestorArchivos"></div>
          </div>
        </div>


<!-- Modal Para Agregar Archivos -->
<div class="modal fade" id="modalAgregarArchivos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Archivos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        	<form id="frmArchivos" name="frmArchivos" enctype="multipart/form-data" method="POST">
          <input type="text" id="login" hidden="" name="login" value="<?php echo $row['usuario'] ?>">
  				<label>Categoria</label>
  				<div id="categoriasLoad"></div>
  				<label>Selecciona archivos</label>
  				<input type="file" name="archivos[]" id="archivos[]" class="form-control" multiple="">   		
        	</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnGuardarArchivos">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>        
      </div>
    </div>
  </div>
</div>


<!-- Modal Visualizar archivo -->
<div class="modal fade" id="visualizarArchivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Archivo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div id="archivoObtenido"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


  <?php include "footer.php";   ?>

  <script src="../js/gestor.js"></script>
  <script type="text/javascript">
  	$(document).ready(function(){
  		$('#tablaGestorArchivos').load("gestor/TablaGestor.php");
      $('#categoriasLoad').load("categorias/selectCategorias.php");

      $('#btnGuardarArchivos').click(function(){
        agregarArchivosGestor();

      });
  		
  	});
  </script>