<?php
	include_once("../resources/fn_limites.php") ; 
	include_once ("../clases/clasesMuestras.php");
	$Nro =1;
	$Nro 		 =  isset($_POST['Nro']) ? $_POST['Nro']: 1 ;
	$D_Muestra 	 =  new Muestras();
	$Det_Muestras=  new Muestras();
	$D_Muestra 	->  Muestra($id);	
	$D_params  	 =  new Muestras();
	$Empaques  	 =  new Muestras();
	$L_clientes  = new Clientes();
	$L_clientes -> get_Clientes();
	$CN 		 = Muestras::CNMuestras($id);
	$LastMuestra = Muestras::LastMuestra($id)+1;
	$view->L_Sedes = Clientes::getSedes($D_Muestra->Cliente);
	$sedes   	 = $view->L_Sedes;
	$sedes   	 = isset($sedes[0]['Sede']) ? $sedes[0]['Sede'] :'' ;
	$sedesId 	 = $view->L_Sedes;
	$sedesId 	 = isset($sedesId[0]['Id']) ? $sedesId[0]['Id'] : '';
	$sedes   	 = explode('|',$sedes);						
	$i=0;
	$usuario =  $_SESSION['username'];
?>

		<div class="panel panel-primary">
			<div class="panel-heading">
				<h4 class="modal-title">Detalles de las muestras</h4> 
			</div>	  
			
			<div class="panel-body">
				<form action="envio.php" id="FormMuest" method="post" enctype="multipart/form-data">
					<div class="defualt codigoI" data-id="<?php echo $D_Muestra->Codigo ?>" style="text-align:center"><strong>CÓDIGO DE INGRESO Nº <?php echo $D_Muestra->Codigo ?></strong></div>
						<div class="row">
							<div class="col col-in col-md-12">
								<label for="Cliente">Cliente/Empresa</label>
								<select name="Cliente" id="Cliente" class="form-control">									
									<?php 
										foreach ($L_clientes->ClientesN as $Lista) {
											echo "
											<option " . ($D_Muestra->Cliente == $Lista['Id'] ? "selected " : '') . "value='".$Lista['Id']."'>".$Lista['Empresa']."
											</option>";
										}
									?>		
								</select>
							</div>
						</div>
					
						<div class="row ">
							<div class="col col-in col-md-6">
								<label for="Sede">Sede</label>
								<select name="Sede" id="sede" class="form-control requerido">									
									<?php
										foreach ($sedes as $S=>$Sede) {
											echo "<option " . ($D_Muestra->Sede == $S ? "selected " : '') . "value='".$S."'>".$sedes[$S]." </option>";		
										}
									?>		 
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col col-md-3">
								<label for="Fecha_ingreso">Fecha de ingreso </label>
								<input id="Fecha_ingreso" name="Fecha_ingreso" class="form-control fechaJQ requerido" type="text" value=<?php echo $D_Muestra->Fecha_I ?>  />
							</div>
							<div class="col col-md-3">
								<label for="hora_ingreso">Hora de ingreso </label>
								<input id="hora_ingreso" name="hora_ingreso" class="form-control" type="time" value=<?php echo $D_Muestra->Hora_ingreso ?>  />
							</div>

							<div class="col col-md-3">
								<label for="Fecha_recoleccion">Fecha de recolección </label>
								<input id="Fecha_recoleccion" name="Fecha_recoleccion" class="form-control fechaJQ" type="text" value=<?php echo $D_Muestra->Fecha_R ?>  />
							</div>
							<div class="col col-md-6">
								<label for="Encargado" id="EncargadoLB">Encargado (por parte del cliente) </label>
								<input id="Encargado" name="Encargado" class="form-control" type="text"  value="<?php echo 
								split ("\|", $D_Muestra->Nombres)[0] ?>" />
							</div>
							<div class="col col-md-6">
								<label for="Recolectado">Recolectado por </label>
								<input id="Recolectado" name="Recolectado" class="form-control" type="text" value="<?php echo
								split ("\|", $D_Muestra->Nombres)[1] ?>" />
								<input type="hidden" id="usuario_cambio" value="<?php echo $usuario ?>">
							</div>
						</div>

						<div class="row">
							<div class="col-col-md-12" style="text-align:center; width:100%; border:0px solid #000; padding:10px">
								<span >MUESTRAS INGRESADAS</span>
							</div>
						</div>

						<div class="row">
							<div class="col col-md-3" style="display:none">
								<button type="button" id="Listado" name="Listado" class="btn btn-primary" data-toggle="modal" data-target="#informacion">
								Listado de parámetros
								</button>
							</div>
						</div> <!-- Row -->
							
						<div class="row">
							<div class="col col-md-12" id="botones">
								<?php foreach($CN as $Detalles){ ?>
									<button type="button" id="" data-id="<?php echo $Detalles['CN'] ?>" class="btn btn-primary load_muestra" data-toggle="" data-target="#informacion">
										<?php echo "Muestra ".str_pad($id,3,"0",STR_PAD_LEFT ).'-'.$Detalles['CN']; ?>
									</button>
								<?php } 

								?>
							</div>
						</div>
						
						<div class="row panel-form" id="panel_muestra">
							<?php 
								$view->contentPanel= "../templates/muestrasPanel.php"; 
								include_once ($view->contentPanel);
							?>
						</div>
						
			</form>
		</div> <!-- panel body -->
	</div> <!-- modal content -->

<!-- Modal -->
<div id ="nuevo" class="modal fade" tabindex="-1" role="dialog" >
  <div class="modal-dialog  modal-xl" role="document">
	<div class="modal-content">  
    	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	<h4 class="modal-title" id="gridSystemModalLabel"><span class="nueva_muestra" muestra-id="<?php echo $LastMuestra ?>" data-id="<?php echo $id ?>" style="color:red"><strong>Muestra <?php echo str_pad($id,3,"0",STR_PAD_LEFT ).'-'.$LastMuestra; ?> </strong></span> </h4>
      	</div>
<!-- Modal -->
	    <div class="modal-body">
			 <div class="form-horizontal">
				  <div class="form-group">
				    <label for="codigo_n" class="col-sm-2 control-label">Código de parámetro: </label>
				    <div class="col colp col-md-4 ">
				      <select id="codigo_n" class="form-control codigo ">
				      	<option value=0> </option>
				      	<?php foreach($codigos as $codigo) { ?>
							<option value=<?php echo $codigo['Id'] ?> > <?php echo $codigo['Codigo'] ?> </option>
						<?php } ; ?>  
						</select>
				    </div>
				    <div id="codigo_n_err" style="display:none">Por favor escoja una opción</div>
				  </div>
			  </div>
	
				<div class="row filas parametros">
					<div class="col colp col-lg-2 col-sm-4 form-primer">
						<div class="col colp col-md-12 th text-primary">Área de análisis </div>
						<div class="col colp col-md-12 td" id="area_n"></div>
					</div>
					
					<div class="col colp colp col-lg-4 col-sm-4 form-input">
						<div class="col colp col-md-12 th text-primary">Categoría de muestra </div>
						<div class="col colp col-md-12 td" id="categoria_n"></div>
					</div>
					<div class="col colp col-lg-4 col-sm-4 form-input">
						<div class="col colp colp col-md-12 th text-primary">Clase de muestra </div>
						<div class="col colp col-md-12 td" id="clase_n"></div>
					</div>
				</div>

				<div class="row filas parametros">
					<div class="col colp col-lg-5 col-md-6 col-sm-4 form-input">
						<div class="col colp col-md-12 th text-primary">Parámetros </div>
						<div class="col colp col-md-12 td" id="parametro_n">
						
						</div>
						
					</div>	
					<div class="col colp col-lg-2 col-md-3 col-sm-2 form-input">
						<div class="col colp colp col-md-12 th text-primary">Límites </div>
						<div class="col colp col-md-12 td" id="limite_n">					 		
							
						</div>
					</div>	
					<div class="col colp col-lg-2 col-md-3 col-sm-2 form-input">
						<div class="col colp col-md-12 th text-primary" style="">Método</div>
						<div class="col colp col-md-12 td" id="metodo_n">
							
						</div>
					</div>	
					<div class="col colp col-lg-2 col-md-3 col-sm-3 form-ultimo">
						<div class="col colp col-md-12 th text-primary">Referencia </div>
						<div class="col colp col-md-12 td" id="referencia_n">	
						</div>
					</div>	
				</div> <!-- row parametros -->
		</div>
	    
	    <div class="modal-footer">
	    	<button type="submit" class="btn btn-success" id="Add">Agregar</button>
	    	<button type="button" class="btn btn-danger"  data-dismiss="modal">Cerrar</button>
	    </div>
 	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
 <script>
 	
 </script>