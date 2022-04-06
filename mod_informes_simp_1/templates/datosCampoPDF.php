	<?php 
	$Muestras_dc		= new Muestras();
	$Muestras_dc 		->Muestra($id);
	$Muestras_dc 		->DetallesMuestras($id, $fq);
	$ParametroId_dc		= $Muestras_dc 			->Parametro;

	$Parametrizacion_dc	= $Muestras_dc 			->getParametrizacion($ParametroId_dc)[0];
	$NParametros_dc		= explode("|",$Parametrizacion_dc['Parametros']);	
	$Metodo_dc 			= explode("|",$Parametrizacion_dc['Metodo']);
	$Norma_dc 			= explode("|",$Parametrizacion_dc['Norma']);
	$Comparador_dc 		= explode("|",$Parametrizacion_dc['Comparador']);
	$Limite_dc 			= explode("|",$Parametrizacion_dc['Limite']);
	$Tipo_dc 			= explode("|",$Parametrizacion_dc['Tipo']);
	$Results_dc			= $Muestras_dc 			->getResultados($id,$fq);
	$Results_dc 	 	= $Muestras_dc 			->Resultados;//explode("|",$Results['Resultados']);
	$Resultados_dc 		= explode("|",$Results_dc);
	$ResComparador_dc	= $Muestras 			->ResComparador;
	$ResComparador_dc	= explode("|",$ResComparador_dc);

    $Detalles  		= $Muestras ->loadDetalles($id,$nd) ;
	$Detalles  		= isset($Detalles[0]) ? explode("|",$Detalles[0]['Detalles']) :'';

    $D_campo  = explode("|",$Muestras_dc ->Datos_campo);
	$Ndet 	   = 0;
  
	$DC='false';
		foreach ($Tipo_dc as $k => $val) {
			if ($val==5) {$DC = 'true';}
		}
	if($DC=='true'){
	?>
	<div class="box">
		<div class="row resultados">
			<div class="col col-xs-12 centrado hd" style="padding-bottom:0">DATOS EN CAMPO</div>
		</div>
		<div class="row head-i" style="padding-top:0">
			<div class="col col-xs-3 th-i">Parámetro</div>
			<div class="col col-xs-2 th-i">Método </div>
			<div class="col col-xs-2 th-i">Norma de Referencia </div>
			<div class="col col-xs-2 th-i">Valor de Referencia </div>
			<div class="col col-xs-1 th-i">Resultado</div>
			<div class="col col-xs-1 th-i">Detalle</div>
		</div>
		
		<?php 
			$j=0;
			foreach ($D_campo as $k => $val) {
				$Resultado_dc[$k]	 = isset($val) ? $val : 'NR';
			}
			$l=0;
			$i=0;
			foreach ($NParametros_dc as $P => $value) {
				$Parametro_dc 	 	 = $Muestras_dc ->getParametros($value);
				$i++;
				if ($Comparador_dc[$i-1]==10){
					$Limites_dc = $Limite_dc[$l+1].'|'.$Limite_dc[$l+2];
				}
				else{
					$Limites_dc=$Limite_dc[$l];	
				}
				$l=$i*3;
				$ValorReferencia_dc = SetReferencia($Comparador_dc[$i-1], $Limites_dc);
				$TipoP_dc 			 = isset($Tipo_dc[$i-1]) ? $Tipo_dc[$i-1] : '';
				if ($TipoP_dc==5){
				?>
			<div class="row">
				<div class="col col-xs-3 td-dc"><?php echo $Parametro_dc ?></div>
				<div class="col col-xs-2 td-dc"><?php echo $Metodo_dc[$i-1] ?></div>
				<div class="col col-xs-2 td-dc"><?php echo $Norma_dc[$i-1] ?> </div>
				<div class="col col-xs-2 td-dc"><?php echo $ValorReferencia_dc ?> </div>
				<div class="col col-xs-1 td-dc"><?php echo isset($Resultado_dc[$j]) ? $Resultado_dc[$j] : '' ?> </div>
				<div class="col col-xs-1 td-i">
					<?php echo $Detalles[$Ndet]==1 ? "Cumple":"No cumple"; ?>
			    </div>
			</div>
		<?php 
			$j++; 
		 	$Ndet++;
		}//Tipo
		
		}?>
	</div>
	<?php 
	}
	else{
		echo'';		
	}?>
	
	