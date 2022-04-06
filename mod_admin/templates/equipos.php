	
			<?php 
				include_once ("../clases/clasesAdmin.php");
				$datos 		= new Administrador();
				$datos      ->getDatos('equipos');
				$equipos    = $datos->Datos;
			?>

			<div class="panel-heading">
				EQUIPOS
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col col-md-6">
						<input type="text" name="equipo" id="text-equipo" class="form-control" placeholder="Escriba el nombre del equipo a agregar" />
					</div>
					<div class="col col--md-2">
						<button class="btn btn-success" id="add-equipo" data-toggle="modal" data-target="#informacion" ><span class="glyphicon glyphicon-plus"></span>&nbsp; Agregar</button>
					</div>
				</div>
				<div class="row">
					<div class="col col-md-6" id="table-equipo">
						<table class="table table-hover listado">
							<tr>
								<thead>
									<th>Id</th>
									<th>Equipo</th>
									<th colspan="2">Acción</th>
								</thead>
							</tr>
							<?php foreach ($equipos as $equipo) { ?>
							<tr>
							<tbody>
								<td data-id="<?php echo $equipo['Id']; ?>"><?php echo $equipo['Id']; ?></td>
								<td class="equipo"><?php echo $equipo['Equipo'] ?></td>
								<td style="width:40px; padding-left:1px; padding-right:5px;padding-top:4px;">
								<a class="editarEquipo" id="editarequipo" data-id="<?php echo $equipo['Id']; ?>" data-name="<?php echo $equipo['Equipo'] ?>"> 
									<div data-toggle="modal" class="btn btn-primary glyphicon glyphicon-pencil" data-placement="top" title="Editar nombre del equipo" id="editarEquipo style="margin-top: 0px;" ></div>
								</a>
								</td>
								<td style="padding-left:5px; padding-right:1px">
									<a class="delete hide" id="eliminarEquipo" data-id="<?php echo $equipo['Id']; ?>" data-name="<?php echo $equipo['Equipo'] ?>">
										<div data-toggle="modal" data-target="#informacion" title="Eliminar equipo" class="btn btn-danger fa fa-times"></div>
									</a>
								</td>
							</tr>
							<?php }	?>
							</tbody>
						</table>
					</div>

					<div class="col col-md-6 edit">
						<div class="box-edit">
							<p><input type="text" id="id-equipo" class="form-control id">
							<p><input type="text" id="input-equipo" class="form-control">
							<p><button class="btn btn-default btn-guardar" id="save-equipo"><span class="fa fa-save"></span>&nbsp; Guardar</button>
						</div>
					</div>

				</div>
			</div>
			
			<script src="./js/functions_panels.js"></script>