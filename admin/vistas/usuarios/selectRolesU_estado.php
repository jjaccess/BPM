<?php 
	
    session_start();
	
    require '../../../funcs/Conexion.php';
	$conexion = new Conectar();
	$mysqli = $conexion->conexion();
    require '../../../funcs/funcs.php';
    
        $idempresa = $_SESSION['id_empresa'];
        
        $sqlempresa = "SELECT empresa FROM empresas WHERE identificador = '$idempresa'";
        $resultempresa = $mysqli->query($sqlempresa);
        $rowempresa = $resultempresa->fetch_assoc();	
        
        $idUsuario = $_SESSION['id_usuario'];
        
        $sql = "SELECT id, usuario, nombre FROM usuarios WHERE id = '$idUsuario'";
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();
    
        $sqlroles = "SELECT id, status FROM status
        ORDER BY id";
        $resultroles = mysqli_query($mysqli, $sqlroles);
            

?>

<select name="activacionU" id="activacionU" class="form-control">

	<?php 					
    	while ($mostrar=mysqli_fetch_array($resultroles)){
		$idrol = $mostrar['id'];       
		$tipo = $mostrar['status'];                 
	?>
			<option value="<?php echo $idrol ?>"><?php echo $tipo?></option>
	<?php 
	}
	 ?>
 
</select>	
 
	