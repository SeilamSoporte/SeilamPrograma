
$(document).ready(function(){ //cuando el html fue cargado iniciar
    //añado la posibilidad de editar al presionar sobre edit
    $("#cargando").css("display", "");
    CargarTabla();
    $(".table").css("display", "");

    $(".busqueda").on("change",function(){
        buscar();
    });

/*
    $('.editParametro').click(function(event){
		//event.preventDefault();
        var id=$(this).attr('data-id');
		alet(id);
        params={};
        params.id=id;
        params.action="editParametro";
        //$('#FormParametro').load('templates/parametrosForm.php', params,function(){
			
        //})
		//event.preventDefault();
    })
*/
    $('.delete').click(function(){
        //event.preventDefault();
		var id=$(this).attr('data-id');
		params={};
        params.id=id;
        params.action="eliminarParametro";
		params.mensaje="Está seguro de eliminar el párametro: ";
        $('#confirma').load('./templates/dialogs.php', params,function(){
			//alert("Ok");
        })
		event.preventDefault();
    })

    $('#btn_fltn').click(function(){
        event.preventDefault();
        var id=0;
		params={};
        params.id=id;
        $('#FormParametro').load('templates/parametrosForm.php', params,function(){
      })
    })	

})	// Fin document ready
function EditarParam(id){
        //var id=$(this).attr('data-id');
    params={};
    params.id=id;
    params.action="editParametro";
    $('#FormParametro').load('templates/parametrosForm.php', params,function(){  })
}

function CargarTabla(){
    $.post("./clases/buscar.php", {valorBusqueda: 'Todo'}, function(mensaje) {
        $("#tbody-parametros").html(mensaje);
        $("#cargando").css("display", "none");
    }); 
}  


function buscar() {
    var textoBusqueda = $("input#filter").val();
        $("#cargando").css("display", "");
        if (textoBusqueda != "") {
        $.post("./clases/buscar.php", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#tbody-parametros").html(mensaje);
            $("#cargando").css("display", "none");
        }); 
    } else { 
        CargarTabla();
    };
};

$(document).on("click","#btn-agregar",function(){
    datos = {};
    
    $(".Comparador") .each(function(i){ datos.in=i+1; });
    //datos.in =$('.Comparador').attr('data-id'); 
    $.post("templates/body_parametros_blank.php",datos ,function(htmlexterno){
        $("#tabla tbody").append(htmlexterno);
    });
});
         
// Evento que selecciona la fila y la elimina 
$(document).on("click",".eliminar",function(){
    var parent = $(this).parents().get(0);
    $(parent).remove();
});
        
$(document).on('change','.Comparador', function (){
    id = $(this).attr('data-id');
    if($(this).val()>7){
     if ($(this).val()==10){
            $('#Limite'+id).css('display', 'none');
            $('#Min'+id).css('display', 'inline');
            $('#Max'+id).css('display', 'inline');
            $('#Max'+id).val(''); 
            $('#Min'+id).val('');
        }
        else{
            $('#Limite'+id).css('display', 'block');
            $('#Min'+id).css('display', 'none');
            $('#Max'+id).css('display', 'none');
            $('#Limite'+id).val('0');
            $('#Limite'+id).prop('disabled', true);
        }
        
    }
    else {
        $('#Limite'+id).prop('disabled', false);
        $('#Limite'+id).css('display', 'block');
        $('#Min'+id).css('display', 'none');
        $('#Max'+id).css('display', 'none');
    }   
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
        datos.tipo      = Array();
        datos.equipo    = Array();
        datos.solucion  = Array();
        Nd              = 0;
        $(".Parametro")  .each(function(i){ datos.parametro[i]  =$(this).val(); Nd++; });
        $(".Norma")      .each(function(i){ datos.norma [i]     =$(this).val(); });
        $(".Comparador") .each(function(i){ datos.comparador[i] =$(this).val(); });
        $(".Metodo")     .each(function(i){ datos.metodo[i]     =$(this).val(); });
        $(".Referencia") .each(function(i){ datos.referencia[i] =$(this).val(); });
        $(".Limite")     .each(function(i){ datos.limite[i]     =$(this).val(); });
        $(".Tipo")       .each(function(i){ datos.tipo[i]       =$(this).val(); });
        $(".Equipo")     .each(function(i){ datos.equipo[i]     =$(this).val(); });
        $(".Solucion")   .each(function(i){ datos.solucion[i]   =$(this).val(); });
        //alert(datos.solucion);
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
        params.action="deleteParametro";
		
        $.post('./resources/QueryS_Parametros.php', params,function(data){
			$("#tabla-usuarios").load("./templates/tabla-usuarios.php")	;
            location.reload();
        })
 }

$(function () {
	$('[data-toggle="modal"]').tooltip();
});
$(function () {
    $('[data-toggle="collapse"]').tooltip();
});
    