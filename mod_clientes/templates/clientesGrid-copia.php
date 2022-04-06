				
				<div id="cargando" > 
					<div id="layerc_load">		
						<div id="loading" style="text-align:center; width: 100%;">
							<img src="../imgs/ajax-loader.gif">
						</div>
					</div>
				</div>

				<table data-filter="#filter" class="table table-hover" style="display:none">
					<thead>
						<tr>
							<th data-hide="phone">
								Id
							</th >
							<th data-class="expand" data-sort-initial="true">
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
					
					<?php foreach ($view->clientes as $cliente) { // uso la otra sintaxis de php para templates ?>
						<tr>
							<td><?php echo $cliente['Id']; ?></td>
							<td><?php echo $cliente['Empresa'];?></td>
							<td><?php echo $cliente['Telefono'];?></td>
							<td><?php echo $cliente['Ciudad'];?></td>
							<td><?php echo $cliente['Email'];?></td>
							<td data-hide="phone">
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
					<?php } ?>		
					</tbody>
				</table> 
	