<?php
  
  session_start();

if(!isset($_SESSION["id_usuario"])){
	header("Location: ../../index.php");
}
  
  include "header.php";

?>
<?php if($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==14 || $_SESSION['tipo_usuario']==15) { ?>
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-6">Administración</h1>
    <hr>
    <div class="row">
      <div class="col-sm-4">
        <span class="btn btn-primary" data-toggle="modal" data-target="#modalAgregaCategoria">
          <span class="fas fa-plus-circle"></span> Agregar nuevo Usuario
        </span>
        <span class="btn btn-primary" data-toggle="modal" data-target="#modalVistaRoles">
          <span class="fas fa-plus-circle"></span> Vista Roles
        </span>
      </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12">
            <div id="tablaUsuarios"></div>
          </div>
        </div>

<!-- Modal  Agregar-->
<div class="modal fade" id="modalAgregaCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmUsuarios">
            <input type="text"  value="<?php echo ''.($row['usuario']);?>" name="iduser" id="iduser" class="form-control" hidden=""> 
            <label>Cédula:</label>
            <input type="text" name="usuario" id="usuario" class="form-control">        
            <label>Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control">
            <label>Correo:</label>
            <input type="text" name="correo" id="correo" class="form-control">                       
            <label>Rol:</label>
  			  	<div id="procesosLoad"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnGuardarUsuario">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal Actualizar -->
<div class="modal fade" id="modalActualizarCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <form id="frmActualizarUsuario">
           <input type="text"  value="<?php echo ''.($row['usuario']);?>" name="iduser" id="iduser" class="form-control" hidden=""> 
           <input type="text" id="idCategoria" name="idCategoria" hidden="">
           <label>Nombre:</label>
            <input type="text" name="nombreU" id="nombreU" class="form-control">
            <label>Correo:</label>
            <input type="text" name="correoU" id="correoU" class="form-control">                       
            <label>Rol:</label>
  			  	<div id="procesosLoadU"></div>
            <label>Estado:</label>
  			  	<div id="activacionLoadU"></div>
           </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCerrarUpdateUsuario">Cerrar</button>
        <button type="button" class="btn btn-warning" id="btnActualizaUsuario">Actualizar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal  Reset-->
<div class="modal fade" id="modalResetUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reset Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <form id="frmResetUsuario">
           <input type="text" hidden="" value="<?php echo ''.($row['usuario']);?>" name="iduser" id="iduser" class="form-control" > 
           <input type="text" hidden="" id="idR" name="idR" >
           <label>Nombre:</label>
            <input type="text" name="nombreR" id="nombreR" class="form-control">
           </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCerrarResetUsuario">Cerrar</button>
        <button type="button" class="btn btn-success" id="btnResetUsuario">Reset</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal  VistaRoles-->
<div class="modal fade" id="modalVistaRoles" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Vista Roles</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="table-responsive">
      <table class="table" id="tablaRolesDataTable">
  <thead class="thead-dark">
    <tr style="text-align: center;">
      <th scope="col">Rol</th>
      <th scope="col">Descripción</th>
    </tr>
  </thead>
  <tbody>
  <?php 

						$sql = "SELECT id, tipo, descripcion FROM tipo_usuario ORDER BY tipo";
						 $result=mysqli_query($mysqli, $sql);
               while ($mostrar=mysqli_fetch_array($result)){
                ?>
    <tr>
      <td><?php echo $mostrar['tipo']; ?></td>
      <td><?php echo $mostrar['descripcion']; ?></td>
    </tr>
    <?php
					}
					?>
  </tbody>
</table>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#tablaRolesDataTable').DataTable();
	});
</script>
    

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCerrarRolestabla">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<?php 
        include ("footer.php");
?>
    <!--Dependencia de categorias, todas las funciones js de categorias-->
  <script src="../js/usuarios.js"></script> 
  <script type="text/javascript">
    $(document).ready(function(){
        $('#tablaUsuarios').load("usuarios/tablaUsuarios.php");
        $('#procesosLoad').load("usuarios/selectRoles.php");
        $('#procesosLoadU').load("usuarios/selectRolesU.php");
        $('#activacionLoadU').load("usuarios/selectRolesU_estado.php");

        $('#btnGuardarUsuario').click(function(){
           agregarUsuario();
        });    
        $('#btnActualizaUsuario').click(function(){
          actualizaUsuario();
        });   
        $('#btnResetUsuario').click(function(){
          resetUsuario();
        });     

    });
  </script>
	<?php } ?>