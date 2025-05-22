<?php
session_start();

if(!isset($_SESSION["id_usuario"])){
	header("Location: index.php");
}

 require_once 'funcs/Conexion.php';
  require 'funcs/funcs.php';
  include "header.php";

  $conexion = new Conectar();
	$mysqli = $conexion->conexion();
  
	$idempresa = $_SESSION['id_empresa'];

	$sqlempresa = "SELECT empresa FROM empresas WHERE codempresa = '$idempresa'";
	$resultempresa = $mysqli->query($sqlempresa);
	$rowempresa = $resultempresa->fetch_assoc();	
	
	$idUsuario = $_SESSION['id_usuario'];

	$sql = "SELECT id, usuario, nombre, password_request, password FROM usuarios WHERE id = '$idUsuario'";
	$result = $mysqli->query($sql);
	$row = $result->fetch_assoc();
  
  $passwordhashold = $row['password'];
    
    if(!empty($_POST))
    {
  
		$id = $mysqli->real_escape_string($_POST['id']);
        $password = $mysqli->real_escape_string($_POST['password']);    
        $con_password = $mysqli->real_escape_string($_POST['con_password']);    
        $login = $mysqli->real_escape_string($_POST['login']);
        
                
        if(!validaPassword($password, $con_password))
        {
            $errors[] = "Las contraseñas no coinciden";
        }

        if(!validaPasswordAnterior($password, $passwordhashold))
        {
            $errors[] = "debe usar una contraseña diferente a la actual";
        }

        if(strlen($password) < 8){
            $errors[] = "La clave debe tener al menos 8 caracteres";
        }

        if(strlen($password) > 16){
            $errors[] = "La clave no puede tener más de 16 caracteres";
        }

        if (!preg_match('`[a-z]`',$password)){
            $errors[] =  "La clave debe tener al menos una letra minúscula";
         }
         if (!preg_match('`[A-Z]`',$password)){
            $errors[] =  "La clave debe tener al menos una letra mayúscula";
         }
         if (!preg_match('`[0-9]`',$password)){
            $errors[] =  "La clave debe tener al menos un caracter numérico";
         }

		if(count($errors) == 0)
		{
        $pass_hash = hashPassword($password);
      	
		$registro = cambiaPassword($pass_hash, $login , $id);
        if($registro > 0 )
            {	

                $creado[] = "Contrase&ntilde;a Modificada exitosamente";
                		
                    
            } else {
                        $erros[] = "Error al modificar contrase&ntilde;a";
                    }
		}
    }

?>
<html>
	<head>
		<title>Bienvenido - ▂ : BPM : ▂</title>
	</head>
	
	<body>
			<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #E5E8EC;">
  				<div class="container">
   						<a class="nav-link" href="#">
						   <img src="img/super.png" alt="" width="170px"> 
						   <small><code><span class="fas fa-code-branch"></span> <?php include('invti/version.php');?></code></small>
						</a>
						<a class="nav-link" href="#"><span class="fas fa-user"></span> <?php echo ($row['nombre']); ?></a>
						<a class="nav-link" href="#"><span class="fas fa-database"></span> <?php echo ($rowempresa['empresa']); ?></a>
  				</div>
		    </nav>
			<p></p>		

    <nav class="navbar navbar-expand-lg navbar-light static-top">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav">
        <li class="nav-item">
				  <a class="nav-link" style="color: blue" href="welcome.php">
				  <p></p><span class="fas fa-arrow-left fa-2x"></span></a>
				  </li>
		<li class="nav-item">
            <a class="nav-link" href="#" style="color: red" onclick="valida();">
			<p></p><span class="fas fa-power-off fa-2x"></span> Salir
            </a>
          </li>
		</ul>
		</div>
        </div>
</nav>
        <script type="text/javascript">  
  function valida()
{

	swal({
  title: "Cerrar sesión",
  text: "Está seguro de salir del aplicativo?",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
window.location.href='logout.php';
  } else {
  }
});


}
</script>		


<body>
    <div class="container">
        <div class="col-md-4 offset-md-4 mt-5">

        <?php echo resultBlock($errors); ?>
						<?php echo resultCrear($creado); ?>

                            <div id="signupalert" style="display:none" class="alert alert-danger">
                                <p>Error:</p>
                                <span></span>
                            </div>
                            <div id="signupalert" style="display:none" class="alert alert-creado">
                                <p>Notificación:</p>
                                <span></span>
                            </div>

            <h1 class="my-3 text-center">Cambiar password</h1>
            <div class="card">
                <div class="card-body">
                    <form id="formulario-cambiopass" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" role="form" autocomplete="off">
                        <div class="form-group">
                        <input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>" />
						<input type="hidden" id="login" name="login" value="<?php echo $row['usuario']; ?>" />
                          <label for="pass">Nuevo Password</label>
                          <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese contraseña">
                        </div>
                        <div class="form-group">
                          <label for="pass2">Confirmar Password</label>
                          <input type="password" class="form-control" id="con_password" name="con_password" placeholder="Repita contraseña">
                        </div>
                        <button type="submit" class="btn btn-primary">Modificar</button>
                      </form>                    
                </div>
            </div>
        </div>
    </div>         
		</body>
        <script src="admin/librerias/jquery-3.4.1.min.js"></script>
	<script src="admin/librerias/bootstrap4/popper.min.js"></script>
	<script src="admin/librerias/bootstrap4/bootstrap.min.js"></script>
	<script src="admin/librerias/sweetalert.min.js"></script>		
	<script src="admin/librerias/datatable/jquery.dataTables.min.js"></script>
	<script src="admin/librerias/datatable/dataTables.bootstrap4.min.js"></script>
</html>