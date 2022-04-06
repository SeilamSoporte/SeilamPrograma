<?php
/*
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
}*/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Parametrización</title>
	<link href="fonts/fnt-awesome.min.css" rel="stylesheet">
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
		.panel-primary
		{
			border:0px solid #FFF;
		}
		.fila-base{ display: none; } /* fila base oculta */
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
	
<form>
	<div class="panel panel-primary box-shadow-2dp" style="width:90%; margin:auto; border:0px solid #FFF"> 
		<div class="panel-heading" style="text-align:center">PARAMETRIZACIÓN DE MUESTRA</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
					  <label for="FechaIngreso">Área de análisis</label>
						<select class="form-control" id="Area">
						  <option value="0"> </option>
						  <option value="1">Microbiología</option>
						  <option value="2">Fisicoquímico</option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					  <label for="FechaIngreso">Categoría de muestra</label>
						<select class="form-control" id="Categoria">
							<option value="0"> </option>
							<option value="1"> Control De Higiene </option>
							<option value="2"> Alimentos Consumo Humano </option>
							<option value="3"> Alimentos Consumo Animal </option>
							<option value="4"> Aguas Tratadas </option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					  <label for="FechaIngreso">Clase de muestra</label>
						<select class="form-control" id="Categoria">
							<option value="0"> </option>
							<option value="1"> Frotis a manipuladores </option>
							<option value="2"> Frotis a superficies mohos y levaduras </option>
							<option value="3"> Placa de ambiente  Mesofilos </option>
							<option value="4"> Placa de ambiente  Mesofilos</option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="btn-agregar"> &nbsp;</label><br>
						<button style="width:100%" type="button" class="btn btn-primary" id="btn-agregar"> Agregar parámetro</button>
							<!-- Botón para agregar filas 
							<input type="button" id="agregar" value="Agregar fila" />-->
					</div>
				</div>
			</div>	
				
				<div class="table-responsive">
						<table class="table table-hover" id="tabla" >
							<thead>
								<tr  class="success">
									<th>Párametro</th>
									<th>Norma de referencia</th>
									<th>Comparador</th>
									<th>Límites permisibles</th>
									<th>Método de ensayo</th>
									<th>Referencia del método</th>
									<th> </th>
								</tr>
							</thead>
							<tbody>
							<!-- fila base para clonar y agregar al final -->
							<tr class="fila-base">
							<!--	<tr> -->
									<td> 					  	
										<select class="form-control" id="Parametro">
											<option value="0"> </option>
											<option value="1"> Coliformes fecales </option>
											<option value="2"> Coliformes totales </option>
											<option value="3"> Salmonella </option>
											<option value="4"> Mohos y Levaduras </option>
										</select> 
									</td>
									<td>
										<input type="text" id="Norma" class="form-control" placeholder="Norma">
									</td>
									<td>
										<select class="form-control" id="Limites">
											<option value="1"> < </option>
											<option value="2"> > </option>
											<option value="3"> >= </option>
											<option value="4"> <=</option>
											<option value="5"> =</option>
											<option value="6">Res/100mL </option>
										</select>
									</td>
									<td>
										<input type="number" id="Limites" class="form-control" placeholder="Limites">
									</td>
									<td>
										<input type="text" id="Metodo" class="form-control" placeholder="Método">
									</td>
									<td>
										<input type="text" id="Referencia" class="form-control" placeholder="Referencia">
									</td>
									<td class="eliminar">
									<div>
										<button type="button" class="btn btn-danger"  data-toggle="tooltip" data-placement="top" ria-label="Left Align" title="Eliminar parámetro">
										  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
										</button>	
									</div>
									</td>
								<!--</tr> -->
								</tr>
								<!-- fin de código: fila base -->
 
 
							</tbody>
						</table>
				</div>
		</div>
	</div>

</form>
<br>
<br>
<br>	
    <script src="js/jquery-2.2.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script>
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		});
	</script>
	<script>	
		$(function(){
			// Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
			$("#btn-agregar").on('click', function(){
				$("#tabla tbody tr:eq(0)").clone().removeClass('fila-base').appendTo("#tabla tbody");
			});
		 
			// Evento que selecciona la fila y la elimina 
			$(document).on("click",".eliminar",function(){
				var parent = $(this).parents().get(0);
				$(parent).remove();
			});
		}); 	
	
	</script>

</body>
</html>