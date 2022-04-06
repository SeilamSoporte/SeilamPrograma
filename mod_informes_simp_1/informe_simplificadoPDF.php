<?php   

include_once("../mpdf/mpdf.php");
$mpdf=new mPDF('utf-8', 'Letter', 0, '', 10,10,30,12,1,1,'p');	
$mpdf->_getPageFormat('Letter');
ob_start(); 

?> 
<?php 
function buscarPal($texto, $Titulo){
    $TextTitulo   = strtolower($Titulo); 
    $textoSelArr  = explode(" ", $TextTitulo);
    $palabras     = explode(",", $texto);

    foreach ($textoSelArr as $ArrT) {
      	foreach ($palabras as $Word) {
             
            if($ArrT == $Word){   
               	return true;
                }        		
        	}
        }
    }
   
function recuperaId($ide){
	$id_des 	= $ide ;
	$str 		= substr($ide, 4, 6);
	$mul 		= substr($ide, 24);
	$id  		= $str/$mul ;
	return $id;
}

function recuperaCon($ide){
	$id_des 	= $ide ;
	$con = intval(substr($ide, 16,2));
	//return 1;
	return $con;
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
			return "&le;".$Limite;
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
function SetResultado($Comparador,$Limite,$Resultado, $ResComp){
	switch ($Comparador) {
		case '1':
			# <
			if(($Resultado<=$Limite && $ResComp=='2') || ($Resultado<$Limite && $ResComp=='1')){
				return 'true';
			}
			else{
				return 'false';
			}
			break;
		case '2':
			# >

			if(($Resultado>=$Limite && $ResComp=='3') || ($Resultado>$Limite && $ResComp=='1')){
				return 'true';
			}
			else{
				return 'false';
			}
			break;
		case '3':
			# <=
			if(($Resultado<=$Limite && $ResComp=='2') || ($Resultado<=$Limite && $ResComp=='1')){
				return 'true';
			}
			else{
				return 'false';
			}
			break;
		case '4':
			# >=
			if(($Resultado>=$Limite && $ResComp=='3') || ($Resultado>=$Limite && $ResComp=='1')){
				return 'true';
			}
			else{
				return 'false';
			}
			break;
		case '5':
			# =
			if($Resultado!=$Limite ){
				return 'false';
			}
			else{
				return 'true';
			}
			break;
		case '6':
			# Res/100mL
			if(($Resultado<=$Limite && $ResComp=='2') || ($Resultado<=$Limite && $ResComp=='1') ){
				return 'true';
			}
			else{
				return 'false';
			}		
			break;
		case '7':
			# Res/200mL
			if(($Resultado<=$Limite && $ResComp=='2') || ($Resultado<=$Limite && $ResComp=='1')){
				return 'true';
			}
			else{
				return 'false';
			}
			break;
		case '8':
			# Ausencia
			$Resultado = strtolower($Resultado);
			if($Resultado!='ausencia'){
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
			$limiteInf = explode("|",$Limite)[0];
			if($Resultado>$limiteSup || $Resultado<$limiteInf){
				return 'false';
			}
			else{
				return 'true';
			}
			break;
		case '11':
			# Sin especificar, sin limites establecidos
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
	include_once 'clases/clasesInformes.php';

	date_default_timezone_set('America/Bogota');

	$D_Empresa 			= new Empresa();
	$D_Empresa			->D_Empresa(1);
	$Nombre_empresa   	=$D_Empresa 			->Empresa;
	$Direccion_empresa	=$D_Empresa 			->Direccion;
	$Telefono_empresa 	=$D_Empresa 			->Telefono;
	$Correo_empresa   	=$D_Empresa 			->Email;

	$str_id 		  	= $_GET['id'];
	$id 			  	= $_GET['id'];
	$mb 			  	= $_GET['mb'];
	$fq 			  	= $_GET['fq'];
	$sp 				= $_GET['sp'];
	$nd					= $_GET['nd'];

	$view  				= new stdClass(); 
	$Muestras			= new Muestras();
	$Muestras 			->Muestra($id);
	
	$NroInforme			= $Muestras 			->Codigo;
	$NroInforme		   .= '-'.$cn;

	$Observaciones 		= $Muestras 			->Observaciones;
	$ParametroId		= $Muestras 			->Parametro;
	$Parametrizacion 	= $Muestras 			->getParametrizacion($ParametroId)[0];
	$Categoria 			= $Muestras 			->getCategoria($Parametrizacion['Categoria']); //ListaCategoria($Parametrizacion['Categoria']);
	$Categoria 			= $Muestras 			->Categ;  
	$Titulo 			= strtoupper($Parametrizacion['Area'].' '.$Categoria);
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
	$ResComparador 		= $Muestras 			->ResComparador;
	$ResComparador 		= explode("|",$ResComparador);
?>

  <head>
		<meta charset="utf-8">
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link href="css/estilos_pdf.css" rel="stylesheet">
</head>
<body>
<style>

.printvisible{
	border: 0px solid #222;
	height: 0px;

}
</style>

<div class="printvisible visible-print-block"></div>
<div class="doc" role="document">
	<div class="doc-content">
      	<div class="doc-body">
	      	<div class="container-report">
				<?php // include_once ($view->contentTemplate);
					include_once 'templates/clientePDF.php';
					include_once 'templates/datosCampoPDF.php';
					include_once 'templates/caracteristicas.php' ;
					include_once 'templates/mbPDF.php';
					include_once 'templates/fqPDF.php';
					include_once 'templates/obsPDF.php';	
					include_once 'templates/firmasPDF.php';
				?>
			</div>
        </div> <!-- doc Body-->
    </div> <!-- doc content-->
  </div>
</body>
</html>

 <?php// include_once 'inf_sp.php' ?>

<?php 
$html = ob_get_contents();
ob_end_clean();
	$mpdf->WriteHTML($html);
	echo $Cliente; 
	$nombreInf = $NroInforme.'-('.$Cliente.')';
	$mpdf->Output($nombreInf.'.pdf','I');
	exit;

 ?>
	