<?php 

	$id =$_POST['id'];
	$Nro= $_POST['Nro'];
	if($Nro==0){
		$Nro=1;
	}


	include_once ("../clases/clasesMuestras.php");	
	include_once("../resources/fn_limites.php") ; 
	$Det_Muestras 		= new Muestras();
	$Det_Muestras		->DetallesMuestras($id,$Nro);
	$parametrizacion   	= Muestras::getParametrizacion($Det_Muestras->Parametro)[0]; // Selecciono los datos de parameitrización con el codigo guarado .. 
	$codigos 		   	= Muestras::getParametrizacion();
	$LastMuestra		= Muestras::LastMuestra($id)+1;							  
?>	
<div class="modal-dialog modal-xl">
	<div class="modal-content">  
    	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	<h4 class="modal-title" id="gridSystemModalLabel"><span class="num" muestra-id="<?php echo $Nro ?>" data-id="<?php echo $id ?>" style="color:red"><strong>Muestra <?php echo str_pad($id,3,"0",STR_PAD_LEFT ).'-'.$Nro; ?> </strong></span> </h4>
      	</div>
	    <div class="modal-body">
	    				<dl class="dl-horizontal">
				  <dt><span class="codigo_label">Codigo de parámetro:</span></dt>
				  <dd>
				  	<div class="col colp col-md-4 ">
				  		<select name="codigo" id="codigo" class="form-control codigo">
				  		<?php foreach($codigos as $codigo) { ?>
							<option value=<?php echo $codigo['Id'] ?> <?php echo ($Det_Muestras->Parametro==$codigo['Id']) ? 'selected' :''; ?> > <?php echo $codigo['Codigo'] ?> </option>
						<?php } ; ?>  
						</select>
					</div>
				  </dd>
				</dl>
				<div class="row filas parametros">
					<div class="col colp col-lg-2 col-sm-4 form-primer">
						<div class="col colp col-md-12 th text-primary">Área de análisis &emsp; &emsp; &emsp;</div>
						<div class="col colp col-md-12 td" id="area"><?php echo $parametrizacion['Area'] ?></div>
					</div>
					
					<div class="col colp colp col-lg-2 col-sm-4 form-input">
						<div class="col colp col-md-12 th text-primary">Categoría de muestra </div>
						<div class="col colp col-md-12 td" id="categoria"><?php echo $parametrizacion['Categoria'] ?></div>
					</div>
					<div class="col colp col-lg-2 col-sm-4 form-input">
						<div class="col colp colp col-md-12 th text-primary">Clase de muestra  &emsp; &emsp;</div>
						<div class="col colp col-md-12 td" id="clase"><?php echo $parametrizacion['Clase'] ?></div>
					</div>
					<div class="col colp col-lg-2 col-md-4 col-sm-4 form-input">
						<div class="col colp col-md-12 th text-primary">Parámetros &emsp; &emsp; &emsp; &emsp; </div>
						<div class="col colp col-md-12 td" id="parametro">
						
						<?php foreach (explode("|", $parametrizacion['Parametros']) as $param) {
							$ParametroName  = Muestras::getParametros($param)[0];
							echo '<p><span class="ui-menu-icon ui-icon ui-icon-triangle-1-e"></span>'.$ParametroName['Nombre'] .'</p>' ;	
						} ?></div>
						
					</div>	
					<div class="col colp col-lg-1 col-md-2 col-sm-2 form-input">
						<div class="col colp colp col-md-12 th text-primary">Límites &emsp; </div>
						<div class="col colp col-md-12 td" id="limite">					 		
							<?php 
							$i=0;
							foreach (explode("|", $parametrizacion['Comparador']) as $comparador) {
								echo '<p>'.LoadLimite($comparador,$parametrizacion['Limite'][$i]);
								$i++;
							} ?>
						</div>
					</div>	
					<div class="col colp col-lg-1 col-md-2 col-sm-2 form-input">
						<div class="col colp col-md-12 th text-primary" style="">Método</div>
						<div class="col colp col-md-12 td" id="metodo">
							<?php 
							foreach (explode("|", $parametrizacion['Metodo']) as $Metodo){
								echo '<p>'.$Metodo;
							}
							?>
						</div>
					</div>	
					<div class="col colp col-lg-2 col-md-3 col-sm-3 form-ultimo">
						<div class="col colp col-md-12 th text-primary">Referencia &emsp; &emsp; &emsp; &emsp; &emsp;</div>
						<div class="col colp col-md-12 td" id="referencia">	<?php 
							foreach (explode("|", $parametrizacion['Referencia']) as $Referencia){
								echo '<p>'.$Referencia;
							}
							?>
						</div>
					</div>	
				</div> <!-- row parametros -->
	    <?php 
			/*
									<tr><!-- Fila base -->
									
										<td class="parametro">
										
											 <table style="width:100%">
												 <tr>
												 	<th class="param-data-10"> 	Código 				</th>
												 	<th class="param-data-15">  Área de análisis	</th>
												 	<th class="param-data-10">	Categoría de muestra</th>
												 	<th class="param-data-15"> 	Clase de muestra	</th>
												 	<th class="param-data-15">	Parámetros			</th>
												 	<th class="param-data">		Límites				</th>
												 	<th class="param-data-10">	Método 				</th>
												 	<th class="param-data-15">	Referencia 			</th>

												 </tr>
									
												 <tr>  
												 	<td class="param-data-10">
												 		<input  list="list_parametros" class="form-control lista_params" data-id="<?php echo $Nro ?>" id="<?php echo 'lista_params'.$Nro ?>" name="lista" required />
												 		<datalist id="list_parametros">
												 			<?php foreach(Muestras::getCodigosPar()  as $codigo) : ?>
												 			<option><?php echo $codigo['Codigo'] ?> </option>
												 			<?php endforeach ; ?>	
												 		</datalist>			
												 	</td>
												 	<td id="<?php echo 'Area'.$Nro ?>" 		class="DParametro"> </td>
												 	<td id="<?php echo 'Categoria'.$Nro ?>" class="DParametro"> </td>
												 	<td id="<?php echo 'Clase'.$Nro ?>" 	class="DParametro"> </td>
												 	<td id="<?php echo 'Parametros'.$Nro?>" class="DParametro"> </td>
												 	<td id="<?php echo 'Limite'.$Nro ?>" 	class="DParametro"> </td>
												 	<td id="<?php echo 'Metodo'.$Nro ?>" 	class="DParametro"> </td>
												 	<td id="<?php echo 'Referencia'.$Nro?>" class="DParametro"> </td>
												</tr>
												<tr>
													<td> <div>&nbsp;</div></td>
												</tr>
												<tr>
													<th colspan=""  class="param-data-15">  Acta de recolección       </th>
												 	<th colspan="2" class="param-data-15"> 	Descripción de la muestra </th>
												 	<th colspan="2" class="param-data">		Observación de la toma	  </th>
												 	<th colspan="2" class="param-data">		Hora de recolección		  </th>
												 </tr>
												<tr>
													<td colspan="" > <input type="text" class="form-control blanck acta"  value="" id="<?php echo 'acta'.$Nro ?>"/>		  </td>
												 	<td colspan="2" > <input type="text" class="form-control blanck descripcion" value="" id="<?php echo 'descripcion'.$Nro ?>"/>  </td>
												 	<td colspan="2" > <input type="text" class="form-control blanck observacion" value="" id="<?php echo 'observacion'.$Nro ?>"/>  </td>
												 	<td colspan="2" > <input type="time" class="form-control blanck hora_rec" 	 value="" id="<?php echo 'hora_rec'.$Nro ?>"/>  </td>
												 </tr>
												 <tr style="border-top:0px solid #000;">
											 	 	<td align="center" colspan="10" >
											 	 	<div style="padding:10px; border-bottom:1px solid #FFF;">
											 	 		<span class="text-primary"><strong>Condición de la muestra e información complementaria</strong></span>
													</div>
											 	 	</td>
											 	 </tr>
											 	 <tr>
											 	 	<th class="param-data">Temperatura de ingreso		</th>
											 	 	<th class="param-data">Lote							</th>
											 	 	<th class="param-data">Fecha de producción			</th>
											 	 	<th class="param-data">Fecha de vencimiento 		</th>
											 	 	<th class="param-data">Cantidad						</th>
											 	 	<th class="param-data" colspan="2">Tipo de empaque	</th>	
											 	 </tr>
											 	 <tr>
											 	 	<td class="param-data-15">
											 	 		<div class="input-group">
														  <input type="text" class="form-control blanck temperatura" aria-label="Celcius" id="<?php echo 'temperatura'.$Nro ?>">
														  <span class="input-group-addon">ºC</span>
														</div> 
													</td>
											 	 	<td><input type="text" class="form-control blanck lote" id="<?php echo 'lote'.$Nro ?>" required /> </td>
											 	 	<td><input type="date" class="form-control input-control<?php echo $Nro ?> fecha-prod" id="<?php echo 'fecha-prod'.$Nro ?>"/> </td>
											 	 	<td><input type="date" class="form-control input-control<?php echo $Nro ?> fecha-venc" id="<?php echo 'fecha-venc'.$Nro ?>"/> </td>
											 	 	<td>											 	 		
											 	 		<div class="input-group">
														  <input type="text" class="form-control blanck input-control<?php echo $Nro ?> cantidad" aria-label="gramos" id="<?php echo 'cantidad'.$Nro ?>"/>
														  <span class="input-group-addon">g</span>
														</div> 
											 	 	<td  colspan="2"><input type="text" class="form-control blanck input-control<?php echo $Nro ?> empaque" id="<?php echo 'empaque'.$Nro ?>"/> </td>
											 	 </tr>
											 </table>
											
										</td>  
									</tr>
										
									</tr> <!-- Final Fila base -->
								<tr> <td> <div style=""> </div> </td> </tr>
		*/ ?>
		</div>
	    
	    <div class="modal-footer">
	    	<button type="submit" class="btn btn-success" id="Add">Agregar</button>
	    	<button type="button" class="btn btn-danger"  data-dismiss="modal">Cerrar</button>
	    </div>
 	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
 