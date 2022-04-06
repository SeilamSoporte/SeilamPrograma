<?php

	include_once ("../clases/clasesParametros.php");
	$action 	= isset($_POST['action']) ? $_POST['action']: '';
	$id			= isset($_POST['id']) ? $_POST['id']: '0';

	$D_Parametros= new Parametros();
	$D_Parametros->Parametro($id);
	$ListaClases = new Parametros();

	$ListaClases    = Parametros::Lista_Clases();
	$ListaCategoria = Parametros::Lista_Categoria();
	$ListaParametro = Parametros::Lista_Parametros();
	$ListaEquipos   = Parametros::Lista_Equipos();
?>

	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Detalles de parametro</h4> 
			</div>	  
			
			<div class="modal-body">
				<form action="#" id="FormParams" method="post" enctype="multipart/form-data">
					<div class="panel panel-primary" > 
						<div class="panel-heading" style="text-align:center"><strong>PARAMETRIZACIÓN DE MUESTRA</strong></div>
						<div class="panel-body">
			

							<div class="row">
								<div class="col col-in col-md-8">
									<label for="Codigo">Código</label>
									<input type="text" name="Codigo" id="Codigo" class="form-control" placeholder="Código" value="<?php echo $D_Parametros->Codigo ?>" />
								</div>
								<div class="col col-in col-md-4">
									<label for="Area">Área de análisis</label>
									<select class="form-control" name="Area" id="Area">
										<?php echo "<option " . ($D_Parametros->Area == '' ? "selected " : '') . "value=''> </option>";?>
										<?php echo "<option " . ($D_Parametros->Area == "Microbiológico" ? "selected " : '') . "value='Microbiológico'>Microbiológico</option>";?>
										<?php echo "<option " . ($D_Parametros->Area == "Fisicoquímico" ? "selected " : '') . "value='Fisicoquímico'>Fisicoquímico</option>";?>
									</select>
								</div>
						    </div>
							<div class="row row-2">
								<div class="col col-in col-md-4">
									<label for="Categoria">Categoría de muestra</label>
										<select class="form-control" id="Categoria" >
											<?php foreach ($ListaCategoria as $Categorias) { ?>
												<?php echo '<option '.($D_Parametros->Categoria==$Categorias["Id"] ? "selected" : '').' value="'.$Categorias["Id"].'"> '. $Categorias["Categoria"]. ' </option>'; ?>
											<?php } ?>
										</select>
								</div>
								<div class="col col-md-4">
									<label for="Clase">Clase de muestra</label>
										<select class="form-control" id="Clase" >
											<?php foreach ($ListaClases as $Clases) { ?>
												<?php echo '<option '.($D_Parametros->Clase==$Clases["Id"] ? "selected" : '').' value="'.$Clases["Id"].'"> '. $Clases["Clase"]. ' </option>'; ?>
											<?php } ?>
										</select>
								</div>
								<div class="col col-md-4">
										<label for="btn-agregar"> &nbsp;</label><br>
										<button style="width:100%" type="button" class="btn btn-primary" id="btn-agregar"> Agregar parámetro</
								</div>
							</div> <!-- Row -->
						</div>	<!-- Panel Body -->
							
						<div class="table-responsive">
							<table class="table table-hover" id="tabla" >
								<thead>
									<tr  class="info">
										<th class="th-1">Párametro				</th>
										<th class="th-2">Norma de referencia	</th>
										<th class="th-1 comp">Comparador		</th>
										<th class="th-2 lim">Límites permisibles</th>
										<th class="th-2">Método de ensayo		</th>
										<th class="th-2">Referencia del método	</th>
										<th class="th-3">Tipo </th>
										<th class="th-1">Equipo </th>
										<th class="th-1">Solución titulante </th>
										<th> </th>
									</tr>
								</thead>
								<tbody>
									<?php 
									if( $id != 0){
										$N=0;
										$i=0;
												//foreach ($view->contactos as $Contacto):
												//$N = count(explode("|", $D_Parametros->Parametro));
										$Parametro_d= explode("|", $D_Parametros->Parametro);
										$Norma		= explode("|", $D_Parametros->Norma);
										$Comparador	= explode("|", $D_Parametros->Comparador);
										$Limite 	= explode("|", $D_Parametros->Limite);
										$Metodo 	= explode("|", $D_Parametros->Metodo);
										$Referencia	= explode("|", $D_Parametros->Referencia);
										$Tipo		= explode("|", $D_Parametros->Tipo);
										$Equipos 	= explode("|", $D_Parametros->Equipo);
										$Limite 	= explode("|", $D_Parametros->Limite);
										$Solucion 	= explode("|", $D_Parametros->Solucion);
										$N = count($Parametro_d);
										for ($i==0; $i<$N ; $i++)
										{
											$L=$i*3;	
										?>
								    <!-- fila base para clonar y agregar al final -->
									<tr class="fila-base">
										<td class="td-1"> 					  	
										<select class="form-control form-control-param select-in Parametro" id="Parametro" data-id="<?php echo $N ?>">
											<?php foreach ($ListaParametro as $Parametro) { ?>
												<?php echo '<option '.($Parametro_d[$i]==$Parametro["Id"] ? "selected" : '').' value="'.$Parametro["Id"].'"> '. $Parametro["Nombre"]. ' </option>'; ?>
											<?php } ?>
										</select>
								
										<td class="td-1">
											<input type="text" id="Norma" class="form-control form-control-param Norma" placeholder="Norma" value="<?php echo $Norma[$i] ?>" />
										</td>
										<td class="td-1">
											<select class="form-control  form-control-param Comparador" id="Comparador" data-id="<?php echo $i ?>">		
												<?php echo "<option " . ($Comparador[$i] == "1" ? "selected " : '') . "value='1'> < </option>";?>
												<?php echo "<option " . ($Comparador[$i] == "2" ? "selected " : '') . "value='2'> > </option>";?>
												<?php echo "<option " . ($Comparador[$i] == "3" ? "selected " : '') . "value='3'> <= </option>";?>
												<?php echo "<option " . ($Comparador[$i] == "4" ? "selected " : '') . "value='4'> >= </option>";?>
												<?php echo "<option " . ($Comparador[$i] == "5" ? "selected " : '') . "value='5'> = </option>";?>
												<?php echo "<option " . ($Comparador[$i] == "6" ? "selected " : '') . "value='6'> Res/100mL </option>";?>
												<?php echo "<option " . ($Comparador[$i] == "7" ? "selected " : '') . "value='7'> Res/200mL </option>";?>
												<?php echo "<option " . ($Comparador[$i] == "8" ? "selected " : '') . "value='8'> Ausencia </option>";?>
												<?php echo "<option " . ($Comparador[$i] == "9" ? "selected " : '') . "value='9'> Negativo </option>";?>
												<?php echo "<option " . ($Comparador[$i] == "10" ? "selected " : '') . "value='10'>Rango </option>";?>
												<?php echo "<option " . ($Comparador[$i] == "11" ? "selected " : '') . "value='11'>No Especifica </option>";?>
												<?php echo "<option " . ($Comparador[$i] == "12" ? "selected " : '') . "value='12'>Aceptable </option>";?>
												<?php echo "<option " . ($Comparador[$i] == "13" ? "selected " : '') . "value='13'>Fondo visible </option>";?>
											</select>
										</td>
										<?php 
										if($Comparador[$i]==10)
										{
											$displayL = "none";
											$displayM = "inline";
										}
										else
										{
											$displayL = "inline";
											$displayM = "none";	
										} 
										?>		
										<td class="td-1"> 
											<input type="number" style="display:<?php echo $displayL ?>" id="<?php echo 'Limite'.$i ?>" min="0" class="form-control form-control-param Limite" placeholder="Limites" value="<?php echo $Limite[$L] ?>" />
											
											<input type="number" style="display:<?php echo $displayM ?>" id="<?php echo 'Min'.$i ?>" min="0" class="form-control form-control-param Limite Min" placeholder="min" value="<?php echo $Limite[$L+1] ?>" />
											<input type="number" style="display:<?php echo $displayM ?>" id="<?php echo 'Max'.$i ?>" min="0" class="form-control form-control-param Limite Max" placeholder="max" value="<?php echo $Limite[$L+2] ?>" />		
										</td>
										<td class="td-1">
											<input type="text" id="Metodo" class="form-control form-control-param Metodo" placeholder="Método" value="<?php echo $Metodo[$i] ?>" />
										</td>
										<td class="td-1">
											<input type="text" id="Referencia" class="form-control form-control-param Referencia" placeholder="Referencia" value="<?php echo $Referencia[$i] ?>" />
										</td>
										<td class="td-3">
											<select name="" class="form-control  form-control-param Tipo" id="">
												<?php echo "<option " . ($Tipo[$i] == '1' ? "selected " : '') . "value='1'>MB</option>";?>
												<?php echo "<option " . ($Tipo[$i] == '2' ? "selected " : '') . "value='2'>FQ</option>";?>
												<?php echo "<option " . ($Tipo[$i] == '3' ? "selected " : '') . "value='3'>Vol</option>";?>
												<?php echo "<option " . ($Tipo[$i] == '4' ? "selected " : '') . "value='4'>Iones</option>";?>
												<?php echo "<option " . ($Tipo[$i] == '5' ? "selected " : '') . "value='5'>DC</option>";?>
											</select>
										</td>
										<td class="td-1">
											<select name="" class="form-control form-control-param Equipo" id="Equipo">
												<option value="0">NA</option>
												<?php foreach ($ListaEquipos as $Equipo) { ?>
												<?php echo "<option " . ($Equipos[$i] == $Equipo["Id"] ? "selected " : '') . "value=".$Equipo["Id"]."> ". $Equipo["Equipo"]." </option>";?>
												<?php } ?>
											</select>
										</td>
										<td class="td-1">
											<input type="text" class="form-control form-control-param Solucion" placeholder="Sol. titulante" value="<?php echo $Solucion[$i] ?>" />
										</td>

										<td class="eliminar td-3">
											<button type="button" class="btn btn-danger"  data-toggle="tooltip" data-placement="top" ria-label="Left Align" title="Eliminar">
												<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
											</button>	
										</td>
									</tr>  <!--Fila base-->			
									<!-- fin de código: fila base -->
									<?php 
											} //Fin de for 
										}// Fin de if 
										else{
												echo '<tr>';
												include("body_parametros_blank.php");
												echo '</tr>';
											}
										?>
										<!-- <tr id="fila_abajo"> </tr> -->
								</tbody>
								<tfoot>
									<tr>
										<td>&nbsp;</td>
									</tr>
								</tfoot>
							</table>
						</div> <!-- Table responsive -->
							
					</div> 
					</div>
				</form>
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
	    </div> 
	</div> 
		
		<div id="confirmacion">	</div>
	
	<script>
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		});
		$(function(){
	        $("#Clase").chosen({ 
	            no_results_text: "No se encuentra:", 
	            disable_search_threshold:4
	        });
	    });
		$(function(){
	        $(".Parametro").chosen({ 
	            no_results_text: "No se encuentra:", 
	            disable_search_threshold:4
	        });
	    });	    
	    $(function(){
	    	$(".Comparador") .each(function(i){ 
	    		if ($(this).val()>7)
	    		{
	    			id = $(this).attr('data-id');
	    			$('#Limite'+id).prop('disabled',true);
	    		} 
	    	});
	    });
	</script>



