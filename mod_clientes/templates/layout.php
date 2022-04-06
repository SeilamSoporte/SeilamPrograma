<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Clientes</title>
		<link href="../fonts/font-awesome.min.css" rel="stylesheet">
		<!-- Bootstrap -->	
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link href="../css/bootstrap-dialog.min.css" rel="stylesheet">
		<link href="../css/btn_floating.css" rel="stylesheet">
		<link href="./css/estilos.css" rel="stylesheet">
		<script src="../js/jquery-2.2.2.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/bootstrap-dialog.min.js"></script>
 		<script src="./js/functions.js"></script>

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

				<div class="navbar-form navbar-left" role="search" action="">
				  <div class="form-group form-control" style="margin-top:6px; ">
					<input type="text" id="filter" class="busqueda" placeholder="Buscar" style="width:20em;">
					<span class="glyphicon glyphicon-search"></span>
				  </div>
				</div>
			
			  <ul class="nav navbar-nav navbar-right">
				<li class ="btn-dark" id="logout"><a href="../session.php?logout=true" class="btn-dark"><i class="fa fa-power-off fa-2x">&nbsp;</i>Salir</a></li>
			  </ul>
			</div><!-- /.navbar-collapse -->		  
		  </div><!-- /.container-fluid -->
		</nav>	
	</header>

	
	<div class="container">
		<div id="content">
			<div class="panel panel-primary">
				<div class="panel-heading"><strong>Lista de Clientes</strong></div>
				<div id="tablaClientes">
					<?php include_once($view->contentTemplate);?>
				</div>
			</div>
		</div>
	</div> <!-- Container -->

	<!-- Modal de Formulario de cliente-->
	<div class="modal fade" tabindex="-1" role="dialog" id="FormCliente"> </div><!-- /.modal-dialog -->
		
	<!-- Modal de confirmación para eliminar-->
	<div class="modal fade" id="confirma" role="dialog" tabindex="-1"></div>

	<!-- Btn nuevo cliente-->
	<a id="btn_fltn" class="btn-floating fixed-action-btn btn-large waves-effect modal-tr editCliente" data-id="0" data-toggle="modal"  title="Nuevo cliente" data-target="#FormCliente">
		<i style="font-size:24px" class="material-icons fa fa-user-plus" >&nbsp;</i> 
	</a>

		<!-- <script src="./js/functions.js"></script>  -->


</body>
</html>