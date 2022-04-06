<?php 

if(isset($_POST['refresh'])){
 	$desde  = "'".($_POST['desde'])."'";
	$hasta  = "'".($_POST['hasta'])."'";
 	$fdesde  = ($_POST['desde']);
	$fhasta  = ($_POST['hasta']);
	include ("../clases/clasesResultadosMB.php");
	$view = new stdClass(); 	
}
else{
	$desde  = "'".$año_d."-".$mes_d."-".$dia_d."'";
	$hasta  = "'".$año_h."-".$mes_h."-".$dia_h."'";
	$fdesde = $año_d."-".$mes_d."-".$dia_d;
	$fhasta = $año."-".$mes."-".$dia_h;	
}

$view->muestras = Muestras::getMuestraList($desde, $hasta); // tree todos los clientes

function RamdonChar($leng){
	return substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0,$leng);	
} 

?>
		<div id="SendForm"></div>
		
		<div class="panel panel-primary">
			<div class="panel-heading"><strong class="text-uppercase">Ingreso de resultados - Microbiológicos</strong></div>
			<div id="tabla-muestras">
			
			<table class="table table-hover footable" data-filter="#filter">	
				<thead>
					
						<th class="head" data-class="expand">
							Código de ingreso
						</th>
						<th class="head" data-hide="phone">
							Fecha de ingreso
						</th>
						<th class="head" data-hide="phone">
							Fecha de recolección
						</th>
						
						<th class="head" colspan="" >
							Editar resultados
						</th>
					
				</thead>
				<tbody>
					<?php foreach ($view->muestras as $muestra):  // uso la otra sintaxis de php para templates 
						$token = rand(765000,9999999);
						$token2= rand(255,765000);
						
						$id= ($muestra['Id']*$token)+$token2;
					?>
						<tr>
							<td><?php echo $muestra['Codigo']; ?></td>
							<td><?php echo $muestra['Fecha_Ingreso'];?></td>
							<td><?php echo $muestra['Fecha_Recoleccion'];?></td>
							<td style="text-align: center">
								<a class="edit" id="editarResultados" data-id="<?php echo $muestra['Id']; ?>" desde="<?php echo $fdesde; ?>" hasta="<?php echo $fhasta; ?>"> 
									<div class="btn btn-primary glyphicon glyphicon-pencil" data-toggle="modal" data-placement="top" title="Editar resultados" id="editResultados" style="margin-top: 0px;" ></div>
								</a>
							</td>
						</tr>
					<?php endforeach; ?>		
				</tbody>
			</table>	
			</div>
		</div>
		    <script src="../js/jquery-2.2.2.min.js"></script>
		    <script src="../js/jq-ui/jquery-ui.js"></script>
			<script src="../js/bootstrap.min.js"></script>
			<script src="../js/bootstrap-dialog.min.js"></script>
			<script src="../js/footable/footable.js"></script>
			<script src="../js/footable/footable.sortable.js"></script>
			<script src="../js/footable/footable.filter.js"></script>
			<script src="js/fnc_loadRes.js"></script>