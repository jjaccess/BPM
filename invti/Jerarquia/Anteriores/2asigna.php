<?php
	session_start();
	
	require '../../../funcs/connect.php';
  require '../../../funcs/funcs.php';

	if(!isset($_SESSION["id_usuario"])){
	header("Location: ../../../index.php");
	}

	$now = time();
	if($now > $_SESSION['expire']) {
	session_destroy();

	echo "Su sesion a terminado";
	header('Location: ../../../index.php');
	exit;
	}	

	$idempresa = $_SESSION['id_empresa'];
	
	$sqlempresa = "SELECT empresa FROM empresas WHERE identificador = '$idempresa'";
	$resultempresa = $mysqli->query($sqlempresa);
	$rowempresa = $resultempresa->fetch_assoc();
	
    $idUsuario = $_SESSION['id_usuario'];
    
    $sql = "SELECT id, usuario, nombre FROM usuarios WHERE id = '$idUsuario'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    
    
    //$busqueda = $_GET['busqueda'];

	$query= "SELECT ccostos.id id, ccostos.COD COD, ccostos.CODBODEGA CODBODEGA, ccostos.NOMBRE NOMBRE, ccostos.RESPONSABLE RESPONSABLE, status.status ESTADO 
                    FROM ccostos, status 
                    WHERE COD LIKE '%'
                    AND ccostos.ESTADO = status.id
                    ";
	$resultado = $mysqli->query($query);

?>


<!DOCTYPE html>
<html lang="es">

    <head>

        <meta charset="utf-8">
        <title>▂ : BPM : ▂ Administración</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Ejemplo Permisos con Desarrollos PHP">

        <!-- CSS -->
        <link rel="icon" type="image/png" href="../../img/Supergiros.ico" />
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="../../css/bootstrap.min.css">
        <link rel="stylesheet" href="../../css/bootstrap-theme.css">
        <link rel="stylesheet" href="../../css/jquery.dataTables.min.css">
        <script src="../../js/jquery-3.3.1.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/jquery.dataTables.min.js"></script>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
       

    </head>

<!--//////////////////////////////////////////////////Empieza cuerpo del documento interno////////////////////////////////////////////-->

<div class="container">
    <div class="jumbotron">

        <div style="position: absolute; margin: -40px 0px 0px 850px;">
            <IMG src="../../img/super.png" width="200px" alt="x"></IMG>
        </div>

        <center><h2><dt>Asignación Responsables</dt></h2></center>

        <ul class="nav navbar-nav navbar-left">
            <li><a href=""><span class="glyphicon glyphicon-user"></span> <?php echo ''.utf8_decode($row['nombre']); ?></a></li>
			<li><a href=""><span class="glyphicon glyphicon-mail"></span> <?php echo "@" .utf8_decode($rowempresa['empresa']); ?></a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">

            <li><a href="../../logout.php" class='nav navbar-nav navbar-right'><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesi&oacute;n</a></li>
        </ul>

 <input type="hidden" value="<?php echo 'Login:  '.utf8_decode($row['usuario']);?>">

    </div>
</div>  

    <div class="container">
        <div class="btn-group">
            <a href="2NewCCosto.php" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Nuevo Responsable</a><a href="../principal.php" class="btn btn-danger"><span class="glyphicon glyphicon-arrow-left"></span> Vovler</a>
        </div>    
    <br><br>
 
        <div class="row table-responsive">
        <table class="table table-bordered display" id="mitabla">
            <thead class="text-center text-primary">
                    <tr>
                        <td><center><b>Id</td>
                        <td><center><b>Codigo</td>
                        <td><center><b>Nombre</td>
                        <td><center><b>Codigo bodega</td>
                        <td><center><b>Responsable</td>
                        <td><center><b>Estado</td>
                        <td><center><b>Editar</td>
                    </tr>
            </thead>
  
              
            <tbody>
                        <?php while($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['COD']; ?></td>
                                <td><?php echo $row['NOMBRE']; ?></td>
                                <td><?php echo $row['CODBODEGA'];?></td>                               
                                <td><?php echo $row['RESPONSABLE']; ?></td>
                                <td><?php echo $row['ESTADO']; ?></td>
                                
                                <td><a href="2statusActualizar.php?id=<?php echo $row['id']; ?>"><center><span class="glyphicon glyphicon-edit" onclick='return confirmarEditar()'></span></a></td>
								
                                
                            </tr>
                        <?php } ?>
            </tbody>
        </table>
        </div><br>
   
<script>
        
        $(document).ready(function(){

            $('#mitabla').dataTable({

                "language":{

                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "info": "Mostrando pagina _PAGE_ de _PAGES_",
                        "infoEmpty": "No hay registros disponibles",
                        "infoFiltered": "(filtrada de _MAX_ registros)",
                        "loadingRecords": "Cargando...",
                        "processing":     "Procesando...",
                        "search": "Buscar:",
                        "zeroRecords":    "No se encontraron registros que coincidan",
                        "paginate": {
                            "next":       "Siguiente",
                            "previous":   "Anterior"
                        }
                }

            });

        });

    </script>

  </body>
</html>