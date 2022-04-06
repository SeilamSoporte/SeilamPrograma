										<tr class="fila-base">
											<?php 
												include_once ("../clases/clasesParametros.php");
												$D_Parametros= new Parametros();
												$ListaParametro = Parametros::Lista_Parametros();
												$ListaEquipos   = Parametros::Lista_Equipos();
												$IN = isset($_POST['in']) ? $_POST['in']: '';
											 ?>

												<td class="td-1"> 	
												<select class="form-control select-in Parametro form-control-param" id="Parametro" data-id="<?php echo $IN ?>">
													<?php foreach ($ListaParametro as $Parametro) { ?>
														<?php echo '<option '.($Parametro_d[$i]==$Parametro["Id"] ? "selected" : '').' value="'.$Parametro["Id"].'"> '. $Parametro["Nombre"]. ' </option>'; ?>
													<?php } ?>
												</select>				  	
												</td>

												<td class="td-1">
													<input type="text" id="Norma" class="form-control form-control-param  Norma" placeholder="Norma" value="" />
												</td>
												<td class="td-1">
													<select class="form-control form-control-param  Comparador" id="Comparador" data-id="<?php echo $IN ?>">
														<option value='1'> < 		</option>
														<option value='2'> > 		</option>
														<option value='3'> <=		</option>
														<option value='4'> >= 		</option>
														<option value='5'> =		</option>
														<option value='6'> Res/100mL</option>
														<option value='7'> Res/200mL</option>
														<option value='8'> Ausencia </option>
														<option value='9'> Negativo </option>
														<option value='10'>Rango    </option>
														<option value='11'>No Especifica </option>
														<option value='12'>Aceptable </option>
														<option value='13'>Fondo visible </option>	
													</select>
												</td>
												<td class="td-1"> 
														<input type="number" id="<?php echo 'Limite'.$IN ?>" class="form-control Limite" placeholder="Limites" value="" />

														<input type="number" id="<?php echo 'Min'.$IN ?>" style="display:none" class="form-control Limite Min form-control-param " placeholder="min" value="" />
														<input type="number" id="<?php echo 'Max'.$IN ?>"  style="display:none" class="form-control Limite Max form-control-param " placeholder="max" value="" />

													</td>
													<td class="td-1">
														<input type="text" id="Metodo" class="form-control Metodo form-control-param " placeholder="Método" value="" />
													</td>
													<td class="td-1">
														<input type="text" id="Referencia" class="form-control Referencia form-control-param " placeholder="Referencia" value="" />
													</td>
											
													<td class="td-3">
														<select name="" class="form-control  form-control-param Tipo" id="">
															<option value="1">MB	</option>
															<option value="2">FQ	</option>
															<option value="3">Vol	</option>
															<option value="4">Iones	</option>
															<option value="5">DC	</option>
														</select>
													</td>
													<td class="td-1">
														<select name="" class="form-control form-control-param Equipo" id="">
															<option value="0">NA</option>
															<?php foreach ($ListaEquipos as $Equipo) { ?>
															<?php echo '<option value="'.$Equipo["Id"].'"> '. $Equipo["Equipo"]. ' </option>'; ?>
															<?php } ?>
														</select>
													</td>
													<td class="td-1">
														<input type="text" class="form-control form-control-param Solucion" placeholder="Sol. titulante" value="" />
													</td>													
													<td class="eliminar td-1">
														
															<button type="button" class="btn btn-danger"  data-toggle="tooltip" data-placement="top" ria-label="Left Align" title="Eliminar">
															  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
															</button>	
														
													</td>
												</tr>

<script>
  		$(function(){
	        $(".Parametro").chosen({ 
	            no_results_text: "No se encuentra:", 
	            disable_search_threshold:4
	        });
	    });	    

</script>