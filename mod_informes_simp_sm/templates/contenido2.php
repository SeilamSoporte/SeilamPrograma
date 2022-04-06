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
	$color 	  = ($EstadoM=='Reportado') ? 'text-verde' : 'text-rojo';
?>
<div class="hidden" id="datos" data-id="<?php echo $id ?>" data-cn="<?php echo $cn ?>"> </div>
<div class="container-report">
		<div class="encabezado">
			<div class="row">				
				<div class="col col-xs-12">
					<div class="row titulo-1 text-center"><span> INFORME DE ENSAYOS <?php echo '('.$Area.')-'.$NroInforme?></span></div>
					<div class="row titulo centrado "><span id="titulo"> <?php echo $Titulo ?> </span></div>
					<div class="row text-center"><span class="<?php echo $color ?>" style="font-size: 1.5em"><strong><?php echo $estado_m ?></strong></span></div>
				</div>

			</div>
		</div>	
	
	<div class="box hide">
		<div class="row">
			<div class="col col-xs-12 centrado hd">
				DATOS GENERALES DEL CLIENTE
			</div>
		</div>
		<div class="row">
			<div class="col col-xs-2 th">Cliente/Empresa:</div>
			<div class="col col-xs-10 td"><?php echo $Cliente ?></div>
		</div>
		<div class="row">
			<div class="col col-xs-2 th">Dirección:</div>
			<div class="col col-xs-5 td"><span id="direccion"><?php echo $Direccion_cliente ?></span> </div>
			<div class="col col-xs-2 th">Teléfono:</div>
			<div class="col col-xs-3 td"><span id="telefono"><?php echo $Telefono_cliente ?></span></div>
		</div>
		<div class="row">	
			<div class="col col-xs-2 th">Sede:</div>
			<div class="col col-xs-5 td"><span id="sede"><?php echo $Sede_cliente ?></span></div>
			<div class="col col-xs-2 th">Encargado:</div>
			<div class="col col-xs-3 td"><span id="encargado"><?php echo $Encargado ?></span></div>		
		</div>
	</div>
	<?php include_once 'recepcion.php' ?>
	<?php include_once 'caracteristicas.php' ?>
	<?php include_once 'datosencampo.php' ?>
	
	<div class="box <?php echo $clase_box_resultados ?>">
		<div class="row resultados">
			<div class="col col-xs-12 centrado hd">RESULTADOS DE ENSAYOS </div>
		</div>
		<div class="row head-i">
			<div class="col <?php echo $colPar ?> th-i">Parámetro</div>
			<div class="col col-xs-2 th-i">Método </div>
			<div class="col col-xs-2 th-i">Norma de Referencia </div>
			<div class="col <?php echo $colVref ?> th-i">Valor de Referencia </div>
			<div class="col col-xs-1 th-i">Resultado</div>
			<div class="col col-xs-2 th-i <?php echo $hide_c ?>">Criterio </div>
		</div>
		<div class=<?php echo $clase_datos ?>>
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
				<div class="col <?php echo $colPar ?> td-i"> 		 <?php echo $j.' - '.$Parametro ?></div>
				<div class="col col-xs-2 td-i">			     		 <?php echo $Metodo[$i-1] ?></div>
				<div class="col col-xs-2 td-i">				 		 <?php echo $Norma[$i-1] ?> </div>
				<div class="col <?php echo $colVref ?> td-i">		 <?php echo $ValorReferencia ?> </div>
				<div class="col col-xs-1 td-i">				 		 <?php echo $ResultadoComp ?> </div>
				<div class="col col-xs-2 td-i <?php echo $hide_c ?>"><?php echo $R_Cumple ?> </div>
			</div>
			<?php  $StatusCumple = SetResultado($Comparador[$i-1],$Limites, $Resultado); 
			if ($StatusCumple=='false'){
					$Cumple = 'false';
				}
			}//Tipo
		}
			$ObservacionesCompl = $Muestras->Observaciones($Clase_obs,$Cumple); 
		?>
	
		</div>
	</div>

</div>
