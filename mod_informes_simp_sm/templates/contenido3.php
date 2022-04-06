<?php 
	if (buscarPal('alimento,alimentos',$Titulo)=='true'){
		$clase_datos 		  = 'datos-mb';
		$clase_box_resultados =	 'box-resultados-mb';
	}
	else{
		$clase_datos 		  = 'datos';
		$clase_box_resultados =	'box-resultados';	
	} 
	$id=explode("-",$NroInforme)[0];
	$cn=explode("-",$NroInforme)[1];
	$estado_m = ($EstadoM=='Reportado') ? 'REPORTADO' : 'INFORME PARCIAL';
?>

<div class="container-report">
	<div class="box ">
		<div class="row">
			<div class="col col-xs-12 centrado hd">
				DATOS GENERALES DEL CLIENTE Y MUESTRA
			</div>
		</div>
		<div class="row">
			<div class="col col-xs-2 th">Cliente/Empresa:</div>
			<div class="col col-xs-5 td"><?php echo $Cliente ?></div>
			<div class="col col-xs-2 th">Teléfono:</div>
			<div class="col col-xs-3 td"><span id="telefono"><?php echo $Telefono_cliente ?></span></div>			
		</div>
		<div class="row">
			<div class="col col-xs-2 th">Responsable:</div>
			<div class="col col-xs-5 td"><span id="direccion"><?php echo $Encargado ?></span> </div>
			<div class="col col-xs-2 th">Sede:</div>
			<div class="col col-xs-5 td"><span id="sede"><?php echo $Sede_cliente ?></span></div>
		</div>

		<div class="row">	
			<div class="col col-xs-2 th">Muestreador:</div>
			<div class="col col-xs-5 td"><span id="sede"><?php echo $Recolectado ?></span></div>
			<div class="col col-xs-2 th">Fecha de ingreso:</div>
			<div class="col col-xs-3 td"><span id="encargado"><?php echo $Fecha_Hora_I ?></span></div>		
		</div>
		<div class="row">	
			<div class="col col-xs-2 th">Descripción de la muestra:</div>
			<div class="col col-xs-5 td"><span id="sede"><?php echo $Descripcion ?></span></div>
			<div class="col col-xs-2 th">Remisiones de la muestra:</div>
			<div class="col col-xs-3 td"><span id="encargado"><?php echo $Remisiones ?></span></div>		
		</div>

	</div>
	<?php include_once 'datosencampo.php' ?>
	<?php include_once 'caracteristicas.php' ?>

	<div class="box">
		<div class="row resultados">
			<div class="col col-xs-12 centrado hd">EXAMENES MICROBIOLÓGICOS Y MOHOS</div>
		</div>
		<div class="row head-i">
			<div class="col col-xs-3 th-i">Parámetro</div>
			<div class="col col-xs-2 th-i">Método </div>
			<div class="col col-xs-2 th-i">Norma de Referencia </div>
			<div class="col col-xs-2 th-i">Valor de Referencia </div>
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
			<div class="row">
				<div class="col col-xs-3 td-i"> 	 <?php echo $j.' - '.$Parametro ?></div>
				<div class="col col-xs-2 td-i">		 <?php echo $Metodo[$i-1] ?></div>
				<div class="col col-xs-2 td-i">		 <?php echo $Norma[$i-1] ?> </div>
				<div class="col col-xs-2 td-i">		 <?php echo $ValorReferencia ?> </div>
				<div class="col col-xs-1 td-i">		 <?php echo $ResultadoComp ?> </div>
				<div class="col col-xs-1 td-i">
					<select name="" id="" class="cumplimiento">
						<option value="1">Cumple</option>
						<option value="2">No cumple</option>
					</select>
			    </div>
			</div>
			<?php  
			}//Tipo
		}
		?>
	
		</div>
	</div>

</div>
