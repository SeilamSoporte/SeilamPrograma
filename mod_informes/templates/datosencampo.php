	<?php 
		$DC='false';
		foreach ($Tipo as $k => $val) {
			if ($val==5) {$DC = 'true';}
		}
	if($DC=='true'){
	?>
	
	<div class="box" style="font-size:0.8em; line-height: 1em;">
		<div class="row resultados">
			<div class="col col-xs-12 centrado hd" style="padding-bottom:0">DATOS EN CAMPO</div>
		</div>
		<div class="row head-i" style="padding-top:0; line-height: 0.5em;">
			<div class="col col-xs-3 th-dc">Parámetro</div>
			<div class="col col-xs-2 th-dc">Método </div>
			<div class="col col-xs-3 th-dc">Norma de Referencia </div>
			<div class="col col-xs-2 th-dc">Valor de Referencia </div>
			<div class="col col-xs-1 th-dc">Resultado</div>
		</div>
		
		<?php 
			$j=0;
			foreach ($D_campo as $k => $val) {
				$Resultado[$k]	 = isset($val) ? $val : 'NR';
			}
			foreach ($Comparador_DC as $k => $val) {
				$comparadorDC[$k]	 = isset($val) ? $val : '';
			}
			$l=0;
			$i=0;
			foreach ($NParametros as $P => $value) {
				$Parametro 	 	 = $Muestras ->getParametros($value);
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
				if ($TipoP==5){
				?>
				<?php 
					$resultadoDC 	= isset($Resultado[$j]) ? $Resultado[$j] : '' ;
					$resultadoDC 	=  str_replace ( '.' , ',' , (string)$resultadoDC);
					

					$comparador_DC 	= isset($comparadorDC[$j]) ? $comparadorDC[$j] : '' ;
					if ($comparador_DC=='='){
						$comparador_DC ='';
					}
					$resultado_DC 	= $comparador_DC.$resultadoDC; 
				?>
			<div class="row" style="line-height: 1em;">
				<div class="col col-xs-3 td-dc"><?php echo $Parametro ?></div>
				<div class="col col-xs-2 td-dc"><?php echo $Metodo[$i-1] ?></div>
				<div class="col col-xs-3 td-dc"><?php echo $Norma[$i-1] ?> </div>
				<div class="col col-xs-2 td-dc"><?php echo str_replace ( '.' , ',' , (string)$ValorReferencia) ?> </div>
				<div class="col col-xs-1 td-dc"><?php echo formato($resultado_DC) ; ?> </div>
			</div>
		<?php $j++; }//Tipo
		}?>
	</div>
	<?php 
	}
	else{
		echo'';		
	}?>
	
	