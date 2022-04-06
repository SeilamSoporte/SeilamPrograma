window.datoCampo =[]

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
        $("#datos_campo").html('');
        $("#titulo_datos").addClass('oculto');
        
        var id      = $(this).val();
        datos       = {};
        datos.id    = id;
        datos.action='readParametro_full';
  
        $.post("../../mod_parametros/resources/QueryS_Parametros.php", datos, function(data)
        {
            var dato     = data.split(",");
            var cell_area=$("#area");
            var cell_cate=$("#categoria");
            var cell_clas=$("#clase");
            var cell_para=$("#parametro");
            var cell_limi=$("#limite");
            var cell_meto=$("#metodo");
            var cell_refe=$("#referencia");
            var cell_datC=$("#datos_campo");
            var input_td =$('.input-control');
            var texto_p  ="";
            var texto_c  ="";
            var texto_m  ="";
            var texto_r  ="";
            var insertD  =""; 
            cell_area.text(dato[0]);
            cell_cate.text(dato[1]);
            cell_clas.text(dato[2]);
            var dato_p  = dato[3].split("|");
            var dato_l  = dato[4].split("|"); //limites
            var dato_m  = dato[5].split("|");
            var dato_c  = dato[6].split("|"); //comparadores
            var dato_r  = dato[7].split("|");
            var tipos   = dato[8].split("|");
            var visible = Array();

            cell_datC.html('');

            $.each(tipos, function (ind, elem) { 
                if (parseInt(elem)===5){
                $("#titulo_datos").removeClass('oculto');
                 visible[ind] = 'oculto' ;   
                }
                else{   
                 visible[ind] = 'visible' ;   
                }
            });

            $.each(dato_p, function (ind, elem) { 
                texto_p="";
                LoadParametro(elem, function(resp){
                    texto_p= texto_p+'<p class="'+visible[ind]+'"><span class="ui-menu-icon ui-icon ui-icon-triangle-1-e"></span>'+resp;
                    cell_para.html(texto_p);
                }) ; 
            }); 
            
            $.each(dato_c, function (ind, elem) { 
                var idL=ind*3;
                if(parseInt(elem)===10){
                    texto_c= texto_c +'<p class="'+visible[ind]+'">'+ LoadComparador(elem, dato_l[idL+1],dato_l[idL+2]) ;
                }
                else{
                    texto_c= texto_c +'<p class="'+visible[ind]+'">'+ LoadComparador(elem, dato_l[idL],'') ;
                }
            }); 

            $.each(dato_m, function (ind, elem) { 
                texto_m= texto_m +'<p class="'+visible[ind]+'">'+ elem ;
            }); 

            $.each(dato_r, function (ind, elem) { 
                texto_r= texto_r +'<p class="'+visible[ind]+'">' + elem;
            });   
            
            
            $.each(tipos, function (ind, elem) {

                if ( parseInt(elem) ===5){
           //         console.log(dato_p[ind])
                    if(parseInt(dato_p[ind]) === 13 ){
                    LoadParametro(parseInt(dato_p[ind]), function(resp){
                        datoCampo[0]=resp;
                        }) 
                    }
                    if(parseInt(dato_p[ind]) === 15 ){
                    LoadParametro(parseInt(dato_p[ind]), function(resp){
                        datoCampo[1]=resp;
                        })
                    }
                    if(parseInt(dato_p[ind]) === 16 ){
                    LoadParametro(parseInt(dato_p[ind]), function(resp){
                        datoCampo[2]=resp;
                        })
                    }
                    if(parseInt(dato_p[ind]) === 58 ){
                    LoadParametro(parseInt(dato_p[ind]), function(resp){
                        datoCampo[3]=resp;
                        })
                    }
                    if(parseInt(dato_p[ind]) === 17 ){
                    LoadParametro(parseInt(dato_p[ind]), function(resp){
                        datoCampo[4]=resp;
                        })
                    }
                    if(parseInt(dato_p[ind]) === 73 ){
                    LoadParametro(parseInt(dato_p[ind]), function(resp){
                        datoCampo[5]=resp;
                        })
                    }
                    if(parseInt(dato_p[ind]) === 74 ){
                    LoadParametro(parseInt(dato_p[ind]), function(resp){
                        datoCampo[6]=resp;
                        })
                    }
                    if(parseInt(dato_p[ind]) === 76 ){
                    LoadParametro(parseInt(dato_p[ind]), function(resp){
                        datoCampo[7]=resp;
                        })                                                                                                                                                
                    }

                }
            })
            $.each(datoCampo, function (ind, elem) {
               console.log(ind+':'+elem);
            })

            /*$.each(tipos, function (ind, elem) {
                if ( parseInt(elem) ===5){

                    //console.log(dato_p[ind]);
                    if(parseInt(dato_c[ind])===8){
                        LoadParametro(dato_p[ind], function(resp){
                        //console.log(resp);
                        insertD=insertD+'<div class="col colp col-md-3"><div class="col colp col-md-12">'+resp+'</div>';
                        insertD=insertD+'<select class="select-input form-control datoencampo" style="border:1px solid #ccc; background:#fff">';
                        insertD=insertD+'<option value="Ausencia"> Ausencia  </option>'; 
                        insertD=insertD+'<option value="Presencia"> Presencia </option>';
                        insertD=insertD+'</select></div>';
                        cell_datC.html(insertD);
                      });
                    }
                    else{
                      LoadParametro(dato_p[ind], function(resp){
                        //console.log(resp);
                        insertD=insertD+'<div class="col colp col-md-3"><div class="col colp col-md-12">'+resp+'</div>';
                        insertD=insertD+'<div class="input-group"><div class="input-group-addon"><select class="select-input comparador_dc">';                    
                        insertD=insertD+'<option value="="> = </option><option value="<"> < </option><option value=">"> > </option></select></div>';
                        insertD=insertD+'<input type="number" class="form-control datoencampo" value=""></div></div>'; 
                        cell_datC.html(insertD);
                    });
                  }
                } //If
            });
*/
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
  
        $.post("../../mod_parametros/resources/QueryS_Parametros.php", datos, function(data)
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
           // alert(dato[4].split("|"));
            $.each(dato_p, function (ind, elem) { 
                LoadParametro(elem, function(resp){

                texto_p= texto_p+'<p class=""><span class="ui-menu-icon ui-icon ui-icon-triangle-1-e"></span>'+resp;
                cell_para.html(texto_p);
                }) ; 
            }); 

            $.each(dato_c, function (ind, elem) { 
                
                if(elem!=10){
                    ind=ind*3;
                    texto_c= texto_c +'<p>'+ LoadComparador(elem, dato_l[ind]) ;
                }
                else{
                    ind=ind*3;
                    texto_c= texto_c +'<p>'+ LoadComparador(elem, dato_l[ind+1], dato_l[ind+2]) ;   
                }
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
        /*texto       = 'control, higiene';
        campo       = '.NA2';
        campo2      = '#empaque';
        HabilitaCampo(selector, texto, campo, campo2, true, 1, 0);*/

        texto       = 'alimentos,alimento,higiene';
        buscarPal(selector, texto, campo); 

        var textoSelArr  = $('#categoria').html().toLowerCase();
        if (textoSelArr == "aguas no tratadas"){
            //alert("Hola");
            $('#datos_campo_cr').val("").prop("disabled", true);
        }
    }

    function buscarPal(selector, texto, campo){
        var textoSelArr  = $(selector).html().toLowerCase().split(" ");
        var palabras     = texto.split(",");
        $('.organ').prop("disabled", true);
        $.each(textoSelArr, function(i){
            $.each(palabras, function(j){    
                if(textoSelArr[i] == palabras[j]){   
                    $('#medio').           val("").prop("disabled", true);
                    $('#datos_campo_ph').  val("").prop("disabled", true);
                    $('#datos_campo_temp').val("").prop("disabled", true);
                    $('#datos_campo_cr').  val("").prop("disabled", true);
                    $('#estado_tiempo').   val("").prop("disabled", true);
                    $('.organ').           prop("disabled", false);
                  }
                })  
            })  
    }

    function HabilitaCampo(selector, texto, campo, campo2, enable, U, U2){
        var textoSelArr  = $(selector).html().toLowerCase().split(" ");
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
    }
})
