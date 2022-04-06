<?php 
/*function buscarPal($texto, $Titulo){
    $TextTitulo   = strtolower($Titulo); 
    $textoSelArr  = explode(" ", $TextTitulo);
    $palabras     = explode(",", $texto);

    foreach ($textoSelArr as $ArrT) {
      	foreach ($palabras as $Word) {
             
            if($ArrT == $Word){   
               	//echo $ArrT;  
               	return true;
                }        		
        	}
        }
    }
   
function unidadCt($UId){
	switch ($UId) {
		case '0':
			return "mL";
			break;
		case '1':
			return "g";
			break;
		case '2':
			return "mL";
			break;
		
		default:
			return "";
			break;
	}
}

function EstadoT($Id){
	switch ($Id) {
		case '1':
			return "Seco";
			break;
		case '2':
			return "Húmedo";
			break;
		case '3':
			return "Lluvioso";
			break;
		
		default:
			return "";
			break;
	}
}
function buscar($cadena, $word ){
	$result = false;
	$buscar = explode(",", $word);

	foreach ($buscar as $key) {
		$result = $result || strpos($cadena, $key);	
	}
	return $result; 
}
function SetReferencia($Comparador,$Limite){
	switch ($Comparador) {
		case '1':
			# <
			return "<".$Limite;
			break;
		case '2':
			# >
			return ">".$Limite;
			break;
		case '3':
			# <=
			return "&le;".$Limite; //"&le;".$Limite;
			break;
		case '4':
			# >=
			return "&ge;".$Limite;
			break;
		case '5':
			# =
			return "=".$Limite;
			break;
		case '6':
			# Res/100mL
			return $Limite.'/100mL';
			break;
		case '7':
			# Res/200mL
			return $Limite.'/200mL';
			break;
		case '8':
			# Ausencia
			return "Ausencia";
			break;
		case '9':
			# Negativo
			return "Negativo";
			break;
		case '10':
			# Rango
			$Limits =explode("|", $Limite);
			$Lim1 = $Limits[0];
			$Lim2 = $Limits[1];
			return $Lim1." - ".$Lim2;
			break;
		case '11':
			return 'No específica';
			break;
		default:
			# code...
			break;
	}
}

function SetResultado($Comparador,$Limite,$Resultado){
	switch ($Comparador) {
		case '1':
			# <
			if($Resultado<$Limite ){
				return 'true';
			}
			else{
				return 'false';
			}
			break;
		case '2':
			# >
			if($Resultado>$Limite ){
				return 'true';
			}
			else{
				return 'false';
			}
			break;
		case '3':
			# <=
			if($Resultado<=$Limite ){
				return 'true';
			}
			else{
				return 'false';
			}
			break;
		case '4':
			# >=
			if($Resultado>=$Limite ){
				return 'true';
			}
			else{
				return 'false';
			}
			break;
		case '5':
			# =
			if($Resultado==$Limite ){
				return 'true';
			}
			else{
				return 'false';
			}
			break;
		case '6':
			# Res/100mL
			if($Resultado<=$Limite ){
				return 'true';
			}
			else{
				return 'false';
			}		
			break;
		case '7':
			# Res/200mL
			if($Resultado<=$Limite ){
				return 'true';
			}
			else{
				return 'false';
			}
			break;
		case '8':
			# Ausencia
			$Resultado = strtolower($Resultado);
			if($Resultado!='ausencia' ){
				return 'false';
			}
			else{
				return "true";
			}
			break;
		case '9':
			# Negativo
			$Resultado = strtolower($Resultado);
			if($Resultado!='negativo' ){
				return 'false';
			}
			else{
				return "true";
			}
			break;
		case '10':
			$limiteSup = explode("|",$Limite)[1];
			if($Resultado>$limiteSup){
				return 'false';
			}
			else
				return 'true';
			break;
		case '11':
			return 'true';
			break;
		default:
			# code...
			break;
	}	
}
function SetResComparador($Id){
	switch ($Id) {
		case '0':
			return 'NR';
			break;
		case '1':
			return '=';
			break;
		case '2':
			return '<';
			break;
		case '3':
			return '>';
			break;
		case '4':
			return '';
			break;
		default:
			# code...
			break;
	}	
}
	include_once '../clases/clasesInformes.php';

	date_default_timezone_set('America/Bogota');
//	$zonaHoraria = date_default_timezone_get();
*/

	$id 		  		= $_GET['id'];
	$cn 				= $_GET['sp'];
	$nd					= $_GET['nd'];
	
	$view  				= new stdClass(); 
	$Muestras			= new Muestras();
	$Muestras 			->Muestra($id);
	
	$Muestras 			->DetallesMuestras($id, $cn);
	$ParametroId		= $Muestras 			->Parametro;

	$Parametrizacion 	= $Muestras 			->getParametrizacion($ParametroId)[0];//getParametrizacion($ParametroId)[0];
	$Categoria 			= $Muestras 			->getCategoria($Parametrizacion['Categoria']); 

	$Area 				= $Parametrizacion['Area'];
	$Clase 				= $Muestras 			->getClase($Parametrizacion['Clase']);
	$Clase 				= $Muestras 			->Clase;
	$NParametros		= explode("|",$Parametrizacion['Parametros']);	
	$Metodo 			= explode("|",$Parametrizacion['Metodo']);
	$Norma 				= explode("|",$Parametrizacion['Norma']);
	$Comparador 		= explode("|",$Parametrizacion['Comparador']);
	$Limite 			= explode("|",$Parametrizacion['Limite']);
	$Tipo 				= explode("|",$Parametrizacion['Tipo']);
	$Results			= $Muestras 			->getResultados($id,$cn);
	$Results 	 		= $Muestras 			->Resultados;//explode("|",$Results['Resultados']);
	$Resultados 		= explode("|",$Results);
	$Fecha_result 		= $Muestras 			->Fecha_result;//$Results['Fecha'];
	$ResComparador 		= $Muestras 			->ResComparador;
	$ResComparador 		= explode("|",$ResComparador);
	$EstadoM 			= $Muestras 			->Estado;

    $view->contentTemplate= '../templates/cont_sp.php'; // seteo el template que se va a mostrar

?>

<?php include_once ($view->contentTemplate);?>
