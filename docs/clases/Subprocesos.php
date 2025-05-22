<?php 

		class Procesos extends Conectar {

		public function agregarProceso($datos) {
			$conexion = Conectar::conexion();

			$sql = "INSERT INTO dc_subprocesos (nombre, id_proceso, id_user) 
								VALUES (?,?,?)";
			
			$query = $conexion->prepare($sql);
			$query->bind_param("sii",$datos['subproceso'], $datos['id_proceso'], $datos['iduser']);
            $respuesta = $query->execute();
            $query->close();
            return $respuesta;	
		}
		
		public function eliminarProceso($idProceso) {
			$conexion = Conectar::conexion();

			$sql = "DELETE FROM dc_subprocesos 
						WHERE id_subproceso = ?";
			$query = $conexion->prepare($sql);
			$query->bind_param('i', $idProceso);
			$respuesta = $query->execute();
            $query->close();
            return $respuesta;
		}

		public function obtenerProceso($idProceso) {
			$conexion = Conectar::conexion();

			$sql = "SELECT id_subproceso, nombre FROM dc_subprocesos
							WHERE id_subproceso = '$idProceso'";
			$result = mysqli_query($conexion, $sql);
			$proceso = mysqli_fetch_array($result);
			$datos = array(
				"idProceso" => $proceso['id_subproceso'],
				"nombreProceso" => $proceso['nombre']
			);
			return $datos;
		}

		public function actualizarProceso($datos) {
			$conexion = Conectar::conexion();

			$sql = "UPDATE dc_subprocesos 
						SET nombre = ?
						WHERE id_subproceso = ?";
			$query = $conexion->prepare($sql);
			$query->bind_param("si", $datos['proceso'],
									$datos['idProceso']);
			$respuesta = $query->execute();
            $query->close();
            return $respuesta;
		}
	}
 ?>