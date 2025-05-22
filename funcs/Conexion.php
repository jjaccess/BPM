<?php 


session_start();

$idempresa = $_SESSION['id_empresa'];

if($idempresa=='1')
{
	class conectar{
		private $servidor="localhost";
		private $usuario="admrsoc";
		private $password="7637ba32d1c3c5673b9fc5a35fb91182";
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
		private $usuario="admrsoc";
		private $password="7637ba32d1c3c5673b9fc5a35fb91182";
		private $bd="BPMSSN";

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
		private $usuario="admrsoc";
		private $password="7637ba32d1c3c5673b9fc5a35fb91182";
		private $bd="BPMRSO";

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
		private $usuario="admrsoc";
		private $password="7637ba32d1c3c5673b9fc5a35fb91182";
		private $bd="BPMATL";

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
		private $usuario="admrsoc";
		private $password="7637ba32d1c3c5673b9fc5a35fb91182";
		private $bd="BPMMAG";

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
		private $usuario="admrsoc";
		private $password="7637ba32d1c3c5673b9fc5a35fb91182";
		private $bd="BPMDEMO";

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