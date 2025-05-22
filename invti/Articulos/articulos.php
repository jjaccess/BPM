
<?php
session_start();

if(!isset($_SESSION["id_usuario"])){
	header("Location: ../../index.php");
}
?>

<script type="text/javascript">

function miFuncion() {
	$('#tablaCategoriaLoad').load("TablaArt.php");
		}


</script>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Control activos</title>
  
    <?php require_once "../menu.php"; ?>
	<?php require_once "../librerias.php"; ?>
    </head>

    <body onload="miFuncion();">
<div class="container">
<div class="col-md-8 offset-md-3 mt-4">

			<h2 class="text-primary"><dt>
			<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-upc-scan" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  				<path fill-rule="evenodd" d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
 				<path d="M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z"/>
				</svg>
				Crear Categoría - Artículos
				<span class="btn btn-primary" data-toggle="modal" data-target="#modalAgregaCategoria">Agregar</span>
				</dt></h2>	
				
		<br>
		
			</div>
			</div>

		<div class="row">
        <div class="col-sm-12">
            <div id="tablaCategoriaLoad"></div>
          </div>
        </div>



 
		<!-- Modal Agregar -->
		<div class="modal fade" id="modalAgregaCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo artículo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmCategorias">
            <label>Artículo:</label>
            <input type="text" name="categoria" id="categoria" class="form-control">                               
            <label>Seleccione tipo:</label>
			<select  class="form-control input-sm" name="id_tipoart" id="id_tipoart">
                            <option value="" required >Selección:</option>
                            <?php
															
                                                            $query1 = $mysqli -> query ("SELECT id, tipo FROM invti_tipoart ORDER BY tipo");
                                                                                              
                                                            while ($tipo = mysqli_fetch_array($query1)) {
                                                                                                  
                                                              echo '<option value="'.$tipo['id'].'">'.$tipo['tipo'].'</option>';
                                                                                                  
                                                            }
                                                          ?>
                        </select>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnAgregaCategoria">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>



		<!-- Modal actualizar -->
<div class="modal fade" id="actualizaCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar artículo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form id="frmCategoriaU">
							<input type="text" hidden="" id="idcategoria" name="idcategoria">
							<label>Artículo</label>
                            <input type="text" id="categoriaU" name="categoriaU" class="form-control input-sm">
						</form>
      </div>
      <div class="modal-footer">
	  <button type="button" id="btnActualizaCategoria" class="btn btn-warning" data-dismiss="modal">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

	</body>
	</html>
	<script type="text/javascript">
		$(document).ready(function(){

		

			$('#btnAgregaCategoria').click(function(){

				vacios=validarFormVacio('frmCategorias');

				if(vacios > 0){
					alertify.alert("Debes llenar todos los campos!!");
					return false;
				}

				datos=$('#frmCategorias').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"procesos/agregaCategoria.php",
					success:function(r){
						if(r==1){
					//esta linea nos permite limpiar el formulario al insetar un registro
					$('#frmCategorias')[0].reset();

					$('#tablaCategoriaLoad').load("TablaArt.php");
					alertify.success("Artículo agregado con exito :D");
				}else{
					alertify.error("No se pudo agregar Artículo");
				}
			}
		});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnActualizaCategoria').click(function(){

				vacios=validarFormVacio('frmCategoriaU');

				if(vacios > 0){
					alertify.alert("Debes llenar todos los campos!!");
					return false;
				}

				datos=$('#frmCategoriaU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"procesos/actualizaCategoria.php",
					success:function(r){
						if(r==1){
							$('#tablaCategoriaLoad').load("TablaArt.php");
							alertify.success("Actualizado con exito :)");
						}else{
							alertify.error("no se pudo actualizar :(");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		function agregaDato(idCategoria,categoria){
			$('#idcategoria').val(idCategoria);
			$('#categoriaU').val(categoria);
		}

		function eliminaCategoria(idcategoria){
			alertify.confirm('¿Desea eliminar este artículo?', function(){ 
				$.ajax({
					type:"POST",
					data:"idcategoria=" + idcategoria,
					url:"procesos/eliminarCategoria.php",
					success:function(r){
						if(r==1){
							$('#tablaCategoriaLoad').load("TablaArt.php");
							alertify.success("Eliminado con exito!!");
						}else{
							alertify.error("No se pudo eliminar :(");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelada !')
			});
		}
    </script>
