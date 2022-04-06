<?php
include_once ("../clases/clasesUsuarios.php");
$view= new stdClass(); 						// creo una clase standard para contener la vista
$view->disableLayout=false;					// marca si usa o no el layout , si no lo usa imprime directamente el template
$view->usuarios=Usuarios::getUsuarios(); 	// trae todos los usuarios
?>
<table class="table table-hover">
					<thead>
						<tr>
							<th>
								Id
							</th>
							<th>
								Usuario
							</th>
							<th>
								Nombre y apellidos
							</th>
							<th>
								Cargo
							</th>
							<th>
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
				<script src="./js/functions.js"></script>