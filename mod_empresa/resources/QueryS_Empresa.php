<?php

include_once ("../clases/clasesEmpresa.php");	// incluyo las clases a ser usadas

$action	=isset($_POST['action']) ? $_POST['action']: '';

$view= new stdClass(); 							// creo una clase standard para contener la vista
$view->disableLayout=false;						// marca si usa o no el layout , si no lo usa imprime directamente el template

switch ($action)
{
	case 'saveEmpresa':
        
		$id=intval($_POST['id']);
        /*$nombre=cleanString($_POST['Nombre']);	*/
		$empresa	= $_POST['empresa'];
        $nit		= $_POST['nit'];
        $telefono	= $_POST['telefono'];
        $regimen	= $_POST['regimen'];
		$email		= $_POST['email'];
		$direccion	= $_POST['direccion'];
		$web		= $_POST['web'];
		$logo		= $_POST['logo'];

		$Empresa	=  new Empresa($id);
		
		$Empresa	-> setEmpresa($empresa);
        $Empresa	-> setNit($nit);
        $Empresa	-> setTelefono($telefono);
		$Empresa	-> setWeb($web);
		$Empresa	-> setEmail($email);
		$Empresa	-> setDireccion($direccion);
		$Empresa	-> setRegimen($regimen);
		$Empresa	-> setLogo($logo);
		
		echo $Empresa -> save();
        break;
   default :
}
?>