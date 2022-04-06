<?php

	include_once ("../clases/clasesParametros.php");
	$action 	= isset($_POST['action']) ? $_POST['action']: '';
	$id			= isset($_POST['id']) ? $_POST['id']: '0';

	$D_Parametros = new Parametros();
	$D_Parametros ->Parametro($id);
    
?>
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Detalles de parametro</h4> 
			</div>	  
			
			<div class="modal-body">
				<!-- <div class=""> -->
					<form action="#" id="FormUser" method="post" enctype="multipart/form-data">  
						
						<div class="panel panel-primary">
							<div class="panel-heading" style="height:70px; padding:2px; padding-right:30px; vertical-align: middle;"><strong>Datos del Parámetro</strong>
						</div>
							<div class="panel-body">
								<div class="row">
									<div class="col col-md-6">
										<div class="input-group">
											<span class="primary input-group-addon" id="basic-addon-emp"><span class="glyphicon glyphicon-user"> </span> </span>
											<input  value = "<?php echo $D_Parametros->Codigo; ?>" type="text" id="Codigo" class="form-control" placeholder="Código" aria-describedby="basic-addon-emp">
										</div>
									</div>
									<div class="col col-md-6">
										<div class="input-group">
											<span class="primary input-group-addon" id="basic-addon-emp"><span class="glyphicon glyphicon-user"> </span> </span>
											<input value = "<?php echo $D_Parametros->Area; ?>" type="text" id="Area" class="form-control" placeholder="Área de análisis" aria-describedby="basic-addon-emp">
										</div>
									</div>
								</div>	
								<div class="row">								
									<div class="col col-md-6">
										<div class="input-group">
											<span class="primary input-group-addon" id="basic-addon-tel"><span class="glyphicon glyphicon-phone-alt"> </span> </span>
											<input value = "<?php echo $D_Parametros->Categoria; ?>" type="text" id="Categoria" class="form-control" placeholder="Categoría" aria-describedby="basic-addon-tel">
										</div>
									</div>					
									<div class="col col-md-6">
										<div class="input-group">
											<span class="primary input-group-addon" id="basic-addon-dir"><span class="glyphicon glyphicon-phone"> </span> </span>
											<input value = "<?php echo $D_Parametros->Clase; ?>" type="text" id="Clase" class="form-control" placeholder="Clase de muestra" aria-describedby="basic-addon-dir">
										</div>
									</div>
								</div>	
								<div class="row">	
									<div class="col col-md-6">
										<div class="input-group">
												<!-- <label for="Email">Nit</label> -->
												<span class="primary input-group-addon" id="basic-addon-email"><span class="glyphicon glyphicon-envelope"></span> </span>
												<input value = "<?php echo $D_Usuarios->Email; ?>" type="email" id="Email" class="form-control" placeholder="Email" aria-describedby="basic-addon-email">
										</div>
									</div>
									
									<div class="col col-md-6">
										<div class="input-group">
											<span class="primary input-group-addon" id="basic-addon-dir"><span class="glyphicon glyphicon-map-marker"> </span> </span>
											<input value = "<?php echo $D_Usuarios->Direccion; ?>" type="text" id="Direccion" class="form-control" placeholder="Dirección" aria-describedby="basic-addon-dir">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col col-md-6">
										<div class="input-group">
											<span class="primary input-group-addon" id="basic-addon-reg"><span class="fa fa-black-tie"> </span> </span>
											<span class="input-group-addon primary" style="border-left:0px solid transparent">Cargo</span>
											<input list="Cargos" id="Cargo" value = "<?php echo $D_Usuarios->Cargo; ?>" class="form-control" style="border-radius:0px 3px 3px 0px; ">
											
											<datalist id="Cargos" >
											<?php	
												$lista = new cargos();
												foreach ($lista->getCargos() as $cargo): ?>
													<option value="<?php echo $cargo['Cargo'] ?>">
											<?php endforeach; ?>	
											</datalist> 
										</div>
									</div>

									<div class="col col-md-6">
										<div class="input-group">
											<span class="primary input-group-addon" id="basic-addon-dir"><span class="glyphicon glyphicon-subtitles"> </span> </span>
											<input value = "<?php echo $D_Usuarios->Identificacion; ?>" type="text" id="Identificacion" class="form-control" placeholder="Número de identificacion" aria-describedby="basic-addon-dir">
										</div>
									</div>
								</div>
						
							</div>	
						</div>	
						
						<div class="panel panel-primary">
							<div class="panel-heading"><strong>Permisos y Seguridad </strong></div>
							<div class="panel-body">
								<div class="row">
									<div class="col col-md-6">
										<div class="input-group">
											<span class="primary input-group-addon" id="basic-addon-emp"><span class="glyphicon glyphicon-user"> </span> </span>
											<input value = "<?php echo $D_Usuarios->Username; ?>" type="text" id="Usuario" class="form-control" placeholder="Usuario" aria-describedby="basic-addon-emp">
										</div>
									</div>
									<div class="col col-md-6">
										<div class="input-group">
											<span class="primary input-group-addon" id="basic-addon-emp"><span class="glyphicon glyphicon-lock"> </span> </span>
											<input value = "<?php echo $D_Usuarios->Password; ?>" type="text" id="Password" class="form-control" placeholder="Password" aria-describedby="basic-addon-emp">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="panel-heading"><strong>Estabecer permisos para ingresar y editar </strong></div>
									</div>
								</div>					
								<?php
									$Data =$D_Usuarios->Permisos;
									for($i=0;$i<7;$i++) 
									{						
										if (explode(",",$Data)[$i]=='true')
										{ 
											$P[$i]='checked';
										}
										else
										{
											$P[$i]="";
										}
									}
								?> 
								<div class="row">
									<div class="col.md-4"> 
										 
										<div class="checkbox">
											<p>
												<input type="checkbox" id="Muestras" <?php echo $P[0] ;?> value="Muestras" />
												<label for="Muestras">Muestras</label>							
											</p>
										</div>  							
										<div class="checkbox">
											<p>
												<input type="checkbox" id="Resultados" <?php echo $P[1] ;?> value="Resultados" /> 
												<label for="Resultados">Resultados</label>								
											</p>
										</div>  							

										<div class="checkbox">
											<p>
												<input type="checkbox" id="Informes" <?php echo $P[2] ;?> value="Informes" />
												<label for="Informes">Informes</label>								
											</p>
										</div>  							
										 
										<div class="checkbox">
											<p>
												<input type="checkbox" id="Parametros" <?php echo $P[3] ;?> value="Parametros" />
												<label for="Parametros">Parámetros</label>
											</p>
										</div>  
										
										<div class="checkbox">
											<p>
												<input type="checkbox" id="Cliente" <?php echo $P[4] ;?> />
												<label for="Cliente">Clientes</label>
											</p>
										</div> 

										<div class="checkbox">
											<p>
												<input type="checkbox" id="Usuarios" <?php echo $P[5] ;?> />
												<label for="Usuarios">Usuarios</label>
											</p>
										</div> 

										<div class="checkbox">
											<p>
												<input type="checkbox" id="Empresa" <?php echo $P[6] ;?> />
												<label for="Empresa">Datos de la empresa y configuración</label>
											</p>
										</div> 

									</div>
								</div>
							</div>
						</div>
					</form><br>				
				<!-- </div> -->
			</div>		
		<!--</div> -->
		  <div class="modal-footer">
			<div class="row">
			<div class="col-md-9">
				<div id="confirmacion">	</div>
			</div>
			<div class="col-md-3">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary" id="Guardar_usuario" >Guardar</button>
			</div>
			</div>
		  </div>
	</div><!-- /.modal-content -->
		<div id="confirmacion">	</div>

	<script>	
	$('#Guardar_usuario').click(function(){
		datos				= {};						//Definicion del contenedor que enviará los datos del formulario como parametros
		datos.id			= <?php echo $id ?>;
		datos.action		= "saveUsuario"; 
	
		datos.nombre		= $("#Nombre")		.val();	
		datos.apellido		= $("#Apellidos")	.val();
		datos.telefono		= $("#Telefono")	.val();
		datos.celular		= $("#Celular")		.val();
		datos.email			= $("#Email")		.val();
		datos.direccion		= $("#Direccion")	.val();
		datos.cargo			= $("#Cargo")		.val();
		datos.identificacion= $("#Identificacion").val();
		datos.usuario		= $("#Usuario")		.val();
		datos.password		= $("#Password")	.val();
		var foto_im			= $("#User_foto")	.val();
		
		if(foto_im!=""){
			datos.foto		= $("#User_foto")[0].files[0].name;	
		}
		else{
			datos.foto=<?php echo "'".$Foto_User."'"; ?>;
		} 
			
		datos.permisos		= Array(7);
		
		var i=0;
		$("input[type=checkbox]").each(function(){		//Se verifica cada uno de los checkbox para saber cuales están en checked
			datos.permisos[i]=$(this).is(':checked'); i++; }) 
			datos.permisos.toString();					//Se convierte el arreglo en cadena entes de enviarlo como paràmetro
			
			$.post("./resources/QueryS_Usuarios.php", datos, function(data)
			{
				var Data=data.split(",");
				params	={};
				params.mensaje	= Data[0];				//Mensaje enviado desde el Query save
				params.action	= Data[1];				//Acción enciada por el Query save, si es 0, es que no se modificò ningún dato, 1 se modificó al menos una fila de BD
				var documento=$(document.body);
				if (Data[1]==0){
					BootstrapDialog.show({
						title: 'Atención', 
						message: "<span class='glyphicon glyphicon-exclamation-sign' style='font-size:15px'></span> No se ha realizado ningun cambio.",						
						buttons:[{ label: 'Ok',
									action: function(dialogRef){dialogRef.close();}	
								}]
						});
					documento.attr("class","modal-opened");
					}
				else{
					BootstrapDialog.show({
						title: 'Atención', 
						message: "<span class='glyphicon glyphicon-ok'> </span> Los cambios se guardaron exitosamente.", 
						type:"type-success",
						buttons:[{ label: 'Ok',
									action: function(dialogRef){dialogRef.close();}	
								}]
						});
					$("#tabla-usuarios").load("./templates/tabla-usuarios.php");
					documento.attr("class","modal-opened");
				} 
				
				if (foto_im!="") {
					save_img();
				}
			});
	})
	</script>
  <script>
	 function save_img()
	 {
		var formData = new FormData($("#FormUser")[0]);
            var ruta = "./resources/SaveImg.php";
            $.ajax({
					url: ruta,
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,
					/*success: function(datos)
					{
						if (datos!="Ok")
						{alert(datos);}
					}*/
				});
	 }
    </script>
	
	<script>  
     $(function(){
        $("input[name='file']").on("change", function(){
            var formData = new FormData($("#FormUser")[0]);
            var ruta = "./resources/ErrorImg.php";
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                /*success: function(datos)
                {
                    if (datos!="Ok")
					{alert(datos);}
                }*/
            });
        });
     });
    </script>