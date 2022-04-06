<?php
	function encriptar($cadena)
	{
		$key='';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
		$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
		//return $encrypted; //Devuelve el string encriptado
      return $cadena;
	}
	
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_name']) && $_POST['form_name'] == 'loginform')
{

   $token = isset($_POST['token']) ? $_POST['token'] : 'Error';
   //$success_page = './Success.php';
   $error_page 		= './Error.html';
   $mysql_server 	   = 'localhost';
   $mysql_username 	= '531L4M';
   $mysql_password 	= 'OH0rXG7NOXS7Hsp2';
   $mysql_database 	= 'DB_S';
   $mysql_table 	   = 'usuarios';
   $crypt_pass 		= encriptar($_POST['password']);//md5($_POST['password']);//encriptar($_POST['password']);
   $found 			   = false;
   $active           = false;
   $session_timeout = 600;
   $db = mysqli_connect($mysql_server, $mysql_username, $mysql_password);
   if (!$db)
   {
      die('Failed to connect to database server!<br>'.mysqli_error($db));
   }
   mysqli_select_db($db, $mysql_database) or die('Failed to select database<br>'.mysqli_error($db));
   $sql = "SELECT password, active, Permisos FROM ".$mysql_table." WHERE username = '".mysqli_real_escape_string($db, $_POST['username'])."'";
   $result = mysqli_query($db, $sql);
   if ($data = mysqli_fetch_array($result))
   {
      if ($crypt_pass == $data['password'])// && $data['active'] != 0)
      {
         $found  = true;
         if ($data['active'] != 0){
            $active = true;            
         }
      }     
   }
   mysqli_close($db);
   
   if($found == false)
   {
      //header('Location: index.php?Error='.$crypt_pass);
      echo 'error;';
      exit;
   }
   else
   {
      if ($active==true){

         if (session_id() == "")
         {
            session_start();
         }
         $_SESSION['username'] = $_POST['username'];
         //$_SESSION['fullname'] = $fullname;
         $_SESSION['expires_by'] = time() + $session_timeout;
         $_SESSION['expires_timeout'] = $session_timeout;
         echo $token.";".$data["Permisos"];
         exit;
      }
      else{
         echo 'inactivo;';
         exit;
      }
   }
}
$username = isset($_COOKIE['fbsql_username(link_identifier)']) ? $_COOKIE['username'] : '';
$password = isset($_COOKIE['password']) ? $_COOKIE['password'] : '';

?>