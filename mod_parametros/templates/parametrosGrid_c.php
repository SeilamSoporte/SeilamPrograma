<?php 


function Load_parametro($Id){
	$Det_Parametros= new Parametros();
	$Det_Parametros->getParametro($Id);
	echo $Det_Parametros->ListaParam;
}

function Load_limite($comparador,$limite){
	switch($comparador)
	{
		case '1':
			return "<".$limite;
		break;
		case '2':
			return ">".$limite;
		break;	
		case '3':
			return "<=".$limite;
		break;
		case '4':
			return ">=".$limite;
		break;
		case '5':
			return "=".$limite;
		break;
		case '6':
			return $limite."/100mL";
		break;
		case '7':
			return $limite."/250mL";
		break;
		case '8':
			return "Ausencia";
		break;
		case '9':
			return "Negativo";
		break;	
		case '10':
			return "Rango";
		case '11':
			return "No específica";
		break;	
	}
}

function ListaCategoria($Id){
	$Det_Parametros= new Parametros();
	$Det_Parametros->getCategoria($Id);
	echo $Det_Parametros->ListaCateg;
}
function ListaClase($Id){
	$Det_Clase= new Parametros();
	$Det_Clase->getClase($Id);
	echo $Det_Clase->ListaClase;
}
?>
		<div class="panel panel-primary">
			<div class="panel-heading"><strong>Lista de parametros</strong></div>
			<div id="tabla-parametros">
			
			<table class="table table-hover footable" data-filter="#filter">	
				<thead>
				<div id="cargando" class="hide">
					<div class="text-center text-primary">
						<i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>
				</div>		
						<th class="head" data-class="expand">
							Código
						</th>
						<th class="head" data-hide="phone">
							Área de análisis
						</th>
						<th class="head" data-hide="phone">
							Categoría de muestra
						</th>
						<th class="head" data-hide="phone,tablet">
							Clase de muestra
						</th>
						<th class="head" colspan="3" >
								Acción
						</th>
					
				</thead>
				<tbody>
					<?php foreach ($view->parametros as $parametro):  // uso la otra sintaxis de php para templates ?>
						<tr>
							<td><?php echo $parametro['Codigo']; ?></td>
							<td><?php echo $parametro['Area'];?></td>
							<td><?php ListaCategoria($parametro['Categoria']);?></td>
							<td><?php ListaClase($parametro['Clase']);?></td>
						
							<td style="width:40px;  padding-left:1px; padding-right:1px" >
								<a role="button" data-toggle="collapse" href="<?php echo '#collapsed'.$parametro['Id'] ?>" aria-expanded="false" aria-controls="<?php echo '#collapsed'.$parametro['Id'] ?>">
										<div class="btn btn-success glyphicon glyphicon-chevron-down" data-placement="top" title="Expandir" id="expandir" data-toggle="modal"></div>		
								</a>							
							</td>
							<td style="width:40px; padding-left:1px padding-right:1px">
								<a class="editParametro" id="editarParametro" data-id="<?php echo $parametro['Id']; ?>" > 
									<div class="btn btn-primary glyphicon glyphicon-pencil" data-toggle="modal" data-placement="top" title="Editar parámetro" id="editParametro" data-target="#FormParametro"></div>
								</a>
							</td>
							<td style="padding-left:1px; padding-right:1px">
								<a class="delete" id="eliminarParametro" data-id="<?php echo $parametro['Id'];?>">
									<div data-toggle="modal"  data-target="#confirma" title="Eliminar parametro" class="btn btn-danger fa fa-times"></div>
								</a>
							</td>
						</tr> 
			
						<tr>
						
						<td colspan="8" style="padding:0px; background-color: #f5f5f5;" >
						  <div class="collapse" id="<?php echo 'collapsed'.$parametro['Id'] ?>">
							<div class="collap">
								<?php  
									$Np=0;
									$Nl=0;
									$parametros 	= split("\|", $parametro['Parametros']);
									$normas		 	= split("\|", $parametro['Norma']);
									$comparadores	= split("\|", $parametro['Comparador']);
									$limites	 	= split("\|", $parametro['Limite']);
									$metodos		= split("\|", $parametro['Metodo']);
									$referencias	= split("\|", $parametro['Referencia']);
									
								?>	
								<div class="col col-xs-6 col-sm-3 col-md-4 highlight" >
									<div><strong>Parámetros</strong></div>
									<?php foreach ($parametros as $param){ ?>
										<div class="row fila">	
											<?php echo Load_parametro($param); ?>
											<?php //$Np++; ?>
										</div> 
									<?php }  $Np=0;?>
								</div>
								
								<div class="col col-xs-6 col-sm-3 col-md-2" >
									<div><strong>Norma</strong></div>
									<?php foreach ($parametros as $params){ ?>
										<div class="row fila">	
											<?php echo $normas[$Np] ?>
											<?php $Np++; ?>
										</div> 
									<?php } $Np=0;?>
								</div>
								<div class="clearfix visible-xs-block"> </div>

								<div class="col col-xs-6 col-sm-3 col-md-2">
									<div><strong>Límite</strong></div>
									<?php foreach ($parametros as $params): ?>
										<div class="row fila">	
											<?php 
											if ($comparadores[$Np]==10) {
											 	echo LoadLimite($comparadores[$Np], $limites[$Nl+1],$limites[$Nl+2]); }
											else{
												echo LoadLimite($comparadores[$Np], $limites[$Nl],'');
											}?>
											<?php
												$Np++; 
												$Nl=$Np*3; 
											?>
										</div> 
									<?php endforeach; $Np=0;?>
								</div>

								<div class="col col-xs-6 col-sm-3 col-md-2">
									<div><strong>Método</strong></div>
									<?php foreach ($parametros as $params): ?>
										<div class="row fila">	
											<?php echo $metodos[$Np] ?>
											<?php $Np++; ?>
										</div> 
									<?php endforeach; $Np=0;?>
								</div>

								<div class="col col-xs-6 col-sm-3 col-md-2">
									<div><strong>Referencia</strong></div>
									<?php foreach ($parametros as $params): ?>
										<div class="row fila">	
											<?php echo $referencias[$Np] ?>
											<?php $Np++; ?>
										</div> 
									<?php endforeach; $Np=0;?>
								</div>
									<!-- </tbody> 
								</table> -->
							</div>
						  </div>
						  </td>
						</tr>
						
					<?php endforeach; ?>		
				</tbody>
			</table>	
			</div>
		</div>
