							<?php 
							$N=$_POST['Nc'];
							$html = "'"?> 
							<div class="panel-body barra_l" id="<?php echo "fila".$N ?>">
								<div class="row">
									<div class="col col-md-6">
										<div class="input-group">
											<span class="primary input-group-addon" id="basic-addon-emp"><span class="glyphicon glyphicon-user"> </span> </span>
											<input value = "" type="text" id="" class="form-control contacto" placeholder="Contacto" aria-describedby="basic-addon-cargo">
										</div>
									</div>
									<div class="col col-md-6">
										<div class="input-group">
											<span class="primary input-group-addon" id="basic-addon-emp"><span class="glyphicon glyphicon-envelope"></span> </span>
											<input value = "" type="email" id="C_Email" class="form-control email" placeholder="Email" aria-describedby="basic-addon-cargo">
										</div>
									</div>
									<div class="col col-md-6">
										<div class="input-group">
											<span class="primary input-group-addon" id="basic-addon-emp"><span class="glyphicon glyphicon-briefcase"> </span> </span>
											<input value = "" type="text" id="C_Cargo" class="form-control " placeholder="Cargo" aria-describedby="basic-addon-cargo">											</div>
									</div>
									
									<div class="col col-md-5">
										<div class="input-group">
											<span class="primary input-group-addon" id="basic-addon-emp"><span class="glyphicon glyphicon-phone"> </span> </span>
											<input value = "" type="text" id="C_Celular" class="form-control " placeholder="Celular" aria-describedby="basic-addon-cargo">
										</div>
									</div>
									<div class="col col-md-1">
										<div style="width:40px">
											<a class="delete" id="eliminarContacto" data-id="">
												<div data-toggle="tooltip"  data-target="#confirma" title="Eliminar contacto" class="btn btn-danger fa fa-times"></div>
											</a>
										</div>
									</div>	
																
								</div>
							</div>
						<?php 
						"'";
						?>
							