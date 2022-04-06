 $(".cumplimiento").change(function()
    {
        arrSelect = [];
        n=0;
        strSelect =''
        $('.cumplimiento').each(function(){
            arrSelect[n] = $(this).val();
            n++
        })
            strSelect = arrSelect.join('|');   
            params={};
            params.id       = $(this).attr('data-id');
            params.nd       = $(this).attr('data-n');
            params.datos    = strSelect; 
            params.action   = 'updateDetalles';
            console.log(params)
        $.post("../resources/QueryS_informes.php", params,function(data){ console.log(data) })
    })
  $("#obs").change(function()
    {
        
            params={};
            params.id       = $(this).attr('data-id');
            params.nd       = $(this).attr('data-n');
            params.datos    = $(this).val();
            params.action   = 'updateObservaciones';
            
        $.post("../resources/QueryS_informes.php", params,function(data){ console.log(data) })        

    })
 
  $("#anotaciones").change(function()
    {
        
            params={};
            params.id       = $(this).attr('data-id');
            params.nd       = $(this).attr('data-n');
            params.datos    = $(this).val();
            params.action   = 'updateAnotaciones';
            
        $.post("../resources/QueryS_informes.php", params,function(data){ console.log(data) })        

    })
 