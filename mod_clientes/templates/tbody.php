									<tbody>
										<tr class="fila-base">
										
										<td>										
											<div class="col col-md-6">
												<div class="input-group">
													<span class="primary input-group-addon" id="basic-addon-emp"><span class="glyphicon glyphicon-user"> </span> </span>
													<input value = "<?php echo explode("|", $Contacto['Nombre'])[$i]; //$Contacto['Nombre'] ?>" type="text" id="Contacto" class="form-control Nombre_c" placeholder="Contacto" aria-describedby="basic-addon-c0ntacto">
												</div>
											</div>
												
											<div class="col col-md-6">
												<div class="input-group">
													<span class="primary input-group-addon" id="basic-addon-emp"><span class="glyphicon glyphicon-briefcase"> </span> </span>
													<input value = "<?php echo explode("|", $Contacto['Cargo'])[$i];//$Contacto['Cargo'] ?>" type="text" id="Cargo" class="form-control Cargo_c" placeholder="Cargo" aria-describedby="basic-addon-cargo">
												</div>
											</div>
											
											<div class="col col-md-6">
												<div class="input-group">
													<span class="primary input-group-addon" id="basic-addon-emp"><span class="glyphicon glyphicon-envelope"> </span> </span>
													<input value = "<?php echo explode("|", $Contacto['Email'])[$i];//$Contacto['Email'] ?>" type="text" id="Email_C" class="form-control Email_c" placeholder="Email" aria-describedby="basic-addon-email">
												</div>
											</div>
												
											<div class="col col-md-5">
												<div class="input-group">
													<span class="primary input-group-addon" id="basic-addon-emp"><span class="glyphicon glyphicon-phone"> </span> </span>
													<input value = "<?php echo explode("|", $Contacto['Celular'])[$i];//$Contacto['Celular'] ?>" type="text" id="Celular" class="form-control Celular_c" placeholder="Celular" aria-describedby="basic-addon-celular">
												</div>
											</div>											
											
											<div class="eliminar col col-md-1">
												<div style="width:40px">
													<a class="delete" id="eliminarContacto" > 
														<div data-toggle="tooltip"  data-target="#confirma" title="Eliminar contacto" class="btn btn-danger fa fa-times eliminar"></div>
													</a>
												</div>
											</div>
										</td>
										
										</tr>			
									</tbody>