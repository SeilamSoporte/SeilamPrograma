<?php

include_once ("../clases/clasesMuestras.php");	// incluyo las clases a ser usadas
						
$action='';
if(isset($_POST['action']))
{$action=$_POST['action'];}

$view= new stdClass(); 							// creo una clase standard para contener la vista
$view->disableLayout=false;						// marca si usa o no el layout , si no lo usa imprime directamente el template

switch ($action)
{
	case 'update_f': 	
		$id 	  = intval($_POST['id']);
		$factura  = intval($_POST['factura']);
		$Muestras = new Muestras($id);
		$Muestras-> setId($id);
        $Muestras-> setFactura($factura);
		echo $Muestras -> update_f($id);	

    break;
}

?>