<?php

if (session_id() == "")
{
   session_start();
    $_SESSION['expires_timeout'] = 600;
}
if (!isset($_SESSION['username']))
{
   header('Location: ../index.php');
   exit;
}
if (isset($_SESSION['expires_by']))
{
   $expires_by = intval($_SESSION['expires_by']);
   if (time() < $expires_by)
   {
      $_SESSION['expires_by'] = time() + intval($_SESSION['expires_timeout']);
   }
   else
   {  
      unset($_SESSION['username']);
      unset($_SESSION['expires_by']);
      unset($_SESSION['expires_timeout']);
      header('Location: ../index.php');
      exit;
   }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_name']) && $_POST['form_name'] == 'logoutform')
{
   if (session_id() == "")
   {
      session_start();
      $_SESSION['expires_timeout'] = 600;
   }
   unset($_SESSION['username']);
   unset($_SESSION['fullname']);
   header('Location: ../index.php');
   exit;
}

if (isset($_GET['logout']))
{
	if (isset($_COOKIE[session_name()]))
	{
		setcookie(session_name(), '',time() - 42000, '/');
	}
	$_SESSION = array();
    unset($_SESSION['username']);
    unset($_SESSION['fullname']);

	session_unset();
	session_destroy();
    header('Location: index.php');
	
    exit;
	
}
?>