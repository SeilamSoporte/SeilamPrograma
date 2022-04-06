<?php
	include_once ("../clases/clasesClientes.php");
	
	//$action 	 = isset($_POST['action']) ? $_POST['action']: '';
	$id			 = isset($_POST['id']) ? $_POST['id']: '0';

	$D_Cliente 	 = new Clientes();
	$D_Contactos = new Contactos();	
	$D_Sedes	 = new Sedes();	
	
	$D_Cliente 	 ->D_Cliente($id);
	$D_Contactos ->D_Contactos($id);
	$D_Sedes	 ->D_Sedes($id);
	
	$Nombre = array();
?>
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Detalles del cliente</h4> 
			</div>	  
			
			<div class="modal-body">
				<!-- <div class=""> -->
					<form action="#" id="FormClient" method="post" enctype="multipart/form-data">  
						
						<div class="panel panel-primary">
							
							<div class="panel-body">
								<div class="row">
									<div class="col col-md-12">
										<div class="input-group">
											<span class="primary input-group-addon" id="basic-addon-emp"><span class="glyphicon glyphicon-user"> </span> </span>
											<input  value = "<?php echo $D_Cliente->Empresa; ?>" type="text" id="Empresa" class="form-control" placeholder="Empresa" aria-describedby="basic-addon-emp">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col col-md-12">
										<div class="input-group">
											<span class="primary input-group-addon" id="basic-addon-dir"><span class="glyphicon glyphicon-map-marker"> </span> </span>
											<input value = "<?php echo $D_Cliente->Direccion; ?>" type="text" id="Direccion" class="form-control" placeholder="Dirección" aria-describedby="basic-addon-dir">
										</div>
									</div>
								</div>	
								<div class="row">
									<div class="col col-md-6">
										<div class="input-group">
											<span class="primary input-group-addon" id="basic-addon-emp"><span class="glyphicon glyphicon-barcode"> </span> </span>
											<input value = "<?php echo $D_Cliente->Nit; ?>" type="text" id="Nit" class="form-control" placeholder="Nit" aria-describedby="basic-addon-emp">
										</div>
									</div>
									<div class="col col-md-6">
										<div class="input-group">
											<span class="primary input-group-addon" id="basic-addon-emp"><span class="glyphicon "> </span> Régimen</span>
											<!-- <input value = "" type="text" id="Regimen" class="form-control" placeholder="Regimen" aria-describedby="basic-addon-emp">
											-->
											<select class="form-control" id="Regimen" name="Regimen">
												<?php echo "<option " . ($D_Cliente->Regimen == 0 ? "selected " : '') . "value='0'> </option>";?>
												<?php echo "<option " . ($D_Cliente->Regimen == 1 ? "selected " : '') . "value='1'>Común</option>";?>
												<?php echo "<option " . ($D_Cliente->Regimen == 2 ? "selected " : '') . "value='2'>Simplificado </option>";?>
											</select>
										</div>
									</div>
								</div>
								
								<div class="row">								
									<div class="col col-md-6">
										<div class="input-group">
											<span class="primary input-group-addon" id="basic-addon-tel"><span class="glyphicon glyphicon-phone-alt"> </span></span>
											<input value = "<?php echo $D_Cliente->Telefono; ?>" type="tel" id="Telefono" class="form-control" placeholder="Teléfono" aria-describedby="basic-addon-tel">
										</div>
									</div>
										
						
									<div class="col col-md-6">
										<div class="input-group">
											<span class="primary input-group-addon" id="basic-addon-dir"><span class="glyphicon glyphicon-globe"> </span> </span>
											<input value = "<?php echo $D_Cliente->Ciudad; ?>" type="text" id="Ciudad" class="form-control" placeholder="Ciudad" aria-describedby="basic-addon-dir">
										</div>
									</div>
								</div>	
								<div class="row">	
									<div class="col col-md-6">
										<div class="input-group">
												<!-- <label for="Email">Nit</label> -->
												<span class="primary input-group-addon" id="basic-addon-email"><span class="glyphicon glyphicon-envelope"></span> </span>
												<input value = "<?php echo $D_Cliente->Email; ?>" type="email" id="Email" class="form-control" placeholder="Email" aria-describedby="basic-addon-email">
										</div>
									</div>
									
									<div class="col col-md-6">
										<div class="input-group">
											<span class="primary input-group-addon" id="basic-addon-dir"><span class="">Grupo </span> </span>
											<input value = "<?php echo $D_Cliente->Web; ?>" type="number" id="Web" class="form-control" placeholder="Grupo" aria-describedby="basic-addon-dir">
										</div>
									</div>
								</div>
							</div>	
						</div>	

						<div class="panel panel-primary" id="Panel_Contactos">
							<div class="panel-heading" ><strong>Contactos del cliente</strong></div>
							<div id="tabla">
								<?php 
								if( $id != 0){
									$N=0;
									$i=0;
									$N_Contactos = $D_Contactos->getContactos($id); 
									$view = new stdClass(); 
									$view->contactos = Contactos::getContactos($id); 
									foreach ($view->contactos as $Contacto):
									$N = count(explode("|", $Contacto['Nombre']));
									for ($i==0; $i<$N ; $i++)
									{
								?>
									<table class="table" id="tabla_c">
									<?php 
										include("tbody.php");
									?>
									</table>
								<?php } endforeach; } 
								else{
									echo '<table class="table" id="tabla_c">';
									include("tbody_blank.php");
									echo '</table>';
								}
								?>
								<div id="Campos_contacto"> </div>
							</div>	<!--div tabla -->
						</div> <!-- Panel contactos -->
						<button type="button" class="btn btn-primary" id="btn-agregar"> Agregar contacto</button>
						<div style="padding:10px"> </div>
		<!-- PANEL PARA SEDES -->
						<div class="panel panel-primary" id="Panel_Sedes">
							<div class="panel-heading" ><strong>Sedes del cliente</strong></div>
							<div id="tabla_sedes">
								<?php 
								if( $id != 0){
									$N=0;
									$i=0;
									$N_Sedes = $D_Sedes->getSedes($id); 
									$view = new stdClass(); 
									$view->sedes = Sedes::getSedes($id); 
									foreach ($view->sedes as $Sede):
									$N = count(explode("|", $Sede['Sede']));
									for ($i==0; $i<$N ; $i++)
									{
								?>
									<table class="table" id="tabla_s">
									<?php 
										include("body_sede.php");
									?>
									</table>
								<?php } endforeach; } 
								else{
									echo '<table class="table" id="tabla_c">';
									include("body_sede_blank.php");
									echo '</table>';
								}
								?>
								<div id="Campos_sedes"> </div>
							</div>	<!--div tabla_sedes -->
						</div> <!-- Panel sedes -->
						<button type="button" class="btn btn-primary" id="btn-agregar-sede"> Agregar sede</button>
				<!-- </div> -->
			</div>		
		<!--</div> -->
		  <div class="row">
			<div class="col">
				<?php // echo $D_Contactos->getContactos($id); ?>
			</div>
		  </div>
		  <div class="modal-footer">
			<div class="row">
			<div class="col-md-9">
				<div id="confirmacion">	</div>
			</div>
			<div class="col-md-3">
				<button type="button" class="btn btn-danger" data-dismiss="modal" id="cancelar">Cancelar</button>
				<button type="button" data-id="<?php echo $D_Cliente->Id; ?>" class="btn btn-primary" id="Guardar_cliente" >Guardar</button>
			</div>
			</div>
		  </div>
	</div><!-- /.modal-content -->
	<div id="confirmacion">	</div>
	
	<!-- <script src="./js/functions.js"></script> -->
