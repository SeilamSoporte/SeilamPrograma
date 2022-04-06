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
			<div class="row">
				<div class="col col-xs-3 td-i"> 	 <?php echo $Parametro ?></div>
				<div class="col col-xs-2 td-i">		 <?php echo $Metodo[$i-1] ?></div>
				<div class="col col-xs-2 td-i">		 <?php echo $Norma[$i-1] ?> </div>
				<div class="col col-xs-2 td-i">		 <?php echo $ValorReferencia ?> </div>
				<div class="col col-xs-1 td-i">		 <?php echo $ResultadoComp ?> </div>
				<div class="col col-xs-1 td-i">
					<select 
						id="<?php echo 'sel_sp_'.$j ?>" 
						class="cumplimiento" 
						data-id="<?php echo $id ?>" 
						data-n ="<?php echo $nd ?>"
					>
						<?php 
						echo "<option ".($Detalles[$Ndet] == 1 ? "selected ":''). "value='1' >Cumple</option>";
						echo "<option ".($Detalles[$Ndet] == 2 ? "selected ":''). "value='2' >No cumple</option>";
						?>
					</select>
			    </div>
			</div>
			<?php  
			}//Tipo
		$Ndet++;
		}
		?>
		