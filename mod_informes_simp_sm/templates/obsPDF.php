<?php 
	
	if ($conIncertidumbreMB==true || $conIncertidumbreSP==true || $conIncertidumbreFQ==true ) {
		$conIncertidumbre = true;		
	}
	else{
		$conIncertidumbre=false;
	}

/*	   $Detalles  			= $Muestras ->loadDetalles($id,$nd) ;	
$Observaciones 		= isset($Detalles[0]) ? $Detalles[0]['Observaciones']:''; 
	if ($Observaciones==''){
		$Observaciones  ='Para mejor comprensión de los resultados comuníquese con su asesor.';
	}
*/
//	$Observaciones  ='Para mejor comprensión de los resultados comuníquese con su asesor.';
?>

<!-- <div class="row">
	<div class="col col-xs-12 centrado hd">OBSERVACIONES</div>
	<div class="col col-xs-12 centrado">***<span><?php echo $Observaciones ?> ***</span></div>
</div> -->
		<div class="col col-xs-12 centrado hd">OBSERVACIONES</div>
		<div class="col col-xs-12 centrado" style="line-height:90%; font-weight: bold; font-size: 11px">
			***Para mejor comprensión de los resultados comuníquese con su asesor***
		</span></div>	
		
		<div class="col col xs-12"  style="line-height:90%;">
			<span class="notas">
				<?php 
				if($conIncertidumbre==true){ 
					echo 'Se declara una incertidumbre expandida U con un factor de cobertura k=2, para un intervalo de confianza aproximado del 95 %.';
				}
				else { 
					echo 'La incertidumbre del (los) ensayo (s) están a disposición cuando sea requerido por el cliente según procedimiento interno para su estimación.';
				}	
				?>		

			</span>
			<span class="notas">
				<br>SM: Standar Methods | Ed: Edición | NA: No aplica | NR: No registrado | Se utiliza la coma (,) como separado decimal | <?php echo $Log; ?>
				<br>Los parámetros con asterisco se encuentran acreditados
				<br>En SEILAM S.A.S., contamos con acreditación ONAC, vigente a la fecha, con código de acreditación 18-LAB-012, bajo la norma ISO/IEC 17025:2005
			</span>	


<!--			<span class="notas">
				<?php 
				if($conIncertidumbre==true){ 
					echo 'Se declara una incertidumbre expandida U con un factor de cobertura k=2, para un intervalo de confianza aproximado del 95 %. <br>';
				}
				else { 
					echo 'La incertidumbre del (los) ensayo (s) están a disposición cuando sea requerido por el cliente según procedimiento interno para la estimación de incertidumbre.';
				}	
				?>		

			</span>
			<span class="notas">
				SM: Standar Methods | Ed: Edición | NA: No aplica | Se utiliza la coma (,) como separado decimal | Parámetros sin asterisco NO se encuentran acreditados
			</span>	-->
		</div>
