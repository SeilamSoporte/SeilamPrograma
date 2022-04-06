<?php 
	include_once ("../Clases/clasesClientes.php");
	$action='';
	if(isset($_POST['action']))
	{$action=$_POST['action'];}
	$mensaje=$_POST['mensaje'];
	$id		=isset($_POST['id']) ? $_POST['id'] : '' ;
	
	$D_Clientes = new Clientes();
	$D_Clientes->D_Cliente($id);
    $Cliente  	= $D_Clientes->Empresa;

	
	switch ($action)
	{
		case '0':
			echo '<div class="alert alert-info just-izq" tabindex="-1" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong><span class="glyphicon glyphicon-exclamation-sign" style="font-size:15px" aria-hidden="true"></span> </strong>
			 '.$mensaje.'</div>';
		break;
		case '1':
			echo '<div class="alert alert-success just-izq" tabindex="-1" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<span class="glyphicon glyphicon-ok"></span> '.$mensaje.'</div>';
		break;		
		case 'eliminarCliente':
	?>
	<div class="bs-example-modal-sm">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header bg-red">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-equestion-sign" style="font-size:15px" aria-hidden="true"></span>Atención</h4>
			  </div>
			  <div class="modal-body" id="mensaje_modal">
				<?php echo $mensaje . "<br><strong>" .$Cliente. "? </strong>"?> 
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
				<button type="button" class="btn btn-success eliminar_si" id="eliminar_si" data-dismiss="modal" onclick="eliminar('<?php echo $id ?>')">Si</button>
			  </div>
			</div>
		  </div>
	</div>
<?php
		break;
		default :
	}
?>