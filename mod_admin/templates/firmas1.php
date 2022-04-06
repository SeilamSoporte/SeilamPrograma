		
			<?php 
				include_once ("../clases/clasesAdmin.php");
				$datos 		= new Administrador();
				$datos      ->getFirmas();
				$listas     = $datos->Datos;
				$datos 		->getUsuarios();
				$users 	  	= $datos->Datos;
			?>

			<div class="panel-heading">
				FIRMAS PARA INFORMES
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col col-md-6 text-center">
						<div class="col col-md-12 alert list-group-item firmas-box">
							<div class="col col-md-12"><strong>FIRMAS INFORMES MICROBIOLÓGICOS</strong></div>
							<div class="col col-md-6 ">REVISADO POR:</div>
							<div class="col col-md-6 ">APROBADO POR:</div>
																	
							<div class="col col-md-6 ">
								<select name="" id="RMB" class="form-control">
									<option value="0"> </option>
									<?php foreach ($users as $usuario) { 
										$Nombre = $usuario['Nombre'].' '.$usuario['Apellido'] ?>
									<?php echo '<option '.($listas['RMB']==$usuario['Id'] ? "selected" : '').' value="'.$usuario['Id'].'"> '.$Nombre.' </option>'; ?>
									<?php } ?>
								</select>
							</div>
							<div class="col col-md-6 ">
								<select name="" id="AMB" class="form-control">
									<option value="0"> </option>
									<?php foreach ($users as $usuario) { 
										$Nombre = $usuario['Nombre'].' '.$usuario['Apellido'] ?>
									<?php echo '<option '.($listas['AMB']==$usuario['Id'] ? "selected" : '').' value="'.$usuario['Id'].'"> '.$Nombre.' </option>'; ?>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="col col-md-6 text-center">
						<div class="col col-md-12 alert list-group-item firmas-box">
							<div class="col col-md-12"><strong>FIRMAS INFORMES FISICOQUÍMICOS</strong></div>
							<div class="col col-md-6 ">REVISADO POR:</div>
							<div class="col col-md-6 ">APROBADO POR:</div>
							<div class="col col-md-6 ">
								<select name="" id="RFQ" class="form-control">
									<option value="0"> </option>
									<?php foreach ($users as $usuario) { 
										$Nombre = $usuario['Nombre'].' '.$usuario['Apellido'] ?>
									<?php echo '<option '.($listas['RFQ']==$usuario['Id'] ? "selected" : '').' value="'.$usuario['Id'].'"> '.$Nombre.' </option>'; ?>
									<?php } ?>
								</select>
							</div>
							<div class="col col-md-6 ">
								<select name="" id="AFQ" class="form-control">
									<option value="0"> </option>
									<?php foreach ($users as $usuario) { 
										$Nombre = $usuario['Nombre'].' '.$usuario['Apellido'] ?>
									<?php echo '<option '.($listas['AFQ']==$usuario['Id'] ? "selected" : '').' value="'.$usuario['Id'].'"> '.$Nombre.' </option>'; ?>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="col col-md-12 text-center">
						<button type="button" class="btn btn-md btn-primary btn-menu" id="save-firmas" data-toggle="modal" data-target="#informacion" >
						  <span class="fa fa-save" aria-hidden="true">&nbsp;</span><span class="bt">Guardar</span>
						</button>
					</div>
				</div>
				
			</div>
			
			<script src="./js/functions_panels.js"></script>