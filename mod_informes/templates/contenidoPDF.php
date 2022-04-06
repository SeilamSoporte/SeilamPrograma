<?php
function formato($valor)
{
    //return $valor;

    //return $valor;
    $str   = strval($valor); 		// Se convierte a string
    $split = explode('.', $str);
    $dec   = count($split);  	    //Indagammos si posee decimales
    $comp  = substr($str, 0, 1);
    return (str_replace('.', ',', $str));
}

    if (buscarPal('alimento,alimentos', $Titulo)=='true') {
        $clase_datos 		  = 'datos-mb';
        $clase_box_resultados =	 'box-resultados-mb';
    } else {
        $clase_datos 		  = 'datos';
        $clase_box_resultados =	'box-resultados';
    }
    $FQA 	= (buscarPal('agua,aguas', $Titulo)) =='true' ? 'show' : '';
    $MBA	= (buscarPal('tratada,tratadas', $Titulo)) =='true' ? 'show' : '';
    $ALMB 	= (buscarPal('alimento,alimentos', $Titulo)) =='true' ? 'show' : '';
    $FR		= (buscarPal('superficie,frotis', $Titulo)) =='true' ? 'show' : '';
    $PL 	= (buscarPal('placas,ambientes', $Titulo)) =='true' ? 'show' : '';
    $LugarM   = ($LugarM =='') ? 'No reporta':$LugarM;
    $FirmaRi= "src='../mod_usuarios/imgs/".$ImgFirmaR."'";
    $FirmaAi= "src='../mod_usuarios/imgs/".$ImgFirmaA."'";
    //$conIncertidumbre=true;
?>

<div class="container-report">
	<div class="encabezado">
		<div class="row">
			<div class="col col-xs-12">
				<div class="row titulo-1 text-center"><span> INFORME DE ENSAYOS <?php echo '('.$Area.')-'.  $NroInforme ?></span>
				</div>
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
			<div class="col col-xs-9 td"><?php echo $Cliente ?>
			</div>
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
			<div class="col col-xs-3 td"><span id="encargado"><?php echo $Encargado ?></span></div>
		</div>
	</div>

	<div class="box ">
		<div class="row">
			<div class="col col-xs-12 text-center hd" style="line-height:90%">
				INFORMACIÓN DE RECEPCIÓN DE LA MUESTRA
			</div>
		</div>
		<div class="row" style="line-height:95%; font-size:8pt">
			<div class="col col-xs-6">
				<div class="row">
					<div class="col col-xs-5 th">Recolectado por: </div>
					<div class="col col-xs-7 td"><?php echo  $Recolectado  ?>
					</div>
				</div>
				<div class="row">
					<div class="col col-xs-5 th">Código de Muestra: </div>
					<div class="col col-xs-7 td"><?php echo  $NroInforme ?>
					</div>
				</div>
				<div class="row">
					<div class="col col-xs-5 th">Descripción: </div>
					<div class="col col-xs-7 td"><?php echo  $Descripcion ?>
					</div>
				</div>
				<div class="row">
					<div class="col col-xs-5 th">Tipo de empaque: </div>
					<div class="col col-xs-7 td"><?php echo  $Empaque ?>
					</div>
				</div>
				<div class="row">
					<div class="col col-xs-5 th">Clase de muestra: </div>
					<div class="col col-xs-7 td"><?php echo $Clase ?>
					</div>
				</div>
				<div class="row">
					<div class="col col-xs-5 th">Fecha y hora de recolección: </div>
					<div class="col col-xs-4 td"><?php echo  $Fecha_Hora_R ?>
					</div>
				</div>

			</div>
			<div class="col col-xs-6" style="line-height:95%; font-size:8pt">
				<div class="row">
					<div class="col col-xs-5 th-m">Fecha y hora de ingreso: </div>
					<div class="col col-xs-6 td"><?php echo  $Fecha_Hora_I  ?>
					</div>
				</div>
				<div class="row">
					<div class="col col-xs-5 th-m">Temperatura de ingreso: </div>
					<div class="col col-xs-6 td"><?php echo  formato($TemperaturaIngreso)  ?>
					</div>
				</div>
				<div
					class="row hide  <?php echo $FQA ?> <?php echo $MBA ?> <?php echo $ALMB ?>">
					<div class="col col-xs-5 th-m">Cantidad: </div>
					<div class="col col-xs-6 td"><?php echo  $Cantidad  ?>
					</div>
				</div>
				<div class="row hide <?php echo $ALMB ?>">
					<div class="col col-xs-5 th-m ">Fecha de producción: </div>
					<div class="col col-xs-6 td"><?php echo  $Fecha_produccion  ?>
					</div>
				</div>
				<div class="row  hide <?php echo $ALMB ?>">
					<div class="col col-xs-5 th-m">Fecha de vencimiento: </div>
					<div class="col col-xs-6 td"><?php echo  $Fecha_vencimiento  ?>
					</div>
				</div>
				<div
					class="row hide <?php echo $ALMB ?> <?php echo $FR ?> <?php echo $PL ?>">
					<div class="col col-xs-5 th-m">Lote: </div>
					<div class="col col-xs-6 td"><?php echo  $Lote  ?>
					</div>
				</div>
				<div
					class="row hide <?php echo $FR ?> <?php echo $PL ?>">
					<div class="col col-xs-5 th-m">Medio: </div>
					<div class="col col-xs-6 td"><?php echo  $Medio  ?>
					</div>
				</div>
				<div
					class="row hide <?php echo $FQA ?> <?php echo $MBA ?>">
					<div class="col col-xs-5 th-m">Estado del tiempo: </div>
					<div class="col col-xs-6 td"><?php echo  $Estado  ?>
					</div>
				</div>
				<div class="row <?php echo $FQA ?>">
					<div class="col col-xs-5 th-m">Lugar/Punto de muestreo: </div>
					<div class="col col-xs-6 td"><?php echo  $LugarM  ?>
					</div>
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

	<!-- <?php include_once 'caracteristicas.php' ?>
	-->
	<?php include_once 'datosencampo.php' ?>

	<div class="box <?php echo $clase_box_resultados ?>">
		<div class="row resultados" style="line-height:80%">
			<div class="col col-xs-12 centrado hd pt-2">RESULTADOS DE ENSAYOS </div>
		</div>

		<?php if ($Area == 'Microbiológico') { ?>
		<div class="row head-i">
			<div class="col col-xs-4 th-i ">Parámetro (unidades)</div>
			<div class="col col-xs-2 th-i ">Método de referencia </div>
			<div class="col col-xs-2 th-i ">Norma de Referencia </div>
			<div class="col col-xs-1 th-i ">Valor de Referencia </div>
			<div class="col col-xs-1 th-i ">Resultado</div>
			<?php
                if ($conIncertidumbre==true) {
                    ?>
			<div class="col col-xs-15 th-i text-center">Incertidumbre &plusmn; (<i>U</i> Log<sub>10</sub>)</div>

			<?php
                } ?>
		</div>
		<?php } ?>
		<?php if ($Area == 'Fisicoquímico') { ?>
		<div class="row head-i row-head">
			<div class="col col-xs-3  th-i ">Parámetro</div>
			<div class="col col-xs-25 th-i ">Método </div>
			<div class="col col-xs-2  th-i ">Norma de Referencia </div>
			<div class="col col-xs-15 th-i  text-center">Valor de Referencia </div>
			<div class="col col-xs-1  th-i  text-center">Resultado</div>
			<?php
                if ($conIncertidumbre==true) {
                    ?>
			<div class="col col-xs-15 th-i text-center">Incertidumbre &plusmn; (<i>U</i>)</div>
			<?php
                } ?>
		</div>
		<?php } ?>
		<div class="<?php echo $clase_datos ?>">
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
                if ($Comparador[$i-1]==10) {
                    $Limites = $Limite[$l+1].'|'.$Limite[$l+2];
                } else {
                    $Limites=$Limite[$l];
                }
                $l=$i*3;
                $ValorReferencia = SetReferencia($Comparador[$i-1], $Limites) ;
                $TipoP 			 = isset($Tipo[$i-1]) ? $Tipo[$i-1] : '';

                if ($TipoP!=5) {
                    $Resultado 		 = isset($Resultados[$j]) ? $Resultados[$j] : 'NR';
                    $Resultado 		 = trim($Resultado, ' ');
                    $Resultado  	 = ($Resultado!="") ? $Resultado : 'NR';
                    $Resultado 	 	 = isset($Resultados[$j]) ? $Resultados[$j] : 'NR';

                    $Incertidumbre = isset($Incertidumbres[$j]) ? $Incertidumbres[$j] : 'NR';
                    $Incertidumbre = trim($Incertidumbre, ' ');
                    //$Incertidumbre = ($Incertidumbre!="") ? $Incertidumbre : 'NR';

                    $j 				 = str_pad($j, 2, "0", STR_PAD_LEFT);
                    if ($Resultado=='') {
                        $Resultado = 'NR';
                    }
                
                    if ($Incertidumbre=='') {
                        $Incertidumbre = 'NR';
                    } else {
                        $Incertidumbre = formato($Incertidumbre, 2, ',', ' ');
                    }


                    $j++;
                    $ResComp = SetResComparador($ResComparador[$j-1]);
                    if (isset($ResComparador[$j-1])) {
                        $ResComp = SetResComparador($ResComparador[$j-1]);
                    } else {
                        $ResComp = '';
                    }
                    $Clase_obs ='A';
                    if ($ResComp   =='=') {
                        $ResComp='';
                    }
                    if ($Resultado == 'NR') {
                        $ResultadoComp='NR';
                        $Clase_obs='NR';
                        $R_Cumple 		= '';
                    } else {
                        $ResultadoComp = $ResComp.$Resultado;
                        $Cumplimiento  	= SetResultado($Comparador[$i-1], $Limites, $Resultado, $ResComparador[$j-1]);
                        $R_Cumple 		= 'Cumple';
                        if ($Cumplimiento=='false') {
                            $R_Cumple = 'No cumple';
                        }
                    } ?>
			<?php if ($Area == 'Microbiológico') { ?>
			<div class="row par bbl">
				<div class="col col-xs-4 td-i col-td-i ">
					<?php echo $Parametro ?>
				</div>
				<div class="col col-xs-2 col-td-i td-i">
					<?php echo $Metodo[$i-1] ?>
				</div>
				<div class="col col-xs-2 col-td-i td-i">
					<?php echo $Norma[$i-1] ?>
				</div>
				<div class="col col-xs-1 col-td-i td-i">
					<?php echo formato($ValorReferencia)  ?>
				</div>
				<div class="col col-xs-1 td-i col-td-i">
					<?php
                        echo formato($ResultadoComp);
                    ?>

				</div>
				<?php
                if ($conIncertidumbre==true) {
                    ?>
				<div class="col col-xs-15 td-i col-td-i text-center">
					<?php echo $Incertidumbre ?>
				</div>
				<?php
                } ?>
			</div>

			<?php } ?>
			<?php if ($Area == 'Fisicoquímico') { ?>
			<div class="row par bbl" style="font-size:0.8em; line-height: 0.8em; ">
				<div class="col col-xs-3 td-i col-tdi " style="padding-left:20px "> <?php echo $Parametro ?>
				</div>
				<div class="col col-xs-25 td-i col-tdi "> <?php echo $Metodo[$i-1] ?>
				</div>
				<div class="col col-xs-2 td-i col-tdi text-center"><?php echo $Norma[$i-1] ?>
				</div>
				<div class="col col-xs-15 td-i col-tdi "><?php echo formato($ValorReferencia) ?>
				</div>

				<?php
                    if ($Parametro== "IRAPI (%)") {
                        ?>
				<div class="col col-xs-1 td-i col-tdi text-center"><?php echo formato($ResultadoComp)  ?>
				</div>
				<?php
                    } else { ?>
				<div class="col col-xs-1 td-i col-tdi text-center"><?php echo formato($ResultadoComp) ?>
				</div>
				<!-- <div class="col col-xs-1 td-i col-tdi text-left"><?php echo $R_Cumple ?>
			</div> -->
			<?php } ?>

			<?php
                if ($conIncertidumbre==true) {
                    ?>
			<div class="col col-xs-15 td-i col-td-i text-center">
				<?php echo $Incertidumbre ?>
			</div>
			<?php
                } ?>

		</div>
		<?php } ?>

		<?php $StatusCumple = SetResultado($Comparador[$i-1], $Limites, $Resultado, $ResComparador[$j-1]);
                    if ($StatusCumple=='false') {
                        $Cumple = 'false';
                    }
                }//Tipo
            };
            if ($Area == 'Microbiológico') {
                $ObservacionesCompl = $Muestras->Observaciones($Clase_obs, $Cumple);
                $Log ='';
                //$Log = 'Log<sub>10</sub> = Logaritmo en base 10';
            }

            if ($Area == 'Fisicoquímico') {
                if ($Cumple =='false') {
                    $Clase_obs = 'NC';
                }
                $ObservacionesCompl = $Muestras->Observaciones($Clase_obs, $Cumple);
            }
        ?>
	</div>

	<div class="row" style="padding-top: 10px; padding-bottom: 1px">
		<div class="col col-xs-12" style="font-size: 0.9em;">
			Fecha de ensayo:<span id="fecha-ensayo"><?php echo $Fecha_result ?></span>
		</div>
	</div>
</div>

<div class="row centrado linea" style="padding-bottom: 1px; line-height:90%;">

	<div class="col col-xs-12 hd">OBSERVACIONES</div>
	<span id="observaciones-result">***<?php echo 'Para mejor comprensión de los resultados y mejoramiento de los mismos comuníquese con nuestros asesores' ?>***</span>
	<div class="col col xs-12" style="line-height:90%;">
		<span class="notas">
			<?php
                if ($conIncertidumbre==true) {
                    echo 'Se declara una incertidumbre expandida U con un factor de cobertura k=2, para un intervalo de confianza aproximado del 95 %.';
                } else {
                    echo 'La incertidumbre del (los) ensayo (s) están a disposición cuando sea requerido por el cliente según procedimiento interno para su estimación.';
                }
                ?>

		</span>
		<span class="notas">
			<br>SM: Standar Methods | Ed: Edición | NA: No aplica | NR: No registrado | Se utiliza la coma (,) como
			separado decimal | <?php echo $Log; ?>
			<!--<br>Los parámetros con asterisco se encuentran acreditados
			<br>En SEILAM S.A.S., contamos con acreditación ONAC, vigente a la fecha, con código de acreditación
			18-LAB-012, bajo la norma ISO/IEC 17025:2005-->
		</span>
	</div>
</div>

<div class="row" style="padding-bottom: 0px;">
	<!-- <div class="col col-xs-12 text-center hd linea">FORMALIZACI�N DEL REPORTE</div>-->

	<div class="col col-xs-12 notas"><strong>Nota aclaratoria:</strong> Los resultados sólo están relacionados con los
		ítems ensayados. Este documento no se puede reproducir sin la aprobación escrita de SEILAM S.A.S.
	</div>
</div>
<div class="row" style="padding-bottom: 25px;">
	<div class="col col-xs-8">
		<!--<strong>Autorizaci�n del Informe de Ensayos</strong> -->
		<span style="font-size: 0.75em">
			[Fecha de impresión: <span id="fecha-impresion"><?php echo date('Y-m-d')  ?>]</span></span>
	</div>
	<div class="col col-xs-4 text-right" style="font-size: 0.75em">
		Página 1 de 1
	</div>
</div>

<table name='footer' width="100%" cellspacing='0'
	style='border-collapse:collapse; border-spacing: 0px; padding: 0px; margin:0px; line-height:1' ;>
	<tr>
		<td width="50%">
			<img style='height:45px; line-height:1' <?php echo $FirmaRi ?> >
		</td>
		<td> </td>
		<!-- <td align="center"><img style='height:45px; line-height:1' <?php echo $FirmaAi ?>
		> </td> -->
	</tr>

	<tr>
		<td style='font-size: 11px; line-height:1' +><strong><?php echo $FirmaR ?></strong> </td>
		<!-- <td style='font-size: 11px; line-height:1' align="center"><strong><?php echo $FirmaA ?></strong>
		</td> -->
		<td> </td>
	</tr>
	<tr>
		<td style='font-size: 9px; line-height:1'><?php echo $CargoR ?>
		</td>
		<td> </td>
		<!-- <td style='font-size: 9px; line-height:1' align="center"><?php echo $CargoA ?>
		</td>-->
	</tr>
	<tr>
		<td colspan="2" style='font-size: 9px; line-height:1' align="center">----[ FINAL DEL INFORME DE ENSAYOS
			<?php echo $NroInforme ?> ]-----
		</td>

	</tr>
</table>

</div>
<script>