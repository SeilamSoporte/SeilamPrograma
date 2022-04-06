<?php
/*
 * Autor: Wilfrank Badillo M
 */
include_once ("../session.php");
include_once ("../common/valsess.php");
	
$action='index';
if(isset($_POST['action']))
{$action=$_POST['action'];}

$view = new stdClass(); 						
$vista= new stdClass();
$view->disableLayout=false;					

switch ($action)
{
    case 'index':
        $view->contentTemplate= "templates/main.php"; 
        break;
    default:
        $view->contentTemplate= "templates/blank.php"; 
        break;
}

// si esta deshabilitado el layout solo imprime el template
if ($view->disableLayout==true)
    { include_once ($view->contentTemplate); }
else
    { include_once ('templates/layout.php'); } // el layout incluye el template adentro
?>
<script>
	
</script>