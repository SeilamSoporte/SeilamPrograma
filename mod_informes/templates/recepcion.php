
	<div class="box ">
		<div class="row">
			<div class="col col-xs-12 text-center hd">
				INFORMACIÓN DE RECEPCIÓN DE LA MUESTRA
			</div>
		</div>
		<div class="row">
			<div class="col col-xs-6">
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
					<td class="th">Clase de muestra:		   </td><td class="td"><?php echo $Clase ?></td>
				</tr>
				<tr>
					<td class="th">Fecha y hora de recolección:</td><td class="td"><?php echo  $Fecha_Hora_R ?></td>
				</tr>
				
			</table>
			</div>
			<div class="col col-xs-6">
			<table class="table-muestra">
					
				<tr>
					<td class="th-m">Fecha y hora de ingreso:	 </td><td class="td"><?php echo  $Fecha_Hora_I  ?></td>
				</tr>
				<tr>
					<td class="th-m">Temperatura de ingreso:     </td><td class="td"><?php echo $TemperaturaIngreso ?></td>
				</tr>
				<!--///////////////////////////////////////// CAMPOS VARIABLES   ////////////////////////////////////////////////////////-->
				<tr class="FQ-Aguas MB-Aguas MB-Alimentos " style="display: none" >
					<td class="th-m">Cantidad:</td>				<td class="td"><?php echo $Cantidad ?></td>
				</tr>
				
				<tr class="MB-Alimentos " >
					<td class="th-m">Fecha de producción:		 </td><td class="td"><?php echo  $Fecha_produccion ?></td>
				</tr>
				<tr class="MB-Alimentos " style="display: none">
					<td class="th-m">Fecha de vencimiento:	 	</td><td class="td"><?php echo  $Fecha_vencimiento ?></td>
				</tr>
				<tr class="MB-Alimentos Frotis Placas " style="display: none">
					<td class="th-m ">Lote:						</td><td class="td"><?php echo  $Lote ?></td>
				</tr>
				<tr class="Frotis Placas " style="display: none">
					<td class="th-m">Medio:						</td><td class="td"><?php echo  $Medio ?></td>
				</tr>
				<tr class="MB-Aguas FQ-Aguas " style="display: none">
					<td class="th-m">Estado del tiempo:		  	</td><td class="td"><?php echo $Estado ?></td>
				</tr>

				<!-- <tr class="FQ-Aguas" style="display: none">-->
				<tr class="FQ-Aguas">
					<td class="th">Lugar/Punto de muestreo:	 	</td><td class="td"><?php echo $LugarM ?></td>
				</tr>
			</table>
			</div>
			<div class="col col-xs-12 obs">
			<table class="table-muestra">
				<tr>
					<td><span class="th">Observaciones:</span><span class="td" id="observaciones"><?php echo strtolower($Observaciones) ?></span></td>
				</tr>
			</table>
			</div>
		</div><!-- row recepcion de muestra -->	

	</div>

	<script>
	    function buscarPal(texto, campo){
        var textoSelArr  = $('#titulo').html().toLowerCase().split(" ");
        var palabras     = texto.split(",");
        $.each(textoSelArr, function(i){
            $.each(palabras, function(j){    
                if(textoSelArr[i] == palabras[j]){   
                	$(campo).css('display', '')	;
                  }
                })  
            })  
    	}

    	$(function(){
    		buscarPal('agua,aguas', '.FQ-Aguas');
    		buscarPal('tratada,tratadas', '.MB-Aguas');
    		buscarPal('alimento,alimentos', '.MB-Alimentos');
    		buscarPal('superficie,frotis', '.Frotis');
    		buscarPal('placas,ambientes', '.Placas');
    		//buscarPal('placas,ambientes', '.Placas');
    	});
	</script>
