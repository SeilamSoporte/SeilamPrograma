
<?php

	include_once ("../Clases/clasesMuestras.php");
	$action 	= isset($_POST['action']) ? $_POST['action']: '';
	$id			= isset($_POST['id']) ? $_POST['id']: '0';

	$D_Muestra =  new Muestras();
	$D_Muestra -> Muestra($id);
	
	$view = new stdClass(); 
	$view->L_CLientes = Clientes::getClientes();
    $view->disableLayout=false;
?>

	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Detalles de la muestra</h4> 
			</div>	  
			
			<div class="modal-body">
				<form action="#" id="FormMuest" method="post" enctype="multipart/form-data">

					<div class="panel panel-primary" > 
						<div class="panel-heading" style="text-align:center"><strong>MUESTRA Nº <?php echo $D_Muestra->Codigo ?></strong></div>
						<div class="panel-body">
			

							<div class="row">
								<div class="col col-in col-md-12">
									<label for="Cliente">Cliente/Empresa</label>
									<select name="Cliente" id="Cliente" class="form-control">									
										<?php 
											foreach ($view->L_CLientes as $Lista) {
												echo "
												<option " . ($D_Muestra->Cliente == $Lista['Id'] ? "selected " : '') . "value='".$Lista['Id']."'>".$Lista['Empresa']."
												</option>";
											}
										?>		
									</select>
								</div>
							</div>

							<div class="row">
								<div class="col col-md-3">
									<label for="Fecha_ingreso">Fecha de ingreso </label>
									<input id="Fecha_ingreso" name="Fecha_ingreso" class="form-control" type="date" />
								</div>
								<div class="col col-md-3">
									<label for="Fecha_recoleccion">Fecha de recoleccion </label>
									<input id="Fecha_recoleccion" name="Fecha_recoleccion" class="form-control" type="date" />
								</div>
								<div class="col col-md-3">
									<label for="Encargado">Encargado (cliente) </label>
									<input id="Encargado" name="Encargado" class="form-control" type="text" style="font-size:12px;" />
								</div>
								<div class="col col-md-3">
									<label for="Recoletado">Recolectado por </label>
									<input id="Recoletado" name="Recoletado" class="form-control" type="text" style="font-size:12px;" />
								</div>
							</div>

							<div class="row">
								<div class="col col-md-2"> 
									<button type="button" id="Agregar" name="Agregar" class="btn btn-primary" >Agregar tipo de muestra</button>
								</div>
							</div>
							<div class="row">
								<div class="col col-md-12">
									<table class="table">
										<tr>
											<th class="th">N</th>
											<th class="th">Código</th>
											<th class="th">Área de anánisis</th>
											<th class="th">Categoría de muestra </th>
											<th class="th">Clase de muestra </th>
											<th class="th">Parámetros </th>
										</tr>
										<tr>
											<td style="width:30px; padding:2px;"> <input type="text" class="form-control input-codigo" /> </td>
											<td style="width:100px; padding:2px;"> <input type="text" class="form-control input-codigo params" /> </td>
											<td style="width:100px; padding:2px;">  </td>
											<td style="width:100px; padding:2px;">  </td>
											<td style="width:100px; padding:2px;">  </td>
											<td> </td>
										</tr>
									</table>
								</div>
							</div>

						</div>
					</div>
			</div>
		   <div class="modal-footer">
				<div class="row">
					<div class="col-md-9">
						<div id="confirmacion">	</div>
					</div>
					<div class="col-md-3">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						<button type="button" class="btn btn-primary" data-id="<?php echo $id ?>"  id="Guardar_parametro" >Guardar</button>
						
					</div>
				</div>
		  	</div>

		</div> <!-- modal content -->
	</div>
		<div id="confirmacion">	</div>

</form>

	<script>
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		});
	</script>

