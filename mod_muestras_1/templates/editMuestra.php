<?php
	include_once ("../../session.php");
	include_once ("../clases/clasesMuestras.php");
	$view  = new stdClass(); 
	$id_tStr   = isset($_GET['i-t']) ? $_GET['i-t']: '0';
	$tokenStr  = isset($_GET['t-ram']) ? $_GET['t-ram']: '1';
	$token2Str = isset($_GET['t-s']) ? $_GET['t-s']: '0';
	$idArray = getdate();
	$idComp  = $idArray['hours'].$idArray['wday'].$idArray['mon'];
	$idSend  = isset($_GET['s']) ? $_GET['s']:0;

	$token     = intval($tokenStr);
	$id_t      = intval($id_tStr);
	$token2    = intval($token2Str);
	//$id 	   =($id_t-$token2)/$token;
	$id 	   =$id_t;

	$view->muestras       = Muestras::getMuestra(); // tree todos las muestras
    $view->contentTemplate= "../resources/formMuestra_blank.php";
    $hide 	   = 'hide';
    if ($idSend==$idComp ){
    	$hide  = '';
    	$view->contentTemplate= "../resources/formMuestra.php"; // seteo el template que se va a mostrar
    }
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Muestras</title>
		<link href="../../fonts/font-awesome.min.css" rel="stylesheet">
		<!-- Bootstrap -->	
		<link href="../../css/bootstrap.css" rel="stylesheet">
		<link href="../../css/zeus.css" rel="stylesheet">
		<link href="../../css/bootstrap-dialog.min.css" rel="stylesheet">
		<link href="../../css/btn_floating.css" rel="stylesheet">
		<link href="../css/estilos.css" rel="stylesheet">
		<link href="../../css/chosen.css" rel="stylesheet" type="text/css" />
		<link href="../../css/jquery-ui.css" rel="stylesheet" type="text/css" />
		<link href="../../css/style.css" rel="stylesheet" type="text/css" />

    <script src="../../js/jquery-2.2.2.min.js"></script>
	<script src="../../js/chosen.jquery.js"></script>
	<script src="../../js/jq-ui/jquery-ui.js"></script>
	<script src="../js/functionForm.js"></script>

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
			<?php include_once '../../logo-black.php'; ?>
			</div>
			
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			  <ul class="nav navbar-nav navbar-right">
			  	<li class ="btn-dark <?php echo $hide ?>" id="logout"><a href="#" id="Guardar" class="btn-dark" data-toggle="modal" data-placement="bottom" title="Guardar" data-target="#informacion_g"><i class="fa fa-save fa-2x">&nbsp;</i></a></li>
				<li class ="btn-dark" id="logout"><a href="#" id="volver" class="btn-dark" data-toggle="modal" data-placement="bottom" title="Volver">
				<i class="fa fa-arrow-left fa-2x">&nbsp;</i></a></li>
			  </ul>
			</div><!-- /.navbar-collapse -->		  
		  </div><!-- /.container-fluid -->
		</nav>	
	</header>
	
	<div id="cargando" > 
		<div id="layerc_load">		
			<div id="loading" style="text-align:center; width: 100%;">
				<img src="../../imgs/loading3.gif" alt="">
			</div>
		</div>
	</div>
	<div id="content">
		<div class="container">	
			<?php include_once ($view->contentTemplate);?>	
    </div>
	</div> <!-- Container -->

<!-- Modal de Formulario de parámetro-->
<!-- <div class="modal fade" tabindex="-1" role="dialog" id="ListadoMuestras"> </div> --> <!-- /.modal-dialog -->
	<div class="modal " tabindex="-1" role="dialog" id="informacion"> </div><!-- /.modal-dialog -->
	<div class="modal fade" tabindex="-1" role="dialog" id="informacion_g"> </div>
<!-- Btn nuevo parámetro-->
	<div class="div-flt-btn-fixed">
		<!--
		<a id="btn_fltn_listado" class="btn-floating flt-btn btn-large waves-effect modal-tr" data-toggle="modal"  title="Ver listado de parametrización" data-target="#informacion" >
			<i style="font-size:24px" class="glyphicon glyphicon-th-list center">&nbsp;</i> 
		</a>		
		-->
		<a id="btn_fltn" class="btn-floating flt-btn btn-large waves-effect modal-tr" data-toggle="modal"  title="Nueva muestra" data-target="#nuevo" >
			<i style="font-size:24px" class="glyphicon glyphicon-plus center">&nbsp;</i> 
		</a>	
	</div>


	<div id="form_insert"> </div>
	<script src="../../js/bootstrap.min.js"></script>
	<script src="../../js/footable/footable.js"></script>
	<script src="../../js/bootstrap-dialog.min.js"></script>
	<script src="../../js/jquery.ui.datepicker-es.js"></script>
  	<script src="../../js/footable/footable.filter.js"></script>
  	<script src="../../js/footable/footable.paginate.js"></script>
  	
    <script src="../js/functions.js"></script>
	
	<script>
	/*	$(function() {
		  $('table').footable();
		});
	*/		
		$(function () {
			$('[data-toggle="modal"]').tooltip()
		});
	</script>	
</body>
</html>