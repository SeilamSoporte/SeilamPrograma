		<style>	
		.resultado{
			max-width: 150px !important;
		}
		.table{
			width: 100%;
		}
		.opciones{
			margin-left: 5px;
			margin-right: 5px; 
		}
		fieldset{
			margin: 0;
		}
		</style>		
		
		<?php
		function buscar($strp, $pal1, $pal2){
			$found 		= false; 
			$palabras[0]= "/".$pal1."\b/i";
			$palabras[1]= "/".$pal2."\b/i";
			foreach ($palabras as $i => $palabra) {
				if (preg_match($palabra, $strp))
				{
					$found = true;
				}
			}
			return $found;

		}
			date_default_timezone_set('America/Bogota');
			include_once("../resources/fn_limites.php") ; 
			$Called   = isset($_POST["call"]) ? $_POST["call"] : false ;
			$new	  = isset($_POST["new"]) ? $_POST["new"] : false ;
			if ($Called){
				$Nro  = $_POST["Nro"];
				$id   = $_POST["id"];
				include_once ("../clases/clasesResultadosMB.php");
				$Det_Muestras= new Muestras();
				$view 	   	 = new stdClass(); 
			}
			$Det_Muestras->DetallesMuestras($id,$Nro);
			$parametrizacion = Muestras::getParametrizacion($Det_Muestras->Parametro)[0];
			$comparador 	 = explode('|', $parametrizacion['Comparador']);
			$Det_Muestras    ->getCategoria($parametrizacion['Categoria'] );
			$Categoria 		 = $Det_Muestras->Categ; 
			$Det_Muestras    ->getClase($parametrizacion['Clase'] );
			$Clase 			 = $Det_Muestras->Clase;
			$Descripcion     = $Det_Muestras->Descripcion;
			
			$Caracteristicas = Muestras::getCaracteristicas($id, $Nro);
			$Caracteristicas = explode("|",$Caracteristicas);
			$color 			 = isset($Caracteristicas[0]) ? $Caracteristicas[0] : '';
			$olor 			 = isset($Caracteristicas[1]) ? $Caracteristicas[1] : '';
			$aspecto		 = isset($Caracteristicas[2]) ? $Caracteristicas[2] : '';

			$resultadosArr   = Muestras::getResultados($id, $Nro);
			$resultados      = isset($resultadosArr[0]) ? $resultadosArr[0]['Resultados'] : '';
			$incertidumbres      = isset($resultadosArr[0]) ? $resultadosArr[0]['Incertidumbres'] : '';
			$ResComparador 	 = isset($resultadosArr[0]) ? $resultadosArr[0]['ResComparador'] : '';
			$ResComparador	 = explode("|",$ResComparador);
			$estado 		 = isset($resultadosArr[0]) ? $resultadosArr[0]['Estado'] : 'No reportado';
			$fecha 			 = isset($resultadosArr[0]) ? $resultadosArr[0]['Fecha'] : '';
			$fechaR			 = $fecha;
			$estado 		 = ($estado=="") ? 'No reportado' : $estado;
			$fecha 			 = ($fecha==0) ? '' : " - Fecha:".$fecha; 
			#Variables por dafault
			$hidden ="";
			$Type='number';
			$disabled='';
			$field_disabled= ($estado == 'Reportado') ? 'disabled' : '';
			if (buscar($Categoria, "conrtrol", "higiene")){ $hidden ="oculto";}
			?>

		<div class="col col-md-12">
			<div class="form-muestra">
				<div class="row filas">
					<div class="col col-md-12 titulo">					
						<span style="color:red" class="num" cons-id="<?php echo $Det_Muestras->Consecutivo;?>" data-id="<?php echo $id ?>"><strong>Código de Muestra <?php echo str_pad($id,4,"0",STR_PAD_LEFT ).'-'.$Det_Muestras->Consecutivo; ?> </strong></span>
						<br><span class="estado hide"> (<?php echo $estado . $fecha ?>) </span>
						<br>
						<!--
						<button type="button" class="btn btn-primary opciones reportar <?php echo $field_disabled ?>" cons-id="<?php echo $Det_Muestras->Consecutivo;?>" data-id="<?php echo $id ?>" data-toggle="modal" data-target="#informacion_g">
						  <span class="glyphicon glyphicon-check" aria-hidden="true">&nbsp;</span>
						  <span class="bt">Marcar Como Reportado</span>
						</button> 
						-->

						<button type="button" class="btn btn-primary opciones hide" id="" >
						  <span class="glyphicon glyphicon-copy" aria-hidden="true">&nbsp;</span>
						  <span class="bt">Generar Suplemento</span>
						</button>
					</div>
				</div>
			<fieldset <?php echo $field_disabled ?> >
			<!--
					<div class="row caracteristicas">
						<div class="col col-xs-12 th text-primary subtitulo">Características Organolépticas</div>
						<div class="col col-xs-4 th " > Color	 </div>
						<div class="col col-xs-4 th " > Olor	 </div>
						<div class="col col-xs-4 th " > Aspecto</div>
					</div>
					-->
					<div class="row">
						<div class="col col-xs-4"><input type="hidden" class="form-control organ" id="color"   value="<?php echo $color ?>"  >  </div>
						<div class="col col-xs-4"><input type="hidden" class="form-control organ" id="olor"    value="<?php echo $olor ?>"  >	</div>
						<div class="col col-xs-4"><input type="hidden" class="form-control organ" id="aspecto" value="<?php echo $aspecto ?>"  >  </div>
						<div class="col col-xs-4">

						<span class="th">Fecha de ensayo:</span>
						<input type="text" id="fechaR" class="form-control fechaR fechasJQ" style="width:10em;" value="<?php echo $fechaR ?>">

						</div>
					</div>	

				<div class="row filas parametros">
					<div class="col colp col-md-2 col-sm-4 form-primer">
						<div class="col colp col-md-12 th text-primary">Área de análisis </div>
						<div class="col colp col-md-12 td" id="area"><?php echo $parametrizacion['Area'] ?></div>
					</div>
					
					<div class="col colp colp col-md-3 col-sm-4 form-input">
						<div class="col colp col-md-12 th text-primary">Categoría de muestra </div>
						<div class="col colp col-md-12 td" id="categoria"><?php echo $Categoria ?></div>
					</div>
					<div class="col colp col-md-3 col-sm-4 form-input">
						<div class="col colp colp col-md-12 th text-primary">Clase de muestra </div>
						<div class="col colp col-md-12 td" id="clase"><?php echo $Clase ?></div>
					</div>
					<div class="col colp col-md-3 col-sm-4 form-input <?php echo $hidden ?>">
						<div class="col colp colp col-md-12 th text-primary">Descripción de la muestra </div>
						<div class="col colp col-md-12 td" id="clase"><?php echo $Descripcion ?></div>
					</div>
				</div>
				<div class="row filas parametros">
				<table class="table">
					<thead>
						<tr>
							<th class="td-parametro">
								<span class="th text-primary ">Parámetros</span>
							</th>
							<th class="td-resultado">
								<span class="th text-primary ">Resultado</span>
							</th>
							<th class="td-resultado">
								<span class="th text-primary">Incertidumbre</span>	
							</th>
							
						</tr>
					</thead>

					<tbody>
						<?php
							$Results = (!empty($resultados)) ? explode("|",$resultados) : ''; 
							$Incerts = (!empty($incertidumbres)) ? explode("|",$incertidumbres) : ''; 
							if (count($Results)<=1){
								$Results[0]=$resultados;
								$Incerts[0]=$incertidumbres;
							}
							$i=0;
							
							$NombreParametro=array();
							foreach (explode("|", $parametrizacion['Parametros']) as $p => $param) {
								$NombreParametro[$p] = Muestras::getParametros($param)[0]['Nombre'];
							}	
						?>

						<?php 
							$Tipos = explode("|",$parametrizacion['Tipo']);
							foreach ($Tipos as $t => $Tipo) {
							if ($Tipo!=5){ 
								$Resultado 		= isset($Results[$i]) ? $Results[$i]:'';
								$Incertidumbre= isset($Incerts[$i]) ? $Incerts[$i]:'';
						?>

						<tr>
							<td class="td-parametro">
								<span class="ui-menu-icon ui-icon ui-icon-triangle-1-e"></span> <?php echo $NombreParametro[$t] ?>
							</td>
							<td class="td-resultado">
							<?php 
							$ResComparador[$i] = isset($ResComparador[$i]) ? $ResComparador[$i] : 0;
							switch ($comparador[$t]) {
							 	case '1':
							 	case '2':
							 	case '3':
							 	case '4':
							 	case '5':
							 	case '6':
							 	case '7':
							 	case '10':
							 	case '11':
								?> 		
									<div class="input-group">
										<span class="input-group-addon" >
											<select class="form-control addon ResComparador" data-id="<?php echo $i ?>"> 
												<option <?php echo ($ResComparador[$i]=='1') ? 'selected': ''?> value="1"> = </option>
												<option <?php echo ($ResComparador[$i]=='2') ? 'selected': ''?> value="2"> < </option>
												<option <?php echo ($ResComparador[$i]=='3') ? 'selected': ''?> value="3"> > </option>
												<option <?php echo ($ResComparador[$i]=='4') ? 'selected': ''?> value="4"> Incont </option>
											</select>	
										</span>
										<?php if(isset($ResComparador[$i])){
											$Type 	  = ($ResComparador[$i]==4) ? 'text'  	: 'number';
											$disabled = ($ResComparador[$i]==4) ? 'disabled'  : ''; 
										}
										?> 
										<?php //$Type 	= ($ResComparador[$i]==4) ? 'text'  	: 'number'; ?>
										<?php //$disabled = ($ResComparador[$i]==4) ? 'disabled'  : ''; ?>
										  <input type="<?php echo $Type ?>" class="form-control resultado" id="<?php echo 'resultado'.$i ?>" value="<?php echo $Resultado ?>" <?php echo $disabled ?> >
									</div>
								<?php 	
							 		break;
							 	case '8':
								?> 		
									<div class="input-group"> 
											<span class="input-group-addon">
												<select class="form-control addon ResComparador" data-id="<?php echo $i ?>"> 
													<option value="1"> = </option>
												</select>	
											</span>
										<!-- <input type="text"  class="form-control ResComparador" value="1"> -->
										<select type="text" class="form-control resultado" style="width:150px" id="<?php echo 'resultado'.$i ?>"> 
											<option value="">	</option>
											<option <?php echo ($Resultado=='Ausencia') ? 'selected' : '' ?> value="Ausencia">Ausencia </option>
											<option <?php echo ($Resultado=='Presencia') ? 'selected' : '' ?> value="Presencia">Presencia</option>
										</select>	
									
									</div>
								<?php 	
									break;							 		
							 	case '9':
								?> 		
								<div class="input-group">
									<span class="input-group-addon">
										<select class="form-control addon ResComparador" data-id="<?php echo $i ?>"> 
											<option value="1000"> = </option>
										</select>	
									</span>
									<select type="text" class="form-control resultado" style="width:150px" id="<?php echo 'resultado'.$i ?>"> 
										<option value="">	</option>
										<option <?php echo ($Resultado=='Negativo') ? 'selected' : '' ?> value="Negativo">Negativo </option>
										<option <?php echo ($Resultado=='Positivo') ? 'selected' : '' ?> value="Positivo">Positivo</option>
									</select>	
								</div>
								<?php 	
									break;		
								case '12':
								?> 		
								<div class="input-group"> 
									<span class="input-group-addon">
										<select class="form-control addon ResComparador" data-id="<?php echo $i ?>"> 
											<option value="1000"> = </option>
										</select>	
									</span>
									<select type="text" class="form-control resultado" style="width:150px" id="<?php echo 'resultado'.$i ?>"> 
										<option value="">	</option>
										<option <?php echo ($Resultado=='Aceptable') ? 'selected' : '' ?> value="Aceptable">Aceptable</option>
										<option <?php echo ($Resultado=='No aceptable') ? 'selected' : '' ?> value="No aceptable">No aceptable</option>
									</select>
								</div>	
								<?php 	
									break;						 		
								case '13':
								?> 		
								<div class="input-group"> 
									<span class="input-group-addon">
										<select class="form-control addon ResComparador" data-id="<?php echo $i ?>"> 
											<option value="1000"> = </option>
										</select>	
									</span>
									<select type="text" class="form-control resultado" style="width:150px" id="<?php echo 'resultado'.$i ?>"> 
										<option value="">	</option>
										<option <?php echo ($Resultado=='Fondo visible') ? 'selected' : '' ?> value="Fondo visible">Fondo visible </option>
										<option <?php echo ($Resultado=='Fondo no visible') ? 'selected' : '' ?> value="Fondo no visible">Fondo no visible</option>
									</select>
								</div>	
								<?php 	
									break;								 	
							 	default:
							 		# code...
							 		break;
							 } ?>

							</td>
							<td class="col-xs-3">
								<input type="<?php echo $Type ?>" class="form-control incertidumbre" id="<?php echo 'incertidumbre'.$i ?>" value="<?php echo $Incertidumbre ?>" <?php echo $disabled ?> >
							</td>
							<?php $i++; ?>		
						</tr>
						<?php } } ?>
					</tbody>
				</table>
			</div> <!-- row parametros -->
				 <!-- form-muestra -->
		</fieldset>
		</div>
		
	</div>

	 
	<script src="../js/fnc_panel.js"></script>
	