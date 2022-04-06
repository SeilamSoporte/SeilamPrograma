

<div class="container-report">
	<?php 
		$src_logo = "../../mod_empresa/imgs/".$Logo; 
	?>
	<div class="encabezado">
		<div class="row">	
			<div class="col col-xs-3"><img src="<?php echo $src_logo ?>" alt="" id="logo"> </div> 
			<div class="col col-xs-6 centrado titulo " style="padding-right:35px" >
				<span> INFORME DE RESULTADOS</span>	<span id="titulo"> <?php echo $Titulo ?> </span>
			</div>
			<div class="col col-xs-3">
				<div >
					<div class="col col-xs-7"><span>Nro. de informe:</span> </div>
					<div class="col col-xs-5 borde" id="consecutivo"> <?php echo $NroInforme ?></div>
					<div class="row divisor" style="border:0px solid #FFF"></div>
					<div class="col col-xs-7"><span class="c-v"> Fecha de informe:</span></div>
					<div class="col col-xs-5 " id="fecha-informe"> xxxx-xx-xx </div>
					
				</div>
		    </div>
		</div>
	</div>

	<div class="row">
		<div class="col col-md-12 centrado">
			<span id="subtitulo"> PROCESO DE PRESTACIÓN DEL SERVICIO  </span>
		</div>
	</div>
	
	<div class="box">
		<div class="row">
			<div class="col col-xs-12 centrado hd">
				DATOS GENERALES DEL CLIENTE
			</div>
		</div>
		<div class="row">
			<div class="col col-xs-2">CLIENTE/EMPRESA:</div>
			<div class="col col-xs-10"><?php echo $Cliente ?></div>
		</div>
		<div class="row">
			<div class="col col-xs-2">DIRECIÓN:</div>
			<div class="col col-xs-5"><span id="direccion"><?php echo $Direccion_cliente ?></span> </div>
			<div class="col col-xs-2">TELÉFONO:</div>
			<div class="col col-xs-3"><span id="telefono"><?php echo $Telefono_cliente ?></span></div>
		</div>
		<div class="row">	
			<div class="col col-xs-2">SEDE:</div>
			<div class="col col-xs-5"><span id="sede"><?php echo $Sede_cliente ?></span></div>
			<div class="col col-xs-2">ENCARGADO:</div>
			<div class="col col-xs-3"><span id="encargado"><?php echo $Encargado ?></span></div>		
		</div>
	</div>
	<div class="box ">
		<div class="row">
			<div class="col col-xs-12 centrado hd">
				INFORMACIÓN DE RECEPCIÓN DE LA MUESTRA
			</div>
		</div>
		<div class="row">
			<div class="col col-xs-6 data-muestra">
			<table class="table-muestra">
				<tr>
					<td class="th">Recolectado por:			 </td><td class="td"><?php echo $Recolectado ?></td>
				</tr>
				<tr>
					<td class="th">Código de Muestra:		 </td><td class="td"><?php echo  $NroInforme ?></td>
				</tr>
				<tr>
					<td class="th">Descripción de la muestra:</td><td class="td"><?php echo  $Descripcion ?></td>
				</tr>
				<tr>
					<td class="th">Tipo de empaque:			 </td><td class="td"><?php echo  $Empaque ?></td>
				</tr>
				<tr>
					<td class="th">Datos en campo:			 </td><td class="td"><?php echo  $Datos_campo ?></td>
				</tr>
				<tr>
					<td class="th">Fecha y hora de ingreso:	 </td><td class="td"><?php echo  $Fecha_Hora_I  ?></td>
				</tr>
			</table>
			</div>
			<div class="col col-xs-6">
			<table class="table-muestra">
				<tr>
					<td class="th">Fecha y hora de recolección:</td><td class="td"><?php echo  $Fecha_Hora_R ?></td>
				</tr>
				<tr>
					<td class="th">Temperatura de ingreso:     </td><td class="td"><?php echo $TemperaturaIngreso ?></td>
				</tr>
				<tr>
					<td class="th">Clase de muestra:		   </td><td class="td"><?php echo $Clase ?></td>
				</tr>
				<tr>
					<td class="th">Cantidad:	  			  </td><td class="td"><?php echo $Cantidad ?></td>
				</tr>
				<tr>
					<td class="th">Estado del tiempo:		  </td><td class="td"><?php echo $Estado ?></td>
				</tr>
				<tr>
					<td class="th">Lugar/Punto de muestreo:	 </td><td class="td"><?php echo $LugarM ?></td>
				</tr>
			</table>
			</div>
			<div class="col col-xs-12 obs">
			<table class="table-muestra">
				<tr>
					<td><span class="th">Observaciones:</span><span class="td" id="observaciones"><?php echo ' '.$Observaciones ?></span></td>
				</tr>
			</table>
			</div>
		</div><!-- row recepcion de muestra -->
	</div>
	<div class="box box-reultados">
		<div class="row resultados">
			<div class="col col-xs-12 centrado hd">RESULTADOS DE ENSAYOS </div>
		</div>
		<div class="row head-i">
			<div class="col col-xs-4 th-i">Parámetro (unidades) ITEMS de ensayos	</div>
			<div class="col col-xs-1 th-i">Método </div>
			<div class="col col-xs-2 th-i">Norma de Referencia </div>
			<div class="col col-xs-2 th-i">Valor de Referencia </div>
			<div class="col col-xs-1 th-i">Resultado</div>
			<div class="col col-xs-2 th-i">Cumplimiento </div>
		</div>

		<div class="datos">
		<?php 
			$items = count($NParametros);
			$i=0;
			foreach ($NParametros as $Parametro => $value) {
				$Parametro 	 = $Muestras ->getParametros($value);
			$i++;
			$i = str_pad($i,2,"0",STR_PAD_LEFT ); 
			$ValorReferencia = SetReferencia($Comparador[$i-1], $Limite[$i-1]);
			$Cumplimiento  	 = SetResultado($Comparador[$i-1], $Limite[$i-1], $Resultados[$i-1]);
			$Resultado 		 = $Resultados[$i-1];

			//for($i=1; $i<=$items; $i++){ ?>
			<div class="row">
				<!-- <div class="col col-xs-1"><?php  ?></div> -->
				<div class="col col-xs-4 td-i"><?php echo $i.' - '.$Parametro ?></div>
				<div class="col col-xs-1 td-i"><?php echo $Metodo[$i-1] ?></div>
				<div class="col col-xs-2 td-i"><?php echo $Norma[$i-1] ?> </div>
				<div class="col col-xs-2 td-i"><?php echo $ValorReferencia ?> </div>
				<div class="col col-xs-1 td-i"><?php echo $Resultado ?> </div>
				<div class="col col-xs-2 td-i"><?php echo $Cumplimiento ?> </div>
			</div>
		<?php
			};
		?>
	
		</div>
		<!--
		<div class="row">
			<div class="col col-xs-2">Norma referencia:</div>
			<div class="col col-xs-3"><span id="norma-referencia">xxx</span></div>
		</div>
		-->
		<div class="row" style="padding-top: 10px; padding-bottom: 10px">
			<div class="col col-xs-12">
				Fecha de ensayo:<span id="fecha-ensayo"></span>
			</div>
		</div>
	</div>
	<div class="row centrado" style="padding-bottom: 10px;">
		<div class="col col-xs-12 hd">OBSERVACIONES</div>
		<div class="col col xs-12"><span id="observaciones-result">xxx</span></div>
	</div>

	<div class="row" style="padding-bottom: 10px;">
		<div class="col col-xs-12 centrado hd">FORMALIZACIÓN DEL REPORTE</div>
		<div class="col col xs-12">
			<div class="col col-xs-12">Nota aclaratoria: Los resultados sólo están relacionados con los ítems ensayados
			<br>
			«Este documento no se debe reproducir, excepto en su totalidad, sin la aprobación escrita de la organización»
			</div>
		</div>
	</div>
	<div class="row" style="padding-bottom: 50px;"><div class="col col-xs-12"><strong>Autorización del Informe de Ensayos</strong></div></div>
	<div class="row" >
		<div class="col col-xs-6">Revisado por: <div id="revisado"></div></div>
		<div class="col col-xs-6">Aprobado por: <div id="revisado"></div></div>
	</div>
	<div class="row">
		<div class="col col-xs-6">Cargo: <div id="revisado"></div></div>
		<div class="col col-xs-6">Cargo: <div id="revisado"></div></div>
	</div>
	<div class="row" style="padding-top: 30px; padding-bottom: 5px">
		<div class="col col-xs-12 centrado foot1">
			Fecha de impresión: <span id="fecha-impresion"></span> /  [Página 1 de 1]
		</div>
	</div>
	<div class="row">
		<div class="col col-xs-12 centrado footer_page">
			<?php echo $Nombre_empresa .' / '. $Direccion_empresa .' / '. $Telefono_empresa .' / '. $Correo_empresa?>
		</div>
	</div>
</div>
