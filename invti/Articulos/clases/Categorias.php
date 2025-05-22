


<?php 

	class categorias{

		public function agregaCategoria($datos){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="INSERT into invti_articulos(articulo,
										id_tipoart)
						values ('$datos[0]',
								'$datos[1]')";

			return mysqli_query($conexion,$sql);
		}

		public function actualizaCategoria($datos){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE invti_articulos set articulo='$datos[1]'
								where id='$datos[0]'";
			echo mysqli_query($conexion,$sql);
		}

		public function eliminaCategoria($idcategoria){
			$c= new conectar();
			$conexion=$c->conexion();
			$sql="DELETE from invti_articulos 
					where id='$idcategoria'";
			return mysqli_query($conexion,$sql);
		}

	}

 ?>