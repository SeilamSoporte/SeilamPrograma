<?php

	include_once ("../Clases/clasesMuestras.php");
	$IdCliente 	= isset($_POST['IdCliente']) ? $_POST['IdCliente'] : 0;
	$Sedes 		= Clientes::getSedes($IdCliente); 
	
	$sedesL 	= isset($Sedes[0]['Sede']) ? $Sedes[0]['Sede'] : '';
	echo $sedesL;
				
?>