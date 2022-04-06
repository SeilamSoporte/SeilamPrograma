	
<?php

	include_once("../resources/fn_limites.php") ; 
	include_once ("../clases/clasesResultadosFQ.php");

	$D_Muestra 	 =  new Muestras();
	$Det_Muestras=  new Muestras();
	$D_Muestra 	->  Muestra($id);	
	$D_params  	 =  new Muestras();
	$Empaques  	 =  new Muestras();

	$Clientes  	 = new Clientes(); 
	$Cliente 	 = Clientes::getCliente($D_Muestra->Cliente);
	$CN 		 = Muestras::CNMuestras($id);
	$Datos 	     = Muestras::MuestraPrametro($id);
	$CNro 		 = count($Datos);
	$Nro 		 = ($CNro>0) ? $Datos[0]['CN'] : 0;
	
	$LastMuestra = Muestras::LastMuestra($id)+1;
	$i=0;
?>

		<div class="panel panel-primary">
			<div class="panel-heading">
				<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
				<h4 class="modal-title">Resultados de las muestras Fisicoquímicas</h4> 
			</div>	  
			
			<div class="panel-body">
				<!-- <form action="" id="FormMuest" method="post" enctype="multipart/form-data"> -->
					<div class="defualt codigoI" data-id="<?php echo $D_Muestra->Codigo ?>" style="text-align:center"><strong>CÓDIGO DE INGRESO Nº <?php echo str_pad($D_Muestra->Codigo,4,"0",STR_PAD_LEFT ) ?></strong></div>
						<div class="row">
							<div class="col col-md-12">
							<table>
								<tr>
									<td>
										<strong>Fecha de ingreso: 	</strong>
									</td>
									<td>
										<?php echo $D_Muestra->Fecha_I ?>  
									</td>
								</tr>
								<tr>
									<td>
										<strong>Fecha de recoleccion:</strong>
									</td>
									<td>
										<?php echo $D_Muestra->Fecha_R ?>
									</td>
								</tr>
							</table>	
						<div class="row">
							<div class="col-col-md-12" style="text-align:center; width:100%; border:0px solid #000; padding:10px">
								<span>MUESTRAS INGRESADAS</span>
							</div>
						</div>
						
						<div class="row">
							<div class="col col-md-12">
								<?php foreach($Datos as $Detalles){ ?>
									<?php 
										$resultadosArr  = Muestras::getResultados($id, $Detalles['CN']);
									 	$btn 			= isset($resultadosArr[0]) ? ($resultadosArr[0]['Estado']=='Reportado') ? 'btn-success' : 'btn-primary' : 'btn-primary';
									 	$hide 			= isset($resultadosArr[0]) ? ($resultadosArr[0]['Estado']!='Reportado') ? 'hide' : '' : 'hide';
									 ?>
									<button type="button" id="<?php echo $Detalles['CN'] ?>" data-id="<?php echo $Detalles['CN'] ?>" class="btn <?php echo $btn ?> load_muestra" data-toggle="" data-target="#informacion">
									<span class="<?php echo $hide ?> fa fa-check-square-o" aria-hidden="true">&nbsp;</span>
										<?php echo "Muestra ".str_pad($id,3,"0",STR_PAD_LEFT ).'-'.$Detalles['CN']; ?>
									</button>
								<?php } 

								?>
							</div>
						</div>
						
						<div class="row panel-form hidden" id="panel_muestra">
							<?php 
								$view->contentPanel= ($Nro>0) ? "../templates/muestrasPanel.php" : "../templates/No_samples.php";
								include_once ($view->contentPanel);
							?>
						</div>
		<!--	</form> -->
		</div> <!-- panel body -->
	</div> <!-- modal content -->
