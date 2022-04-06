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
$view->muestras       = Muestras::getMuestraList($desde, $hasta); // tree todos los clientes

?>
<style>
	.factura{
		width: 120px;
		background: transparent;
		font-weight: bold;
		font-size: 0.9em;
		color: red;
	}
	input[type="number"]:focus
	 {
		background: #fff;
	}
</style>
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
							Fecha de ingreso
						</th>
						<th class="head" data-hide="phone">
							N. Factura
						</th>
						<th class="head hide" colspan="3" >
								Acción
						</th>
				</thead>

				<tbody>

					<?php foreach ($view->muestras as $muestra):  // uso la otra sintaxis de php para templates 
						$id= $muestra['Id'];
					?>
						<tr>
							<td>
								<?php echo $muestra['Codigo']; ?>
							</td>
							<td>
								<?php echo $muestra['Nombre_cliente'];?>
							</td>
							<td>
								<?php echo $muestra['Fecha_Ingreso'];?>
							</td>
							<td>
								<input class="form-control factura" id="<?php echo 'id-'.$muestra['Id'] ?>" onchange ="editarF('<?php echo $muestra['Id'] ?>')" type="number" value="<?php echo Muestras::getFacturas($muestra['Codigo']) ?>">
								<?php //echo $muestra['Fecha_Recoleccion'];?>
							</td>
							<td class="hide" style="width:40px; padding-left:1px padding-right:1px">
								<a class="editMuestra" data-id="<?php echo $muestra['Id']; ?>" onClick="editarF('<?php echo $muestra['Id'] ?>')"> 
									<div class="btn btn-primary glyphicon glyphicon-pencil" data-toggle="modal" data-placement="top" title="Editar muestra" style="margin-top: 0px;" ></div>
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>	
				<div id="cargando_l" class="">
					<div class="text-center text-primary">
						<i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>
				</div>
			</div>
		</div>
		
		    <script src="../js/jquery-2.2.2.min.js"></script>
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