<?php 
		class Mcprocesos extends Conectar {

		public function agregarMcproceso($datos) {
			$conexion = Conectar::conexion();

			$sql = "INSERT INTO dc_mcprocesos (nombre, id_user) 
								VALUES (?,?)";
			
			$query = $conexion->prepare($sql);
			$query->bind_param("si",$datos['mcproceso'], $datos['iduser']);
            $respuesta = $query->execute();
            $query->close();
            return $respuesta;	
		}
		
		public function eliminarMcproceso($idMcproceso) {
			$conexion = Conectar::conexion();

			$sql = "DELETE FROM dc_mcprocesos 
						WHERE id_mcproceso = ?";
			$query = $conexion->prepare($sql);
			$query->bind_param('i', $idMcproceso);
			$respuesta = $query->execute();
            $query->close();
            return $respuesta;
		}

		public function obtenerMcproceso($idMcproceso) {
			$conexion = Conectar::conexion();

			$sql = "SELECT id_mcproceso, nombre FROM dc_mcprocesos
							WHERE id_mcproceso = '$idMcproceso'";
			$result = mysqli_query($conexion, $sql);
			$mcproceso = mysqli_fetch_array($result);
			$datos = array(
				"idMcproceso" => $mcproceso['id_mcproceso'],
				"nombreMcproceso" => $mcproceso['nombre']
			);
			return $datos;
		}

		public function actualizarMcproceso($datos) {
			$conexion = Conectar::conexion();

			$sql = "UPDATE dc_mcprocesos 
						SET nombre = ?
						WHERE id_mcproceso = ?";
			$query = $conexion->prepare($sql);
			$query->bind_param("si", $datos['mcproceso'],
									$datos['idMcproceso']);
			$respuesta = $query->execute();
            $query->close();
            return $respuesta;
		}
	}
 ?>