
$(document).ready(function(){ //cuando el html fue cargado iniciar
    $("#cargando").css("display", "none"); 

    $("#volver").click(function(){
        desde = $(this).attr('fecha-d');
        hasta = $(this).attr('fecha-h');

        $("#form_insert").html('<form action="../index.php" id="form" name="form" method="post" style="display:none;"> <input type="text" name="valida" value="true" /><input type="text" name="desde" value="'+desde+'" /><input type="text" name="hasta" value="'+hasta+'" /><input type="text" name="back" value="true" /></form>' );
        $("#form").submit();
        
    });

    $(".edit").click(function(){
        var token  = Math.round(Math.random()*(1000000000 - 100000023) + 100000023); 
        var id     = $(this).attr('data-id')*token + token;
        var desde  = $(this).attr('desde');
        var hasta  = $(this).attr('hasta');   
        var fecha_d= desde;
        var fecha_h= hasta;
        var form   = '<form action="templates/editarResultados.php" id="form" name="form" method="post" style="display:none">';
        var inputs = '<input type="text" name="id" value="'+id+'" /> <input type="text" name="t-ram" value="'+token+'" /> <input type="text" name="fecha_d" value="'+fecha_d+'" /> <input type="text" name="fecha_h" value="'+fecha_h+'" /> ';
     
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
        saveR.codigo_M = $(".num")      .attr('data-id');
        saveR.Nro      = $(".num")      .attr('cons-id');
        color          = $("#color")    .val();
        olor           = $("#olor")     .val();
        aspecto        = $("#aspecto")  .val();
        saveR.fechaR   = $("#fechaR")   .val();
        
        saveR.Caracte  = color+"|"+olor+"|"+aspecto;
        var resultados = '';
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
                params={};
                params.action ='1';
                params.mensaje="Los datos de la muestra <strong class='text-primary'>"+saveR.codigo_M+"-"+saveR.Nro +"</strong> se han guardados exitosamente...";
                //if (data1==0 ){params.mensaje="No se han realizado cambios...";}
                $('#informacion_g').load('dialogs.php', params,function(){
                 })//load
            }) //post data1      
        }) //post data
    } //fin function guardarDatos

    $('#btn_fltn').click(function(){
        var Btn_function =$(this).attr('id-btn');
        if (Btn_function=="nuevo"){  
            window.location = 'templates/editMuestra.php';
        }
       
    }) ;    

})	// Fin document ready


$(function () {
	$('[data-toggle="modal"]').tooltip()
});
