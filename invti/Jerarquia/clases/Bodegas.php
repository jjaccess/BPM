<?php 

	class jerarquias{

		public function agregaBodega($datos){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="INSERT into bodegas(COD,
										NOMBRE, RESPONSABLE, ESTADO, LOGIN)
						values ('$datos[0]',
								'$datos[1]',
								'$datos[2]',
								'$datos[3]',
								'$datos[4]')";

			return mysqli_query($conexion,$sql);
		}

		public function actualizaBodega($datos){
			$c= new conectar();
			$conexion=$c->conexion();


			
			$sql="UPDATE bodegas AS bodegas2
			SET bodegas2.ESTADO = 1, bodegas2.FECHAREG = NOW(), bodegas2.LOGIN = '$datos[3]'
			WHERE bodegas2.ESTADO = 0
			AND bodegas2.COD = '$datos[1]'
			AND bodegas2.id = '$datos[0]'
			AND bodegas2.RESPONSABLE = '$datos[2]';";
			echo mysqli_query($conexion,$sql);
		}

		public function eliminaBodega($id){
			$c= new conectar();
			$conexion=$c->conexion();
			$sql="DELETE from bodegas 
					where id='$id'
					and ESTADO = 0";
			return mysqli_query($conexion,$sql);
		}

	}

 ?>