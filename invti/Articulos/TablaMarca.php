<?php
	session_start();

    if(!isset($_SESSION["id_usuario"])){
        header("Location: ../../index.php");
    }

	require '../../funcs/Conexion.php';
	$conexion = new Conectar();
	$mysqli = $conexion->conexion();
		
	$idempresa = $_SESSION['id_empresa'];
	
	$sqlempresa = "SELECT empresa FROM empresas WHERE identificador = '$idempresa'";
	$resultempresa = $mysqli->query($sqlempresa);
	$rowempresa = $resultempresa->fetch_assoc();		
	
	$idUsuario = $_SESSION['id_usuario'];
	
	$sql = "SELECT id, usuario, nombre FROM usuarios WHERE id = '$idUsuario'";
	$result = $mysqli->query($sql);
	
	$rowuser = $result->fetch_assoc();
	$userensqlzona = utf8_decode($rowuser['usuario']);
?>
<html>
    <head>
    <?php require_once "../librerias.php"; ?>
        <title>
        </title>
    </head>
    <body>
<div class="container">
        <div class="row table-responsive">
            <table class="table table-hover table-condensed table-bordered" id="mitabla" style="text-align: center;" cellspacing="0" width="100%">
                <thead class="text-center">
                    <tr>
                        <td>Artículo</td>
                        <td>Marca</td>    
                        <td>Editar</td>
                        <td>Eliminar</td> 
                    </tr>

                </thead>

                <tbody>

                     <?php 

$query = mysqli_query($mysqli,"SELECT invti_marca.id id, invti_marca.marca marca, invti_articulos.articulo id_articulo
FROM invti_marca, invti_articulos 
WHERE marca LIKE '%'
AND invti_marca.id_articulo = invti_articulos.id
ORDER BY id_articulo, marca

");

                    mysqli_close($mysqli);

                    $result = mysqli_num_rows($query);
                    if($result > 0){

                        while ($data = mysqli_fetch_array($query)) {

                    ?>

                    <tr>
                        <td><?php echo $data['id_articulo']; ?></td>
                        <td><?php echo $data['marca']; ?></td>
                        <td>
			<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#actualizaCategoria" onclick="agregaDato('<?php echo $data['id'] ?>','<?php echo $data['marca'] ?>')">
				<span class="fas fa-edit"></span>
			</span>
        </td>
        <td>
			<span class="btn btn-danger btn-xs" onclick="eliminaCategoria('<?php echo $data['id']?>')">
				<span class="fas fa-trash-alt"></span>
			</span>
		</td>
                    </tr>
                        <?php } ?>
                    <?php }?>

                </tbody>
            </table>

            
        </div> <!-- fin div responsive --><br>
    </div> <!-- fin div container -->
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
<?php
require_once '../creditos.php';
?>
        </body>
</html>