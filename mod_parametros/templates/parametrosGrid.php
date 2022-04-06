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
		case '12':
			return "Aceptable";
		break;	
		case '13':
			return "Fondo visible";
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
			
			<table class="table table-hover footable" style="display: none" data-filter="#filter">	
				<thead>
					
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
				<tbody id="tbody-parametros">
					
				</tbody>
			</table>
			
			<div id="cargando">
				<div class="text-center text-primary">
					<i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i>
					<span class="sr-only">Loading...</span>
				</div>
			</div>	
			</div>
		</div>
