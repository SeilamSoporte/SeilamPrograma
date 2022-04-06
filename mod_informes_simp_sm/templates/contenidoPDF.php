<?php 
function formato($valor){
	//return $valor;

	//return $valor;
	$str   = strval($valor); 		// Se convierte a string
	$split = explode('.', $str);
	$dec   = count($split);  	    //Indagammos si posee decimales
	$comp  = substr($str, 0,1);
	return (str_replace('.', ',', $str));
}
	if (buscarPal('alimento,alimentos',$Titulo)=='true'){
		$clase_datos 		  = 'datos-mb';
		$clase_box_resultados =	 'box-resultados-mb';
	}
	else{
		$clase_datos 		  = 'datos';
		$clase_box_resultados =	'box-resultados';	
	} 	
	$FQA 	= (buscarPal('agua,aguas',$Titulo)) =='true' ? 'show' : '';
	$MBA	= (buscarPal('tratada,tratadas',$Titulo)) =='true' ? 'show' : '';
	$ALMB 	= (buscarPal('alimento,alimentos',$Titulo)) =='true' ? 'show' : '';
	$FR		= (buscarPal('superficie,frotis',$Titulo)) =='true' ? 'show' : '';
	$PL 	= (buscarPal('placas,ambientes',$Titulo)) =='true' ? 'show' : '';	
?>

<div class="container-report">
	<div class="box">
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
			<div class="col col-xs-2 th">Sede:</div>
			<div class="col col-xs-5 td"><span id="sede"><?php echo $Sede_cliente ?></span></div>
			<div class="col col-xs-2 th">Responsable:</div>
			<div class="col col-xs-3 td"><span id="encargado"><?php echo $Encargado ?></span></div>		
		</div>
		<div class="row">	
			<div class="col col-xs-2 th">Descripción:</div>
			<div class="col col-xs-5 td"><span id="sede"><?php echo $Sede_cliente ?></span></div>
			<div class="col col-xs-2 th">Remisiones:</div>
			<div class="col col-xs-3 td"><span id="encargado"><?php echo $Encargado ?></span></div>		
		</div>
		<div class="row">	
			<div class="col col-xs-2 th">Muestreador:</div>
			<div class="col col-xs-5 td"><span id="sede"><?php echo $Sede_cliente ?></span></div>
			<div class="col col-xs-2 th">Fecha:</div>
			<div class="col col-xs-3 td"><span id="encargado"><?php echo $Encargado ?></span></div>		
		</div>
	</div>
	<?php include_once 'caracteristicas.php' ?>
	<?php include_once 'datosencampo.php' ?>

	<div class="box <?php echo $clase_box_resultados ?>">
		<div class="row resultados">
			<div class="col col-xs-12 centrado hd">RESULTADOS DE ENSAYOS </div>
		</div>
		<?php if ($Area == 'Microbiológico'){ ?>
		<div class="row head-i">
			<div class="col col-xs-5 th-i">Parámetro</div>
			<div class="col col-xs-2 th-i">Método </div>
			<div class="col col-xs-2 th-i">Norma de Referencia </div>
			<div class="col col-xs-2 th-i">Valor de Referencia </div>
			<div class="col col-xs-1 th-i">Resultado</div>
		</div>
		<?php } ?>
		<?php if ($Area == 'Fisicoquímico'){ ?>
		<div class="row head-i">
			<div class="col col-xs-4 th-i" style="width: 30%">Parámetro</div>
			<div class="col col-xs-2 th-i" style="width: 20.83333333%">Método </div>
			<div class="col col-xs-2 th-i" style="width: 16.66666667%">Norma de Referencia </div>
			<div class="col col-xs-1 th-i text-center" style="width: 15.0%">Valor de Referencia </div>
			<div class="col col-xs-1 th-i text-center" style="width: 14%">Resultado</div>
			
		</div>
		<?php } ?>
		<div class=<?php echo $clase_datos ?>>
		<?php 
			$ObRes 		  ='true';
			$StatusCumple = 'true'; 
			$Cumple 	  = 'true';
			$items 		  = count($NParametros);
			$i=0;
			$l=0;
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
				$ValorReferencia = SetReferencia($Comparador[$i-1], $Limites) ;
				$TipoP 			 = isset($Tipo[$i-1]) ? $Tipo[$i-1] : '';

				if ($TipoP!=5){
				$Resultado 		 = isset($Resultados[$j]) ? $Resultados[$j] : 'NR';
				$Resultado 		 = trim($Resultado, ' ');
				$Resultado  	 = ($Resultado!="") ? $Resultado : 'NR';
				$Resultado 	 	 = isset($Resultados[$j]) ? $Resultados[$j] : 'NR';	
				$j 				 = str_pad($j,2,"0",STR_PAD_LEFT ); 
				if ($Resultado==''){ $Resultado = 'NR';	}

				$j++;
				$ResComp = SetResComparador($ResComparador[$j-1]);
				if(isset($ResComparador[$j-1])){
					$ResComp = SetResComparador($ResComparador[$j-1]);
				}
				else{
					$ResComp = '';
				}
				$Clase_obs ='A';
				if ($ResComp   =='='){ $ResComp='';}
				if ($Resultado == 'NR'){
					$ResultadoComp='NR'; $Clase_obs='NR';
					$R_Cumple 		= '';
				}
				else { 
					$ResultadoComp = $ResComp.$Resultado; 
					$Cumplimiento  	= SetResultado($Comparador[$i-1], $Limites, $Resultado, $ResComparador[$j-1]);
					$R_Cumple 		= 'Cumple';
					if ($Cumplimiento=='false'){
						$R_Cumple = 'No cumple';
					}
				}	
				?>
			<?php if ($Area == 'Microbiológico'){ ?>
			<div class="row par">
				<div class="col col-xs-7 td-i col-tdi" style="width: 35%" ><?php echo $j.' - '.$Parametro ?></div>
				<div class="col col-xs-5 td-i col-tdi" style="width: 20.83333333%"><?php echo $Metodo[$i-1] ?></div>
				<div class="col col-xs-4 td-i col-tdi text-center" style="width: 16.66666667%" ><?php echo $Norma[$i-1] ?> </div>
				<div class="col col-xs-4 td-i col-tdi text-center" style="width: 16.66666667%"><?php echo $ValorReferencia ?> </div>
				<div class="col col-xs-3 td-i col-tdi text-center" style="width: 8%"><?php echo formato($ResultadoComp) ?> </div>
			</div>
			<?php } ?>
			<?php if ($Area == 'Fisicoquímico'){ ?>
			<div class="row par ">
				<div class="col col-xs-7 td-i col-tdi" style="width: 30%" ><?php echo $j.' - '.$Parametro ?></div>
				<div class="col col-xs-5 td-i col-tdi" style="width: 20.83333333%"><?php echo $Metodo[$i-1] ?></div>
				<div class="col col-xs-4 td-i col-tdi text-center" style="width: 16.66666667%" ><?php echo $Norma[$i-1] ?> </div>
				<div class="col col-xs-4 td-i col-tdi text-center" style="width: 15.0%"><?php echo $ValorReferencia ?> </div>
				<div class="col col-xs-3 td-i col-tdi text-center" style="width: 7%"><?php echo formato($ResultadoComp) ?> </div>
				<div class="col col-xs-3 td-i col-tdi text-left" style="width: 7%"><?php echo $R_Cumple ?> </div>
			</div>
			<?php } ?>

			<?php $StatusCumple = SetResultado($Comparador[$i-1],$Limites, $Resultado, $ResComparador[$j-1]); 

			if ($StatusCumple=='false'){
					$Cumple = 'false';
				}
			}//Tipo
		};
			if ($Area == 'Microbiológico'){
				$ObservacionesCompl = $Muestras->Observaciones($Clase_obs,$Cumple);
			}

			if ($Area == 'Fisicoquímico'){
				if ($Cumple =='false'){
					$Clase_obs = 'NC';
				}
				$ObservacionesCompl = $Muestras->Observaciones($Clase_obs,$Cumple);
				
			}
		?>
	
		</div>

		<div class="row" style="padding-top: 10px; padding-bottom: 10px">
			<div class="col col-xs-12" style="font-size: 0.9em">
				Fecha de ensayo:<span id="fecha-ensayo"><?php echo $Fecha_result ?></span>
			</div>
		</div>
	</div>
	<div class="row centrado" style="padding-bottom: 1px;">
		<div class="col col-xs-12 hd">OBSERVACIONES</div>
		<div class="col col xs-12"><span id="observaciones-result">***<?php echo $Muestras->Obs_cumplimiento ?>***</span></div>
	</div>

	<div class="row" style="padding-bottom: 0px;">
		<div class="col col-xs-12 text-center hd">FORMALIZACIÓN DEL REPORTE</div>
			
				<div class="col col-xs-12 notas">Nota aclaratoria: Los resultados sólo están relacionados con los ítems ensayados
				<br>Este documento no se debe reproducir, excepto en su totalidad, sin la aprobación escrita de la organización
				</div>
			
	</div>
	<div class="row" style="padding-bottom: 25px;">
		<div class="col col-xs-8"><strong>Autorización del Informe de Ensayos</strong> <span style="font-size: 0.75em"> [Fecha de impresión: <span id="fecha-impresion"><?php echo date('Y-m-d')  ?>]</span></span>	
		</div>
		<div class="col col-xs-4 text-right" style="font-size: 0.75em">
			Página 1 de 1
		</div>		
	</div>
	<div class="row" >
		<div class="col col-xs-15 firmas text-center hide ">Revisado por:</div>
		<div class="col col-xs-45 firmas text-center"><strong> <?php echo $FirmaR?></strong></div>
		<div class="col col-xs-15 firmas hide">Aprobado por:</div>
		<div class="col col-xs-45 firmas text-center"><strong> <?php echo $FirmaA?></strong></div>
	</div>
	<div class="row">
		<div class="col col-xs-15 firmas hide">&nbsp;</div>
		<div class="col col-xs-45 firmas text-center"><?php echo $CargoR?></div>
		<div class="col col-xs-15 firmas hide">&nbsp;</div>
		<div class="col col-xs-45 firmas text-center"><?php echo $CargoA?></div>
	</div>

</div>
<script>


