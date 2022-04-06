<?php
/*
 * Autor: Wilfrank Badillo M
 */
include_once 'templates/func_limites.php';
include_once ("../session.php");
include_once ("../common/valsess.php");
include_once ("clases/clasesParametros.php");	// incluyo las clases a ser usadas
$action='index';
if(isset($_POST['action']))
{$action=$_POST['action'];}

$view = new stdClass(); 						// creo una clase standard para contener la vista
$vista= new stdClass();
$view->disableLayout=false;					// marca si usa o no el layout , si no lo usa imprime directamente el template

// para no utilizar un framework y simplificar las cosas uso este switch
switch ($action)
{
    case 'index':
        $view->parametros=Parametros::getParametros(); // tree todos los clientes
        $view->contentTemplate="templates/parametrosGrid.php"; // seteo el template que se va a mostrar
        break;
    case 'refreshGrid':
        $view->disableLayout=true; // no usa el layout
        $view->usuarios=Usuarios::getUsuarios();
        $view->contentTemplate="templates/parametrosGrid.php"; // seteo el template que se va a mostrar
        break;
    case 'saveUsuario':
        // limpio todos los valores antes de guardarlos
        // por las dudas venga algo raro
        $id			= intval($_POST['id']);
        $nombre		= cleanString($_POST['nombre']);
        $apellido	= cleanString($_POST['apellido']);
        $usuario	= new Usuario($id);
        $usuario   -> setNombre($nombre);
        $usuario   -> setApellido($apellido);
        $usuario   -> save();
        break;
    case 'newUsuario':
        $view->usuario=new Usuarios();
        $view->label='Nuevo Usuario';
        $view->disableLayout=true;
        $view->contentTemplate="templates/parametrosForm.php"; // seteo el template que se va a mostrar
        break;
    case 'editClient':
        $editId=intval($_POST['id']);
        $view->label='Editar Usuario';
        $view->usuario=new Usuarios($editId);
        $view->disableLayout=true;
        $view->contentTemplate="templates/parametrosForm.php"; // seteo el template que se va a mostrar
        break;
    case 'deleteClient':
        $id=intval($_POST['id']);
        $client=new Usuarios($id);
        $client->delete();
        die; // no quiero mostrar nada cuando borra , solo devuelve el control.
        break;
    default :
}

// si esta deshabilitado el layout solo imprime el template
if ($view->disableLayout==true)
{include_once ($view->contentTemplate);}
else
{include_once ('templates/layout.php');} // el layout incluye el template adentro
