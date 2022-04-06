<?php
 
include_once ("../clases/clasesUsuarios.php");  // incluyo las clases a ser usadas
 
$action='';
if(isset($_POST['action']))
{$action=$_POST['action'];}
 
//include_once ("SaveImg.php");                 // incluyo script para guardar imagen de foto
 
 
$view= new stdClass();                          // creo una clase standard para contener la vista
$view->disableLayout=false;                      // marca si usa o no el layout , si no lo usa imprime directamente el template
 
switch ($action)
{
    case 'saveUsuario':
        // limpio todos los valores antes de guardarlos
        // si por las dudas venga algo raro
         
         
        $id=intval($_POST['id']);
        /*$nombre=cleanString($_POST['Nombre']);    */
        $nombre     = $_POST['nombre'];
        $apellido   = $_POST['apellido'];
        $telefono   = $_POST['telefono'];
        $celular    = $_POST['celular'];
        $email      = $_POST['email'];
        $direccion  = $_POST['direccion'];
        $cargo      = $_POST['cargo'];
        $identificacion=$_POST['identificacion'];
        $permisos   = $_POST['permisos'];
        $username   = $_POST['usuario'];
        $password   = $_POST['password'];
        $foto       = $_POST['foto'];
        $Usuarios   = new Usuarios($id);
         
        $Usuarios   -> setId($id);
        $Usuarios   -> setNombre($nombre);
        $Usuarios   -> setApellido($apellido);
        $Usuarios   -> setTelefono($telefono);
        $Usuarios   -> setCelular($celular);
        $Usuarios   -> setEmail($email);
        $Usuarios   -> setDireccion($direccion);
        $Usuarios   -> setCargo($cargo);     
        $Usuarios   -> setPermiso($permisos);
        $Usuarios   -> setPassword($password);
        $Usuarios   -> setIdentificacion($identificacion);
        $Usuarios   -> setUsuario($username);    
        $Usuarios   -> setFoto($foto);
        //echo $Usuarios->getUsuarioF();     
        echo $Usuarios -> save();
        break;
         
    //case 'newUsuario':
     //   $view->usuario=new Usuarios();
        //$view->label='Nuevo Usuario';
    //    $view->disableLayout=true;
        //$view->contentTemplate="templates/clientForm.php"; // seteo el template que se va a mostrar
 //       break;
/*
    case 'editClient':
        $editId=intval($_POST['id']);
        $view->label='Editar Cliente';
        $view->client=new Cliente($editId);
        $view->disableLayout=true;
        $view->contentTemplate="templates/clientForm.php"; // seteo el template que se va a mostrar
        break;
        */
    case 'deleteUsuario':
        $id         = intval($_POST['id']);
        $Usuarios   = new Usuarios($id);
        $Usuarios   -> setId($id);
        echo $Usuarios->delete();
        break;
         
   default :
}
 
// si esta deshabilitado el layout solo imprime el template
/*if ($view->disableLayout==true)
{include_once ($view->contentTemplate);}
else
{include_once ('templates/layout.php');} // el layout incluye el template adentro
*/
?>