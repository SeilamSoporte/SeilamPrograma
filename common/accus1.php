<?php 

$modulo 	= explode("/", $_POST["modulo"]);
$permisos 	= explode(",",$_POST["permisos"]);

switch ($modulo[0]) {
	case 'mod_muestras':
		echo $permisos[0];
		break;
	case 'mod_resultados_MB':
		echo $permisos[1];
		break;
	case 'mod_resultados_FQ':
		echo $permisos[2];
		break;
	case 'mod_informes':
		echo $permisos[3];
		break;	
	case 'mod_parametros':
		echo $permisos[4];
		break;
	case 'mod_clientes':
		echo $permisos[5];
		break;	
	case 'mod_usuarios':
		echo $permisos[6];
		break;
	case 'mod_empresa':
		echo $permisos[7];
		break;
	case 'mod_admin':
		echo $permisos[8];
		break;
	case 'mod_ordenes':
		echo $permisos[9];
		break;
	case 'mod_relfacturas':
		echo $permisos[10];
		break;
	default:
		echo false;
		break;
}
?>