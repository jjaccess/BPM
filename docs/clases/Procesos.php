<?php 
		class Procesos extends Conectar {

		public function agregarProceso($datos) {
			$conexion = Conectar::conexion();

			$sql = "INSERT INTO dc_procesos (nombre, id_mcproceso, id_user) 
								VALUES (?,?,?)";
			
			$query = $conexion->prepare($sql);
			$query->bind_param("sii",$datos['proceso'], $datos['id_mcproceso'], $datos['iduser']);
            $respuesta = $query->execute();
            $query->close();
            return $respuesta;	
		}
		
		public function eliminarProceso($idProceso) {
			$conexion = Conectar::conexion();

			$sql = "DELETE FROM dc_procesos 
						WHERE id_proceso = ?";
			$query = $conexion->prepare($sql);
			$query->bind_param('i', $idProceso);
			$respuesta = $query->execute();
            $query->close();
            return $respuesta;
		}

		public function obtenerProceso($idProceso) {
			$conexion = Conectar::conexion();

			$sql = "SELECT id_proceso, nombre FROM dc_procesos
							WHERE id_proceso = '$idProceso'";
			$result = mysqli_query($conexion, $sql);
			$proceso = mysqli_fetch_array($result);
			$datos = array(
				"idProceso" => $proceso['id_proceso'],
				"nombreProceso" => $proceso['nombre']
			);
			return $datos;
		}

		public function actualizarProceso($datos) {
			$conexion = Conectar::conexion();

			$sql = "UPDATE dc_procesos 
						SET nombre = ?
						WHERE id_proceso = ?";
			$query = $conexion->prepare($sql);
			$query->bind_param("si", $datos['proceso'],
									$datos['idProceso']);
			$respuesta = $query->execute();
            $query->close();
            return $respuesta;
		}
	}
 ?>