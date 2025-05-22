<?php 

	class jerarquias{

		public function agregaResponsable($datos){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="INSERT into ccostos(LOGIN,
										COD, NOMBRE, CODBODEGA, RESPONSABLE, ESTADO)
						values ('$datos[0]',
								'$datos[1]',
								'$datos[2]',
								'$datos[3]',
								'$datos[4]',
								'$datos[5]')";

			return mysqli_query($conexion,$sql);
		}

		public function actualizaBodega($datos){
			$c= new conectar();
			$conexion=$c->conexion();
			
			$sql="UPDATE ccostos
			SET ccostos.ESTADO = 1, ccostos.LOGIN = '$datos[3]', ccostos.FECHAREG = NOW()
			WHERE ccostos.RESPONSABLE = '$datos[1]'
			AND ccostos.id = '$datos[0]';";
			echo mysqli_query($conexion,$sql);
		}

		public function eliminaBodega($id){
			$c= new conectar();
			$conexion=$c->conexion();
			$sql="DELETE from ccostos 
					where id='$id'
					and ESTADO = 0";
			return mysqli_query($conexion,$sql);
		}

		public function actualizaBodega2($datos){
			$c= new conectar();
			$conexion=$c->conexion();


			
			$sql="UPDATE ccostos 
			SET ccostos.ESTADO = '$datos[1]', ccostos.FECHAREG = NOW(), ccostos.LOGIN = '$datos[2]'
			WHERE ccostos.id = '$datos[0]';";
			echo mysqli_query($conexion,$sql);
		}

	}

 ?>