
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Ordenes de servicio</title>
		 <link href="../favicon.ico" rel="shortcut icon" type="image/x-icon" />
		<link href="../fonts/font-awesome.min.css" rel="stylesheet">
		<!-- Bootstrap -->	
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link href="../css/zeus.css" rel="stylesheet">
		<link href="../css/bootstrap-dialog.min.css" rel="stylesheet">
		<link href="../css/jquery-ui.css" rel="stylesheet">
		<link href="./css/estilos.css" rel="stylesheet">

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
				<li class ="btn-dark" id="logout"><a href="../session.php?logout=true" class="btn-dark"><i class="fa fa-power-off fa-2x">&nbsp;</i>Salir</a></li>
			  </ul>
			</div><!-- /.navbar-collapse -->		  
		  </div><!-- /.container-fluid -->
		</nav>	
	</header>

	
	<div class="container">
		<div id="content">
			<?php  include_once ($view->contentTemplate);?>
        </div>
	</div> <!-- Container -->
<!-- Modal de confirmación para eliminar-->

	<div class="modal fade" id="informacion" role="dialog" tabindex="-1"> </div>
	<script src="../js/jquery-2.2.2.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="./js/functions.js"></script>
	<script src="../js/jq-ui/jquery-ui.js"></script>


</body>
</html>