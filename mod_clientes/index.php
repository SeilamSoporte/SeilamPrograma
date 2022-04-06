<?php
/*
 * Autor: Wilfrank Badillo M
 */
include_once ("../session.php");
include_once ("../common/valsess.php");
include_once ("clases/clasesClientes.php");	// incluyo las clases a ser usadas
$action='index';

if(isset($_POST['action']))
{$action=$_POST['action'];}

$view = new stdClass(); 						// creo una clase standard para contener la vista
$view->disableLayout=false;						// marca si usa o no el layout , si no lo usa imprime directamente el template

// para no utilizar un framework y simplificar las cosas uso este switch
switch ($action)
{
    case 'index':
        //$view->clientes=Clientes::getClientes(); 			// tree todos los clientes
        $view->contentTemplate="templates/clientesGrid.php";// seteo el template que se va a mostrar
        break;
    case 'refreshGrid':
        $view->disableLayout=true; 							// no usa el layout
        $view->clientes=Clientes::getClientes(); 			// tree todos los clientes
        echo $view->contentTemplate="templates/clientesGrid.php";// seteo el template que se va a mostrar
        break;
    case 'newCliente':
        $view->cliente=new Clientes();
        $view->disableLayout=true;
        $view->contentTemplate="templates/clienteForm.php"; // seteo el template que se va a mostrar
        break;
    case 'editClient':
        $editId=intval($_POST['id']);
        $view->cliente=new Clientes($editId);
        $view->disableLayout=true;
        $view->contentTemplate="templates/clienteForm.php"; // seteo el template que se va a mostrar
        break;
    case 'deleteClient':
        $id=intval($_POST['id']);
        $client=new Cliente($id);
        $client->delete();
        die; 												// no quiero mostrar nada cuando borra , solo devuelve el control.
        break;
    default :
}

// si esta deshabilitado el layout solo imprime el template
if ($view->disableLayout==true)
{include_once ($view->contentTemplate);}
else
{include_once ('templates/layout.php');} // el layout incluye el template adentro
