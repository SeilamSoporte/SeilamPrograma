		
		<div class="panel panel-primary">
			<div class="panel-heading"><strong>Lista de Usuarios</strong></div>
			<div id="tabla-usuarios">
			
				<table class="table table-hover">
					<thead>
						<tr>
							<th data-hide="phone,tablet">
								Id
							</th>
							<th data-hide="phone,tablet">
								Usuario
							</th>
							<th data-class="expand" data-sort-initial="true">
								Nombre y apellidos
							</th>
							<th data-hide="phone">
								Cargo
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
					
					<?php foreach ($view->usuarios as $usuario):  // uso la otra sintaxis de php para templates ?>
						<?php if ($usuario['id']!=1)  { ?>
						<tr>
							<td><?php echo $usuario['id']; ?></td>
							<td><?php echo $usuario['username'];?></td>
							<td><?php echo $usuario['Nombre']. " " .$usuario['Apellido'];?></td>
							<td><?php echo $usuario['Cargo'];?></td>
							<td><?php echo $usuario['email'];?></td>
							<td style="width:40px">
								<a class="editUsuario" data-id="<?php echo $usuario['id']; ?>" > 
									<div class="btn btn-primary glyphicon glyphicon-pencil" data-toggle="modal" data-placement="top" title="Editar usuario" id="editUsuario" data-target="#FormUsuario"></div>
								</a>
							</td>
							<td style="width:40px">
								<a class="delete" id="eliminarUsuarios" data-id="<?php echo $usuario['id'];?>">
									<div data-toggle="modal"  data-target="#confirma" title="Eliminar usuario" class="btn btn-danger fa fa-times"></div>
								</a>
							</td>
						</tr>  
					<?php } endforeach; ?>
								
					</tbody>
				</table> 
			</div>
		</div>
