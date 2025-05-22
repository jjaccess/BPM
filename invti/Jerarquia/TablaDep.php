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
<div class="table-responsive">
<table class='table table-striped table-bordered table-light' id='mitabla' style="text-align: center;" cellspacing="0" width="100%">
		<thead class="thead-dark">
					<tr style="text-align: center;">
                        <td>Codigo</td>
                        <td>Bodega padre</td>  
                        <td>Codigo</td> 
                        <td>Dependencia</td> 
                        <td>Estado</td>
                        <td>Cambia estado</td>
                        <td>Eliminar</td> 
                    </tr>

                </thead>

                <tbody>

                     <?php 

                    $query = mysqli_query($mysqli,"SELECT
                    puntosdeventa.COD COD, 
                    puntosdeventa.CODCCOSTO CODPADRE,
						  ccostos.NOMBRE NOMPADRE, 
                    puntosdeventa.NOMBRE NOMBRE,  
                    status.status ESTADO,
						  puntosdeventa.ESTADO idestado 
                    FROM puntosdeventa, status, ccostos
                    WHERE puntosdeventa.COD LIKE '%'
                    AND puntosdeventa.CODCCOSTO = ccostos.COD
                    AND puntosdeventa.ESTADO = status.id 
                    GROUP BY COD
                    ORDER BY NOMBRE, COD, CODBODEGA, NOMPADRE     
                        ");

                

                    $result = mysqli_num_rows($query);
                    if($result > 0){
                        mysqli_close($mysqli);
                        while ($data = mysqli_fetch_array($query)) {

                    ?>

                    <tr>
                        <td><?php echo $data['CODPADRE']; ?></td>
                        <td><?php echo $data['NOMPADRE']; ?></td>
                        <td><?php echo $data['COD']; ?></td>
                        <td><?php echo $data['NOMBRE']; ?></td>
                        <td><?php echo $data['ESTADO']; ?></td>


<!-- Modificar -->        
    <td>
			<span class="btn btn-warning btn-xs" data-toggle="modal" 
            data-target="#actualizaCategoria" 
            onclick="agregaDato('<?php echo $data['COD'] ?>','<?php echo $data['ESTADO'] ?>','<?php echo $rowuser['usuario'] ?>')">
				<span class="fas fa-edit"></span>
			</span>
        </td>
<!-- Elimina --> 
        <td>
        <?php 
            $validabod =  $data['idestado'];
            if($validabod == 0){

        ?>
			<span class="btn btn-danger btn-xs" onclick="eliminaCategoria('<?php echo $data['COD']?>')">
				<span class="fas fa-trash-alt"></span>
			</span>
        <?php 
                    }else{
                        ?> 
			<span class="btn btn-danger btn-xs">
				<span class="fas fa-ban"></span>
			</span> 
            <?php 
                    }
                        ?>                       
		</td>
                    </tr>
                        <?php } ?>
                    <?php }
                    ?>

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