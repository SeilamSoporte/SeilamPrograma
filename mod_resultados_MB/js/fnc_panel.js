
    $(function (){

   var jQueryDatePickerOptions =
       {
          dateFormat: 'yy-mm-dd',
          changeMonth: false,
          changeYear: true,
          showButtonPanel: false,
          showAnim: 'slide'
       };
        $(".fechasJQ").datepicker(jQueryDatePickerOptions);

        $(".ResComparador").change(function(){
            id  = $(this).attr("data-id");
            if ($(this).val()==4){
                resultado = $("#resultado"+id);
                resultado.prop('type', 'text');
                resultado.val('Incontable');
                resultado.prop('disabled', true);
            }
            else{
                $("#resultado"+id).prop('disabled', false);
                $("#resultado"+id).prop('type', 'number');
            }
        });
       });

    $('.resultado').change(function(){
        $('.reportar').prop('disabled',true);        
    });

    $('.reportar').click(function(){
        var vacio    = false;
        var id       = $(this).attr('data-id');
        var nro      = $(this).attr('cons-id');
        $('.resultado').each(function(i){
            if ($(this).val()==''){ vacio = true};
        });
        if(vacio==false){
            params       = {};
            params.id    = id;
            params.Nro   = nro;
            params.call  = true;
            params.action='reportar';
            $.post('../resources/querys_resultados.php', params,function(data){
                if (data==1){
                    msg={};
                    msg.action ='1';
                    msg.mensaje="La muestra ha sido marcada como reportada, no se podrán hacer mas modificaciones";
                    $('#informacion_g').load('dialogs.php', msg,function(){  });
                    var idElem= '#'+nro;
                    $(idElem).addClass('btn-success');
                    $(idElem+' span').removeClass('hide');
                };
                $('#panel_muestra').load('muestrasPanel.php', params,function(){}); 
            });
        }
        else{
                params={};
                params.action ='null';
                params.mensaje="No se puede marcar esta muestra como reportada, hay campos de resultados vacíos ";
                $('#informacion_g').load('dialogs.php', params,function(){  });
        }
    });
    