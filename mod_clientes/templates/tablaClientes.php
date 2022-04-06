
		<script src="../js/footable/footable.js"></script>
		<script src="../js/footable/footable.sortable.js"></script>
		<script src="../js/footable/footable.filter.js"></script>
		<script src="../js/footable/footable.paginate.js" ></script>
		<script src="./js/functions.js"></script>
 
		<script>
			$(function() {
			  $('.table').footable();
			  $('.table').paginate();
			});
		</script>
<?php
//echo $action = isset($_REQUEST['action']) ? $_REQUEST['action']: "xxxxxxxxxxxx";
//if ($action == "refresh")
{
	include_once ("../Clases/clasesClientes.php");
	$view= new stdClass(); 								// creo una clase standard para contener la vista 						
	$view->clientes=Clientes::getClientes(); 			// tree todos los clientes
}
?>
				<table data-filter="#filter" class="table table-hover">
					<thead>
						<tr>
							<th data-hide="phone">
								Id
							</th >
							<th data-class="expand" data-sort-initial="true" >
								Cliente
							</th>
							<th  data-hide="phone">
								Teléfono
							</th>
							<th data-hide="phone,tablet">
								Ciudad
							</th>
							<th data-hide="phone,tablet">
								Email
							</th>
							<th colspan="2">
								Acción
							</th>
						</tr>
					</thead>
					<tbody>
					
					<?php foreach ($view->clientes as $cliente):  // uso la otra sintaxis de php para templates ?>
						<tr>
							<td><?php echo $cliente['Id']; ?></td>
							<td><?php echo $cliente['Empresa'];?></td>
							<td><?php echo $cliente['Telefono'];?></td>
							<td><?php echo $cliente['Ciudad'];?></td>
							<td><?php echo $cliente['Email'];?></td>
							<td>
								<a class="editCliente" id="editarCliente" data-id="<?php echo $cliente['Id']; ?>" > 
									<div class="btn btn-primary glyphicon glyphicon-pencil" data-toggle="modal" data-placement="top" title="Editar cliente" id="editCliente" data-target="#FormCliente"></div>
								</a>
							</td>
							<td>
								<a class="delete" id="eliminarCliente" data-id="<?php echo $cliente['Id'];?>">
									<div data-toggle="modal"  data-target="#confirma" title="Eliminar cliente" class="btn btn-danger fa fa-times"></div>
								</a>
							</td>
						</tr>  
					<?php endforeach; ?>		
					</tbody>
				</table> 
		