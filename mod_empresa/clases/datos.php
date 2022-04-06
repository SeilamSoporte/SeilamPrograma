<?php 
	include_once ("clasesEmpresa.php");

	$D_Empresa 	= new Empresa();
	$D_Empresa	->D_Empresa(1);
    $Logo		= $D_Empresa->Logo;
	if ($Logo=="")
	{
		$src_logo= "./imgs/no_logo.jpg";
	}
	else
	{
		$src_logo = "mod_empresa/imgs/".$Logo;
	}

	$Nombre_empresa= $D_Empresa->Empresa;
	
	if ($Nombre_empresa == "")
	{
		$Nombre_empresa = "Nombre de la empresa";
	}
	$Direccion_empresa= $D_Empresa->Direccion;
	$Telefono_empresa= $D_Empresa->Telefono;
	$Correo_empresa= $D_Empresa->Email;

?>