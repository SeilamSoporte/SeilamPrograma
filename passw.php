<?php 	
	function encriptar($cadena)
	{
		$key='';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
		$encrypted = base64_encode(openssl_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
		return $encrypted; //Devuelve el string encriptado
	}

function desencriptar($cadena){
     $key='';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
     $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
    return $decrypted;  //Devuelve el string desencriptado
}

	$pas=isset($_POST['pass']) ? $_POST['pass'] : '';
	$Dpas=isset($_POST['Dpass']) ? $_POST['Dpass'] : '';
	
	$Crypted=encriptar($pas);
	$DCrypted=desencriptar($Dpas);
	
echo "Encript: ".$Crypted;
echo "<br>";
echo "Desenc: ".$DCrypted;
echo "<br>";
echo "MD5:". md5($pas);
?>

	<form action="passw.php" method="post" >	
		Normal: <input name="pass" id="pass" /><br>	<br>
		Encripptada: <input name="Dpass" id="Dpass" /><br>	
		<button type="submit" name="enviar" >Encriptar </button>
	</form>
	