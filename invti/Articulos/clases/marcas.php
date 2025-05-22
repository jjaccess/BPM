


<?php 

	class categorias{

		public function agregaCategoria($datos){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="INSERT into invti_marca(marca,
										id_articulo)
						values ('$datos[0]',
								'$datos[1]')";

			return mysqli_query($conexion,$sql);
		}

		public function actualizaCategoria($datos){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE invti_marca set marca='$datos[1]'
								where id='$datos[0]'";
			echo mysqli_query($conexion,$sql);
		}

		public function eliminaCategoria($idcategoria){
			$c= new conectar();
			$conexion=$c->conexion();
			$sql="DELETE from invti_marca 
					where id='$idcategoria'";
			return mysqli_query($conexion,$sql);
		}

	}

 ?>