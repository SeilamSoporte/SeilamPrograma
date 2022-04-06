<?php
/*
 * Autor: Wilfrank Badillo M
 */

include_once ("../common/session.php");
include_once ("../common/valsess.php");
include_once ("clases/clasesEmpresa.php");	 	// incluyo las clases a ser usadas
$action ='index';

if(isset($_POST['action']) and isset($_POST['valida']))
{$action=$_POST['action'];}

$view = new stdClass(); 						// creo una clase standard para contener la vista
$vista= new stdClass();
$view->disableLayout=false;						// marca si usa o no el layout , si no lo usa imprime directamente el template

switch ($action)
{
    case 'index':
        $view->empresa=Empresa::getEmpresa(); 	// tree todos los clientes
        $view->contentTemplate="templates/empresaForm.php"; // seteo el template que se va a mostrar
        break;
    case 'saveEmpresa':
        $id			= intval($_POST['id']);
        break;
    default :
}

// si esta deshabilitado el layout solo imprime el template
if ($view->disableLayout==true)
{include_once ($view->contentTemplate);}
else
{include_once ('templates/layout.php');} // el layout incluye el template adentro
