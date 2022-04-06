		<?php

			$ParametroId = $_POST['PID'];
			
			include_once ("../clases/clasesMuestras.php");
			$Det_Muestras= new Muestras();
			$view 	   	 = new stdClass(); 

			$parametrizacion   	= Muestras::getParametrizacion($ParametroId)[0]; // Selecciono los datos de parameitrización con el codigo guardado .. 
			$codigos 		   	= Muestras::getParametrizacion();
			$NombresOrden 		=[];

			function Orden($nombre){
				if (strncasecmp($nombre, 'Temperatura', 10) === 0){
				    $NombresOrden[0]=$nombre;
				}
				if (strncasecmp($nombre, 'ph', 2) === 0){
				    $NombresOrden[1]=$nombre;
				}
				if (strncasecmp($nombre, 'Cloro Residual Libre', 20) === 0){
				    $NombresOrden[2]=$nombre;
				}
				if (strncasecmp($nombre, 'Cloro Combinado', 15) === 0){
				    $NombresOrden[3]=$nombre;
				}
				if (strncasecmp($nombre, 'Potencial Redox', 15) === 0){
				    $NombresOrden[4]=$nombre;
				}
				if (strncasecmp($nombre, 'Materias flotantes', 15) === 0){
				    $NombresOrden[5]=$nombre;
				}																				
			}

			?>
					
					<div class="col col-md-12" id="datos_campo">
						<?php
						$NombreParametro=array();
						$Nombres=array();

						foreach (explode("|", $parametrizacion['Parametros']) as $p => $param) {
								$NombreParametro[] = Muestras::getParametros($param)[0]['Nombre'];
							}	
							$i=0;
							$keys=[];

							foreach (explode("|",$parametrizacion['Tipo']) as $t => $Tipo) {
							if (intval($Tipo) === 5){
								
								$keys[] = $t;
								$Nombres[] = $NombreParametro[$t];
								if (strncasecmp($NombreParametro[$t], 'Temperatura', 10) === 0){
								    $NombresOrden[0]=$NombreParametro[$t];
								}
								if (strncasecmp($NombreParametro[$t], 'ph', 2) === 0){
								    $NombresOrden[1]=$NombreParametro[$t];
								}
								if (strncasecmp($NombreParametro[$t], 'Cloro Residual Libre', 20) === 0){
								    $NombresOrden[2]=$NombreParametro[$t];
								}
								if (strncasecmp($NombreParametro[$t], 'Cloro Combinado', 15) === 0){
								    $NombresOrden[3]=$NombreParametro[$t];
								}
								if (strncasecmp($NombreParametro[$t], 'Potencial Redox', 15) === 0){
								    $NombresOrden[4]=$NombreParametro[$t];
								}
								if (strncasecmp($NombreParametro[$t], 'Materias flotantes', 15) === 0){
								    $NombresOrden[5]=$NombreParametro[$t];
								}
								if (substr_compare($NombreParametro[$t], 'lavapies',-8,8) === 0 && strncasecmp($NombreParametro[$t], 'cloro', 5) === 0){
								    $NombresOrden[6]=$NombreParametro[$t];
								}
								if (strncasecmp($NombreParametro[$t], 'transparencia', 13) === 0){
								    $NombresOrden[7]=$NombreParametro[$t];
								}																
							}
						}
							$nk=0;
							foreach ($keys as $key => $k) {
								$comparador_ap= explode("|",$parametrizacion['Comparador'])[$k];
							
								if (intval($comparador_ap) === 8) { ?>	
									<div class="col colp col-md-3">
										<div class="col colp col-md-12"><?php echo $NombreParametro[$k] ?></div>
										<select class="select-input form-control datoencampo" style="border:1px solid #ccc; background:#fff">
								      		<option value="Ausencia"> Ausencia </option>
								      		<option value="Presencia"> Presencia </option>
								      	</select>
								    </div>
								<?php
								
								}
								else if (intval($comparador_ap) === 9) { ?>
									<div class="col colp col-md-3">
										<div class="col colp col-md-12"><?php echo $NombreParametro[$k] ?></div>
										
										<select class="select-input form-control datoencampo" style="border:1px solid #ccc; background:#fff">
								      		<option value="Positivo"> Positivo </option>
								      		<option value="Negativo"> Negativo </option>
								      	</select>
								    </div>
								<?php
								
								}
								else if (intval($comparador_ap) === 12) { ?>	

									<div class="col colp col-md-3">
										<div class="col colp col-md-12"><?php echo $NombreParametro[$k] ; ?></div>
										<select class="select-input form-control datoencampo" style="border:1px solid #ccc; background:#fff">											
								      		<option value="Aceptable" > Aceptable </option>
								      		<option value="No aceptable"> No Aceptable </option>
								      	</select>
								    </div>
								<?php
								
								}
								else if (intval($comparador_ap) === 13) { ?>	
									<div class="col colp col-md-3">
										<div class="col colp col-md-12"><?php echo $NombreParametro[$k] ?></div>
										<select class="select-input form-control datoencampo" style="border:1px solid #ccc; background:#fff">
								      		<option value="Fondo visible"> Fondo visible </option>
								      		<option value="Fondo no visible"> Fondo no visible </option>
								      	</select>
								    </div>
								<?php 
									
								}else { ?>

								<div class="col colp col-md-3">
									<div class="col colp col-md-12"><?php echo $NombreParametro[$k] ?></div>
									<div class="input-group">
										<div class="input-group-addon">
								      		<select class="select-input comparador_dc">
								      			<option value="=" > = </option>
								      			<option value="<" > < </option>
								      			<option value=">" > > </option>
								      		</select>
							      		</div> 
							      		<input type="number" class="form-control datoencampo" value="<?php echo $DatosEnCampo[$k] ?>"> 
							    	</div> 
								</div>		
						<?php }
						$nk++;
						}//foreach
						?>
					</div>