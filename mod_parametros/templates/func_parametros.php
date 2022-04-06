<?php 

function Load_parametro($param){
	switch($param)
	{
		case '1':
			return "Coliformes fecales";
		break;
		case '2':
			return "Coliformes totales";
		break;	
		case '3':
			return "Salmonella";
		break;
		case '4':
			return "Mohos y levaduras";
		break;
		
	}
}
?>