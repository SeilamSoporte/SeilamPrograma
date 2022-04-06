<?php 

if(isset($_POST['refresh'])){
	$desde  = "'".($_POST['desde'])."'";
	$hasta  = "'".($_POST['hasta'])."'";
	include ("../clases/clasesMuestras.php");
	$view = new stdClass(); 	
}
else{
	$desde  = "'".$año_d."-".$mes_d."-".$dia_d."'";
	$hasta  = "'".$año."-".$mes."-".$dia_h."'";
}
	$L_clientes  = new Clientes();
	$L_clientes -> get_Clientes();

$view->muestras       = Muestras::getMuestraList($desde, $hasta); // tree todos los clientes

function RamdonChar($leng){
	return substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0,$leng);	
} 

 ?>

		<div class="panel panel-primary">
			<div class="panel-heading"><strong>Lista de muestras</strong></div>
			<div id="tabla-muestras">
			
			<table class="table table-hover footable" data-filter="#filter">	
				<thead>
					
						<th class="head" data-class="expand">
							Código de ingreso
						</th>
						<th class="head" data-hide="phone">
							Cliente
						</th>
						<th class="head" data-hide="phone">
							Sede
						</th>
						<th class="head" data-hide="phone">
							Fecha de ingreso
						</th>
						<th class="head" data-hide="phone">
							Fecha de recolección
						</th>
						<th class="head" colspan="3" >
							Editar
						</th>					
				</thead>
				<tbody>
					
						
					<?php foreach ($view->muestras as $muestra):  // uso la otra sintaxis de php para templates 
						$token = rand(765000,9999999);
						$token2= rand(255,765000);
						$idArray = getdate();
						$idSend= $idArray['hours'].$idArray['wday'].$idArray['mon'];
						$view->L_Sedes = Clientes::getSedes($muestra['Cliente']);
						$sedes   	 = $view->L_Sedes;
						$sedes   	 = isset($sedes[0]['Sede']) ? $sedes[0]['Sede'] :'' ;
						$sedes   	 = explode('|',$sedes);
						if ($muestra['Sede'] == 100){
							$sede   	 = 'No aplica';
						}
						else{
							$sede   	 = $sedes[$muestra['Sede']];
						}
						
						$id= $muestra['Id'];
						$link  = "templates/editMuestra.php?i-t=".$id.RamdonChar(5)."&t-ram=".$token.RamdonChar(5)."&t-s=".$token2.RamdonChar(10)."&s=".$idSend;
					?>
						<tr>
							<td><?php echo $muestra['Codigo']; ?></td>
							<td style="max-width:500px;"><?php echo $muestra['Nombre_cliente'];?></td>
							<td><?php echo $sede;?></td>
							<td><?php echo $muestra['Fecha_Ingreso'];?></td>
							<td><?php echo $muestra['Fecha_Recoleccion'];?></td>
							<td style="width:40px; padding-left:1px padding-right:1px">
								<a class="editMuestra" id="editarMuestra" data-id="<?php echo $muestra['Id']; ?>" href="<?php echo $link?>"> 
									<div class="btn btn-primary glyphicon glyphicon-pencil" data-toggle="modal" data-placement="top" title="Editar muestra" id="editMuestra" style="margin-top: 0px;" ></div>
								</a>
							</td>
							<td style="padding-left:1px; padding-right:1px" colspan="2">
								<a class="delete hide" id="eliminarMuestra" data-id="<?php echo $muestra['Id'];?>">
									<div data-toggle="modal"  data-target="#confirma" title="Eliminar muestra" class="btn btn-danger fa fa-times"></div>
								</a>
							</td>
						</tr>
						
					<?php endforeach; ?>		
				</tbody>
			</table>	
		</div>
		
		    <script src="../js/jquery-2.2.2.min.js"></script>
			</div>
		    <script src="../js/jq-ui/jquery-ui.js"></script>
			<script src="../js/bootstrap.min.js"></script>
			<script src="../js/bootstrap-dialog.min.js"></script>
			<script src="../js/footable/footable.js"></script>
			<script src="../js/footable/footable.sortable.js"></script>
			<script src="../js/footable/footable.filter.js"></script>
		
			<script>
				$(function() {
				  $('table').footable();
				});
			$(function () {
        		$('[data-toggle="modal"]').tooltip()
   			});
		</script>	