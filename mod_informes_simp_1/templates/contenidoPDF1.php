<?php 
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
<style>
.col-xs-12 {
  width: 100%;
}
.col-xs-11 {
  width: 91.66666667%;
}
.col-xs-10 {
  width: 83.33333333%;
}
.col-xs-9 {
  width: 37.5%;
}
.col-xs-8 {
  width: 33.33333333%;
}
.col-xs-7 {
  width: 29.16666667%;
}
.col-xs-6 {
  width: 25%;
}
.col-xs-5 {
  width: 20.83333333%;
}
.col-xs-4 {
  width: 16.66666667%;
}
.col-xs-3 {
  width: 12.5%;
}
.col-xs-2 {
  width: 8.33333333%;
}
.col-xs-1 {
  width: 4.66666667%;
}
</style>
<div class="container-report">
		<div class="encabezado">
			<div class="row">				
				<div class="col col-xs-12">
					<div class="row titulo-1 text-center"><span> INFORME DE ENSAYOS <?php echo $NroInforme ?></span></div>
					<div class="row titulo text-center hidden"><span id="titulo"> <?php echo $Titulo ?> </span></div>
				</div>
			</div>
		</div>
	<div class="box">
		<div class="row">
			<div class="col col-xs-12 centrado hd">
				DATOS GENERALES DEL CLIENTE
			</div>
		</div>
		<div class="row">
			<div class="col col-xs-2 th">Cliente/Empresa:</div>
			<div class="col col-xs-9 td"><?php echo $Cliente ?></div>
		</div>
		<div class="row">
			<div class="col col-xs-2 th">Dirección:</div>
			<div class="col col-xs-5 td"><span id="direccion"><?php echo $Direccion_cliente ?></span> </div>
			<div class="col col-xs-1 th">Teléfono:</div>
			<div class="col col-xs-3 td"><span id="telefono"><?php echo $Telefono_cliente ?></span></div>
		</div>
		<div class="row">	
			<div class="col col-xs-2 th">Sede:</div>
			<div class="col col-xs-5 td"><span id="sede"><?php echo $Sede_cliente ?></span></div>
			<div class="col col-xs-1 th">Encargado:</div>
			<div class="col col-xs-4 td"><span id="encargado" style="font-size:0.9em"><?php echo $Encargado ?></span></div>		
		</div>
	</div>
	
	<div class="box ">
		<div class="row">
			<div class="col col-xs-12 text-center hd">
				INFORMACIÓN DE RECEPCIÓN DE LA MUESTRA
			</div>
		</div>
		<div class="row">
			<div class="col col-xs-7">
		
				<div class="row"> 
					<div class="col col-xs-5 th">Recolectado por:				</div><div class="col col-xs-7 td"><?php echo  $Recolectado  ?></div>
				</div>			
				<div class="row"> 
					<div class="col col-xs-5 th">Código de Muestra:		 		</div><div class="col col-xs-7 td"><?php echo  $NroInforme ?></div>
				</div>
				<div class="row"> 
					<div class="col col-xs-5 th">Descripción de la muestra:		</div><div class="col col-xs-7 td"><?php echo  $Descripcion ?></div>
				</div>
				<div class="row"> 
					<div class="col col-xs-5 th">Tipo de empaque:			 	</div><div class="col col-xs-7 td"><?php echo  $Empaque ?></div>
				</div>
				<div class="row"> 
					<div class="col col-xs-5 th">Clase de muestra:		   		</div><div class="col col-xs-7 td"><?php echo $Clase ?></div>
				</div>
				<div class="row"> 
					<div class="col col-xs-5 th">Fecha y hora de recolección:	</div><div class="col col-xs-5 td"><?php echo  $Fecha_Hora_R ?></div>
				</div>
				
		
			</div>
			<div class="col col-xs-5">
				<div class="row"> 
					<div class="col col-xs-6 th-m">Fecha y hora de ingreso:		</div><div class="col col-xs-6 td"><?php echo  $Fecha_Hora_I  ?></div>
				</div>
				<div class="row"> 
					<div class="col col-xs-6 th-m">Temperatura de ingreso: 		</div><div class="col col-xs-6 td"><?php echo  $TemperaturaIngreso  ?></div>
				</div>
				<div class="row hide  <?php echo $FQA ?> <?php echo $MBA ?> <?php echo $ALMB ?>"> 
					<div class="col col-xs-6 th-m">Cantidad:					</div><div class="col col-xs-6 td"><?php echo  $Cantidad  ?></div>
				</div>
				<div class="row hide <?php echo $ALMB ?>"> 
					<div class="col col-xs-6 th-m ">Fecha de producción:		</div><div class="col col-xs-6 td"><?php echo  $Fecha_produccion  ?></div>
				</div>
				<div class="row  hide <?php echo $ALMB ?>"> 
					<div class="col col-xs-6 th-m">Fecha de vencimiento:		</div><div class="col col-xs-6 td"><?php echo  $Fecha_vencimiento  ?></div>
				</div>
				<div class="row hide <?php echo $ALMB ?> <?php echo $FR ?> <?php echo $PL ?>"> 
					<div class="col col-xs-6 th-m">Lote:						</div><div class="col col-xs-6 td"><?php echo  $Lote  ?></div>
				</div>
				<div class="row hide <?php echo $FR ?> <?php echo $PL ?>"> 
					<div class="col col-xs-6 th-m">Medio:						</div><div class="col col-xs-6 td"><?php echo  $Medio  ?></div>
				</div>
				<div class="row hide <?php echo $FQA ?> <?php echo $MBA ?>"> 
					<div class="col col-xs-6 th-m">Estado del tiempo:		    </div><div class="col col-xs-6 td"><?php echo  $Estado  ?></div>
				</div>
				<div class="row hide <?php echo $FQA ?>"> 
					<div class="col col-xs-6 th-m">Lugar/Punto de muestreo:		</div><div class="col col-xs-6 td"><?php echo  $LugarM  ?></div>
				</div>				
			</div>
			
			<div class="col col-xs-12 obs">
			<table class="table-muestra">
				<tr>
					<td><span class="th">Observaciones:</span><span class="td" id="observaciones"><?php echo $Observaciones ?></span></td>
				</tr>
			</table>
			</div>
		</div><!-- row recepcion de muestra -->	

	</div>

	<?php include_once 'caracteristicas.php' ?>
	<?php include_once 'datosencampo.php' ?>

	<div class="box <?php echo $clase_box_resultados ?>">
		<div class="row resultados">
			<div class="col col-xs-12 centrado hd">RESULTADOS DE ENSAYOS </div>
		</div>
		<div class="row head-i">
			<div class="col col-xs-7 th-i" style="width: 35%">Parámetro</div>
			<div class="col col-xs-5 th-i" style="width: 20.83333333%">Método </div>
			<div class="col col-xs-4 th-i" style="width: 16.66666667%">Norma de Referencia </div>
			<div class="col col-xs-4 th-i" style="width: 16.66666667%">Valor de Referencia </div>
			<div class="col col-xs-3 th-i" style="width: 8%">Resultado</div>
		</div>
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
				if ($Resultado == 'NR'){$ResultadoComp='NR'; $Clase_obs='NR';}
				else { $ResultadoComp = $ResComp.$Resultado; }
				?>


			<div class="row par">
				<!-- <div class="col col-xs-1"><?php  ?></div> -->
				<div class="col col-xs-7 td-i col-tdi" style="width: 35%" ><?php echo $j.' - '.$Parametro ?></div>
				<div class="col col-xs-5 td-i col-tdi" style="width: 20.83333333%"><?php echo $Metodo[$i-1] ?></div>
				<div class="col col-xs-4 td-i col-tdi text-center" style="width: 16.66666667%" ><?php echo $Norma[$i-1] ?> </div>
				<div class="col col-xs-4 td-i col-tdi text-center" style="width: 16.66666667%"><?php echo $ValorReferencia ?> </div>
				<div class="col col-xs-3 td-i col-tdi text-center" style="width: 8%"><?php echo $ResultadoComp ?> </div>
			</div>

			<?php $StatusCumple = SetResultado($Comparador[$i-1],$Limites, $Resultado, $ResComparador[$j-1]); 

			if ($StatusCumple=='false'){
					$Cumple = 'false';
				}
			}//Tipo
		};
		echo $ObservacionesCompl = $Muestras->Observaciones($Clase_obs,$Cumple); 
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
		<div class="col col-xs-8">
			<strong>Autorización del Informe de Ensayos</strong> 
			<span style="font-size: 0.75em"> [Fecha de impresión: <span id="fecha-impresion"><?php echo date('Y-m-d')  ?>]</span>
			</span>	
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


