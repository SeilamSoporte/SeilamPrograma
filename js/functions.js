$(document).ready(function(){ //cuando el html fue cargado iniciar
 
    $("#menu_muestras").click(function(){
        $("#loginModal").load("log_user.php?action=mod_muestras/index&id=0");
    });
 
    $("#menu_muestras_MB").click(function(){
        $("#loginModal").load("log_user.php?action=mod_resultados_MB/index&id=0&id_r=MB");
    });
     
    $("#menu_muestras_FQ").click(function(){
        $("#loginModal").load("log_user.php?action=mod_resultados_FQ/index&id=0&id_r=FQ");
    });
 
   $("#menu_informes").click(function(){
        $("#loginModal").load("log_user.php?action=mod_informes/index&id=0");
    });
 
    $("#menu_parametros").click(function(){
        $("#loginModal").load("log_user.php?action=mod_parametros/index&id=0");
    });
 
    $("#menu_clientes").click(function(){
        $("#loginModal").load("log_user.php?action=mod_clientes/index&id=0");
    });
 
    $("#menu_usuarios").click(function(){
        $("#loginModal").load("log_user.php?action=mod_usuarios/index&id=0");
    });
 
    $("#menu_admin").click(function(){
        $("#loginModal").load("log_user.php?action=mod_admin/index&id=0");
    });
     
    $("#menu_empresa").click(function(){
        $("#loginModal").load("log_user.php?action=mod_empresa/index&id=0");
    });
    $("#menu_ordenes").click(function(){
        $("#loginModal").load("log_user.php?action=mod_ordenes/index&id=0");
    });
    $("#menu_facturas").click(function(){
        $("#loginModal").load("log_user.php?action=mod_relfacturas/index&id=0");
    });
    $("#menu_informes_simplificados").click(function(){
        $("#loginModal").load("log_user.php?action=mod_informes_simp/index&id=0");
    });
    $(function () {
        $('[data-type="tooltip"]').tooltip()
    });
 
});