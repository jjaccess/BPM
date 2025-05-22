<?php
session_start();

if(!isset($_SESSION["id_usuario"])){
	header("Location: ../../index.php");
}
?>
<script type="text/javascript">

function miFuncion() {
	$('#tablaCategoriaLoad').load("TablaRes.php");
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
				Crear subbodega - tipo 2
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
        <h5 class="modal-title" id="exampleModalLabel">Nueva sub bodega</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmCategorias">
		<input type="text" hidden="" id="login" name="login" value="<?php echo $rowuser['usuario'] ?>">
		<label>Codigo:</label>
    	<input type="text" name="cod" id="cod" class="form-control">
		<label>Nombre:</label>
        <input type="text" name="nombre" id="nombre" class="form-control">	
            <label>Bodega Padre:</label>
			<select  class="form-control input-sm" name="codpadre" id="codpadre">
                            <option value="" required >Selección:</option>
                            <?php
															
                                                            $sqlbod = $mysqli -> query ("SELECT COD, NOMBRE FROM bodegas 
															WHERE estado = 1
															GROUP BY NOMBRE
															ORDER BY NOMBRE");
                                                                                              
                                                            while ($bod = mysqli_fetch_array($sqlbod)) {
                                                                                                  
                                                              echo '<option value="'.$bod['COD'].'">'.$bod['NOMBRE'].'</option>';
                                                                                                  
                                                            }
                                                          ?>
                        </select>
            <label>Usuario responsable:</label>
			<select  class="form-control input-sm" name="usuario" id="usuario">
                            <option value="" required >Selección:</option>
                            <?php
															
                                                            $query1 = $mysqli -> query ("SELECT * FROM usuarios 
															WHERE id_tipo in (1,3,11,12,13,14,15,16,17)
															AND activacion = 1
															ORDER BY nombre");
                                                                                              
                                                            while ($tipo = mysqli_fetch_array($query1)) {
                                                                                                  
                                                              echo '<option value="'.$tipo['usuario'].'">'.$tipo['nombre'].'</option>';
                                                                                                  
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


		<!-- Modal actualizar Estado -->
		<div class="modal fade" id="actualizaCategoria2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar estado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form id="frmCategoriaU2">
	  <input type="text" id="idcategoriaU2"  hidden="" name="idcategoriaU2">
	  <input type="text" id="loginU2" hidden="" name="loginU2">
	  <label>Estado</label>
	  <select  class="form-control input-sm" name="categoriaU2" id="categoriaU2">
	 		<option value="" required >Selección:</option>
            <?php									
            	 $sqlstatus = $mysqli -> query ("SELECT * FROM status GROUP BY status  ORDER BY status");
                 while ($status = mysqli_fetch_array($sqlstatus)) {
                 echo '<option value="'.$status['id'].'">'.$status['status'].'</option>';
                }
           ?>
        </select>  
	</form>
      </div>
      <div class="modal-footer">
	  <button type="button" id="btnActualizaCategoria2" class="btn btn-warning" data-dismiss="modal">Modificar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


		<!-- Modal actualizar -->
<div class="modal fade" id="actualizaCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar responsable bodega</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form id="frmCategoriaU">
	  <input type="text" id="idcategoria" hidden=""  name="idcategoria">
	  <label>User:</label>
	  <input type="text" class="form-control input-sm" id="responsableU" readonly="" name="responsableU">
	  <input type="text" id="loginU" hidden="" name="loginU">
	  <label>A reemplazar:</label>
	  <select  class="form-control input-sm" name="oldres" id="oldres">
	 		<option value="" required >Selección:</option>
			 <?php									
 					$oldressql = $mysqli -> query ("SELECT  
					 ccostos.COD COD, 
					 ccostos.NOMBRE NOMBRE, 
					 ccostos.RESPONSABLE RESPONSABLE, 
					 ccostos.ESTADO idestado 
					 FROM ccostos
					 WHERE  ccostos.ESTADO = 1
					 GROUP BY COD, NOMBRE
					 ORDER BY NOMBRE, RESPONSABLE, COD, CODBODEGA");
                    while ($oldres = mysqli_fetch_array($oldressql)) {
                    echo '<option value="'.$oldres['RESPONSABLE'].'">'.$oldres['NOMBRE'].'</option>';
                    }
            ?>
        </select> 
	</form>
      </div>
      <div class="modal-footer">
	  <button type="button" id="btnActualizaCategoria" class="btn btn-warning" data-dismiss="modal">Modificar</button>
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
					url:"procesos/agregaResponsable.php",
					success:function(r){
						if(r==1){
					//esta linea nos permite limpiar el formulario al insetar un registro
					$('#frmCategorias')[0].reset();

					$('#tablaCategoriaLoad').load("TablaRes.php");
					alertify.success("Bodega agregada con exito :D");
				}else{
					alertify.error("No se pudo agregar bodega");
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
					url:"procesos/actualizaResponsable.php",
					success:function(r){
						console.log(r);
						if(r==1){
							$('#tablaCategoriaLoad').load("TablaRes.php");
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
		$(document).ready(function(){
			$('#btnActualizaCategoria2').click(function(){

				vacios=validarFormVacio('frmCategoriaU2');

				if(vacios > 0){
					alertify.alert("Debes llenar todos los campos!!");
					return false;
				}

				datos=$('#frmCategoriaU2').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"procesos/actualizaResponsable2.php",
					success:function(r){
						console.log(r);
						if(r==1){
							$('#tablaCategoriaLoad').load("TablaRes.php");
							alertify.success("Actualizado estado con exito :)");
						}else{
							alertify.error("no se pudo actualizar estado :(");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		function agregaDato(idCategoria,responsable,login){
			$('#idcategoria').val(idCategoria);
			$('#responsableU').val(responsable);
			$('#loginU').val(login);
		}

		function agregaDato2(idCategoria,categoria,login){
			$('#idcategoriaU2').val(idCategoria);
			$('#categoriaU2').val(categoria);
			$('#loginU2').val(login);
		}

		function eliminaCategoria(idcategoria){
			alertify.confirm('¿Desea eliminar esta bodega?', function(){ 
				$.ajax({
					type:"POST",
					data:"idcategoria=" + idcategoria,
					url:"procesos/eliminarResponsable.php",
					success:function(r){
						console.log(r);
						if(r==1){
							$('#tablaCategoriaLoad').load("TablaRes.php");
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
