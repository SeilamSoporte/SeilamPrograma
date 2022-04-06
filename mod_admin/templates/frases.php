	
			<?php 
				include_once ("../clases/clasesAdmin.php");
				$datos 		= new Administrador();
				$datos      ->getDatos('observaciones');
				$frases     = $datos->Datos;
			?>

			<div class="panel-heading">
				FRASES	
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col col-md-6">
						<input type="text" name="frase" id="text-frase" class="form-control" placeholder="Escriba frase a agregar" />
					</div>
					<div class="col col--md-2">
						<button class="btn btn-success" id="add-class" data-toggle="modal" data-target="#informacion" ><span class="glyphicon glyphicon-plus"></span>&nbsp; Agregar</button>
					</div>
				</div>
				<div class="row">
					<div class="col col-md-6" id="table-frase">
						<table class="table table-hover listado">
							<tr>
								<thead>
									<th>Id</th>
									<th>Frase</th>
									<th colspan="2">Acción</th>
								</thead>
							</tr>
							<?php foreach ($frases as $frase) { ?>
							<tr>
							<tbody>
								<td><?php echo $frase['Id']; ?></td>
								<td class="frase"><?php echo $frase['Observacion'] ?></td>
								<td style="width:40px; padding-left:1px; padding-right:5px;padding-top:7px;">
								<a class="editarFrase" id="editarfrase" data-id="<?php echo $frase['Id']; ?>" data-name="<?php echo $frase['Observacion'] ?>"> 
									<div data-toggle="modal" class="btn btn-primary glyphicon glyphicon-pencil" data-placement="top" title="Editar frases" id="editarFrase" style="margin-top: 0px;" ></div>
								</a>
								</td>
								<td style="padding-left:5px; padding-right:1px">
									<a class="delete" id="eliminarfrase" data-id="<?php echo $frase['Id']; ?>" data-name="<?php echo $frase['Observacion'] ?>">
										<div data-toggle="modal" data-target="#informacion" title="Eliminar frase" class="btn btn-danger fa fa-times"></div>
									</a>
								</td>
							</tr>
							<?php }	?>
							</tbody>
						</table>
					</div>

					<div class="col col-md-6 edit">
						<div class="box-edit">
							<p><input type="text" id="id-frase" class="form-control">
							<p><input type="text" id="input-frase" class="form-control">
							<p><button class="btn btn-default btn-guardar" id="save-frase"><span class="fa fa-save"></span>&nbsp; Guardar</button>
						</div>
					</div>

				</div>
			</div>
			
			<script src="./js/functions_panels.js"></script>