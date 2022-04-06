<?php
	function encriptar($cadena)
	{

		$key='';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
		$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
		//return $encrypted; //Devuelve el string encriptado
      return $cadena;
	}
	
 $Accion=isset($_REQUEST['Accion']) ? $_REQUEST['Accion'] : '';
 $success_page = './'.$Accion.'.php';
 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_name']) && $_POST['form_name'] == 'loginform')
{
   //$success_page = './Success.php';
   $error_page 		= './Error.html';
   $mysql_server 	= 'localhost';
    
   $mysql_username 	= '531L4M';
   $mysql_password 	= 'OH0rXG7NOXS7Hsp2';
   $mysql_database 	= 'DB_S';
   $mysql_table 	= 'usuarios';
   $crypt_pass 		= encriptar($_POST['password']);//md5($_POST['password']);//encriptar($_POST['password']);
   $found 			= false;
   $fullname 		= '';
   $session_timeout = 10;
   $db = mysqli_connect($mysql_server, $mysql_username, $mysql_password);
   if (!$db)
   {
      die('Failed to connect to database server!<br>'.mysqli_error($db));
   }
   mysqli_select_db($db, $mysql_database) or die('Failed to select database<br>'.mysqli_error($db));
   $sql = "SELECT password, fullname, active FROM ".$mysql_table." WHERE username = '".mysqli_real_escape_string($db, $_POST['username'])."'";
   $result = mysqli_query($db, $sql);
   if ($data = mysqli_fetch_array($result))
   {
      if ($crypt_pass == $data['password'] && $data['active'] != 0)
      {
         $found = true;
         $fullname = $data['fullname'];
      }
   }
   mysqli_close($db);
   if($found == false)
   {
      header('Location: index.php?Error='.$crypt_pass);
      exit;
   }
   else
   {
      if (session_id() == "")
      {
         session_start();
      }
      $_SESSION['username'] = $_POST['username'];
      $_SESSION['fullname'] = $fullname;
      $_SESSION['expires_by'] = time() + $session_timeout;
      $_SESSION['expires_timeout'] = $session_timeout;
	  header('Location: '.$success_page);
      exit;
   }
}
$username = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
$password = isset($_COOKIE['password']) ? $_COOKIE['password'] : '';

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>loginPage</title>
<link href="css/Zeus.css" rel="stylesheet">
<link href="css/login.css" rel="stylesheet">
<link href="css/bootstrap.css" rel="stylesheet">
</head>
<body>
<div id="container">
<div id="wb_Login1" style="position:absolute;left:2px;top:1px;width:350px;height:179px;z-index:0;">
	<form name="loginform" method="post" action="<?php echo basename(__FILE__); ?>" target="_parent" id="loginform">
		<input type="hidden" name="form_name" value="loginform">
		<input type="hidden" name="Accion" value="<?php  echo $Accion; ?>">
		<table id="Login1">
			<tr>
			   <td class="header">Acceso de usuario</td>
			</tr>
			
			<tr>
				<td class="row">
					<div class="form-group" style="padding-left:10px; padding-top:5px;">
						<input style="width:98%;" type="text" name="username" id="username" class="form-control" value="<?php echo $username; ?>" placeholder="Usuario">						
					</div>
				</td>
			</tr>
			
			<tr>
			   <td class="row">
					<div class="form-group" style="padding-left:10px;">
						<input style="width:98%;" type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>" placeholder="Password">						
					</div>
				</td>
			</tr>
			<tr>
			   <td style="text-align:center;">
					<button type="submit" class="btn btn-primary" name="login" id="login"> Entrar </button>
			   <!--<input class="button" type="submit" name="login" value="Log In" id="login">-->
			   </td>
			</tr>
		</table>
	</form>
</div>
<div id="Html1" style="position:absolute;left:123px;top:120px;width:109px;height:22px;z-index:1">
</div>
</div>
    <script src="js/jquery-2.2.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
