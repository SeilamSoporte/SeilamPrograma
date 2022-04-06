<?php 
 
if(isset($_POST['valida']) or isset($valida))
{
    $valida=$_POST['valida'];
    $usuario_logeado = isset($_POST['user']) ? $_POST['user']: '';
}
else{
    header('Location: ../index.php');
    exit;  
}
 
?>