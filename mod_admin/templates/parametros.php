	
			<?php 
				include_once ("../clases/clasesAdmin.php");
				$datos 		= new Administrador();
				$datos      ->getDatos('lista_parametros');
				$parametros     = $datos->Datos;
			?>

			<div class="panel-heading">
				PARÁMETROS
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col col-md-6">
						<input type="text" name="parametro" id="text-param" class="form-control" placeholder="Escriba el nombre del parametro a agregar" />
					</div>
					<div class="col col-md-2">
						<button class="btn btn-success" id="add-param" data-toggle="modal" data-target="#informacion" ><span class="glyphicon glyphicon-plus"></span>&nbsp; Agregar</button>
					</div>
				</div>
				<div class="row">
					<div class="col col-md-6" id="table-parametro">
						<table class="table table-hover listado">
							<tr>
								<thead>
									<th>Id</th>
									<th>Parámetro</th>
									<th colspan="2">Acción</th>
								</thead>
							</tr>
							<?php foreach ($parametros as $parametro) { ?>
							<tr>
							<tbody>
								<td><?php echo $parametro['Id']; ?></td>
								<td class="parametro"><?php echo $parametro['Nombre'] ?></td>
								<td style="width:40px; padding-left:1px; padding-right:5px;padding-top:7px;">
								<a class="editarParam" id="editarparametro" data-id="<?php echo $parametro['Id']; ?>" data-name="<?php echo $parametro['Nombre'] ?>"> 
									<div data-toggle="modal" class="btn btn-primary glyphicon glyphicon-pencil" data-placement="top" title="Editar nombre del parámetro" id="editarPamam" style="margin-top: 0px; " ></div>
								</a>
								</td>
								<td style="padding-left:5px; padding-right:1px">
									<a class="delete hide " id="eliminarparametro" data-id="<?php echo $parametro['Id']; ?>" data-name="<?php echo $parametro['Nombre'] ?>">
										<div data-toggle="modal" data-target="#informacion" title="Eliminar parámetro" class="btn btn-danger fa fa-times"></div>
									</a>
								</td>
							</tr>
							<?php }	?>
							</tbody>
						</table>
					</div>

					<div class="col col-md-6 edit">
						<div class="box-edit">
							<p><input type="text" id="id-param" class="form-control id">
							<p><input type="text" id="input-param" class="form-control">
							<p><button class="btn btn-default btn-guardar" id="save-param"><span class="fa fa-save"></span>&nbsp; Guardar</button>
						</div>
					</div>

				</div>
			</div>
			
			<script src="./js/functions_panels.js"></script>