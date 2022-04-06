<?php
	$D_Muestra 	 =  new Muestras();
	$Det_Muestras=  new Muestras();
	$D_Muestra 	->  Muestra($id);	

	$D_params  	 =  new Muestras();
	$Empaques  	 =  new Muestras();

	$Clientes  	 = new Clientes(); 
	$Clientes 	 ->getCliente($D_Muestra->Cliente);
	
	$CN 		 = Muestras::CNMuestras($id);
	$Datos 	     = Muestras::MuestraParametro($id);
	$Orden 		 = Muestras::getOrden($id);

	$OrdenCN 	 = isset($Orden[0]) ? $Orden[0]['Orden'] : '';

	$CNro 		 = count($Datos);
	$Nro 		 = ($CNro>0) ? $Datos[0]['CN'] : 0;
	$NInfo 		 = round($CNro/3,0);
	
?>

		<div class="panel panel-primary">
			<div class="panel-heading">
				<h4 class="modal-title">Vista e impresión de informes de resultados</h4> 
			</div>	  
			
			<div class="panel-body">
				<!-- <form action="" id="FormMuest" method="post" enctype="multipart/form-data"> -->
					<div class="defualt codigoI" data-id="<?php echo $D_Muestra->Codigo ?>" style="text-align:center"><strong>CÓDIGO DE INGRESO Nº <?php echo str_pad($D_Muestra->Codigo,4,"0",STR_PAD_LEFT ) ?></strong></div>
						<div class="row">
							<div class="col col-md-12">
								<table>
									<tr>
										<td >
											<strong>Cliente/Empresa: </strong>
										</td>
										<td colspan="5">
											<?php  echo $Clientes->ClientesN;  ?>
										</td>
									<tr>
									</tr>
										<td>
											<strong>Fecha de ingreso: 	</strong>
										</td>
										<td>
											<?php echo $D_Muestra->Fecha_I ?>  
										</td>
									</tr>
									<tr>
										<td><strong>Número de muetras</strong></td>
										<td><?php echo $CNro; ?></td>
									</tr>
									<tr>
										<td><strong>Número de informes</strong></td>
										<td><?php echo $NInfo; ?></td>
									</tr>
									<tr>
										<td colspan="5"><hr></td>
									</tr>
									<tr>
										<td></td>
										<td style="min-width: 150px"><label>Microbiológico</label></td>
										<td style="min-width: 150px"><label>Fisicoquímico</label></td>
										<td style="min-width: 150px"><label>Superficie</label></td>
									</tr>
									<?php 
										$NOrden = explode("|",$OrdenCN);
										$No=0;
										for ($N = 1 ; $N <= $NInfo ; $N++){

										?>
										<tr>
											<td><strong>Códigos para informe <?php echo $N ?>:</strong></td>
											<td>
												<select class="form-control seleccion" data-id="<?php echo $id ?>">
													<option value=""></option>						
													<?php 
														foreach ($Datos as $ListaC) {
															echo "
															<option " . ( $NOrden[$No]==$ListaC['CN'] ? "selected " : '') . "value='".$ListaC['CN']."'>"."$id-".$ListaC['CN']."
															</option>";
														}
													?>		
												</select>
											</td>
											<td>
												<select class="form-control seleccion" data-id="<?php echo $id ?>">	
													<option value=""></option>								
													<?php 
														foreach ($Datos as $ListaC) {
															echo "
															<option " . ($NOrden[$No+1]== $ListaC['CN'] ? "selected " : '') . "value='".$ListaC['CN']."'>"."$id-".$ListaC['CN']."
															</option>";
														}
													?>			
												</select>
											</td>
											<td>
												<select class="form-control seleccion" data-id="<?php echo $id ?>">
													<option value=""></option>									
													<?php 
														foreach ($Datos as $ListaC) {
															echo "
															<option " . ($NOrden[$No+2] == $ListaC['CN'] ? "selected " : '') . "value='".$ListaC['CN']."'>"."$id-".$ListaC['CN']."
															</option>";
														}
													?>			
												</select>
											</td>	
											<td>

												<button type="button" class="btn btn-primary visualizar" data-id="<?php echo $id ?>" n-data="<?php echo $N ?>">
												  <span class="glyphicon glyphicon-file " aria-hidden="true"></span> 
												  	Ver Informe
												</button>

												<button type="button" class="btn btn-primary generar" data-id="<?php echo $id ?>" n-data="<?php echo $N ?>">
												  <span class="glyphicon glyphicon-file " aria-hidden="true"></span> 
												  	PDF
												</button>
												<button type="button" class="btn btn-primary imprimir" data-id="<?php echo $id ?>" n-data="<?php echo $N ?>">
												  <span class="glyphicon glyphicon-file " aria-hidden="true"></span> 
												  	Imprimir
												</button>												
											</td>										
										</tr>
									<?php 
									$No=$No+3;
										}
									?>

								</table>
							</div>
						</div>
		
						<div id="form-datos"> </div>
		</div> <!-- panel body -->
	</div> <!-- modal content -->

<div class="doc" role="document">
	<div class="doc-content">
      	<div class="doc-body">
			<div class="report">
				<div id="contenido-informe">
				    <div id="view_mb"> 		</div>
					<!-- <div id="view_fq"> 		</div> -->
				</div>
			</div>
        </div> <!-- doc Body-->
    </div> <!-- doc content-->
  </div>



   
