
$(document).ready(function(){ //cuando el html fue cargado iniciar
    $("#cargando").css("display", "none"); 

    $("#volver").click(function(){
        desde = $(this).attr('fecha-d');
        hasta = $(this).attr('fecha-h');

        $("#form_insert").html('<form action="../index.php" id="form" name="form" method="post" style="display:none;"> <input type="text" name="valida" value="true" /><input type="text" name="desde" value="'+desde+'" /><input type="text" name="hasta" value="'+hasta+'" /><input type="text" name="back" value="true" /></form>' );
        $("#form").submit();
 //       $("#form_insert").html('<form action="../index.php" id="form" name="form" method="post" style="display:none;"> <input type="text" name="valida" value="true" /></form>' );
 //       $("#form").submit();
        
    });

    $(".edit").click(function(){
        var token = Math.round(Math.random()*(1000000000 - 100000023) + 100000023); 
        var id    = $(this).attr('data-id')*token + token;
        var desde  = $(this).attr('desde');
        var hasta  = $(this).attr('hasta');   
        var fecha_d= desde;
        var fecha_h= hasta;
        var form  = '<form action="templates/editarResultados.php" id="form" name="form" method="post" style="display:none">';
        var inputs = '<input type="text" name="id" value="'+id+'" /> <input type="text" name="t-ram" value="'+token+'" /> <input type="text" name="fecha_d" value="'+fecha_d+'" /> <input type="text" name="fecha_h" value="'+fecha_h+'" /> ';

        //var inputs= '<input type="text" name="id" value="'+id+'" /> <input type="text" name="t-ram" value="'+token+'" /> ';
        $("#SendForm").html(form+inputs+'</form>');
        $("#form").submit();
    });
    var Nro = $('.num').attr('cons-id');
    if (Nro == 0) {$('#Guardar').prop("disabled", true)}

    $('#btn_fltn_listado').click(function(event){
        event.preventDefault();
        id='1';
        params={};
        params.id=id;
        $('#informacion').load('../resources/lista.php', params,function(){ })
    })

   var jQueryDatePickerOptions =
       {
          dateFormat: 'yy-mm-dd',
          changeMonth: false,
          changeYear: true,
          showButtonPanel: false,
          showAnim: 'slide'
       };
    $(".fechasJQ").datepicker(jQueryDatePickerOptions);
    
 
    $('#filtrar').click(function(){
       $('#content tbody').html('<tr> <td colspan="4" style="font-weight:bold; text-align:center; height:100px; vertical-align: middle;"> CARGANDO DATOS... </td> </tr>');
        params      = {};
        params.desde= $('#desde').val();
        params.hasta= $('#hasta').val();
        params.refresh=true;
        $('#content').load('./templates/muestrasGrid.php', params,function(){ })
    });
    
/*************************************************************************************************/
/*************************************************************************************************/
/*************************************************************************************************/

 $('.load_muestra').click(function(){
    $('.load_muestra').prop("disabled",false);
    var id      = $(".codigoI").attr('data-id');
    var nro     = $(this).attr('data-id');
    $(this).prop("disabled", true);
    params      = {};
    params.id   = id;
    params.Nro  = nro;
    params.call = true;
    $('#panel_muestra').removeClass('hidden');
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
            
            if($(this).val()==""){
                $(this).addClass("Nulo");
                params={};
                params.action ='null';
                params.mensaje="No se ha podido guardar los cambios en los resultados de muestra debido a que hay campos obligatorios vacíos ";
                $('#informacion_g').load('dialogs.php', params,function(){  });
                flag=false;
            }
            //alert($(this).val());
        })
       return flag;
    } //validaCampos

    function guardarDatos()
    {   
        saveR = {};
        flagD = false;
        saveR.action   = "consulta";
        saveR.codigo_M = $(".num")     .attr('data-id');
        saveR.Nro      = $(".num")     .attr('cons-id');
        var resultados = '';
        var ResComparador = '';
        
        saveR.fechaR   = $("#fechaR")   .val();
        var i=0;
        $(".resultado").each(function(i){
            resultados = (i>0) ? resultados+"|"+$(this).val() : $(this).val();
        })
        $(".incertidumbre").each(function(i){
            incertidumbres = (i>0) ? incertidumbres+"|"+$(this).val() : $(this).val();
        })        
        $(".ResComparador").each(function(i){

            ResComparador = (i>0) ? ResComparador+"|"+$(this).val() : $(this).val();
        })
        
        saveR.ResComparador = ResComparador;
        saveR.resultado     = resultados;
        saveR.incertidumbre = incertidumbres;
        
        $.post("../resources/querys_resultados.php", saveR,function(data){ 
            params={};
            params.action ='1';
            //params.mensaje="Los datos de la muestra <strong class='text-primary'>"+saveR.codigo_M+"-"+saveR.Nro +"</strong> se han guardados exitosamente...";
            if (data==0 )
            { saveR.action= "insertNuevoR"; }
            else
            { saveR.action= "updateResults";}
            
            $.post("../resources/querys_resultados.php", saveR,function(data1){ 
                console.log(data1);
                params={};
                params.action ='1';
                params.mensaje="Los datos de la muestra <strong class='text-primary'>"+saveR.codigo_M+"-"+saveR.Nro +"</strong> se han guardados exitosamente...";
                if (data1==0 ){params.mensaje="No se han realizado cambios...";}
                $('#informacion_g').load('dialogs.php', params,function(){ })//load
            }) //post data1      
        }) //post data
    } //fin function guardarDatos

    $('#btn_fltn').click(function(){
        var Btn_function =$(this).attr('id-btn');
        if (Btn_function=="nuevo"){  
            window.location = 'templates/editMuestra.php';
        }
       
    }) ;    
/*
    $('.delete').click(function(){
		var id=$(this).attr('data-id');
		params={};
        params.id=id;
        params.action="eliminarParametro";
		params.mensaje="Está seguro de eliminar la muestra: ";
        $('#confirma').load('./templates/dialogs.php', params,function(){
			
        })
		event.preventDefault();
    })*/

})	// Fin document ready

/*
function LoadParametro(id, callback) {
    var resp;
    datos={};
    datos.id= id;
    datos.action = "readParametro";
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
/*
function LoadComparador(id,lim){
    switch (id){
        case "1":
            return "<"+lim;
        break;
        case "2":
            return ">"+lim;
        break;
        case "3":
            return "<="+lim;
        break;
        case "4":
            return ">="+lim;
        break;
        case "5":
            return "="+lim;
        break;
        case "6":
            return lim+"/100mL";
        case "7":
            return lim+"/250mL";
        break;
    }
}
*/
/*
function update_celda(celda,texto){
    var celda=$("#"+celda);
    celda.text(texto);
}  
*/
// Evento que selecciona la fila y la elimina 
/*
$(document).on("click",".eliminar",function(){
    var parent = $(this).parents().get(0);
    $(parent).remove();
});
*/    
/*
$(document).on('click', '#Guardar_resultado' , function(){
    alert("Save");
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
*/

/*

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
*/


$(function () {
	$('[data-toggle="modal"]').tooltip()
});
