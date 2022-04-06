<?php 
	$id 		  		= $_GET['id'];
	$cn 				= $_GET['sp'];
	$nd					= $_GET['nd'];

	$Muestras			= new Muestras();
	$Muestras 			->Muestra($id);
	
	$Muestras 			->DetallesMuestras($id, $cn);
	
	$CI_SP 				= $Muestras 			->CI;
	$conIncertidumbreSP = $Muestras 			->CI;


	$ParametroId		= $Muestras 			->Parametro;
	$Parametrizacion 	= $Muestras 			->getParametrizacion($ParametroId)[0];

	$NParametros		= explode("|",$Parametrizacion['Parametros']);	
	$Metodo 			= explode("|",$Parametrizacion['Metodo']);
	$Norma 				= explode("|",$Parametrizacion['Norma']);
	$Comparador 		= explode("|",$Parametrizacion['Comparador']);
	$Limite 			= explode("|",$Parametrizacion['Limite']);
	$Tipo 				= explode("|",$Parametrizacion['Tipo']);
	$Results			= $Muestras 			->getResultados($id,$cn);
	$Results 	 		= $Muestras 			->Resultados;//explode("|",$Results['Resultados']);
	$IncertsSP 			= $Muestras 			->Incertidumbres;
	$IncertidumbresSP	= explode("|",$IncertsSP);

	$Resultados 		= explode("|",$Results);
	$ResComparador 		= $Muestras 			->ResComparador;
	$ResComparador 		= explode("|",$ResComparador);

	foreach ($D_campo as $k => $val) {
		$Resultado[$k]	 = isset($val) ? $val : 'NR';
	}

	$l=0;
	$i=0;
	$j=0;
	foreach ($NParametros as $Parametro => $value) {
		$Parametro 	 = $Muestras ->getParametros($value);
	$i++;
	if ($Comparador[$i-1]==10){
			$Limites = $Limite[$l+1].'|'.$Limite[$l+2];
		}
		else{
			$Limites=$Limite[$l];	
		}
		$l=$i*3;
		$ValorReferencia = SetReferencia($Comparador[$i-1], $Limites);
		$TipoP 			 = isset($Tipo[$i-1]) ? $Tipo[$i-1] : '';
		if ($TipoP!=5){
			$Resultado 	 = isset($Resultados[$j]) ? $Resultados[$j] : 'NR';	
			if ($Resultado==''){
				$Resultado = 'NR';
			} 	 

			$IncertidumbreSP = isset($IncertidumbresSP[$j]) ? $IncertidumbresSP[$j] : 'NR';
			$IncertidumbreSP = trim($IncertidumbreSP, ' ');
			$IncertidumbreSP = ($IncertidumbreSP!="") ? $IncertidumbreSP : 'NR';
						
			$j = str_pad($j,2,"0",STR_PAD_LEFT ); 
			$j++;
			
			if(isset($ResComparador[$j-1])){
				$ResComp = SetResComparador($ResComparador[$j-1]);
			}
			else{
				$ResComp = '';
			}
			if ($ResComp   =='='){ $ResComp='';}
			if ($Resultado == 'NR'){$ResultadoComp='NR';}
			else { $ResultadoComp = $ResComp.$Resultado; }
			
		?>
	<div class="row" style="line-height: 0.9em">
		<div class="col col-xs-4 td-i" style="width:30%;"> 	 <?php echo $Parametro ?></div>
		<div class="col col-xs-3 td-i" style="width:125px">		 <?php echo $Metodo[$i-1] ?></div>
		<div class="col col-xs-1 td-i" style=" width:10.5%"> <?php echo $Norma[$i-1] ?> </div>
		<div class="col col-xs-1 td-i" style="text-align: center;  width:11.5%">	<?php echo formato($ValorReferencia) ?> </div>
		<div class="col col-xs-1 td-i" style="text-align: center">		 <?php echo formato($ResultadoComp) ?> </div>
		<?php if($conIncertidumbreSP==true){ ?>
			<div class="col col-xs-1 td-i" style="width: 100px; text-align: center;"> <?php echo formato($IncertidumbreSP) ?></div>
		<?php } ?> 		
		<!-- 
		<div class="col col-xs-1 td-i">
			<?php echo $Detalles[$Ndet] == 1 ? "Cumple" : "No cumple" ?>
			    </div>
			     -->
	</div>
	<?php 
	$Ndet++; 
	}//Tipo
}
?>
		
