<?php 

	$id 		  		= $_GET['id'];
	$cn 				= $_GET['fq'];
	$mb 				= $_GET['mb'];	
	$fq 		  		= $_GET['fq'];
	$sp 				= $_GET['sp'];
	$nd					= $_GET['nd'];

	$view  				= new stdClass();   
	$Muestras			= new Muestras();
	$Muestras 			->Muestra($id);
	$Muestras 			->DetallesMuestras($id, $cn);	

	$Fecha_Hora_I 		= $Fecha_ingreso.', '. $horaI ;

	$Observaciones 		= $Muestras 			->Observaciones;
	$ParametroId		= $Muestras 			->Parametro;

	$Parametrizacion 	= $Muestras 			->getParametrizacion($ParametroId)[0];//
	
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

    $Detalles  			= $Muestras ->loadDetalles($id,$nd) ;	
	$Detalles  			= isset($Detalles[0]) ? explode("|",$Detalles[0]['Detalles']) :'';
?>
<?php 
	
	$id=explode("-",$NroInforme)[0];
	$cn=explode("-",$NroInforme)[1];
	$estado_m = ($EstadoM=='Reportado') ? 'REPORTADO' : 'INFORME PARCIAL';
?>
	<div class="box">
		<div class="row resultados">
			<div class="col col-xs-12 centrado hd">EXAMENES FISICOQUÍMICOS</div>
		</div>
		<div class="row head-i">
			<div class="col col-xs-3 th-i" style="width: 155px">Parámetro</div>
			<div class="col col-xs-3 th-i" style="width: 140px">Método </div>
			<div class="col col-xs-1 th-i" style="width: 80px">Norma de Referencia </div>
			<div class="col col-xs-1 th-i" style="text-align: center; padding-right: 20px;  width: 80px"> 
				Valor de Referencia 
			</div>
			<div class="col col-xs-1 th-i" style="text-align: center width:80px ">Resultado</div>
			<div class="col col-xs-1 th-i">Detalle </div>
		</div>


		<div >
		<?php 
			$StatusCumple= 'true';
			$Cumple 	 = 'true';
			$items = count($NParametros);
			
			/*foreach ($D_campo as $k => $val) {
				$Resultado[$k]	 = isset($val) ? $val : 'NR';
			}*/

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
		
			<div class="row" >
				<div class="col col-xs-3 td-i" style="width: 165px"> 	 
					<?php echo $Parametro ?></div>
				<div class="col col-xs-3 td-i" style="width: 140px">		 
					<?php echo $Metodo[$i-1] ?></div>
				<div class="col col-xs-1 td-i" style="width: 80px">
					<?php echo $Norma[$i-1] ?> 
				</div>
				<div class="col col-xs-1 td-i" style="text-align: center; padding-right: 5px;  width: 80px"> 
					<?php echo $ValorReferencia ?> </div>
				<div class="col col-xs-1 td-i" style="text-align: center width:80px ">		 
					<?php echo $ResultadoComp ?> </div>
				<div class="col td-i">
					<?php 
					
					switch ($Detalles[$Ndet]) {
						case '1':
							echo "Cumple";
							break;
						case '2':
							echo "No cumple";
							break;
						case '3':
							echo "Cumple, con tendencia corrosiva";
							break;
						case '4':
							echo "No cumple, con tendencia corrosiva";
							break;
						case '5':
							echo "Cumple, con tendencia incrustante";
							break;
						case '6':
							echo "No cumple, con tendencia incrustante";
							break;
						case '7':
							echo "Sin riesgo";
							break;
						case '8':
							echo "Riesgo bajo";
							break;																					
						case '9':
							echo "Riesgo medio";
							break;																					
						case '10':
							echo "Riesgo alto";
							break;	
			
					}
					?>
			    </div>
			</div>
			<?php  
			$Ndet++;
			}//Tipo
		}
		?>
		</div>
	</div>
