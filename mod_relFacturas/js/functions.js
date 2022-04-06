
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
 
   $("#cargando_l").css("display", "none"); 

    $('#filtrar').click(function(){
       $("#cargando_l").css("display", ""); 
       // $("#cargando_l").removeClass("hide");
     //   $("#cargando").css("display", "inline");
        params      = {};
        params.desde= $('#desde').val();
        params.hasta= $('#hasta').val();
        params.refresh=true;
        $('#content').load('./templates/listaFGrid.php', params,function(){ $("#cargando_l").css("display", "none"); })

    });

})	// Fin document ready
 
function editarF(id){
    factura = $('#id-'+id).val();
    //alert(factura);
    params          = {};
    params.action   = "update_f";
    params.id       = id;
    params.factura  = factura;
    $.post('./resources/Querys_Muestras.php', params,function(data){  })
 }

