<?php 

	class jerarquias{

		public function agregaDependencia($datos){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="INSERT into puntosdeventa(COD, NOMBRE, CODCCOSTO, LOGIN, ESTADO)
						values ('$datos[0]',
								'$datos[1]',
								'$datos[2]',
								'$datos[3]',
								'$datos[4]')";

			return mysqli_query($conexion,$sql);
		}

		public function actualizaDependencia($datos){
			$c= new conectar();
			$conexion=$c->conexion();
			
			$sql="UPDATE puntosdeventa
			SET puntosdeventa.ESTADO = '$datos[1]', puntosdeventa.LOGIN = '$datos[2]', puntosdeventa.FECHAREG = NOW()
			WHERE puntosdeventa.COD = '$datos[0]';";
			echo mysqli_query($conexion,$sql);
		}

		public function eliminaDependencia($id){
			$c= new conectar();
			$conexion=$c->conexion();
			$sql="DELETE from puntosdeventa 
					where COD='$id'
					and ESTADO = 0";
			return mysqli_query($conexion,$sql);
		}


	}

 ?>