


<?php 

	class categorias{

		public function agregaCategoria($datos){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="INSERT into invti_clasearticulos(clase,
										id_art)
						values ('$datos[0]',
								'$datos[1]')";

			return mysqli_query($conexion,$sql);
		}

		public function actualizaCategoria($datos){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE invti_clasearticulos set clase='$datos[1]'
								where id='$datos[0]'";
			echo mysqli_query($conexion,$sql);
		}

		public function eliminaCategoria($idcategoria){
			$c= new conectar();
			$conexion=$c->conexion();
			$sql="DELETE from invti_clasearticulos 
					where id='$idcategoria'";
			return mysqli_query($conexion,$sql);
		}

	}

 ?>