
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Muestras</title>
		<link href="../fonts/font-awesome.min.css" rel="stylesheet">
		<!-- Bootstrap -->	
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link href="../css/zeus.css" rel="stylesheet">
		<link href="../css/bootstrap-dialog.min.css" rel="stylesheet">
		<!-- Materialize -->
		<link href="../css/checkbox.css" rel="stylesheet">
		<link href="../css/btn_floating.css" rel="stylesheet">
	
		<link href="../css/footable-0.1.css" rel="stylesheet" type="text/css" />		
		<!-- <link href="../css/footable.paginate.css" rel="stylesheet" type="text/css" /> -->
		<link href="./css/estilos.css" rel="stylesheet">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  
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
				<span class="navbar-brand">
					<i class="fa fa-sheqel fa-2x" style="color:#FFF;">&nbsp;</i>
					<span style="color:#004AFF;font-family:'Myanmar Text';font-size:36px;"><strong>ZEUS</strong></span><span style="color:#FFF;font-family:'Myanmar Text';font-size:36px;"><strong>S</strong></span>
				</span>
			</div>
				<form class="navbar-form navbar-left" role="search">
				  <div class="form-group form-control" style="margin-top:6px; ">
					<input type="text" id="filter" class="busqueda" placeholder="Buscar" style="width:20em;">
					<span class="glyphicon glyphicon-search"></span>
				  </div>
				</form>
			

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			  <ul class="nav navbar-nav navbar-right">
				<li class ="btn-dark" id="logout"><a href="../session.php?logout=true" class="btn-dark"><i class="fa fa-power-off fa-2x">&nbsp;</i>Salir</a></li>
			  </ul>
			</div><!-- /.navbar-collapse -->		  
		  </div><!-- /.container-fluid -->
		</nav>	
	</header>

	
	<div class="container">
		<div id="content">
			<?php include_once ($view->contentTemplate);?>
        </div>
	</div> <!-- Container -->

	<!-- Modal de Formulario de parámetro-->
	<div class="modal fade" tabindex="-1" role="dialog" id="FormMuestra"> </div><!-- /.modal-dialog -->
		
	<!-- Modal de confirmación para eliminar-->
	<div class="modal fade" id="confirma" role="dialog" tabindex="-1"></div>

	<!-- Btn nuevo parámetro-->
	<a id="btn_fltn" id-btn="nuevo" class="btn-floating fixed-action-btn btn-large waves-effect modal-tr" data-toggle="modal"  title="Nueva muestra" data-target="#FormMuestra" >
		<i style="font-size:24px" class="glyphicon glyphicon-plus center">&nbsp;</i> 
	</a>
  
    <script src="../js/jquery-2.2.2.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/bootstrap-dialog.min.js"></script>
	
	<script src="./js/functions.js"></script>

		<script src="../js/footable/footable.js"></script>
		<script src="../js/footable/footable.sortable.js"></script>
		<script src="../js/footable/footable.filter.js"></script>
	
		<script>
			$(function() {
			  $('table').footable();
			});
		</script>	
</body>
</html>