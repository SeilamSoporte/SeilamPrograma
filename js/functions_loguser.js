$(document).ready(function(){ //cuando el html fue cargado iniciar
 
    $("#password").keypress(function(e){
        if (e.which==13){
            valida();
        };
    });
 
    $("#login_btn").click(function(){
        valida();
     });
 
     function valida(){  // 
        datos           = {};
        datos.username  = $("#username").val();
        datos.password  = $("#password").val();
        datos.page      = $(".login-panel").attr("data-id");
        datos.form_name = "loginform";
        Token           = Math.round(Math.random()*(1000000000 - 1000023) + 1000023);
        datos.token     = Token;
        $.post("enter.php", datos, function(datas)
        {
            data = datas.split(";");
            acc = {};
            acc.permisos = data[1]
            acc.modulo   = datos.page;
            if (data[0]==Token){
                $.post("common/accus.php", acc, function(datacc)
                {
                   if (datacc=="true"){ 
                    $("#form_insert").html(
                        '<form action="'+datos.page+'.php" id="form" name="form" method="post" style="display:none;"> <input type="text" name="valida" value="true" /><input type="text" name="user" value="'+datos.username+'" /></form>'
                        );
                    $("#form").submit();
                    //window.location = datos.page+".php?a="+datacc+"&b="+Token ;
                }
                   else {
                    $("#loginModal").load("log_user.php?action=error&id="+$("#username").val());
                   }
                });
            }
            else if (data[0]=='inactivo')
            {
                $("#Error").html("** Error de acceso! - Usuario inactivo **");  
            }
            else
            { 
                $("#Error").html("** Error de acceso! - Clave o usuario incorrecto **");
            }
        });
 
    }
 
});