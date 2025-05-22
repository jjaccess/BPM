<?php

	function traer( $cod, $campo )
	{

		global $mysqli;

		$resultado = $mysqli -> query ("SELECT DISTINCT $campo FROM bodegas WHERE COD = '$cod'");

     while ($consulta = mysqli_fetch_array($resultado))
	 {
		 echo $consulta['COD'];
		 echo $consulta['NOMBRE'];
	 }

	}
	
	function traerLot( $cod, $campo )
	{

		global $mysqli;

 		$resultado = $mysqli -> query ("SELECT DISTINCT $campo FROM resultv_resultados WHERE CODIGO = '$cod'");

     while ($consulta = mysqli_fetch_array($resultado))
	 {
		 echo $consulta['CODIGO'];
		 echo $consulta['NOMBRE_LOTERIA'];
	 }

	}
	
	function isNull($nombre, $user, $pass, $pass_con, $email){
		if(strlen(trim($nombre)) < 1 || strlen(trim($user)) < 1 || strlen(trim($pass)) < 1 || strlen(trim($pass_con)) < 1 || strlen(trim($email)) < 1)
		{
			return true;
			} else {
			return false;
		}		
	}
	
	function isNullModificaPassword($password, $con_password){
		if(strlen(trim($pass)) < 1 || strlen(trim($con_password)) < 1)
		{
			return true;
			} else {
			return false;
		}		
	}	
	
	function isNullModificaUser($id, $tipo, $status, $login){
		if(strlen(trim($id)) < 1 || strlen(trim($tipo)) < 1 || strlen(trim($status)) < 1 || strlen(trim($login)) < 1)
		{
			return true;
			} else {
			return false;
		}		
	}	
	
	function isNullActualizaEstadoBodega($id, $status, $cod){
		if(strlen(trim($id)) < 1 || strlen(trim($status)) < 1 || strlen(trim($cod)) < 1)
		{
			return true;
			} else {
			return false;
		}		
	}	

	function isNullActualizaEstadoResponsable($id, $status, $cod){
		if(strlen(trim($id)) < 1 || strlen(trim($status)) < 1 || strlen(trim($cod)) < 1)
		{
			return true;
			} else {
			return false;
		}		
	}	
	
	function isNullCrearBodega($cod, $nombre,  $responsable){
		if(strlen(trim($cod)) < 1 || strlen(trim($nombre)) < 1 || strlen(trim($responsable)) < 1)
		{
			return true;
			} else {
			return false;
		}		
	}	
	
		function isNullCrearResponsable($cod, $nombre, $responsable){
		if(strlen(trim($cod)) < 1 || strlen(trim($nombre)) < 1 || strlen(trim($responsable)) < 1)
		{
			return true;
			} else {
			return false;
		}		
	}	
	
		function isNullCrearArticulo($articulo, $id_tipoart){
		if(strlen(trim($articulo)) < 1 || strlen(trim($id_tipoart)) < 1)
		{
			return true;
			} else {
			return false;
		}		
	}		
	
		function isNullCrearMarca($marca, $id_articulo){
		if(strlen(trim($marca)) < 1 || strlen(trim($id_articulo)) < 1)
		{
			return true;
			} else {
			return false;
		}		
	}	

	
	function isEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL)){
			return true;
			} else {
			return false;
		}
	}
	
	function validaPassword($var1, $var2)
	{
		if (strcmp($var1, $var2) !== 0){
			return false;
			} else {
			return true;
		}
	}

	function validaPasswordAnterior($var1, $var2)
	{
		$validaPassw = password_verify($var1, $var2);

		if ($validaPassw) {
			return false;
			} else {
			return true;
		}
	}


	function minMax($min, $max, $valor){
		if(strlen(trim($valor)) < $min)
		{
			return true;
		}
		else if(strlen(trim($valor)) > $max)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function usuarioExiste($usuario)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT id FROM usuarios WHERE usuario = ? LIMIT 1");
		$stmt->bind_param("s", $usuario);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();
		
		if ($num > 0){
			return true;
			} else {
			return false;
		}
	}
	
	function emailExiste($email)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT id FROM usuarios WHERE correo = ? LIMIT 1");
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();
		
		if ($num > 0){
			return true;
			} else {
			return false;	
		}
	}
	
	function generateToken()
	{
		$gen = md5(uniqid(mt_rand(), false));	
		return $gen;
	}
	
	function hashPassword($password) 
	{
		$hash = password_hash($password, PASSWORD_DEFAULT);
		return $hash;
	}
	
	function resultBlock($errors){
		if(count($errors) > 0)
		{
			echo "<div id='error' class='alert alert-danger' role='alert'>
			<a href='#' onclick=\"showHide('error');\">[X]</a>
			<ul>";
			foreach($errors as $error)
			{
				echo "<li>".$error."</li>";
			}
			echo "</ul>";
			echo "</div>";
		}
	}

	function resultCrear($creado){
		if(count($creado) > 0)
		{
			echo "<div id='crea' class='alert alert-success' role='alert'>
			<a href='#' onclick=\"showHide('crea');\">[Ok]</a>
			<ul>";
			foreach($creado as $crea)
			{
				echo "<li>".$crea."</li>";
			}
			echo "</ul>";
			echo "</div>";
		}
	}	

	function resultActivoSuccess($creado){
		if(count($creado) > 0)
		{
			echo "<div id='crea' class='alert alert-success' role='alert'>
			<a href='registro.php' onclick=\"showHide('crea');\">[Ok]</a>
			<ul>";
			foreach($creado as $crea)
			{
				echo "<li>".$crea."</li>";
			}
			echo "</ul>";
			echo "</div>";
		}
	}		
	
		function resultActivoError($errors){
		if(count($errors) > 0)
		{
			echo "<div id='error' class='alert alert-danger' role='alert'>
			<a href='registro.php' onclick=\"showHide('error');\">[X]</a>
			<ul>";
			foreach($errors as $error)
			{
				echo "<li>".$error."</li>";
			}
			echo "</ul>";
			echo "</div>";
		}
	}
	
	function registraUsuario($usuario, $pass_hash, $nombre, $email, $activo, $tipo_usuario, $login){
		
		global $mysqli;
		
		$stmt = $mysqli->prepare("INSERT INTO usuarios (usuario, password, nombre, correo, activacion, id_tipo, login) VALUES(?,?,?,?,?,?,?)");
		$stmt->bind_param('ssssiii', $usuario, $pass_hash, $nombre, $email, $activo, $tipo_usuario,$login);
		
		if ($stmt->execute()){
			return $mysqli->insert_id;
			} else {
			return 0;	
		}		
	}
	
	function enviarEmail($email, $nombre, $asunto, $cuerpo){
		
		require 'PHPMailer/PHPMailerAutoload.php';
		
		$mail = new PHPMailer();
		$mail->isSMTP();
		//$mail->SMTPDebug = 2;
		$mail->Debugoutput = 'html';
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'yes'; //Modificar
		$mail->Host = 'correo.supergiroscasanare.co'; //Modificar
		$mail->Port = 587; //Modificar
		
        $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
           )
          );
		
		$mail->Username = 'bpm@supergiroscasanare.co'; //Modificar
		$mail->Password = 'Rsoc2020*'; //Modificar
		
		$mail->setFrom('bpm@supergiroscasanare.co', 'Business Processes Module'); //Modificar
		$mail->addAddress($email, $nombre);
		
		$mail->Subject = $asunto;
		$mail->Body    = $cuerpo;
		$mail->IsHTML(true);
	
	    if (!$mail->send()) {
          echo "Mailer Error: " . $mail->ErrorInfo;
           } else {
            echo "Info enviada a la direccion de correo electronico: $email";
             }
	
	}

	function enviarEmail2($email, $nombre, $asunto, $cuerpo){
		
		
		$mail = new PHPMailer();
		$mail->isSMTP();
		//$mail->SMTPDebug = 2;
		$mail->Debugoutput = 'html';
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'yes'; //Modificar
		$mail->Host = 'correo.supergiroscasanare.co'; //Modificar
		$mail->Port = 587; //Modificar
		
        $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
           )
          );
		
		$mail->Username = 'bpm@supergiroscasanare.co'; //Modificar
		$mail->Password = 'Rsoc2020*'; //Modificar
		
		$mail->setFrom('bpm@supergiroscasanare.co', 'Business Processes Module'); //Modificar
		$mail->addAddress($email, $nombre);
		
		$mail->Subject = $asunto;
		$mail->Body    = $cuerpo;
		$mail->IsHTML(true);
	
	    if (!$mail->send()) {
          echo "Mailer Error: " . $mail->ErrorInfo;
           } else {
            echo "Info enviada a la direccion de correo electronico: $email";
             }
	
	}
	
	function validaIdToken($id, $token){
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE id = ? AND token = ? LIMIT 1");
		$stmt->bind_param("is", $id, $token);
		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->num_rows;
		
		if($rows > 0) {
			$stmt->bind_result($activacion);
			$stmt->fetch();
			
			if($activacion == 1){
				$msg = "La cuenta ya se activo anteriormente.";
				} else {
				if(activarUsuario($id)){
					$msg = 'Cuenta activada.';
					} else {
					$msg = 'Error al Activar Cuenta';
				}
			}
			} else {
			$msg = 'No existe el registro para activar.';
		}
		return $msg;
	}
	
	function activarUsuario($id)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("UPDATE usuarios SET activacion=1 WHERE id = ?");
		$stmt->bind_param('s', $id);
		$result = $stmt->execute();
		$stmt->close();
		return $result;
	}
	
	function isNullLogin($usuario, $password){
		if(strlen(trim($usuario)) < 1 || strlen(trim($password)) < 1)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
	
		function isNullPd_personas($documento,$t_documento,$nombre,$apellido,$cargo,$departamento,$ciudad,$telefono,$fecha_ingreso,$login){
		if(strlen(trim($documento)) < 1 || strlen(trim($t_documento)) < 1 || strlen(trim($nombre)) < 1 || strlen(trim($apellido)) < 1 || strlen(trim($cargo)) < 1 || strlen(trim($departamento)) < 1 || strlen(trim($ciudad)) < 1  || strlen(trim($telefono)) < 1 || strlen(trim($fecha_ingreso)) < 1 || strlen(trim($login)) < 1)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
	
	function login($usuario, $password)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT id, id_tipo, password FROM usuarios WHERE usuario = ? || correo = ? LIMIT 1");
		$stmt->bind_param("ss", $usuario, $usuario);
		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->num_rows;
		
		if($rows > 0) {
			
			if(isActivo($usuario)){
				
				$stmt->bind_result($id, $id_tipo, $passwd);
				$stmt->fetch();
				
				$validaPassw = password_verify($password, $passwd);
				
				if($validaPassw){
					
					lastSession($id);
					$_SESSION['id_usuario'] = $id;
					$_SESSION['tipo_usuario'] = $id_tipo;
					
					header("location: welcome.php");
					} else {
					
					$errors = "La contrase&ntilde;a es incorrecta";
				}
				} else {
				$errors = 'El usuario no esta activo';
			}
			} else {
			$errors = "El usuario no existe o no pertenece a esta empresa";
		}
		return $errors;
	}
	
	function lastSession($id)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("UPDATE usuarios SET last_session=NOW() WHERE id = ?");
		$stmt->bind_param('s', $id);
		$stmt->execute();
		$stmt->close();
	}
	
	function isActivo($usuario)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE usuario = ? || correo = ? LIMIT 1");
		$stmt->bind_param('ss', $usuario, $usuario);
		$stmt->execute();
		$stmt->bind_result($activacion);
		$stmt->fetch();
		
		if ($activacion == 1)
		{
			return true;
		}
		else
		{
			return false;	
		}
	}	
	
	function generaTokenPass($user_id)
	{
		global $mysqli;
		
		$token = generateToken();
		
		$stmt = $mysqli->prepare("UPDATE usuarios SET token_password=?, password_request=1 WHERE id = ?");
		$stmt->bind_param('ss', $token, $user_id);
		$stmt->execute();
		$stmt->close();
		
		return $token;
	}
	
	function getValor($campo, $campoWhere, $valor)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT $campo FROM usuarios WHERE $campoWhere = ? LIMIT 1");
		$stmt->bind_param('s', $valor);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		
		if ($num > 0)
		{
			$stmt->bind_result($_campo);
			$stmt->fetch();
			return $_campo;
		}
		else
		{
			return null;	
		}
	}
	
	function getPasswordRequest($id)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT password_request FROM usuarios WHERE id = ?");
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$stmt->bind_result($_id);
		$stmt->fetch();
		
		if ($_id == 1)
		{
			return true;
		}
		else
		{
			return null;	
		}
	}
	
	function verificaTokenPass($user_id, $token){
		
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE id = ? AND token_password = ? AND password_request = 1 LIMIT 1");
		$stmt->bind_param('is', $user_id, $token);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		
		if ($num > 0)
		{
			$stmt->bind_result($activacion);
			$stmt->fetch();
			if($activacion == 1)
			{
				return true;
			}
			else 
			{
				return false;
			}
		}
		else
		{
			return false;	
		}
	}
	
	function cambiaPassword($pass_hash, $login , $id){
		
		global $mysqli;
		
		$stmt = $mysqli->prepare("UPDATE usuarios SET password = ?, login= ?, fecharegistro = now(), password_request =0 WHERE id = ?");
		$stmt->bind_param('ssi', $pass_hash, $login , $id);
		if($stmt->execute()){
			return true;
			} else {
			return false;		
		}
	}

		function cambiaPassword2($pass_hash, $login , $user_id){
		
		global $mysqli;
		
		$stmt = $mysqli->prepare("UPDATE usuarios SET password = ?, login= ? WHERE id = ?");
		$stmt->bind_param('ssi', $pass_hash, $login, $user_id);
		if($stmt->execute()){
			return true;
			} else {
			return false;		
		}
	}
	
	function CodBodegaNoExiste($cod)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT cod FROM bodegas WHERE cod = ? LIMIT 1");
		$stmt->bind_param('i', $cod);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();
		
		if ($num == 0){
			return true;
			} else {
			return false;
		}
	}
	
	function NomBodegaNoExiste($nombre)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT nombre FROM bodegas WHERE nombre = ? LIMIT 1");
		$stmt->bind_param('s', $nombre);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();
		
		if ($num == 0){
			return true;
			} else {
			return false;
		}
	}		
	
		function registraBodega($cod, $nombre, $responsable, $estado){
		
		global $mysqli;
		
		$stmt = $mysqli->prepare("INSERT INTO bodegas (cod, nombre, responsable, estado) VALUES(?,?,?,?)");
		$stmt->bind_param('issi', $cod, $nombre, $responsable, $estado);
		
		if ($stmt->execute()){
			return $mysqli->insert_id;
			} else {
			return 0;	
		}		
	}
	
	
		function registraResponsable($cod, $nombre, $codbodega, $responsable, $estado){
		
		global $mysqli;
		
		$stmt = $mysqli->prepare("INSERT INTO ccostos (COD, NOMBRE, CODBODEGA, RESPONSABLE, estado) VALUES(?,?,?,?,?)");
		$stmt->bind_param('isisi', $cod, $nombre, $codbodega, $responsable, $estado);
		
		if ($stmt->execute()){
			return $mysqli->insert_id;
			} else {
			return 0;	
		}		
	}
	
	function EstadoBodegaExiste($cod)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT estado FROM bodegas WHERE cod = ?  AND estado = '1' LIMIT 1");
		$stmt->bind_param('i', $cod);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();
		
		if ($num == 0){
			return false;
			} else {
			return true;
		}
	}	


	function EstadoResponsableExiste($cod)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT estado FROM ccostos WHERE cod = ?  AND estado = '1' LIMIT 1");
		$stmt->bind_param('i', $cod);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();
		
		if ($num == 0){
			return false;
			} else {
			return true;
		}
	}		

	function NombreArticuloExiste($articulo, $id_tipoart)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT * FROM invti_articulos WHERE articulo = ?  AND id_tipoart = ? LIMIT 1");
		$stmt->bind_param('si', $articulo, $id_tipoart);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();
		
		if ($num == 0){
			return false;
			} else {
			return true;
		}
	}	

	
	function NombreMarcaExiste($marca, $id_articulo)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT * FROM invti_marca WHERE marca = ?  AND id_articulo = ? LIMIT 1");
		$stmt->bind_param('si', $marca, $id_articulo);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();
		
		if ($num == 0){
			return false;
			} else {
			return true;
		}
	}		
	
	function ActualizaEstadoBodega($status, $id){
		
		global $mysqli;
		
		$stmt = $mysqli->prepare("UPDATE bodegas SET estado = ? WHERE id = ?");
		$stmt->bind_param('ii', $status, $id);
		if($stmt->execute()){
			return true;
			} else {
			return false;		
		}
	}	

	function ActualizaEstadoResponsable($status, $id){
		
		global $mysqli;
		
		$stmt = $mysqli->prepare("UPDATE ccostos SET estado = ? WHERE id = ?");
		$stmt->bind_param('ii', $status, $id);
		if($stmt->execute()){
			return true;
			} else {
			return false;		
		}
	}	
	
		function ModificaRolStatusUser($id, $tipo, $status, $login){
		
		global $mysqli;
		
		$stmt = $mysqli->prepare("UPDATE usuarios set id_tipo=?, activacion=?, login=?, 
		                              fecharegistro=now()  where id=?");
		$stmt->bind_param('iiii', $tipo, $status, $login, $id);
		if($stmt->execute()){
			return true;
			} else {
			return false;		
		}
	}

		function activoExiste($activo)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT activo FROM invti_bodegas WHERE activo = ? LIMIT 1");
		$stmt->bind_param("s", $activo);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();
		
		if ($num > 0){
			return true;
			} else {
			return false;
		}
	}

	function serialExiste($serial)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT SERIAL FROM invti_bodegas WHERE SERIAL = ? LIMIT 1");
		$stmt->bind_param("s", $serial);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();
		
		if ($num > 0){
			return true;
			} else {
			return false;
		}
	}
	

	function Tpendientebodbod($activo)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT activo FROM invti_bodegas WHERE activo = ? AND asigna = 'T' LIMIT 1");
		$stmt->bind_param("s", $activo);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();
		
		if ($num > 0){
			return true;
			} else {
			return false;
		}
	}

	function Tpendientebodres($activo)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT activo FROM invti_responsables WHERE activo = ? AND asigna = 'T' LIMIT 1");
		$stmt->bind_param("s", $activo);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();
		
		if ($num > 0){
			return true;
			} else {
			return false;
		}
	}

		function isNullNuevArt($nit, $clasificacion, $tipo, $clase, $articulo, $marca, $serial, $imei, $sim, $activo, $estado, $factura, $proveedor, $valor, $fecha, $asigna, $zona, $user){
		if(strlen(trim($nit)) < 1 || strlen(trim($clasificacion)) < 1 || strlen(trim($tipo)) < 1 || strlen(trim($clase)) < 1 || strlen(trim($articulo)) < 1 || strlen(trim($marca)) < 1 || strlen(trim($activo)) < 1 || strlen(trim($serial)) < 1 || strlen(trim($imei)) < 1 || strlen(trim($sim)) < 1 || strlen(trim($estado)) < 1 || strlen(trim($factura)) < 1 || strlen(trim($proveedor)) < 1 || strlen(trim($fecha)) < 1 || strlen(trim($zona)) < 1 || strlen(trim($user)) < 1 || strlen(trim($asigna)) < 1 || strlen(trim($valor)) < 1)
		{
			return true;
			} else {
			return false;
		}		
	}
	
		function registraActivo($nit, $clasificacion, $tipo, $clase, $articulo, $marca, $serial, $imei, $sim, $activo, $estado, $factura, $proveedor, $valor, $fecha, $asigna, $zona, $user, $observacion){
		
		global $mysqli;
		
		$stmt = $mysqli->prepare("INSERT INTO invti_bodegas VALUES('',?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,now(),?,'','',?)");
		$stmt->bind_param('sssssssiisssiisssss', $nit, $clasificacion, $tipo, $clase, $articulo, $marca, $serial, $imei, $sim, $activo, $estado, $factura, $proveedor, $valor, $fecha, $asigna, $zona, $user, $observacion);
		
		if ($stmt->execute()){
			return $mysqli->insert_id;
			} else {
			return 0;	
		}		
	}	
		function CrearArticuloNuevo($articulo, $id_tipoart){
		
		global $mysqli;
		
		$stmt = $mysqli->prepare("INSERT INTO invti_articulos VALUES('',?,?)");
		$stmt->bind_param('si', $articulo, $id_tipoart);
		
		if ($stmt->execute()){
			return $mysqli->insert_id;
			} else {
			return 0;	
		}		
	}
	
		function CrearMarcaNuevo($marca, $id_articulo){
		
		global $mysqli;
		
		$stmt = $mysqli->prepare("INSERT INTO invti_marca VALUES('',?,?)");
		$stmt->bind_param('si', $marca, $id_articulo);
		
		if ($stmt->execute()){
			return $mysqli->insert_id;
			} else {
			return 0;	
		}		
	}	
?>
