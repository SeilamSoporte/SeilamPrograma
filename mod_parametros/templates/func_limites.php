		  <?php 	
		  	function LoadLimite($IdC, $lim,$lim2){
			    switch ($IdC){
			        case "1": return "<".$lim;
			        break;
			        case "2": return ">".$lim;
			        break;
			        case "3": return "&le;".$lim; //<=
			        break;
			        case "4": return "&ge;".$lim;  //>=
			        break;
			        case "5": return "=".$lim;
			        break;
			        case "6": return $lim."/100mL";
			        break;
			        case "7": return $lim."/250mL";
			        break;
			        case "8": return "Ausencia";
			        break;
			        case "9": return "Negativo";
			        break;
			        case "10": 
			        return $lim." - ".$lim2;
			        break;
			        case "11": 
			        return 'No específica';
			        break;
			        case "12": 
			        return 'Aceptable';
			        case "13": 
			        return 'Fondo visible';			      
			        break;
			    }
			}	

			?>
