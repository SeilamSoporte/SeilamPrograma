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
			<div class="col col-xs-3 th-i">Parámetro</div>
			<div class="col col-xs-2 th-i">Método </div>
			<div class="col col-xs-2 th-i">Norma de Referencia </div>
			<div class="col col-xs-1 th-i">Valor de Referencia </div>
			<div class="col col-xs-1 th-i">Resultado</div>
			<div class="col col-xs-1 th-i">Detalle </div>
		</div>
		<div >
		<?php 
			$StatusCumple= 'true';
			$Cumple 	 = 'true';
			$items = count($NParametros);
			
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
					$Cumplimiento  	 	  = SetResultado($Comparador[$i-1], $Limites, $Resultado);
					$R_Cumple = 'Cumple';
					if ($Cumplimiento=='false'){
						$R_Cumple = 'No cumple';
					}	
				?>
			<div class="row" >
				<div class="col col-xs-3 td-i"> 	 <?php echo $Parametro ?></div>
				<div class="col col-xs-2 td-i" style="width: 173px">		 <?php echo $Metodo[$i-1] ?></div>
				<div class="col col-xs-2 td-i">		 <?php echo $Norma[$i-1] ?> </div>
				<div class="col col-xs-1 td-i">		 <?php echo $ValorReferencia ?> </div>
				<div class="col col-xs-1 td-i">		 <?php echo $ResultadoComp ?> </div>
				<div class="col col-xs-1 td-i">
					<select 
						id="<?php echo 'sel_fq_'.$j ?>" 
						class="cumplimiento" 
						data-id="<?php echo $id ?>" 
						data-n ="<?php echo $nd ?>"
					>
						<?php 
						echo "<option ".($Detalles[$Ndet] == 1 ? "selected ":''). "value='1' >Cumple</option>";
						echo "<option ".($Detalles[$Ndet] == 2 ? "selected ":''). "value='2' >No cumple</option>";
						echo "<option ".($Detalles[$Ndet] == 3 ? "selected ":''). "value='3' >Cumple, con tendencia corrosiva</option>";
						echo "<option ".($Detalles[$Ndet] == 4 ? "selected ":''). "value='4' >No cumple, con tendencia corrosiva</option>";
						echo "<option ".($Detalles[$Ndet] == 5 ? "selected ":''). "value='5' >Cumple, con tendencia incrustante</option>";
						echo "<option ".($Detalles[$Ndet] == 6 ? "selected ":''). "value='6' >No cumple, con tendencia incrustante</option>";
						echo "<option ".($Detalles[$Ndet] == 7 ? "selected ":''). "value='7' >Sin riesgo</option>";
						echo "<option ".($Detalles[$Ndet] == 8 ? "selected ":''). "value='8' >Riesgo bajo</option>";
						echo "<option ".($Detalles[$Ndet] == 9 ? "selected ":''). "value='9' >Riesgo medio</option>";
						echo "<option ".($Detalles[$Ndet] == 10 ? "selected ":''). "value='10' >Riesgo alto</option>";
						?>					
			
					</select>
			    </div>
			</div>
			<?php  
			}//Tipo
		$Ndet++;
		}
		?>
		</div>
	</div>
