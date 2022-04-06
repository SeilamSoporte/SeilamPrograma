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
							Fecha de recolección
						</th>
						
						<th class="head" colspan="3" >
								Acción
						</th>
					
				</thead>
				<tbody>

					<?php foreach ($view->muestras as $muestra):  // uso la otra sintaxis de php para templates 
						$token = rand(765000,9999999);
						$token2= rand(255,765000);
						
						$id= ($muestra['Id']*$token)+$token2;
						$link  = "templates/editMuestra.php?i-t=".$id."wIl%Ba%mU&t-ram=".$token."Fr%Dilri&t-s=".$token2."aNKlLol%lOsaPoqwUxAjkLwci";
					?>
						<tr>
							<td><?php echo $muestra['Codigo']; ?></td>
							<td style="max-width:500px;"><?php echo $muestra['Nombre_cliente'];?></td>
							<td><?php echo $muestra['Fecha_Ingreso'];?></td>
							<td><?php echo $muestra['Fecha_Recoleccion'];?></td>
							<td style="width:40px; padding-left:1px padding-right:1px">
								<a class="editMuestra" id="editarMuestra" data-id="<?php echo $muestra['Id']; ?>" href="<?php echo $link?>"> 
									<div class="btn btn-primary glyphicon glyphicon-pencil" data-toggle="modal" data-placement="top" title="Editar muestra" id="editMuestra" ></div>
								</a>
							</td>
							<td style="padding-left:1px; padding-right:1px">
								<a class="delete" id="eliminarMuestra" data-id="<?php echo $muestra['Id'];?>">
									<div data-toggle="modal"  data-target="#confirma" title="Eliminar muestra" class="btn btn-danger fa fa-times"></div>
								</a>
							</td>
						</tr>
						
					<?php endforeach; ?>		
				</tbody>
			</table>	
			</div>
