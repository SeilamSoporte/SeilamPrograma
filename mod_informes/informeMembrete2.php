<?php  

$Logo  	  = 'MEMBRETE SEILAM - copia.jpg'; 
$header = ' <table style="width:100%; border-collapse: collapse">
				<tr>
					<td style="width:70%; padding-left:10px">
						<img src="../mod_empresa/imgs/'.$Logo.'" style="height:100%;"> </img>
					</td>
					<td style="width:30%; text-align:center; vertical-align:middle;">
						<img src="../imgs/onac.jpg" style="width:15%;"> </img>
					</td>
				</tr>					
			</table>';
$header = '';
include_once("../mpdf/mpdf.php");
$mpdf=new mPDF('utf-8', 'Letter', 0, '', 10,10,35,27,1,25,'p');	

$mpdf->SetHTMLHeader($header);
$css=file_get_contents('css/style2.css');
$mpdf->WriteHTML($css,1);
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
               	//echo $ArrT;  
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
		case '12':
			return 'Aceptable';
			break;
		case '13':
			return 'Fondo visible';
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
	//$Logo				= $D_Empresa 			->Logo;
	$Nombre_empresa   	=$D_Empresa 			->Empresa;
	$Direccion_empresa	=$D_Empresa 			->Direccion;
	$Telefono_empresa 	=$D_Empresa 			->Telefono;
	$Correo_empresa   	=$D_Empresa 			->Email;

	$str_id 		  	= $_GET['id'];
	#$id 			  	= recuperaId ($str_id);
	#$cn 				= recuperaCon($str_id);
	$id 			  	= $_GET['id'];
	$cn 				= $_GET['cn'];
	$view  				= new stdClass(); 
    
	$Muestras			= new Muestras();
	$Muestras 			->Muestra($id);
	
	$NroInforme			= $Muestras 			->Codigo;
	$NroInforme		   .= '-'.$cn;
	$Cliente 			= $Muestras 			->Nombre_cliente;
	$ClienteId 			= $Muestras 			->Cliente;
	$Nombres 			= explode("|", $Muestras->Nombres);
	$Encargado			= $Nombres[0];
	$Recolectado		= $Nombres[1];
	$Fecha_ingreso		= $Muestras 			->Fecha_I;
	$Fecha_recoleccion	= $Muestras 			->Fecha_R;
	$Hora_ingreso		= $Muestras 			->Hora_I;
	$IdSede 	  		= $Muestras 			->Sede;
	$Sedes	 			= Muestras::getSedes($ClienteId)[0];
	
	$Sede_cliente		= explode("|", $Sedes['Sede'])[$IdSede];
	$Sede_cliente 		= ($Sede_cliente==' ' || $Sede_cliente=='' ) ? 'No aplica' : $Sede_cliente;

	$D_Cliente 			= new Clientes();
	$D_Cliente 			->getCliente($ClienteId);
	$Direccion_cliente  = $D_Cliente 			->Direccion; 
	$Telefono_cliente	= $D_Cliente 			->Telefono;

	//$Muestras			= new Muestras();
	$Muestras 			->DetallesMuestras($id, $cn);
	
	$Codigo 			= $Muestras 			->Codigo_M;
	$Codigo 	       .= "-".$Muestras 		->Consecutivo; 	
	$CI 					= $Muestras 			->CI;
	$conIncertidumbre= $Muestras 			->CI;

	$Descripcion		= $Muestras 			->Descripcion;
	$EmpaqueId			= $Muestras 			->Empaque;
	$Hora_recoleccion 	= $Muestras 			->Hora_rec;
	$D_campo 			= explode("|",$Muestras ->Datos_campo);
	$Comparador_DC      = explode("|",$Muestras ->Comparador_DC);
	$Caracteristicas	= explode("|",$Muestras ->Caracteristicas);
	$color				= isset($Caracteristicas[0]) ? $Caracteristicas[0]:'';
	$olor				= isset($Caracteristicas[1]) ? $Caracteristicas[1]:'';
	$aspecto			= isset($Caracteristicas[2]) ? $Caracteristicas[2]:'';

	$horaI 				= strtotime($Hora_ingreso);
	$horaI 				= date("H:i" , $horaI);
	$horaR 				= strtotime($Hora_recoleccion);
	$horaR 				= date("H:i" , $horaR);
	$Fecha_Hora_I 		= $Fecha_ingreso.', '. $horaI ;
	$Fecha_Hora_R 	 	= $Fecha_recoleccion.', '.$horaR;
	$TemperaturaIngreso = $Muestras 			->Temperatura.' °C';
	$UnidadCant 		= $Muestras 			->Unidad; 	
	$UnidadCant 		= unidadCt($UnidadCant);	
	$Cantidad			= $Muestras 			->Cantidad;
	$Cantidad			= ($Cantidad=="") ? "-" : $Cantidad.' '.$UnidadCant;
	$Estado 			= $Muestras 			->Estado_tiempo ;
	$Estado 			= EstadoT($Estado);
	$LugarM				= $Muestras 			->Lugar;
	$Observaciones 		= $Muestras 			->Observaciones;
	$Empaque 			= $Muestras 			->getEmpaque($EmpaqueId);
	$Empaque 			= $Muestras 			->Empaque_name;
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
	$Results 	 		= $Muestras 			->Resultados;
	$Incerts 			= $Muestras 			->Incertidumbres;
	$Resultados 		= explode("|",$Results);
	$Incertidumbres	= explode("|",$Incerts);

	$ResComparador 		= $Muestras 			->ResComparador;
	$ResComparador 		= explode("|",$ResComparador);

	$Fecha_result 		= $Muestras 			->Fecha_result;//$Results['Fecha'];
	$Fecha_prod 		= $Muestras 			->Fecha_prod;
	$Fecha_produccion 	= ($Fecha_prod==0)? 'NA' : $Fecha_prod ;
	$Fecha_venc		    = $Muestras 			->Fecha_venc;
	$Fecha_vencimiento	= ($Fecha_venc==0) ? 'NA' : $Fecha_venc;

	#$Fecha_vencimiento	= $Muestras 			->Fecha_venc;;
	$Lote				= $Muestras 			->Lote;
	$Medio				= $Muestras 			->Medio;
	$Firmas 			= $Muestras 			->getFirmas();
	$FirmaRFQ			= $Muestras->FirmaRFQ;
	$FirmaRMB			= $Muestras->FirmaRMB;
	$FirmaAMB			= $Muestras->FirmaAMB;
	$FirmaAFQ			= $Muestras->FirmaAFQ;	
	
	$obj_usuario		= new sQuery();
	$result1			= $obj_usuario->executeQuery("SELECT * FROM usuarios WHERE id = ".$FirmaRFQ['id']); //
	$rowRFQ				= mysql_fetch_array($result1);
	$result2			= $obj_usuario->executeQuery("SELECT * FROM usuarios WHERE id = ".$FirmaRMB['id']); // 
	$rowRMB				= mysql_fetch_array($result2);
	$result3			= $obj_usuario->executeQuery("SELECT * FROM usuarios WHERE id = ".$FirmaAMB['id']); // 
	$rowAMB				= mysql_fetch_array($result3);
	$result4			= $obj_usuario->executeQuery("SELECT * FROM usuarios WHERE id = ".$FirmaAFQ['id']); //
	$rowAFQ				= mysql_fetch_array($result4);
	
	$ImgFirmaRFQ = $rowRFQ['foto'];
	$ImgFirmaRMB = $rowRMB['foto'];
	$ImgFirmaAMB = $rowAMB['foto'];
	$ImgFirmaAFQ = $rowAFQ['foto'];

	if ($Area == 'Microbiológico'){
		$FirmaA 	= $Muestras->FirmaAMB['Nombre'].' '.$Muestras->FirmaAMB['Apellido'];
		$FirmaR 	= $Muestras->FirmaRMB['Nombre'].' '.$Muestras->FirmaRMB['Apellido'];
		$CargoA 	= $Muestras->FirmaAMB['Cargo'];
		$CargoR 	= $Muestras->FirmaRMB['Cargo'];
		$ImgFirmaA 	= $ImgFirmaAMB;
		$ImgFirmaR 	= $ImgFirmaRMB;
	} 
	
	if ($Area == 'Fisicoquímico'){
		$FirmaA = $Muestras->FirmaAFQ['Nombre'].' '.$Muestras->FirmaAFQ['Apellido'];
		$FirmaR = $Muestras->FirmaRFQ['Nombre'].' '.$Muestras->FirmaRFQ['Apellido'];
		$CargoA = $Muestras->FirmaAFQ['Cargo'];
		$CargoR = $Muestras->FirmaRFQ['Cargo'];
		$ImgFirmaA 	= $ImgFirmaAFQ;
		$ImgFirmaR 	= $ImgFirmaRFQ;		
	}
	//echo $ImgFirmaAFQ;
	//echo $ImgFirmaRFQ;
	

 	$Clase_obs = 'N';
    $Clase_obs = (buscarPal('agua,aguas,alimento,alimentos', $Titulo)==true) ? 'A' : $Clase_obs;
    $Clase_obs = (buscarPal('superficie,frotis', $Titulo)==true) ? 'F' : $Clase_obs;
    $Clase_obs = (buscarPal('placas,placa,ambientes', $Titulo)==true) ? 'P' : $Clase_obs;
    
    $Clase_obs = (buscarPal('higiene,control', $Titulo)==true) ? 'P' : $Clase_obs;

	$TextTitulo   = strtolower($Titulo); 
    $view->contentTemplate= 'templates/contenidoMPDF.php'; // seteo el template que se va a mostrar

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
			<?php include_once ($view->contentTemplate);?>
        </div> <!-- doc Body-->
    </div> <!-- doc content-->
  </div>
</body>
</html>

<?php 
$footer = array('line'=>0);
//$mpdf->SetFooter('Pagina {PAGENO}', $footer);

$html = ob_get_contents();
ob_end_clean();

	//$html= utf8_encode($html);
	//$mpdf->setFooter('Página {PAGENO}');
	$mpdf->WriteHTML($html);
	echo $Cliente; 
	$nombreInf = $NroInforme.'-('.$Cliente.')';
	$mpdf->Output($nombreInf.'.pdf','I');
	exit;

 ?>
	