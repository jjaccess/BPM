<?php 
	class Gestor extends Conectar {
		public function agregaRegistroArchivo($datos) {
			$conexion = Conectar::conexion();
			
			$sql = "INSERT INTO dc_archivos (id_usuario,
										  id_categoria,
										  nombre,
										  tipo,
										  ruta) 
								VALUES (?, ?, ?, ?, ?)";
			$query = $conexion->prepare($sql);
			$query->bind_param("iisss", $datos['idUsuario'],
										$datos['idCategoria'],
										$datos['nombreArchivo'],
										$datos['tipo'],
										$datos['ruta']);

			$respuesta = $query->execute();
			$query->close();
			return $respuesta;
		}

		public function obtenNombreArchivo($idArchivo) {
			$conexion = Conectar::conexion();
			
			$sql = "SELECT nombre 
					FROM dc_archivos 
					WHERE id_archivo = '$idArchivo' ";
			$result = mysqli_query($conexion, $sql);

			return mysqli_fetch_array($result)['nombre'];
		}

		public function obtenidCategoria($idArchivo) {
			$conexion = Conectar::conexion();
			
			$sql = "SELECT id_categoria 
					FROM dc_archivos 
					WHERE id_archivo = '$idArchivo' ";
			$result = mysqli_query($conexion, $sql);

			return mysqli_fetch_array($result)['id_categoria'];
		}

		public function eliminarRegistroArchivo($idArchivo) {
			$conexion = Conectar::conexion();

			$sql = "DELETE FROM dc_archivos 
					WHERE id_archivo = ?";
			$query = $conexion->prepare($sql);
			$query->bind_param('i', $idArchivo);
			$respuesta = $query->execute();
			$query->close();
			return $respuesta;

		}

		public function obtenerRutaArchivo($idArchivo) {
			$conexion = Conectar::conexion();

			$sql = "SELECT nombre, tipo, id_categoria 
					FROM dc_archivos 
					WHERE id_archivo = '$idArchivo'";
			$result = mysqli_query($conexion, $sql);
			$datos = mysqli_fetch_array($result);
			$nombreArchivo = $datos['nombre'];
			$extension = $datos['tipo'];
			$id_categoria = $datos['id_categoria'];
			return self::tipoArchivo($nombreArchivo, $extension, $id_categoria);
			
		}

		public function tipoArchivo($nombre, $extension, $id_categoria){

			$ruta = "../archivos/".$id_categoria."/".$nombre;

			switch ($extension) {
				case 'png':
					return '<img src="'.$ruta.'" width="80%">';
					break;

				case 'jpg':
					return '<img src="'.$ruta.'" width="80%">';
					break;

				case 'jpeg':
					return '<img src="'.$ruta.'" width="80%">';
					break;	

				case 'pdf':
					return '<embed src="' . $ruta . '#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" width="100%" height="600px" />';
					break;	
			
				case 'mp3':
					return '<audio controls src="' . $ruta . '"></audio>';
					break;

				case 'mp4':
					return '<video src="' . $ruta . '" controls width="100%" height="600px"></video>';
					break;	
						
				default:
					
					break;
			}

		}
	}

 ?>