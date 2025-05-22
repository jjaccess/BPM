


<?php 

	class proveedores{

		public function agregaProveedor($datos){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="INSERT into proveedores(nit,
										proveedor)
						values ('$datos[0]',
								'$datos[1]')";

			return mysqli_query($conexion,$sql);
		}

		public function actualizaProveedor($datos){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE proveedores set proveedor='$datos[1]'
								where id='$datos[0]'";
			echo mysqli_query($conexion,$sql);
		}

		public function eliminaProveedor($id){
			$c= new conectar();
			$conexion=$c->conexion();
			$sql="DELETE from proveedores 
					where id='$id'";
			return mysqli_query($conexion,$sql);
		}

	}

 ?>