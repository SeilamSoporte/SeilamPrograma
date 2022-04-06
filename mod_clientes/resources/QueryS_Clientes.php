<?php

include_once ("../clases/clasesClientes.php");	// incluyo las clases a ser usadas

$action	=isset($_POST['action']) ? $_POST['action']: '';

$view	= new stdClass(); 							// creo una clase standard para contener la vista
$view	->disableLayout=false;						// marca si usa o no el layout , si no lo usa imprime directamente el template

switch ($action)
{
	case 'saveCliente':
        
		$id			= intval($_POST['id']);
 		$empresa	= $_POST['empresa'];
        $nit		= $_POST['nit'];
        $telefono	= $_POST['telefono'];
        $regimen	= $_POST['regimen'];
		$email		= $_POST['email'];
		$direccion	= $_POST['direccion'];
		$ciudad		= $_POST['ciudad'];
		$web		= $_POST['web'];

		$Cliente	=  new Clientes($id);
		
		$Cliente	-> setId($id);
		$Cliente	-> setEmpresa($empresa);
        $Cliente	-> setNit($nit);
        $Cliente	-> setTelefono($telefono);
		$Cliente	-> setWeb($web);
		$Cliente	-> setEmail($email);
		$Cliente	-> setDireccion($direccion);
		$Cliente	-> setCiudad($ciudad);
		$Cliente	-> setRegimen($regimen);
		echo $Cliente->save();
        break;
	case 'saveContactos':
		$id_c		= intval($_POST['id']);
		$idc		= intval($_POST['idc']);
 		$Nombre 	= implode("|", $_POST['nombre']);
        $Cargo		= implode("|", $_POST['cargo']);
        $Email		= implode("|", $_POST['email']);
        $Celular	= implode("|", $_POST['celular']);
		
		$Contacto	=  new Contactos($id);
		
		$Contacto	-> setId_C($id_c);
		$Contacto	-> setId($idc);
		$Contacto	-> setContacto($Nombre);
        $Contacto	-> setCargo($Cargo);
        $Contacto	-> setCelular($Celular);
		$Contacto	-> setEmail($Email);		
		echo $Contacto->save();	
		break; 
		
	case 'saveSedes':
		$id_c		= intval($_POST['id']);
		$idc		= intval($_POST['idc']);
 		$Sede 		= implode("|", $_POST['sede']);
        $Ciudad		= implode("|", $_POST['ciudad']);
        $Telefono	= implode("|", $_POST['telefono']);
        $Direccion	= implode("|", $_POST['direccion']);
		
		$Sedes		=  new Sedes($id_c);
		
		$Sedes	-> setId_C($id_c);
		$Sedes	-> setId($idc);
		$Sedes	-> setSede($Sede);
        $Sedes	-> setCiudad($Ciudad);
		$Sedes	-> setTelefono($Telefono);
        $Sedes	-> setDireccion($Direccion);
		echo $Sedes->save();	
		break; 
		
	case 'deleteCliente':
		$id			= intval($_POST['id']);
        $Cliente	= new Clientes($id);
		$Cliente	-> setId($id);
		echo $Cliente->eliminarC();
		break;

	default :
}
?>