
<?php

include_once ("../clases/clasesAdmin.php");	// incluyo las clases a ser usadas

$action	= isset($_POST['action']) ? $_POST['action']: '';
$tabla	= isset($_POST['tabla'])  ? $_POST['tabla']: '';
$id 	= isset($_POST['id']) 	  ? $_POST['id']:'';
$valor  = isset($_POST['valor'])  ? $_POST['valor']:'';

$view	= new stdClass(); 							// creo una clase standard para contener la vista
$view	->disableLayout=false;						// marca si usa o no el layout , si no lo usa imprime directamente el template

switch ($action)
{
	case 'loadData':
		$datos 		= new Administrador();
		$datos 		->setTabla($tabla);
		break;
	case 'save':
		$dato 	= new Administrador();
		$dato   ->saveDatos($tabla,$valor,$id); 
		break;
	case 'save_firmas':
		$RMB 	= isset($_POST['RMB']) ? $_POST['RMB']: 0;
		$AMB 	= isset($_POST['AMB']) ? $_POST['AMB']: 0;
		$RFQ 	= isset($_POST['RFQ']) ? $_POST['RFQ']: 0;
		$AFQ 	= isset($_POST['AFQ']) ? $_POST['AFQ']: 0;
		$dato 	= new Administrador();
		$dato   ->saveFimas($RMB,$AMB,$RFQ,$AFQ); 
		break;	
	case 'insertar':
		$dato 	= new Administrador();
		echo $dato   ->insertDatos($tabla,$valor,$id); 
		break;

	case 'eliminar':
		$dato 	= new Administrador();
		echo $dato  ->deleteDatos($tabla,$valor,$id);
		break;
	default :
		break;
}
?>