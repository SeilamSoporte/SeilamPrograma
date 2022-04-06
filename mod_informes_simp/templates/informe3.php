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

	$D_Empresa 			= new Empresa();
	$D_Empresa			->D_Empresa(1);
	$Logo				= $D_Empresa 			->Logo;
	$Nombre_empresa   	=$D_Empresa 			->Empresa;
	$Direccion_empresa	=$D_Empresa 			->Direccion;
	$Telefono_empresa 	=$D_Empresa 			->Telefono;
	$Correo_empresa   	=$D_Empresa 			->Email;

	//$str_id 		  	= $_GET['id'];
	//$id 			  	= recuperaId ($str_id);
	//$cn 				= recuperaCon($str_id);
	$id 		  		= $_GET['id'];
	$cn 				= $_GET['mb'];
	$mb 				= $_GET['mb'];	
	$fq 		  		= $_GET['fq'];
	$sp 				= $_GET['sp'];
	$Remisiones 		= $id.'-'.$mb.' / '.$id.'-'.$fq.' / '.$id.'-'.$sp;

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
	
	$D_Cliente 			= new Clientes();
	$D_Cliente 			->getCliente($ClienteId);
	$Direccion_cliente  = $D_Cliente 			->Direccion; 
	$Sede_cliente		= $D_Cliente 			->Sede;
	$Telefono_cliente	= $D_Cliente 			->Telefono;

#   ##############################################################################
#  	FISICOQUIMICO ################################################################

	$Muestras 			->DetallesMuestras($id, $cn);
	
	$Codigo 			= $Muestras 			->Codigo_M;
	$Codigo 	       .= "-".$Muestras 		->Consecutivo; 	
	
	$Descripcion		= $Muestras 			->Descripcion;
	$EmpaqueId			= $Muestras 			->Empaque;
	$Hora_recoleccion 	= $Muestras 			->Hora_rec;
	$D_campo 			= explode("|",$Muestras ->Datos_campo);
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
	$TemperaturaIngreso = $Muestras 			->Temperatura.' ºC';
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

	$Parametrizacion 	= $Muestras 			->getParametrizacion($ParametroId)[0];//getParametrizacion($ParametroId)[0];
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
	$Fecha_result 		= $Muestras 			->Fecha_result;//$Results['Fecha'];
	$ResComparador 		= $Muestras 			->ResComparador;
	$ResComparador 		= explode("|",$ResComparador);
	$EstadoM 			= $Muestras 			->Estado;
	$Fecha_prod 		= $Muestras 			->Fecha_prod;
	$Fecha_produccion 	= ($Fecha_prod==0)? 'NA' : $Fecha_prod ;
	$Fecha_venc		    = $Muestras 			->Fecha_venc;
	$Fecha_vencimiento	= ($Fecha_venc==0) ? 'NA' : $Fecha_venc;

	#$Fecha_produccion 	= $Muestras 			->Fecha_prod;
	#$Fecha_vencimiento	= $Muestras 			->Fecha_venc;;
	$Lote				= $Muestras 			->Lote;
	$Medio				= $Muestras 			->Medio;

	$Firmas 			= $Muestras 			->getFirmas();
	$FirmaRFQ			= $Muestras->FirmaAFQ;
	$FirmaRMB			= $Muestras->FirmaRMB;
	$FirmaAMB			= $Muestras->FirmaAMB;
	$FirmaAFQ			= $Muestras->FirmaAFQ;

	if ($Area == 'Microbiológico'){
		$FirmaA = $Muestras->FirmaAMB['Nombre'].' '.$Muestras->FirmaAMB['Apellido'];
		$FirmaR = $Muestras->FirmaRMB['Nombre'].' '.$Muestras->FirmaRMB['Apellido'];
		$CargoA = $Muestras->FirmaAMB['Cargo'];
		$CargoR = $Muestras->FirmaRMB['Cargo'];
		$hide_c = 'hide';
		$colPar = 'col-xs-5';
		$colVref= 'col-xs-2';
	}

	if ($Area == 'Fisicoquímico'){
		$FirmaA = $Muestras->FirmaAFQ['Nombre'].' '.$Muestras->FirmaAFQ['Apellido'];
		$FirmaR = $Muestras->FirmaRFQ['Nombre'].' '.$Muestras->FirmaRFQ['Apellido'];
		$CargoA = $Muestras->FirmaAFQ['Cargo'];
		$CargoR = $Muestras->FirmaRFQ['Cargo'];
		$hide_c = '';
		$colPar = 'col-xs-4';
		$colVref= 'col-xs-1';
	}
 	$Clase_obs = 'N';
    $Clase_obs = (buscarPal('agua,aguas,alimento,alimentos', $Titulo)==true) ? 'A' : $Clase_obs;
    $Clase_obs = (buscarPal('auperficie,frotis', $Titulo)==true) ? 'F' : $Clase_obs;
    $Clase_obs = (buscarPal('placas,placa,ambientes', $Titulo)==true) ? 'P' : $Clase_obs;
    
    $Clase_obs = (buscarPal('higiene,control', $Titulo)==true) ? 'P' : $Clase_obs;
	$Campo[0] = $D_campo[0]!='' ? $D_campo[0].'ppm': 'NR';
	$Campo[1] = isset($D_campo[1]) ? $D_campo[1]: 'NR';
	$Campo[2] = isset($D_campo[2]) ? $D_campo[2].'ºC': 'NR';

	$Datos_campo		= (buscar($Titulo, 'ALIMENTO')==true) ? "NA" : $D_campo;
	if ($Datos_campo!="NA") 
	{
		$Datos_campo = (buscar($Titulo, 'NO')==true) ? 'pH:' . $Campo[1]. ' / Temperatura:'.$Campo[2].'ºC' : 'Cloro Res:'.$Campo[0] . ' / pH:' . $Campo[1]. ' / Temperatura:'.$Campo[2];
	}  
	$TextTitulo   = strtolower($Titulo); 
    $view->contentTemplate= '../templates/contenido3.php'; // seteo el template que se va a mostrar
	$src_logo = "../../mod_empresa/imgs/".$Logo;	

?>
  <head>
    <meta charset="utf-8">
	    <meta http-equiv="Content-Type" content="text/html">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Informe <?php echo "-".$id."-".$cn."-".$Cliente. " (".$TextTitulo.")"?></title>
		<link href="../../fonts/font-awesome.min.css" rel="stylesheet">
		<link href="../../css/bootstrap.css" rel="stylesheet">
		<!-- <link href="../../css/btn_floating.css" rel="stylesheet"> -->
		<link href="../css/estilos_inf.css" rel="stylesheet">
		<script src="../../js/jquery-2.2.2.min.js"> buscarPal ()</script>
		<!-- <script src="../../js/printThis.js"></script> 
		<script src="../../js/jspdf.js"></script> -->
	</head>
<body>
<style>

.printvisible{
	border: 0px solid #222;
	height: 75px;

}
</style>
<div class="printvisible visible-print-block"></div>
<div class="doc" role="document">
	<div class="doc-content">
    	<div class="doc-header">
    		  
      	</div>
      	<div class="doc-body">
			<div class="report">
				<div id="contenido-informe">
					<?php include_once ($view->contentTemplate);?>
				</div>
			</div>
        </div> <!-- doc Body-->
    </div> <!-- doc content-->
  </div>
</body>
</html>
