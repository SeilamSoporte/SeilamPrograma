
<?php 
if (session_id() == "")
{
   session_start();
    $_SESSION['expires_timeout'] = 10;
}
$_SESSION['expires_by'] = $_POST['timeout'];
if (isset($_SESSION['expires_by']))
{
   $expires_by = intval($_SESSION['expires_by']);
   if (time() < $expires_by)
   {
      $_SESSION['expires_by'] = time() + intval($_SESSION['expires_timeout']);
      echo 'no exit';
   }
   else
   {  
      unset($_SESSION['username']);
      unset($_SESSION['expires_by']);
      unset($_SESSION['expires_timeout']);
      header('Location: ../index.php');
      echo 'exit';
      exit;
   }
}
else{
   echo 'ok';
}
 ?>