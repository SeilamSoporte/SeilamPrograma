<?php 
	function DiasXmes($mes){
		switch ($mes) {
			case '0': #el mes anterior es enero
			case '1':
			case '3':
			case '5':
			case '7':
			case '8':
			case '10':				
			case '12':
				return 31;
			break;
			
			case '2':
				return 28;
			break;
			
			case '4':
			case '6':
			case '9':
			case '11':
				return 30;
			break;
				
			default:
				# code...
				break;
		}
	}
	
?>
