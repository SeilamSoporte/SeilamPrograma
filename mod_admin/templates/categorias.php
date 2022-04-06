
			<?php 
				include_once ("../clases/clasesAdmin.php");
				$datos 		= new Administrador();
				$datos      ->getDatos('categorias');
				$categorias = $datos->Datos;
			?>

			<div class="panel-heading">
				CATEGORÍAS
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col col-md-6">
						<input type="text" name="categoria" id="text-categoria" class="form-control" placeholder="Escriba el nombre de la categoría a agregar" />
					</div>
					<div class="col col--md-2">
						<button class="btn btn-success" id="add-cat" data-toggle="modal" data-target="#informacion" ><span class="glyphicon glyphicon-plus"></span>&nbsp; Agregar</button>
					</div>
				</div>
				<div class="row">
					<div class="col col-md-6" id="table-categorias">
						<table class="table table-hover listado">
							<tr>
								<thead>
									<th>Id</th>
									<th>Categoría</th>
									<th colspan="2">Acción</th>
								</thead>
							</tr>
							<?php foreach ($categorias as $categoria) { ?>
							<tr>
							<tbody>
								<td><?php echo $categoria['Id']; ?></td>
								<td class="categoria"><?php echo $categoria['Categoria'] ?></td>
								<td style="width:40px; padding-left:1px; padding-right:5px;padding-top:7px;">
								<a class="editarCateg" id="editarCategoria" data-id="<?php echo $categoria['Id']; ?>" data-name="<?php echo $categoria['Categoria'] ?>"> 
									<div data-toggle="modal" class="btn btn-primary glyphicon glyphicon-pencil" data-placement="top" title="Editar nombre de categoría" id="editarCateg" style="margin-top: 0px;" ></div>
								</a>
								</td>
								<td style="padding-left:5px; padding-right:1px">
									<a class="delete hide" id="eliminarcategoria" data-id="<?php echo $categoria['Id']; ?>" data-name="<?php echo $categoria['Categoria'] ?>">
										<div data-toggle="modal" data-target="#informacion" title="Eliminar categoría" class="btn btn-danger fa fa-times"></div>
									</a>
								</td>
							</tr>
							<?php }	?>
							</tbody>
						</table>
					</div>

					<div class="col col-md-6 edit">
						<p><input type="text" id="id-cat" class="form-control">
						<p><input type="text" id="input-cat" class="form-control">
						<p><button class="btn btn-default btn-guardar" id="save-cat"><span class="fa fa-save"></span>&nbsp; Guardar</button>
					</div>

				</div>
			</div>
			
			<script src="./js/functions_panels.js"></script>