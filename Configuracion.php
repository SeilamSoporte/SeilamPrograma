<?php
if (session_id() == "")
{
   session_start();
}
if (!isset($_SESSION['username']))
{
   header('Location: ./index.php');
   exit;
}
if (isset($_SESSION['expires_by']))
{
   $expires_by = intval($_SESSION['expires_by']);
   if (time() < $expires_by)
   {
      $_SESSION['expires_by'] = time() + intval($_SESSION['expires_timeout']);
   }
   else
   {
      unset($_SESSION['username']);
      unset($_SESSION['expires_by']);
      unset($_SESSION['expires_timeout']);
      header('Location: ./index.php');
      exit;
   }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_name']) && $_POST['form_name'] == 'logoutform')
{
   if (session_id() == "")
   {
      session_start();
   }
   unset($_SESSION['username']);
   unset($_SESSION['fullname']);
   header('Location: ./index.php');
   exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Configuracion</title>
	<link href="fonts/font-awesome.min.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/zeus.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
		body
		{
		   background-color: #f4f4f4;
		   color: #000000;
		   padding-top:80px;
		}	
		.modal-tr
		{
			cursor: pointer;	
		}
		.modal {
		top: 20%;
		}
		.bg-red{
			background-color:#c9302c; 
			font-size:13px;
		}
		.bg-green{
			background-color:#5cb85c;
			font-size:13px;
		}
		.col{
			padding:15px;
			padding-top:10px;
			padding-bottom:5px;
		}
		.btn{
			
		}
		.cargar_btn{
			width:100%;
			text-align: center;		
			position: relative;           
			text-align: center;
			/* background-color: #CC0000;*/
			color: #fff;
			display: inline;
			font-size: 15px;
			float:left;
			font-family: arial;
			margin-bottom:10px;
		}
		input[type="file"]
		  {			
			z-index: 999;
			width:0px;  
			line-height: 0;
			font-size: 14px;
			position: relative;
			/**opacity: 0;*/
			filter: alpha(opacity = 100);-ms-filter: "alpha(opacity=0)";
			padding:0;
			left:0;
			font-size:0%;
			height: 0px;

		  }   
		  .thumb {
			height: 20px;
			width: 50px;            
			border: 0px solid #000;
			margin: 0px;
		  }

		
  </style>
  
  </head>
  <body>
	<header>
		<nav class="navbar navbar-trp navbar-fixed-top">
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
					<i class="fa fa-sheqel fa-2x" style="color:#8000c0;">&nbsp;</i>
					<span style="color:#004AFF;font-family:'Myanmar Text';font-size:36px;"><strong>ZEUS</strong></span><span style="color:#8000c0;font-family:'Myanmar Text';font-size:36px;"><strong>S</strong></span>
				</span>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			  <ul class="nav navbar-nav navbar-right">
				<li class ="btn-trp"><a href="#" class="btn-tr"><i class="fa fa-save fa-2x">&nbsp;</i>Guardar</a></li>
				<li class ="btn-trp"><a href="#" class="btn-tr"><i class="fa fa-power-off fa-2x">&nbsp;</i>Finalizar</a></li>
			  </ul>
			</div><!-- /.navbar-collapse -->		  
		  </div><!-- /.container-fluid -->
		</nav>	
	</header>
	
	<div class="container-fluid">
		<form>
			<div class="panel panel-primary">
				<div class="panel-heading">Datos de la empresa y configuración</div>
				<div class="panel-body">
					<div class="row">
						<div class="col col-md-4">
							<div class="input-group">
								<span class="primary input-group-addon" id="basic-addon-emp"><span class="fa fa-building-o"> </span> </span>
								<input type="text" id="Empresa" class="form-control" placeholder="Nombre de la empresa o razón social" aria-describedby="basic-addon-emp">
							</div>
						</div>
						<div class="col col-md-4">
							<div class="input-group">
								<span class="primary input-group-addon" id="basic-addon-nit"><span class="glyphicon glyphicon-barcode"> </span> </span>
								<input type="text" id="Nit" class="form-control" placeholder="Nit" aria-describedby="basic-addon-nit">
							</div>
						</div>
													
						<div class="col col-md-4">
							<div class="input-group">
								<span class="primary input-group-addon" id="basic-addon-tel"><span class="glyphicon glyphicon-phone-alt"> </span> </span>
								<input type="text" id="Telefono" class="form-control" placeholder="Teléfono" aria-describedby="basic-addon-tel">
							</div>
						</div>
							
					</div>
					
					<div class="row">
						<div class="col col-md-4">
							<div class="input-group">
								<span class="primary input-group-addon" id="basic-addon-dir"><span class="glyphicon glyphicon-map-marker"> </span> </span>
								<input type="text" id="Direccion" class="form-control" placeholder="Dirección" aria-describedby="basic-addon-dir">
							</div>
						</div>
						<div class="col col-md-4">
							<div class="input-group">
									<!-- <label for="Email">Nit</label> -->
									<span class="primary input-group-addon" id="basic-addon-email">@</span>
									<input type="email" id="Email" class="form-control" placeholder="Email" aria-describedby="basic-addon-email">
							</div>
						</div>
						
						<div class="col col-md-4">
							<div class="input-group">
									<span class="primary input-group-addon" id="basic-addon-dir"><span class="fa fa-internet-explorer"> </span> </span>
									<input type="text" id="Web" class="form-control" placeholder="Página web" aria-describedby="basic-addon-email">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col col-md-4">
							<div class="input-group">
								<span class="primary input-group-addon" id="basic-addon-reg"><span class="fa fa-university"> </span> </span>
								<span class="input-group-addon primary" style="border-left:0px solid transparent">Régimen</span>
								<!--<input type="text" id="Régimen" class="form-control" placeholder="Dirección" aria-describedby="basic-addon-reg">-->
								<select class="form-control">
									<option value="0"> </option>
									<option value="2">Común</option>
									<option value="2">Simplificado</option>
								</select> 
							</div>
						</div>
						<div class="col col-md-4">
								<label class="cargar_btn btn-primary btn">Cargar logo 
								  <span><input type="file" id="File_logo" name="File_logo" onchange="cargaImg()"/></span>
								</label>
							<!--<input type="file" id="File_logo" class="btn btn-primary" name="File_logo" onchange="cargaImg()">
							<input class="btn btn-primary" type="button" value="Cargar logo"> -->
						</div>
						<div class="col col-md-4">
							<div id="wb_Logo_image">
								<img style="width:150px;" src="imgs/no_logo.jpg" id="Logo_image" alt="">
							</div>
						</div>

					</div>
					
				</div>		
<br>				
			</div>
		</form>
	</div>			
	
	<tr class="modal-tr" data-toggle="modal" data-target="#ModalResultados">
	
	<div class="modal fade" tabindex="-1" role="dialog" id="ModalResultados">
	  <div class="modal-dialog modal-md">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Resutados</h4>
		  </div>
		  <div class="modal-body">
			<div class="row">
				<div class="col-md-6">
					Coliformes totales: 
				</div>
				<div class="col-md-6">
					<input type="number" id="parametro" class="form-control" /> 
				</div>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			<button type="button" class="btn btn-primary">Guardar</button>
		  </div>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<script>
		function cargaImg() {
			var oFReader = new FileReader();
			oFReader.readAsDataURL(document.getElementById("File_logo").files[0]);
			oFReader.onload = function (oFREvent) {
				document.getElementById("Logo_image").src = oFREvent.target.result;
			};
		}
	</script>

    <script src="js/jquery-2.2.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
</html>