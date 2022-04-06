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

}) // FIN DEL READY 