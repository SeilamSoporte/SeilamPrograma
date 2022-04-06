<?php 
	include_once ("../../session.php");
	include_once ("../clases/clasesMuestras.php");

	$token  = isset($_POST['token']) ? $_POST['token']: 1;
	$id 	= isset($_POST['id']) ? $_POST['id']/$token : 0;
	if ($id==0){
		header('Location: ../index.php');
   		exit;
	}

	$view  = new stdClass(); 
	$view->muestras       = Muestras::getMuestra(); // tree todos los clientes
    $view->contentTemplate= "../resources/tableInformes.php"; // seteo el template que se va a mostrar
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html">
    <link href="../../favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Ver informes</title>
		<link href="../../fonts/font-awesome.min.css" rel="stylesheet">
		<!-- Bootstrap -->	
		<link href="../../css/bootstrap.css" rel="stylesheet">
		<!-- <link href="../../css/zeus.css" rel="stylesheet"> -->
		<link href="../../css/bootstrap-dialog.min.css" rel="stylesheet">
		<!-- <link href="../../css/btn_floating.css" rel="stylesheet"> -->
		<link href="../css/estilos.css" rel="stylesheet">
		<link href="../../css/chosen.css" rel="stylesheet" type="text/css" />
		<link href="../../css/jquery-ui.css" rel="stylesheet" type="text/css" />
		<link href="../../css/style.css" rel="stylesheet" type="text/css" />
      
        <link href="../css/estilos_informes.css" rel="stylesheet">
	    <script src="../../js/jquery-2.2.2.min.js"></script>
		<script src="../../js/chosen.jquery.js"></script>
		<script src="../../js/jq-ui/jquery-ui.js"></script>
	
	<!-- <script src="../js/functionForm.js"></script> -->
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  
  </head>
  <body>
	<header>
		<nav class="navbar navbar-dark navbar-fixed-top hidden-print">
		  <div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
	 		   <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			<?php include_once '../../logo-black.php'; ?>
			</div>
			
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			  <ul class="nav navbar-nav navbar-right ">
				<!--
				<li class="hidden generar btn-dark" id="print_li">
					<a  href="#" id="print" class="btn-cmd print-i " data-toggle="modal" data-placement="bottom" title="Imprimir informe">
						<i class="fa fa-print fa-2x ">&nbsp;</i>
					</a>
				</li>
				-->
			  	<li class ="btn-dark hidden generar" >	
					<a href="#" id="pdf" class="btn-cmd" data-toggle="modal" data-placement="bottom" title="Generar informe en pdf">
						<i class="fa fa-file-pdf-o fa-2x ">&nbsp;</i>
					</a>
				</li>
				<li class ="btn-dark" id="logout"><a href="#" id="volver" class="btn-dark" data-toggle="modal" data-placement="bottom" title="Volver">
				<i class="fa fa-arrow-left fa-2x">&nbsp;</i></a></li>
			  </ul>
			</div><!-- /.navbar-collapse -->		  
		  </div><!-- /.container-fluid -->
		</nav>	
	</header>
	
	<div id="cargando"> 
		<div id="layerc_load">		
			<div id="loading" style="text-align:center; width: 100%;">
				<img src="../../imgs/loading3.gif" alt="">
			</div>
		</div>
	</div>
	<div id="content">
		<div class="container hidden-print">	
			<?php include_once ($view->contentTemplate);?>	
        </div>
	</div> <!-- Container -->

<!-- Modal de Formulario de parámetro-->
	<div class="modal " tabindex="-1" role="dialog" id="informacion"> </div><!-- /.modal-dialog -->
	<div class="" id="informe"> </div>

	<div id="form_insert"> </div>
	<script src="../../js/bootstrap.min.js"></script>
	<script src="../../js/bootstrap-dialog.min.js"></script>
 	<script src="../js/functions_inf.js"></script> 
	<script>

		$(function () {
			$('[data-toggle="modal"]').tooltip()
		});
	</script>	
</body>
</html>
