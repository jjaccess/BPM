<?php 

		class Usuarios extends Conectar {

		public function agregarUsuario($datos) {

			$conexion = Conectar::conexion();

			$sql = "INSERT INTO usuarios (usuario, password, nombre, correo, activacion, id_tipo, login, password_request) 
					VALUES(?,?,?,?,?,?,?,?)";
			$query = $conexion->prepare($sql);
			$query->bind_param("ssssiiii", $datos['usuario'], $datos['password'], $datos['nombre']
										, $datos['correo'], $datos['activacion'], $datos['rol']
										, $datos['iduser'], $datos['password_request']);
            $respuesta = $query->execute();
            $query->close();
            return $respuesta;	
		}
		
		public function eliminarUsuario($idCategoria) {
			$conexion = Conectar::conexion();

			$sql = "DELETE FROM usuarios 
						WHERE id = ?";
			$query = $conexion->prepare($sql);
			$query->bind_param('i', $idCategoria);
			$respuesta = $query->execute();
            $query->close();
            return $respuesta;
		}

		public function obtenerUsuario($idCategoria) {
			$conexion = Conectar::conexion();

			$sql = "SELECT id, nombre, correo, id_tipo, activacion FROM usuarios
							WHERE id = '$idCategoria'";
			$result = mysqli_query($conexion, $sql);
			$userU = mysqli_fetch_array($result);
			$datos = array(
				"id" => $userU['id'],
				"nombreU" => $userU['nombre'],
				"correoU" => $userU['correo'],
				"id_tipoU" => $userU['id_tipo'],
				"activacionU" => $userU['activacion']
			);
			return $datos;
		}

		public function obtenerUsuarioR($idCategoria) {
			$conexion = Conectar::conexion();

			$sql = "SELECT id, nombre FROM usuarios
							WHERE id = '$idCategoria'";
			$result = mysqli_query($conexion, $sql);
			$userU = mysqli_fetch_array($result);
			$datos = array(
				"idR" => $userU['id'],
				"nombreR" => $userU['nombre']
			);
			return $datos;
		}

		public function CambiapasswordCP($datos) {
			$conexion = Conectar::conexion();

			$sql = "SELECT * FROM usuarios 
						WHERE id = ?
						AND usuario = ?";
			$query = $conexion->prepare($sql);
			$query->bind_param("ii", $datos['CPid'], $datos['CPuser']);
			$respuesta = $query->execute();
            $query->close();
            return $respuesta;
		}

		public function actualizarUsuario($datos) {
			$conexion = Conectar::conexion();

			$sql = "UPDATE usuarios 
						SET login = ?,
						nombre = ?,
						correo = ?,
						id_tipo = ?,
						activacion = ?,
						fecharegistro = now()
						WHERE id = ?";
			$query = $conexion->prepare($sql);
			$query->bind_param("issiii", $datos['iduser'], $datos['nombreU'], $datos['correoU'],
									$datos['id_tipoU'], $datos['activacionU'], $datos['idCategoria']);
			$respuesta = $query->execute();
            $query->close();
            return $respuesta;
		}

		public function resetUsuario($datos) {
			$conexion = Conectar::conexion();

			$sql = "UPDATE usuarios 
						SET login = ?,
						password = ?,
						password_request = 1,
						fecharegistro = now()
						WHERE id = ?";
			$query = $conexion->prepare($sql);
			$query->bind_param("isi", $datos['iduser'], $datos['password'], $datos['idR']);
			$respuesta = $query->execute();
            $query->close();
            return $respuesta;
		}

	}
 ?>