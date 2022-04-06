
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Configuracion</title>
	<link href="../fonts/font-awesome.min.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="../css/bootstrap.css" rel="stylesheet">
	<link href="./css/estilos.css" rel="stylesheet">
	<link href="../css/zeus.css" rel="stylesheet">

    <style>
		body{
			background-color: #eeeeee;
		}
	</style>
  </head>
  <body>
	<header>
		<nav class="navbar navbar-dark navbar-fixed-top">
		  <div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			<?php include_once '../logo-black.php'; ?>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			  <ul class="nav navbar-nav navbar-right">
				<li class ="btn-dark"><a href="#" class="btn-dark" data-target="#confirma" data-toggle="modal" onclick="guardar()"><i class="fa fa-save fa-2x">&nbsp;</i>Guardar</a></li>
				<li class ="btn-dark"><a href="../session.php?logout=true"  class="btn-dark"><i class="fa fa-power-off fa-2x">&nbsp;</i>Salir</a></li>
			  </ul>
			</div><!-- /.navbar-collapse -->		  
		  </div><!-- /.container-fluid -->
		</nav>	
	</header>
	
	<div class="container-fluid">
		<div id="content">
            <?php include_once ($view->contentTemplate);?>
        </div>
	</div>			
	<div class="modal fade" id="confirma" role="dialog" tabindex="-1">
		<div class="bs-example-modal-sm"> 
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header modal-header-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-equestion-sign" style="font-size:15px" aria-hidden="true"></span>Atención</h4>
				  </div>
				  <div class="modal-body strong" id="mensaje_modal" style="font-size:15px; font-weight:bold">
					<!-- Mensaje que se mostrará-->
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>	
				  </div>
				</div>
			  </div>
		</div>
	</div>

		
	<script>
	
	/*
	function guardar()
	{datos				= {};					//Definicion del contenedor que enviará los datos del formulario como parametros
		datos.id			= <?php echo $id ?>;
		//alert(datos.id);
		datos.action		= "saveEmpresa"; 
	
		datos.empresa		= $("#Empresa")		.val();	
		datos.nit			= $("#Nit")			.val();
		datos.telefono		= $("#Telefono")	.val();
		datos.regimen		= $("#Regimen")		.val();
		datos.email			= $("#Email")		.val();
		datos.direccion		= $("#Direccion")	.val();
		datos.web			= $("#Web")			.val();
		var logo			= $("#File_logo").val();
		if( logo=="" ){	
		datos.logo			="";}
		else{ 
			datos.logo		= $("#File_logo")[0].files[0].name;}
		
		$.post("./resources/QueryS_Empresa.php", datos, function(data)
		{
			var Data=data.split(",");
			params={};
			params.mensaje	= Data[0];				//Mensaje enviado desde el Query save
			params.action	= Data[1];				//Acción enciada por el Query save, si es 0, es que no se modificò ningún dato, 1 se modificó al menos una fila de BD
			save_img();
			alert(data);
			/*$('#confirmacion').load('./templates/dialogs.php', params,function(){
				$("#tabla-usuarios").load("./templates/tabla-usuarios.php")
				save_img();
			})
			*/	
			/*
		});
	}
*/	
	</script>

    <script src="../js/jquery-2.2.2.min.js"></script>
	<!--<script src="../js/jquery-ui-1.11.1/jquery-ui.min.js"></script>-->
    <script src="../js/bootstrap.min.js"></script>
	<script src="./js/functions.js"></script>
</body>
</html>