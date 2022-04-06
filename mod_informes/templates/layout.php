<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Informes</title>
        <link href="../favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <link href="../fonts/font-awesome.min.css" rel="stylesheet">
        <!-- Bootstrap -->    
        <link href="../css/jquery-ui.css" rel="stylesheet">
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/zeus.css" rel="stylesheet">
        <link href="../css/bootstrap-dialog.min.css" rel="stylesheet">
        <link href="../css/footable-0.1.css" rel="stylesheet" type="text/css" />  
        <!-- Materialize -->
        <link href="../css/checkbox-1.css" rel="stylesheet"> 
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
            <?php include_once '../logo-black.php'; ?>
            <?php    $F_desde  = $año_d."-".$mes_d."-".$dia_d;
                    $F_hasta  = $año."-".$mes."-".$hoy; 
            ?>
            </div>
            <div id="usuario_logeado" data-user="<?php echo $usuario_logeado ?>" ></div>
                <!--<form class="navbar-form navbar-left" role="search"> -->
                <div class="navbar-form navbar-left" role="search">
                  <div class="form-group form-control" style="margin-top:6px; ">
                    <input type="text" id="filter" class="busqueda" placeholder="Buscar" style="width:20em;">
                    <span class="glyphicon glyphicon-search"></span>
                  </div>
                  <div class="form-group form-control" style="margin-top:6px; ">
                    <input type="text" id="desde" class="busqueda fechasJQ" placeholder="Desde" style="width:7em;" value="<?php echo $F_desde ?>">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </div>
                  <div class="form-group form-control" style="margin-top:6px; ">
                    <input type="text" id="hasta" class="busqueda fechasJQ" placeholder="Hasta" style="width:7em;" value="<?php echo $F_hasta ?>">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </div>
                  <button type="button" class="btn btn-primary" id="filtrar" aria-label="Buscar" style="height: 34px; margin-top: 6px">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                  </button>   
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
    <div class="modal fade" id="informacion" role="dialog" tabindex="-1"></div>
     
<!--
<script src="../js/jquery-2.2.2.min.js"></script>
    <script src="../js/jquery-2.2.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-dialog.min.js"></script>
    -->
     
    <script src="./js/functions.js"></script>
     
</body>
</html>