<?php 
	//include_once ("../Clases/clasesMuestras.php");
	$action	='';
	if(isset($_POST['action']))
	{$action=$_POST['action'];}
	$mensaje=$_POST['mensaje'] ;
	$id		=isset($_POST['id']) ? $_POST['id'] : '' ;
    $Codigo =isset($_POST['dato']) ? $_POST['dato']: '';
    $Tipo   =isset($_POST['tipo']) ? $_POST['tipo']: '';

	switch ($action)
	{
		case '0':
			echo '<div class="alert alert-info just-izq" tabindex="-1" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong><span class="glyphicon glyphicon-exclamation-sign" style="font-size:15px" aria-hidden="true"></span> </strong>
			 '.$mensaje.'</div>';
		break;
		case '1':
			?>
				<div class="bs-example-modal-sm">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
						  <div class="modal-header bg-success bg-round-top">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-equestion-sign" style="font-size:15px" aria-hidden="true"></span>Atención</h4>
						  </div>
						  <div class="modal-body" id="mensaje_modal">
							<?php echo $mensaje ?> 
						  </div>
						  <div class="modal-footer">
							<button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
						  </div>
						</div>
					  </div>
				</div>
			<?php
		break;		
		case 'null':
			?>
				<div class="bs-example-modal-sm">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
						  <div class="modal-header bg-danger bg-round-top text-danger">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-equestion-sign" style="font-size:15px" aria-hidden="true"></span>Atención</h4>
						  </div>
						  <div class="modal-body text-danger" id="mensaje_modal">
							<?php echo $mensaje ?> 
						  </div>
						  <div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Aceptar</button>
						  </div>
						</div>
					  </div>
				</div>
			<?php
		break;
		case 'eliminar':
	?>
	<div class="bs-example-modal-sm">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header bg-red">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-equestion-sign" style="font-size:15px" aria-hidden="true"></span>Atención</h4>
			  </div>
			  <div class="modal-body" id="mensaje_modal">
				<?php echo $mensaje . "<br> << <strong>" .$Codigo. " >> ? </strong>"?> 
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
				<button type="button" class="btn btn-success eliminar_si" id="eliminar_si" data-dismiss="modal" id-data="<?php echo $id ?>" onclick="eliminar('<?php echo $id ?>', '<?php echo $Tipo ?>')">Si</button>
			  </div>
			</div>
		  </div>
	</div>
<?php
		break;
		default :
	}
?>

<script>
	function eliminar(id, tipo){
	datos 		= {};
	datos.id 	= id;
	datos.action= 'eliminar';
	var page ;
	switch(tipo)
	{
		case 'categoria':
		datos.tabla = 'categorias';
		page 		= 'categorias.php';
		break;	
		case 'clase':
		datos.tabla = 'lista_clases';
		page 		= 'clases.php'
		break;
		case 'parametro':
		datos.tabla = 'lista_parametros';
		page 		= 'parametros.php';
		break;
	}
	
	$.post('resources/QueryS_Admin.php', datos, function(data){ 
		$("#panel-contenido").load("templates/"+page, params,function(){ });
	});
}
</script>