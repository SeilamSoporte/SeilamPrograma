<?php
    include_once ('./mod_empresa/clases/datos.php');
?> 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ASSET Software</title>
    <meta content="chrome=1, IE=edge" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <link href="imgs/asset_favicon.png" rel="icon" type="image/png" />
    <link href="fonts/font-awesome.min.css" rel="stylesheet">
    <link href="css/estilos.css" rel="stylesheet">
    <!-- <link href="css/index.css" rel="stylesheet"> -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/flexboxgrid.css" rel="stylesheet">
    <link rel="stylesheet" href="fancybox/jquery.fancybox-1.3.4.css">
</head>
<style type="text/css">
.logo_asset{
    display: flex;
    flex-wrap: nowrap;
}
.azul{
    color:#004AFF;
}
.verde{
    color:#5cb85c;
}
#logo_asset{
    top:25px;
    overflow: hidden;
    z-index: -1;
    background-color: transparent;
    font-family:'Myanmar Text';
    padding-bottom:25px;
}  
.logo{
    font-size: 3.5em;
 }
.text-logo{
    font-size:3em;
    font-weight : bold;     
}
.menu{
    position: absolute;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-content: center;
    align-items: flex-start;
     
    display: -webkit-flex;
    -webkit-justify-content: center;
    -webkit-align-items: flex-start;
     
    margin-top: 5%;
    border: 0px solid #000;
    width: 100%;
 
}
 
.item-menu{
    margin: 2px;
    width: 100px;
    height: 100px;
    border: 1px solid #000;
    color: #000;
    max-width: 50%;
    flex:none;
    cursor: pointer;
}
 
.menu .li
{
    width: 110px;
    height: 100px;
    padding-top: 15px;
    line-height: 1.5;
    text-align: center;
    background-color:  #4169E1;
    border: 1px solid rgba(65, 105, 255, 0.2);
    color: #fff;
    margin-right: 5px;
    border-radius: 5px;
}
.menu .li:hover{
    border-bottom: 3px solid #5cb85c /*rgba(65,105,255,1) */;
    border-top: 1px solid #5cb85c /*rgba(65,105,255,1) */;
    background-color: #FFF;
    cursor: pointer;
    color: #5cb85c ;
}
.menu-text {
    display: block;
    text-align: center;
    word-wrap: break-word;
    font-size: 1.0em;
}
.dropdown-menu {
    position: relative;
    top: 105%;
    left: 0;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 110px;
    width: 100px;  
    padding:0;
    margin:15px 0 0 0;
    color: #4169E1;
    font-size: 1.0em;
    text-align: left;
    list-style: none;
    background-color: #fff;
    -webkit-background-clip: padding-box;
            background-clip: padding-box;
    border: 1px solid #4169E1 ;
    border: 1px solid rgba(65, 105, 255, 0.2);
    border-radius: 0px;
    -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
        box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
}
.dropdown-menu > li {
    height: 40px; 
    text-align: center;
    line-height: 3; 
}
.dropdown-menu >li:hover {
    border-bottom: 0px solid #5cb85c /*rgba(65,105,255,1) */;
    background-color: #dff0d8;
    cursor: pointer;
    color: #5cb85c ;
}
.texto-empresa{
    background-color: #4169E1;
    height: 45px;
    padding: 12px 0;
    color:#FFF;
    font-family: "Myanmar Text";
    font-size: 1.1em;
}
 
.footer{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-content: center;
    align-items: center;
 
    flex-direction: column-reverse; 
     
    display: -webkit-flex;
    -webkit-justify-content: center;
    -webkit-align-items: center;
     
    border: 0px solid #000;
    width: 100%;
    height: 250px;
    position: absolute;
    top:58%;
}
 
 
.logo-box{
    height: 100px;
    width: 240px;
    border-radius: 10px;
    border:0px solid rgba(65, 105, 255, 0.5);
    background-color: #FFF;
    box-shadow: 0 6px 12px rgba(0, 0, 0, .3);
    left:50% ;
    margin-left: -120px;
    top: -50px;
}
#Img_Logo{
    max-height : 72px;
    max-width  : 184px;
    position   : absolute;
    left       : 50%;
    top        : 50%;
    transform  : translate(-50%, -50%);
}
.texto-empresa{
    background-color: #4169E1;
    height: 45px;
    padding: 12px 0;
    color:#FFF;
    font-family: "Myanmar Text";
    font-size: 1.1em;
}
.linea{
    width : 100%;
    position: relative;
    top: 30%;
    left:0px;
    background-color: rgba(65, 105, 255, 1  );
    height: 70px;
    width: 99%
    margin: auto;
    box-shadow: 0 5px 10px rgba(0, 0, 0, .4);
    border: 1px solid rgba(65, 105, 255, 0.2);
}
.logo-box{
    position: absolute;
    display: table;
    height: 100px;
    width: 240px;
    border-radius: 10px;
    border:0px solid rgba(65, 105, 255, 0.5);
    background-color: #FFF;
    box-shadow: 0 6px 12px rgba(0, 0, 0, .3);
    left:50% ;
    margin-left: -120px;
    top: -50px;
}
 
 
body{
    background: rgba(96, 125, 139, .06) !important;
}
 
</style>
 
<body>    
<div class="row logo_asset">
    <div class="col col-xs-12" id="logo_asset">
        <i class="fa fa-sheqel logo fa-2x"></i>
        <span class="text-logo azul">AS</span><span class="text-logo verde">S</span><span class="text-logo azul">ET <i class='verde' style="font-size: 20pt">V 2.1</i></span>
    </div>
</div>
 
<div class="row menu">
    <div class="item-menu li" id="menu_muestras" data-toggle="modal" data-type="tooltip" data-target="#loginModal" title="Ingreso de Muestras" data-target="#loginModal" data-placement="bottom">
        <span class="fa fa-flask fa-2x" aria-hidden="true"></span>
        <span class="menu-text" >Muestras</span>
    </div>
 
    <div class="col col-sm-1 li" id="menu_ordenes" href="#" data-toggle="modal" data-type="tooltip" data-target="#loginModal" title="Impresi&#243;n  de Ordenes de Servicio" data-placement="bottom">
        <span class="fa fa-paste fa-2x" aria-hidden="true"></span>
        <span class="menu-text" >Ordenes de servicio</span>
    </div>
    <div class="item-menu li">
        <div class="" role="group">
            <div class="resultados" data-toggle="dropdown" data-type="tooltip" title="Ingreso de Resultados" aria-haspopup="true" aria-expanded="false">
                <span class="fa fa-check-square-o fa-2x" aria-hidden="true"></span>
                <span class="menu-text" >Resultados</span>
                <span class="caret"></span>         
            </div>
                <ul class="dropdown-menu">
                  <li id="menu_muestras_MB" data-toggle="modal" data-target="#loginModal">Microbilógicos</li>
                  <li id="menu_muestras_FQ" data-toggle="modal" data-target="#loginModal">Fisicoquímico</li>
                </ul> 
        </div>
    </div>
     
    <div class="item-menu li" id="menu_informes" data-toggle="modal" data-type="tooltip" data-target="#loginModal" title="Impresi&#243;n de informes"  data-placement="bottom">
            <span class="fa fa-file-text-o fa-2x" aria-hidden="true"></span>
            <span class="menu-text" >Informes</span>
        </div>
    <div class="item-menu li parametrizacion" id="menu_parametros" data-toggle="modal" data-type="tooltip" data-target="#loginModal" title="Parametrizaci&#243;n de muestras" data-placement="bottom" >
            <span class="fa fa-table fa-2x" aria-hidden="true"></span>
            <span class="menu-text" >Parametrización</span>
        </div>
    <div class="item-menu li" id="menu_clientes" data-toggle="modal" data-type="tooltip" title="Consulta de clientes" data-target="#loginModal" data-placement="bottom">
        <span class="fa fa-users fa-2x" aria-hidden="true"></span>
        <span class="menu-text" >Clientes</span>
    </div>
    <div class="item-menu li" id="menu_usuarios" data-toggle="modal" data-type="tooltip" title="Usuarios del sistema" data-target="#loginModal"  data-placement="bottom">
        <span class="fa fa-user fa-2x" aria-hidden="true"></span>
        <span class="menu-text" >Usuarios</span>
    </div>
    <div class="item-menu li" id="menu_empresa" data-toggle="modal" data-type="tooltip" title="Configurar datos de la empresa" data-target="#loginModal" data-placement="bottom">
        <span class="fa fa-building fa-2x" aria-hidden="true"></span>
        <span class="menu-text" >Datos de la empresa</span>
    </div>
    <div class="item-menu li" id="menu_admin" data-toggle="modal" data-type="tooltip" title="Administración de datos" data-target="#loginModal" data-placement="bottom">
        <span class="fa fa-database fa-2x" aria-hidden="true"></span>
        <span class="menu-text" >Administración de datos</span>
    </div>
    <div class="item-menu li" id="menu_facturas" data-toggle="modal" data-type="tooltip" title="Relación de facturas" data-target="#loginModal" data-placement="bottom">
        <span class="fa fa-tags fa-2x" aria-hidden="true"></span>
        <span class="menu-text" >Relación de facturas</span>
    </div>
    <div class="item-menu li" id="menu_informes_simplificados" data-toggle="modal" data-type="tooltip" title="Informes simplificados" data-target="#loginModal" data-placement="bottom">
        <span class="fa fa-tags fa-2x" aria-hidden="true"></span>
        <span class="menu-text" >Informes simplificados</span>
    </div>
</div>
    <div class="footer col col-xs-12 hidden-xs">
        <div class="linea">
            <div class="logo-box">
                <img id="Img_Logo" src="<?php echo $src_logo ?>">
            </div>
        </div>
    </div>
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"> </div>
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"> </div>
 
</div>
    <script src="js/jquery-1.11.3.min.js"></script>
     
    <script src="js/jquery-2.2.2.min.js"></script>
    <script src="js/functions.js"></script>
    <script src="js/bootstrap.min.js"></script>
 
 
</body>
</html>