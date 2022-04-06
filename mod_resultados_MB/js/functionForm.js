$(document).ready(function(){ //cuando el html fue cargado iniciar
    estadoCampos();
    var jQueryDatePickerOptions =
       {
          dateFormat: 'yy-mm-dd',
          changeMonth: false,
          changeYear: true,
          showButtonPanel: false,
          showAnim: 'slide'
       };
     $(".fechaJQ").datepicker(jQueryDatePickerOptions);

     $(function(){
        $(".codigo").chosen({ 
            no_results_text: "No se encuentra:", 
            disable_search_threshold:4
        });
    });

    $(function(){
        $("#Cliente").chosen({ 
            no_results_text: "No se encuentra:", 
            disable_search_threshold:1 
        });
    });

    $('#codigo').change(function(){
        var id      = $(this).val();
        datos       = {};
        datos.id    = id;
        datos.action='readParametro';
  
        $.post("../../mod_parametros/resources/querys_parametros.php", datos, function(data)
        {
            var dato     = data.split(",");
            var cell_area=$("#area");
            var cell_cate=$("#categoria");
            var cell_clas=$("#clase");
            var cell_para=$("#parametro");
            var cell_limi=$("#limite");
            var cell_meto=$("#metodo");
            var cell_refe=$("#referencia");

            var input_td =$('.input-control');
            var texto_p  ="";
            var texto_c  ="";
            var texto_m  ="";
            var texto_r  ="";
            cell_area.text(dato[0]);
            cell_cate.text(dato[1]);
            cell_clas.text(dato[2]);

            var dato_p  = dato[3].split("|");
            var dato_l  = dato[4].split("|");
            var dato_m  = dato[5].split("|");
            var dato_c  = dato[6].split("|");
            var dato_r  = dato[7].split("|");

            $.each(dato_p, function (ind, elem) { 
                LoadParametro(elem, function(resp){
                texto_p= texto_p+'<p><span class="ui-menu-icon ui-icon ui-icon-triangle-1-e"></span>'+resp;
                cell_para.html(texto_p);
                }) ; 
            }); 

            $.each(dato_c, function (ind, elem) { 
                texto_c= texto_c +'<p>'+ LoadComparador(elem, dato_l[ind]) ;
            }); 

            $.each(dato_m, function (ind, elem) { 
                texto_m= texto_m + elem+'<p>' ;
            }); 

            $.each(dato_r, function (ind, elem) { 
                texto_r= texto_r + elem+'<p>' ;
            });                         

            cell_limi.html(texto_c);
            cell_meto.html(texto_m);
            cell_refe.html(texto_r);

            estadoCampos();
            
        })
    });

    $('#codigo_n').change(function(){
        var id      = $(this).val();
        datos       = {};
        datos.id    = id;
        datos.action='readParametro';
  
        $.post("../../mod_parametros/resources/querys_parametros.php", datos, function(data)
        {
            var dato     = data.split(",");
            var cell_area=$("#area_n");
            var cell_cate=$("#categoria_n");
            var cell_clas=$("#clase_n");
            var cell_para=$("#parametro_n");
            var cell_limi=$("#limite_n");
            var cell_meto=$("#metodo_n");
            var cell_refe=$("#referencia_n");

            var input_td =$('.input-control');
            var texto_p  ="";
            var texto_c  ="";
            var texto_m  ="";
            var texto_r  ="";
            cell_area.text(dato[0]);
            cell_cate.text(dato[1]);
            cell_clas.text(dato[2]);

            var dato_p  = dato[3].split("|");
            var dato_l  = dato[4].split("|");
            var dato_m  = dato[5].split("|");
            var dato_c  = dato[6].split("|");
            var dato_r  = dato[7].split("|");

            $.each(dato_p, function (ind, elem) { 
                LoadParametro(elem, function(resp){
                texto_p= texto_p+'<p><span class="ui-menu-icon ui-icon ui-icon-triangle-1-e"></span>'+resp;
                cell_para.html(texto_p);
                }) ; 
            }); 

            $.each(dato_c, function (ind, elem) { 
                texto_c= texto_c +'<p>'+ LoadComparador(elem, dato_l[ind]) ;
            }); 

            $.each(dato_m, function (ind, elem) { 
                texto_m= texto_m + elem+'<p>' ;
            }); 

            $.each(dato_r, function (ind, elem) { 
                texto_r= texto_r + elem+'<p>' ;
            });                         

            cell_limi.html(texto_c);
            cell_meto.html(texto_m);
            cell_refe.html(texto_r);
        })
    });

    function estadoCampos(){
        var selector= '';
        var texto   = '';
        var campo   = '';
        var campo2  = ''
            
        selector    = '#categoria';
        texto       = 'aguas,agua';
        campo       = '.NA,#fecha_ven,#fecha_pro';
        campo2      = '#unidad';
        HabilitaCampo(selector, texto, campo, campo2, true, 1 ,2);
        texto       = 'control, higiene';
        campo       = '.NA2';
        campo2      = '#empaque';
        HabilitaCampo(selector, texto, campo, campo2, true, 1, 7 );

        texto       = 'alimentos, alimento';
        buscarPal(selector, texto, campo); 
    }

    function buscarPal(selector, texto, campo){
     /*   var textoSelArr  = $(selector).html().toLowerCase().split(" ");
        var palabras     = texto.split(",");
        $.each(textoSelArr, function(i){
            $.each(palabras, function(j){    
                if(textoSelArr[i] == palabras[j]){   
                    $('#medio').           val("").prop("disabled", true);
                    $('#datos_campo_ph').  val("").prop("disabled", true);
                    $('#datos_campo_temp').val("").prop("disabled", true);
                    $('#datos_campo_cr').  val("").prop("disabled", true);
                    $('#estado_tiempo').   val("").prop("disabled", true);
                  }
                })  
            })  
*/    }

    function HabilitaCampo(selector, texto, campo, campo2, enable, U, U2){

/*        var textoSelArr  = $(selector).html().toLowerCase().split(" ");
        var palabras     = texto.split(",");
        var campo        = campo.split(",");
        var selCampo2    = $(campo2).val();
       // alert(selCampo2);
        if (U2!=0){
            $(campo2). val(selCampo2);
        }
        $.each(campo, function(h){
        $(campo[h]).prop("disabled", false);
        
        $.each(textoSelArr, function(i){
            $.each(palabras, function(j){    
                if(textoSelArr[i] == palabras[j]){
                    $(campo2).      val(U2);                    
                    $(campo[h]).    val("").prop("disabled", enable);
                    $('#fecha_pro').val("").prop("disabled", true);
                    $('#fecha_ven').val("").prop("disabled", true);
                }
            })  
        })
        }) // each campo
   */ }

})
