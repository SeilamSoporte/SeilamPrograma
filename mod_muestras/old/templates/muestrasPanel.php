		
		<?php
			error_reporting(0);
			include_once("../resources/fn_limites.php") ; 
			$Called   = isset($_POST["call"]) ? $_POST["call"] : false ;
			$new	  = isset($_POST["new"]) ? $_POST["new"] : false ;
			if ($Called){
				$Nro  = $_POST["Nro"];
				$id   = $_POST["id"];
				include_once ("../clases/clasesMuestras.php");
				$Det_Muestras= new Muestras();
				$view 	   	 = new stdClass(); 
			}
			//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);			
			$Det_Muestras->DetallesMuestras($id,$Nro);
			$Caracteristicas    = $Det_Muestras->Caracteristicas;
			$DatosEnCampo 		= $Det_Muestras->Datos_campo;
			$DatosEnCampo 		= explode("|",$DatosEnCampo);
			$ParametroId		= $Det_Muestras->Parametro;
			$parametrizacion   	= Muestras::getParametrizacion($ParametroId)[0]; // Selecciono los datos de parameitrización con el codigo guardado .. 
			$codigos 		   	= Muestras::getParametrizacion();
			$view->Det_empaques	= Muestras::getEmpaques();
			$claseId 			= $parametrizacion['Clase'];
			$Det_Muestras		->getClase($claseId);
			$clase 		 	    = $Det_Muestras->Clase;

			function ListaCategoria($Id){
				$Det_Muestras= new Muestras();
				$Det_Muestras->getCategoria($Id);
				echo $Det_Muestras->Categ;
			}
			//error_reporting(-1);
			?>
		
		<div class="col col-md-12">
			<div class="form-muestra">
				<div class="row filas">
					<div class="col col-md-12 titulo">
						<span style="color:red" class="num" cons-id="<?php echo $Det_Muestras->Consecutivo;?>" data-id="<?php echo $id ?>"><strong>Muestra <?php echo $id.'-'.$Det_Muestras->Consecutivo; ?> </strong></span>	
					</div>
				</div>
				<dl class="dl-horizontal">
				  <dt><span class="codigo_label">Código de parámetro:</span></dt>
				  <dd>
				  	<div class="col colp col-md-6 ">
				  		<select name="codigo" id="codigo" class="form-control codigo">
				  		<?php foreach($codigos as $codigo) { ?>
							<option value=	<?php echo $codigo['Id'] ?> <?php echo ($Det_Muestras->Parametro==$codigo['Id']) ? 'selected' :''; ?> > <?php echo $codigo['Codigo'] ?> </option>
						<?php } ; ?>  
						</select>
					</div>
				  </dd>
				</dl>
				<div class="row filas parametros">
					<div class="col colp col-md-2 col-sm-4 form-primer">
						<div class="col colp col-md-12 th text-primary">Área de análisis </div>
						<div class="col colp col-md-12 td" id="area"><?php echo $parametrizacion['Area'] ?></div>
					</div>
					
					<div class="col colp colp col-md-4 col-sm-4 form-input">
						<div class="col colp col-md-12 th text-primary">Categoría de muestra </div>
						<div class="col colp col-md-12 td" id="categoria"><?php ListaCategoria($parametrizacion['Categoria']) ?></div>
					</div>
					<div class="col colp col-md-2 col-sm-4 form-input">
						<div class="col colp colp col-md-12 th text-primary">Clase de muestra</div>
						<div class="col colp col-md-12 td" id="clase"><?php echo $clase ?></div>
					</div>
				</div>
				<div class="row filas parametros f2-parametros">
					<div class="col colp col-md-6 col-sm-6 form-input">
						<div class="col colp col-md-12 th text-primary">Parámetros </div>
						<div class="col colp col-md-12 td" id="parametro">
						<?php
							$visible = array();
							foreach (explode("|",$parametrizacion['Tipo']) as $t => $Tipo) {
							 	$visible[$t] = ($Tipo==5) ? 'oculto' : 'visible';
							 }  
						?>
						<?php foreach (explode("|", $parametrizacion['Parametros']) as $p => $param) {
							$ParametroName  = Muestras::getParametros($param)[0];
							$class= isset($visible[$p]) ? $visible[$p] : "";
							echo '<p class="'.$class.'"><span class="ui-menu-icon ui-icon ui-icon-triangle-1-e"></span>'.$ParametroName['Nombre'] .'</p>' ;	
						} ?></div>
						
					</div>	
					<div class="col colp col-md-2 col-sm-2 form-input">
						<div class="col colp colp col-md-12 th text-primary">Límites</div>
						<div class="col colp col-md-12 td" id="limite">					 		
							<?php 
							$Limite = explode("|",$parametrizacion['Limite']);
							$i=0;
							$l=0;
							foreach (explode("|", $parametrizacion['Comparador']) as $p => $comparador) {
								$class= isset($visible[$p]) ? $visible[$p] : "";
								if($comparador==10){
									echo '<p class="'.$class.'">'.LoadLimite($comparador,$Limite[$l+1],$Limite[$l+2]);	
								}
								else{
									echo '<p class="'.$class.'">'.LoadLimite($comparador,$Limite[$l],'');	
								}
								$i++;
								$l=$i*3;
							} ?>
						</div>
					</div>	
					<div class="col colp col-md-2 col-sm-2 form-input">
						<div class="col colp col-md-12 th text-primary" style="">Método</div>
						<div class="col colp col-md-12 td" id="metodo">
							<?php 
							foreach (explode("|", $parametrizacion['Metodo']) as $p => $Metodo){
								$class= isset($visible[$p]) ? $visible[$p] : "";
								echo '<p class="'.$class.'">'.$Metodo;
							}
							?>
						</div>
					</div>	
					<div class="col colp col-md-2 col-sm-2 form-ultimo">
						<div class="col colp col-md-12 th text-primary">Referencia</div>
						<div class="col colp col-md-12 td" id="referencia">	<?php 
							foreach (explode("|", $parametrizacion['Referencia']) as $p => $Referencia){
								$class= isset($visible[$p]) ? $visible[$p] : "";
								echo '<p class="'.$class.'">'.$Referencia;
							}
							?>
						</div>
					</div>	
				</div> <!-- row parametros -->

				<div class="row filas datos-muestra">
					<div class="col colp col-md-2 col-sm-6 form-primer">
						<div class="col colp col-md-12 th ">Acta de recolección </div>
						<div class="col colp col-md-12" ><input type="text" class="form-control requerido" value="<?php echo $Det_Muestras->Acta ?>" id="acta" /> </div>
					</div>
					<div class="col colp col-md-2 col-sm-6">
						<div class="col colp colp col-md-12 th ">Hora de recolección </div>
						<div class="col colp col-md-12" ><input type="time" class="form-control requerido" value="<?php echo $Det_Muestras->Hora_rec ?>" id="hora" /> </div>
					</div>															
					<div class="col colp col-md-4 col-sm-6">
						<div class="col colp  col-md-12 th ">Descripción de la muestra </div>
						<div class="col colp col-md-12" ><input type="text" class="form-control requerido" value="<?php echo $Det_Muestras->Descripcion ?>" id="descripcion" /> </div>
					</div>	
					<div class="col colp col-md-4 col-sm-6">
						<div class="col colp colp col-md-12 th ">Lugar/Punto de muestreo </div>
						<div class="col colp colp col-md-12" ><input type="text" class="form-control requerido" value="<?php echo $Det_Muestras->Lugar ?>" id="lugar" /> </div>
					</div>	
				</div> <!-- row datos-muestra -->
				<div class="row filas complementaria">
					<div class="col colp col-md-12">
						<div class="col colp col-md-12 subtitulo"> <span class="th text-primary">Condición de la muestra e información complementaria</span> 
						</div>
					</div>
					<div class="col colp col-lg-2 col-md-3 col-sm-4">
						<div class="col colp col-md-12 th form-primer">Temperatura de ingreso </div>
						<div class="col colp col-md-12" >
							<div class="input-group">
					      		<input type="number" class="form-control requerido" id="temperatura" value="<?php echo $Det_Muestras->Temperatura ?>" >
					      		<div class="input-group-addon"><sup>o</sup>C</div>
					    	</div> 
					    </div>
					</div>															
					<div class="col colp col-lg-4 col-md-6 col-sm-8">
						<div class="col colp col-md-12 th ">Tipo de empaque </div>
						<div class="col colp col-md-12">
						  	<select id="empaque" class="form-control empaque">
						  		<?php foreach(Muestras::getEmpaques()  as $empaque) { ?>
						  			<option value=<?php echo $empaque['Id']?> <?php echo ($Det_Muestras->Empaque==$empaque['Id']) ? 'selected' :''; ?> ><?php echo $empaque['Empaque'] ?> </option>
								<?php } ; ?>
							</select>
						</div>
					</div>
					<div class="col colp col-lg-2 col-md-3 col-sm-4">
						<div class="col colp col-md-12 th ">Medio </div>
						<div class="col colp col-md-12" >
						<select class="form-control NA" id="medio">
						  		<?php foreach(Muestras::getMedios()  as $medio) { ?>
									<option value=<?php echo $medio['Id']?> <?php echo ($Det_Muestras->Medio==$medio['Id']) ? 'selected' :''; ?> ><?php echo $medio['Medio'] ?> </option>
								<?php } ; ?>						
						</select>
						</div>
					</div>				
					
					<div class="col colp col-lg-2 col-md-3 col-sm-4">
						<div class="col colp col-md-12 th ">Lote </div>
						<div class="col colp col-md-12" ><input type="text" class="form-control NA" value="<?php echo $Det_Muestras->Lote ?>" id="lote" /> </div>
					</div>
					<div class="col colp col-lg-2 col-md-3 col-sm-4">
						<div class="col colp col-md-12 th ">Cantidad </div>
						<div class="col colp col-md-12" >
							<div class="input-group">
					      		<input type="number" class="form-control NA2" id="cantidad" value="<?php echo $Det_Muestras->Cantidad; ?>" >
					      		<div class="input-group-addon">
					      		<select class="select-input" id="unidad">
					      			<option value="1" <?php echo ($Det_Muestras->Unidad==1) ? 'selected' :''; ?> >g</option>
					      			<option value="2" <?php echo ($Det_Muestras->Unidad==2) ? 'selected' :''; ?> >mL</option>
					      		</select></div> 
					    	</div> 
					    </div>
					</div>

				</div> <!-- row complementaria -->
				<div class="row filas complemetaria2"> 
					<div class="col colp col-lg-2 col-md-3 col-sm-4">
						<div class="col colp col-md-12 th form-primer">Fecha de producción </div>
						<div class="col colp col-md-12" > 
						<input type="text" class="form-control fechaJQ" value="<?php echo $Det_Muestras->Fecha_prod ?>" id="fecha_pro" size="30"  placeholder="AAAA-MM-DD" /></div>
					</div>															
					<div class="col colp col-lg-2 col-md-3 col-sm-4">
						<div class="col colp col-md-12 th ">Fecha de vencimiento </div>
						<div class="col colp col-md-12" >
						<input type="text" class="form-control fechaJQ" value="<?php echo $Det_Muestras->Fecha_venc ?>" id="fecha_ven" size="30" placeholder="AAAA-MM-DD"  /> </div>
					</div>	
					<div class="col colp col-lg-2 col-md-3 col-sm-4">
						<div class="col colp col-md-12 th ">Estado del tiempo </div>
						<div class="col colp col-md-12" >
						<select class="form-control NA2" id="estado_tiempo">
							<option value="1" <?php echo ($Det_Muestras->Estado_tiempo=='1') ? 'selected' :''; ?> > Seco </option>
							<option value="2" <?php echo ($Det_Muestras->Estado_tiempo=='2') ? 'selected' :''; ?> > Húmedo </option>
							<option value="3" <?php echo ($Det_Muestras->Estado_tiempo=='3') ? 'selected' :''; ?> > Lluvioso </option>	
						</select> 
						</div>
					</div>
					<div class="col colp col-lg-6 col-md-3 col-sm-6">
						<div class="col colp col-md-12 th " >Observaciones de la toma</div>
						<div class="col colp col-md-12">
							<textarea id="observaciones" class="form-control" cols="30" rows="1"><?php echo $Det_Muestras->Observaciones ?></textarea>
						</div>
					</div>							
				</div> 
				<div class="row filas">
				<?php 
					$tipos5 = array_search('5', explode("|",$parametrizacion['Tipo']));
						$ver = (false != $tipos5) ? 'visible':'oculto';
				?>
				
					<div class="col colp col-md-12 th "><p id="titulo_datos" class="<?php echo $ver ?>">Datos en campo (Para decimales utilizar punto)</p></div>
					<div class="col col-md-12" id="datos_campo">
						<?php
						$NombreParametro=array();
						foreach (explode("|", $parametrizacion['Parametros']) as $p => $param) {
								$NombreParametro[] = Muestras::getParametros($param)[0]['Nombre'];
							}	
							$i=0;
							foreach (explode("|",$parametrizacion['Tipo']) as $t => $Tipo) {
								if ($Tipo==5){ ?>
								<div class="col colp col-md-3">
									<div class="col colp col-md-12"><?php echo $NombreParametro[$t] ?></div>
									<div class="col colp col-md-12"><input type="number" class="form-control datoencampo" value="<?php echo $DatosEnCampo[$i] ?>"> </div> 
								</div>		
						<?php	 $i++;
							} //if  
						}//foreach
						?>
					</div>
				</div>
		</div> <!-- form-muestra -->
			
		</div>
	</div>
	<script src="../js/functionForm.js"></script>
