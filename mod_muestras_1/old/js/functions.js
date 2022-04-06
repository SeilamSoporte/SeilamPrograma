
$(document).ready(function(){ //cuando el html fue cargado iniciar
   var jQueryDatePickerOptions =
       {
          dateFormat: 'yy-mm-dd',
          changeMonth: false,
          changeYear: true,
          showButtonPanel: false,
          showAnim: 'slide'
       };
    $(".fechasJQ").datepicker(jQueryDatePickerOptions);
 
    $("#cargando").css("display", "none"); 
     //estadoCampos();

    $("#volver").click(function(){
        $("#form_insert").html('<form action="../index.php" id="form" name="form" method="post" style="display:none;"> <input type="text" name="valida" value="true" /></form>' );
        $("#form").submit();
        
    });
    
    $('#filtrar').click(function(){
        params      = {};
        params.desde= $('#desde').val();
        params.hasta= $('#hasta').val();
        params.refresh=true;
        $('#content').load('./templates/muestrasGrid.php', params,function(){ })
    });
    $('#btn_fltn_listado').click(function(event){
        event.preventDefault();
        id='1';
        params={};
        params.id=id;
        $('#informacion').load('../resources/lista.php', params,function(){ })
    })
    
  $('#Cliente').change(function(){
        var datos={};
        datos.IdCliente=$(this).val();
        $.post("../resources/loadSedes.php", datos,function(data){
            var sedes   = Array();
            sedes       = data.split("|");
            opciones ='';
            sedes.forEach(function(elem,i){
                opciones = opciones + '<option value="'+i+'">'+elem+'</option>';
                $('#sede').html(opciones);
            });
        });

    });

 $('.load_muestra').click(function(){
    $('.load_muestra').prop("disabled",false);
    var id      = $(".codigoI").attr('data-id');
    var nro     = $(this).attr('data-id');
    $(this).prop("disabled", true);
    params      = {};
    params.id   = id;
    params.Nro  = nro;
    params.call = true;
    $('#panel_muestra').load('muestrasPanel.php', params,function(){

    });

 })

  $('#Guardar').click(function(){

    if(validaCampos()){
        guardarDatos(); 
        }
    }) // Fin Guardar

    function validaCampos(){
        var flag=true;
        $(".requerido").each(function(){
        $(this).removeClass("Nulo");
            if($(this).val()==""){
                $(this).addClass("Nulo");
                //alert($(this).attr('id'));
                params={};
                params.action ='null';
                params.mensaje="No se ha podido guardar los cambios en los detalles de muestra debido a que hay campos obligatorios vacíos ";
                $('#informacion_g').load('dialogs.php', params,function(){
                });
                flag=false;
            }
        })
        return flag;
    } //validaCampos

    function guardarDatos()
    {
        saveM = {};
        saveD = {};
        flagD = false;
        saveM.action        = "updateM";

        saveM.cliente       = $("#Cliente").          val();
        saveM.fecha_ingreso = $("#Fecha_ingreso").    val();
        saveM.fecha_recolec = $("#Fecha_recoleccion").val();
        saveM.hora_ingreso  = $("#hora_ingreso").     val();
        saveM.sede          = $("#sede").             val();
        var encargado       = $("#Encargado").        val();
        var recolectado     = $("#Recolectado").      val();
        saveM.nombres       = encargado+"|"+recolectado;
        saveM.codigo_M      = $(".codigoI").attr("data-id");
        saveD.codigo_M      = saveM.codigo_M;
        
        if (saveM.codigo_M==''){  
          saveM.codigo_M    =0;
          saveM.action      = "insertM";
          saveD.action      = "insertDetMuestra";
        }
        
        saveD.Nro               = $(".num")             .attr('cons-id');
        saveD.parametro         = $("#codigo")          .val();
        saveD.acta              = $("#acta")            .val();
        saveD.descripcion       = $("#descripcion")     .val();
        saveD.observacion       = $("#observaciones")   .val();
        saveD.temperatura       = $("#temperatura")     .val();
        saveD.lote              = $("#lote")            .val();    
        saveD.fechaprod         = $("#fecha_pro")       .val();
        saveD.fechavenc         = $("#fecha_ven")       .val();
        saveD.cantidad          = $("#cantidad")        .val();
        saveD.empaque           = $("#empaque")         .val();    
        saveD.medio             = $("#medio")           .val();
        saveD.datos_campo_cr    = $("#datos_campo_cr")  .val();
        saveD.datos_campo_ph    = $("#datos_campo_ph")  .val();
        saveD.datos_campo_temp  = $("#datos_campo_temp").val();
        saveD.estado_tiempo     = $("#estado_tiempo")   .val();
        saveD.hora_rec          = $("#hora")            .val();
        saveD.lugar             = $("#lugar")           .val();
        saveD.unidad            = $("#unidad")          .val();
        saveD.datosencampo      = '';

        $(".datoencampo").each(function(i){
            if(i==0){ saveD.datosencampo= $(this).val(); }
            else{ saveD.datosencampo    = saveD.datosencampo +"|"+ $(this).val();}
        })
        $.post("../resources/Querys_Muestras.php", saveM,function(data){ 
            var it  = (data*255)+255;
            //alert(saveM.action);
            
            if (saveM.action == "insertM")
            {
                saveD.action    = "insertDetMuestra";
                saveD.Nro       = 1;
                saveD.codigo_M  = data;  
                //alert(data);      
                $.post("../resources/Querys_Muestras.php", saveD,function(data1){ 
                    params={};
                    params.action ='1';
                    params.mensaje="Los datos de la muestra <strong class='text-primary'>"+saveD.codigo_M+"-"+saveD.Nro +"</strong> se han guardados exitosamente...";
                    
                    if (data==0 && data1==0 ){params.mensaje="No se han realizado cambios...";}
                    
                    $('#informacion_g').load('dialogs.php', params,function(){ 
                       var params   = {};
                       params.id    = saveD.codigo_M;
                       $.post('../resources/randLink.php',params,function(link){
                            window.location = link;
                       });
                    })//load   
                });
            }
            else{
                saveD.action    = "updateMuestras";
                $.post("../resources/Querys_Muestras.php", saveD,function(data1){ 
                    params={};
                    params.action ='1';
                    params.mensaje="Los datos de la muestra <strong class='text-primary'>"+saveD.codigo_M+"-"+saveD.Nro +"</strong> se han guardados exitosamente...";
                    if (data==0 && data1==0 ){params.mensaje="No se han realizado cambios...";}
                    $('#informacion_g').load('dialogs.php', params,function(){
                         
                    })//load
                }) //post data1      
            } //else
        }) //post data        
    } //fin function guardaDatos


    $('#Add').click(function(e){
        e.preventDefault();
       
        params={};
        params.id           = $(".nueva_muestra").attr('data-id');
        params.Nro          = $(".nueva_muestra").attr('muestra-id');
        params.parametro    = $("#codigo_n").val();
        params.acta         = $("#acta").val();
        params.hora_ingreso = $('#hora').val();
        params.temperatura  = $('#temperatura').val(); 
//        params.CN           = $('.nueva_muestra').attr('muestra-id');
        params.action       = "insertNuevaM";
        
        if(params.parametro==0){
            alert("Debe escoger una opción!");
        }
        else{
            $.post("../resources/Querys_Muestras.php", params,function(data){
            location.reload();
            //$.post("../resources/load_btns.php", params,function(data){
            $('#botones').load('../resources/load_btns.php', params,function(){ });    
           // });
            params.call = true;
            $('#panel_muestra').load('muestrasPanel.php', params,function(){ });
            //$('#nuevo').modal('toggle');
         });
        }
    })
    
    $('#btn_fltn').click(function(){
        var Btn_function =$(this).attr('id-btn');
        if (Btn_function=="nuevo"){  
            var fecha = new Date();
            var dia = fecha.getDay();
            var mes = fecha.getMonth()+1;
            var hora= fecha.getHours();
            var send= (hora+6)+''+dia+''+mes; 
            params = {};
            
            $.post("resources/send.php", params,function(send){
                window.location = 'templates/editMuestra.php?s='+send;
            });
            
        }
       
    }) ;    

    $('.delete').click(function(){
		var id=$(this).attr('data-id');
		params={};
        params.id=id;
        params.action="eliminarParametro";
		params.mensaje="Está seguro de eliminar la muestra: ";
        $('#confirma').load('./templates/dialogs.php', params,function(){
			
        })
		event.preventDefault();
    })

})	// Fin document ready
/*
function readDatos(id,Nro, callback){
    var resp;
    datos={};
    datos.id= id;
    datos.Nro=Nro;
    datos.action = "readDatosC";
    $(document).ready(function(){
        $.ajax({
            type: 'POST',
            url: '../resources/QueryS_Muestras.php',
            contentType: "application/x-www-form-urlencoded",
            processData:true,
            data:datos,
            success: function(data){
                data=$.trim(data);
                resp = data;
                callback(resp);
            } 
        });
    });
    return resp;    
}
*/
function LoadParametro(id, callback) {
    var resp;
    datos={};
    datos.id= id;
    datos.action = "readParametro";
    $(document).ready(function(){
        $.ajax({
            type: 'POST',
            url: '../resources/Querys_Muestras.php',
            contentType: "application/x-www-form-urlencoded",
            processData:true,
            data:datos,
            success: function(data){
                data=$.trim(data);
                resp = data;
                callback(resp);
            } 
        });
    });
    return resp;
}

function LoadComparador(id,lim,lim2){
    switch (id){
        case "1":
            return "<"+lim;
        break;
        case "2":
            return ">"+lim;
        break;
        case "3":
            return "&le;"+lim;
        break;
        case "4":
            return "&ge;"+lim;
        break;
        case "5":
            return "="+lim;
        break;
        case "6":
            return lim+"/100mL";
        case "7":
            return lim+"/250mL";
        break;
        case "8":
            return "Ausencia";
        break;
        case "9":
            return "Negativo";
        break;
        case "10":
            return lim+" - "+lim2;
        break;
        case "11":
            return 'No específica';
        break;
    }
}

function update_celda(celda,texto){
    var celda=$("#"+celda);
    celda.text(texto);
}  

// Evento que selecciona la fila y la elimina 
$(document).on("click",".eliminar",function(){
    var parent = $(this).parents().get(0);
    $(parent).remove();
});
        
$(document).on('click', '#Guardar_parametro' , function(){
    var id          = $(this).attr('data-id');  
    datos           = {};                   //Definicion del contenedor que enviará los datos del formulario como parametros
    datos.id        = id;
    datos.action    = "saveParametro"; 
    datos.codigo    = $("#Codigo")   .val();
    datos.area      = $("#Area")     .val();
    datos.categoria = $("#Categoria").val();
    datos.clase     = $("#Clase")    .val();
        //var total_p =0;
        //$(".parametro").each(function(i){ total_p++ ; });
        datos.parametro = Array();
        datos.norma     = Array();
        datos.comparador= Array();
        datos.limite    = Array();
        datos.metodo    = Array();
        datos.referencia= Array(); 
        $(".Parametro")  .each(function(i){ datos.parametro[i]  =$(this).val(); });
        $(".Norma")      .each(function(i){ datos.norma [i]     =$(this).val(); });
        $(".Comparador") .each(function(i){ datos.comparador[i] =$(this).val(); });
        $(".Limite")     .each(function(i){ datos.limite[i]     =$(this).val(); });
        $(".Metodo")     .each(function(i){ datos.metodo[i]     =$(this).val(); });
        $(".Referencia") .each(function(i){ datos.referencia[i] =$(this).val(); });
        
        $.post("./resources/QueryS_Parametros.php", datos, function(data)
        {
            var Data=data.split(",");
                
                var documento = $(document.body);
                    if (data == 0 && dataCont==0 && Data[1]== 0){
                        
                        BootstrapDialog.show({
                            title: 'Atención', 
                            message: "<span class='glyphicon glyphicon-exclamation-sign' style='font-size:15px'></span> No se ha realizado ningun cambio.",                     
                            buttons:[{ label: 'Ok',
                                        action: function(dialogRef){dialogRef.close();} 
                                    }]
                            });
                        documento.attr("class","modal-opened");
                        }
                    else{
                        
                        BootstrapDialog.show({
                            title: 'Atención', 
                            message:"<span class='glyphicon glyphicon-ok'> </span> Los cambios se guardaron exitosamente.", 
                            type:"type-success",
                            buttons:[{ label: 'Ok',
                                        action: function(dialogRef){dialogRef.close(); $("#FormCliente").modal('toggle'); 
                                        //$("#tabla-clientes").load("./templates/tablaClientes.php");                               
                                        location.reload();
                                        }   
                                    }]
                            });
                    }

        })              

})//Guardar parámetro

function eliminar(id)
{
		params={};
        params.id=id;
        params.action="deleteMuestra";
		
        $.post('./resources/Querys_Muestras.php', params,function(data){
			$("#content").load("./resources/muestrasGrid.php")	;
            location.reload();  
        })
 }

