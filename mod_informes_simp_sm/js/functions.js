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
    $('#filtrar').click(function(){
       $('#content tbody').html('<tr> <td colspan="5" style="font-weight:bold; text-align:center; height:100px; vertical-align: middle;"> CARGANDO DATOS... </td> </tr>');
        params      = {};
        params.desde= $('#desde').val();
        params.hasta= $('#hasta').val();
        params.refresh=true;
        $('#content').load('./templates/listGrid.php', params,function(){ })
    });

/*    $('.printed').click(function(){
        params       = {};
        params.estado= $(this).is(':checked');
        params.id    = $(this).attr('data-id');
        params.action= 'updatePrint';
        var estado   = $(this).is(':checked');
        if (estado==true){
            params.estado = 1;
        }
        else{
            params.estado = 0;   
        }
        $.post("./resources/Querys_Informes.php", params,function(data){ });
    });    */
}) // FIN DEL READY 