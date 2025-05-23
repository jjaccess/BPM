<?php 


session_start();

$idempresa = $_SESSION['id_empresa'];

if($idempresa=='1')
{
	class conectar{
		private $servidor="localhost";
		private $usuario="root";
		private $password="";
		private $bd="BPM";

		public function conexion(){
			$mysqli=mysqli_connect($this->servidor,
									 $this->usuario,
									 $this->password,
									 $this->bd);
			$mysqli->set_charset('utf8mb4');
			return $mysqli;
		}
	}
} elseif($idempresa=='2')
{
	class conectar{
		private $servidor="localhost";
		private $usuario="root";
		private $password="0";
		private $bd="BPM2";

		public function conexion(){
			$mysqli=mysqli_connect($this->servidor,
									 $this->usuario,
									 $this->password,
									 $this->bd);
			$mysqli->set_charset('utf8mb4');						 
			return $mysqli;
		}
	}
}
elseif($idempresa=='3')
{
	class conectar{
		private $servidor="localhost";
		private $usuario="root";
		private $password="0";
		private $bd="BPM3";

		public function conexion(){
			$mysqli=mysqli_connect($this->servidor,
									 $this->usuario,
									 $this->password,
									 $this->bd);
			$mysqli->set_charset('utf8mb4');									 
			return $mysqli;
		}
	}
}	
elseif($idempresa=='4')
{
	class conectar{
		private $servidor="localhost";
		private $usuario="root";
		private $password="0";
		private $bd="BPM4";

		public function conexion(){
			$mysqli=mysqli_connect($this->servidor,
									 $this->usuario,
									 $this->password,
									 $this->bd);
			$mysqli->set_charset('utf8mb4');									 
			return $mysqli;
		}
	}
}	
elseif($idempresa=='5')
{
	class conectar{
		private $servidor="localhost";
		private $usuario="root";
		private $password="0";
		private $bd="BPM5";

		public function conexion(){
			$mysqli=mysqli_connect($this->servidor,
									 $this->usuario,
									 $this->password,
									 $this->bd);
			$mysqli->set_charset('utf8mb4');									 
			return $mysqli;
		}
	}
}	
elseif($idempresa=='6')
{
	class conectar{
		private $servidor="localhost";
		private $usuario="root";
		private $password="0";
		private $bd="BPM6";

		public function conexion(){
			$mysqli=mysqli_connect($this->servidor,
									 $this->usuario,
									 $this->password,
									 $this->bd);
			$mysqli->set_charset('utf8mb4');									 
			return $mysqli;
		}
	}
}	
?>