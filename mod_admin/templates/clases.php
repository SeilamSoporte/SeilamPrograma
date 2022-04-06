	
			<?php 
				include_once ("../clases/clasesAdmin.php");
				$datos 		= new Administrador();
				$datos      ->getDatos('lista_clases');
				$clases     = $datos->Datos;
			?>

			<div class="panel-heading">
				CLASES
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col col-md-6">
						<input type="text" name="clase" id="text-clase" class="form-control" placeholder="Escriba el nombre de la clase a agregar" />
					</div>
					<div class="col col--md-2">
						<button class="btn btn-success" id="add-class" data-toggle="modal" data-target="#informacion" ><span class="glyphicon glyphicon-plus"></span>&nbsp; Agregar</button>
					</div>
				</div>
				<div class="row">
					<div class="col col-md-6" id="table-clase">
						<table class="table table-hover listado">
							<tr>
								<thead>
									<th>Id</th>
									<th>Clase</th>
									<th colspan="2">Acción</th>
								</thead>
							</tr>
							<?php foreach ($clases as $clase) { ?>
							<tr>
							<tbody>
								<td><?php echo $clase['Id']; ?></td>
								<td class="clase"><?php echo $clase['Clase'] ?></td>
								<td style="width:40px; padding-left:1px; padding-right:5px;padding-top:7px;">
								<a class="editarClass" id="editarclase" data-id="<?php echo $clase['Id']; ?>" data-name="<?php echo $clase['Clase'] ?>"> 
									<div data-toggle="modal" class="btn btn-primary glyphicon glyphicon-pencil" data-placement="top" title="Editar nombre de clase" id="editarClass" style="margin-top: 0px;" ></div>
								</a>
								</td>
								<td style="padding-left:5px; padding-right:1px">
									<a class="delete hide" id="eliminarclase" data-id="<?php echo $clase['Id']; ?>" data-name="<?php echo $clase['Clase'] ?>">
										<div data-toggle="modal" data-target="#informacion" title="Eliminar clase" class="btn btn-danger fa fa-times"></div>
									</a>
								</td>
							</tr>
							<?php }	?>
							</tbody>
						</table>
					</div>

					<div class="col col-md-6 edit">
						<div class="box-edit">
							<p><input type="text" id="id-class" class="form-control">
							<p><input type="text" id="input-class" class="form-control">
							<p><button class="btn btn-default btn-guardar" id="save-class"><span class="fa fa-save"></span>&nbsp; Guardar</button>
						</div>
					</div>

				</div>
			</div>
			
			<script src="./js/functions_panels.js"></script>