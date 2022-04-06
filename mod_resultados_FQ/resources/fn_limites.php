		  <?php 	
		  	function LoadLimite($IdC, $lim){
			    switch ($IdC){
			        case "1": return "<".$lim;
			        break;
			        case "2": return ">".$lim;
			        break;
			        case "3": return "<=".$lim;
			        break;
			        case "4": return ">=".$lim;
			        break;
			        case "5": return "=".$lim;
			        break;
			        case "6": return $lim."/100mL";
			        case "7": return $lim."/250mL";
			        break;
			    }
			}	

			?>