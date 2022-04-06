
<?php   
	$idArray = getdate();
	$idComp  = $idArray['minutes'].$idArray['hours'].$idArray['wday'].$idArray['mon'].$idArray['yday'];
	$idSent  = isset($_GET['id']) ? $_GET['id']:0;
	$desde 	 = isset($_GET['dd']) ? $_GET['dd']:'';
	$hasta 	 = isset($_GET['hh']) ? $_GET['hh']:'';
	if($idSent==0 || $idSent!=$idComp){
?>	
    <!DOCTYPE html>
	<html lang="es">
	<body>
		<div class="text-center">ERROR DE CARGA, SE HA SUPERADO EL TIEMPO DE ACCESO A LA BASE DE DATOS<br>
								 ESTE PROCEDIMIENTO SE REALIZA POR SEGURIDAD. <br>
								 POR FAVOR VUELVA A CARGAR DESDE EL PANEL DE ORDENES DE SERVICIO
								 </div>	
	</body>
	</html>

<?php 
    exit;
}

include_once("clases/clasesOrden.php");
include_once("resources/Tipos_param.php");

$tipo 	  =  FQ;
$Muestra  =  new Muestras();
$Muestras = Muestras::getMuestra($desde,$hasta);
$Logo 	  = Muestras::getLogo();
$Logo  	  = ($Logo[0]['logo']=='') ? '' : $Logo[0]['logo'];

$header = ' <table style="height:50px; font-size:9pt; width:100%; border-collapse: collapse" border="1">
				<tr>
					<td rowspan="4" style="width:20%; padding-left:20px"><img src="../mod_empresa/imgs/'.$Logo.'" style="height:25px;"> </img></td>
					<td rowspan="4" style="width:60%; text-align: center;">Orden de servicio laboratorio de Fisicoquímico de aguas (parámetros básicos)
					<br>('.$desde.'/'.$hasta.')</td>
					<td style="width:20%; font-size:7pt; border:0 ; border-right:1px solid #000; border-top:1px solid #000; padding:3px 0 0 10px ">CODIGO: F-FQ-01</td>
				</tr>
				<tr>
					<td style="font-size:7pt; border:0 ; border-right:1px solid #000 ; padding:0 0 0 10px">VERSIÓN: 02 </td>
				</tr>
				<tr>
					<td style="font-size:7pt; border:0 ; border-right:1px solid #000; padding:0 0 0 10px">FECHA: 2018-10-16 </td>
				</tr>
				<tr>
					<td style="font-size:7pt; border:0 ; border-right:1px solid #000; border-bottom: 1px solid #000; padding:0 0 3p 10px" >PÁGINA: {PAGENO} de {nbpg}</td>
				</tr>						
			</table>';

include_once("../mpdf/mpdf.php");
ini_set("memory_limit","-1"); 
$mpdf=new mPDF();	
$mpdf->setAutoTopMargin = 'stretch';
$mpdf->autoMarginPadding = 1;

$mpdf->showImageErrors = true;
$mpdf->_getPageFormat('LEGAL');
$mpdf->_setPageSize('LEGAL-L');
//$mpdf->SetHeader('|Orden de servicio laboratorio de Fisicoquímico de aguas (parámetros básicos)|('.$desde.'/'.$hasta.')');
$mpdf->SetHTMLHeader($header);
$setAutoTopMargin= true;
/*
$mpdf->SetFooter('Página {PAGENO}');
if ($Logo !=''){
	$mpdf->SetWatermarkImage('../mod_empresa/imgs/'.$Logo);
	$mpdf->showWatermarkImage = true;
} 
*/
ob_start(); 

?> 
 
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Ordenes de Servicios FQ</title>  
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link href="css/estilos_pdf.css" rel="stylesheet">
  </head>

  <body>
	<table class="table" width="">
	<div class="">
	<?php  $Parametros= new Muestras(); ?>
	<?php foreach ($Muestras as $Muestra_d)
	{
	?>
		<?php 
			$DParametros = $Parametros->getParametros($Muestra_d['Parametro']);  
			$NPArray 	 = explode("|",$DParametros[0]['Tipo']);
			$Hide 	 	 = (in_array($tipo,$NPArray)==false) ? 'hide':'';
			if($Hide!='hide'){
		 ?>
		<tr>
			<td colspan="13" class="muestra <?php echo $Hide ?>">
				MUESTRA:	<?php echo $Muestra_d['Codigo'].'-'.$Muestra_d['CN'] ?>
			</td>		
		</tr>
		<tr class="<?php echo $Hide ?>">
				<td class="th th-3">
					PARÁMETRO
				</td>
				<td class="th th-3">
					EQUIPO
				</td>
				<td class="th th-4">
					FECHA DE ANÁLISIS<br>(AAAA/MM/DD)
				</td>
				<td class="th th-1">
					ANALISTA
				</td>
				<td class="th th-1">
					FACTOR DE DILUCIÓN 
				</td>
				<td class="th th-1">
					RESPUESTA DEL EQUIPO(X<sub>1</sub>)
				</td>
				<td class="th th-1">
					RESPUESTA DEL EQUIPO(X<sub>2</sub>) DUPLICADO
				</td>		
				<td class="th th-3">
					OBSERVACIONES
				</td>		
				<td class="th th-4">
					APROBACIÓN
				</td>			
			</tr>
		<?php 
		}
		 	foreach ($DParametros as $params) {
		 	$IdParametros = explode("|",$params['Parametros']);
		 	$TipoParam 	  = explode("|",$params['Tipo']);
		 	$IdEq  		  = explode("|",$params['Equipo']);
		 		foreach ($IdParametros as $k=>$Id) {
		 			if($TipoParam[$k] ==$tipo){
		 				$NParametros  = $Parametros->getParametrosN($Id);
		 				$Equipo 	  = $Parametros->getEquiposN($IdEq[$k]);		 					
		 ?>
		
			<tr>
				<td class="td td-3 item">
					<?php echo $NParametros  ?>
				</td>
				<td class="td td-3 item">
					<?php echo $Equipo  ?>	
				</td>
				<td class="td td-4">	</td>
				<td class="td td-1">	</td>
				<td class="td td-1">	</td>
				<td class="td td-1">	</td>
				<td class="td td-1">	</td>
				<td class="td td-3">	</td>
				<td class="td td-4">	</td>
			</tr>
			<?php } } 
			} ?>
        
	<?php } ?>
	</table>
	</div> <!-- Container -->

	</body>
</html>
<?php 
$html = ob_get_contents();
ob_end_clean();

//	$html=utf8_encode($html);
	$mpdf->WriteHTML($html);
	$mpdf->Output('orden.pdf','I');
	exit;

 ?>
	