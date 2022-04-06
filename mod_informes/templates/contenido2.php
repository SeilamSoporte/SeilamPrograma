
<?php 
function formato($valor){
    $str   = strval($valor);        // Se convierte a string
    $split = explode('.', $str);
    $dec   = count($split);         //Indagammos si posee decimales
    $comp  = substr($str, 0,1);
    return (str_replace('.', ',', $str));
}
    if (buscarPal('alimento,alimentos',$Titulo)=='true'){
        $clase_datos          = 'datos-mb';
        $clase_box_resultados =  'box-resultados-mb-Prev';
    }
    else{
        $clase_datos          = 'datos';
        $clase_box_resultados = 'box-resultados-Prev';  
    } 
    $id=explode("-",$NroInforme)[0];
    $cn=explode("-",$NroInforme)[1];
    //$estado_m = ($EstadoM=='Reportado') ? 'REVISADO' : 'INFORME PARCIAL';
    $estado_m = ($revision1==1) ? 'REVISADO' : 'INFORME PARCIAL';
    //$color    = ($EstadoM=='Reportado') ? 'text-verde' : 'text-rojo';
    $color    = ($revision1==1) ? 'text-verde' : 'text-rojo';
    $suplemento =($Fecha_Hora_R <='2018-10-14' ? '-(Suplemento)' : '');
?>
<div class="hidden" id="datos" data-id="<?php echo $id ?>" data-cn="<?php echo $cn ?>" > </div>
<div class="container-report-Prev">
        <div class="encabezado">
            <div class="row">             
                <div class="col col-xs-12">
                    <div class="row titulo-1 text-center"><span>INFORME DE ENSAYOS<?php echo '('.$Area.')-'.$NroInforme?></span></div>
                     
                    <div class="row centrado">
                        <div class="checkbox print"> 
                            <input type="checkbox"
                                class="incertidumbre"
                                data-id="<?php echo $id; ?>"
                                data-cn="<?php echo $cn; ?>"$ 
                                <?php echo $CI==1 ? 'checked' : '' ?>
                                />
                            <span style="font-weight: bold; font-size:10pt ">Incluir incertidumbre en informa final</span>  
                        </div>
                    </div>
 
                    <div class="row titulo centrado "><span id="titulo"> <?php echo $Titulo ?> </span></div>
                    <div class="row text-center"><span class="<?php echo $color ?>" style="font-size: 1.5em"><strong><?php echo $estado_m ?></strong></span></div>
                </div>
 
            </div>
        </div>    
     
 
    <div class="box hide">
        <div class="row">
            <div class="col col-xs-12 centrado hd">
                DATOS GENERALES DEL CLIENTE
            </div>
        </div>
        <div class="row">
            <div class="col col-xs-2 th">Cliente/Empresa:</div>
            <div class="col col-xs-10 td"><?php echo $Cliente ?></div>
        </div>
        <div class="row">
            <div class="col col-xs-2 th">Dirección:</div>
            <div class="col col-xs-5 td"><span id="direccion"><?php echo $Direccion_cliente ?></span> </div>
            <div class="col col-xs-2 th">Teléfono:</div>
            <div class="col col-xs-3 td"><span id="telefono"><?php echo $Telefono_cliente ?></span></div>
        </div>
        <div class="row"> 
            <div class="col col-xs-2 th">Sede:</div>
            <div class="col col-xs-5 td"><span id="sede"><?php echo $Sede_cliente ?></span></div>
            <div class="col col-xs-2 th">Encargado:</div>
            <div class="col col-xs-3 td"><span id="encargado"><?php echo $Encargado ?></span></div>       
        </div>
    </div>
    <?php include_once 'recepcion.php' ?>
    <?php include_once 'caracteristicas.php' ?>
     
    <?php include_once 'datosencampo.php' ?>
 
    <div class="box <?php echo $clase_box_resultados ?>">
        <div class="row resultados">
            <div class="col col-xs-12 centrado hd pt-2">RESULTADOS DE ENSAYOS </div>
        </div>
         
        <?php if ($Area == 'Microbiológico'){ ?>
        <div class="row head-i">
            <div class="col col-xs-4 th-i ">Parámetro (unidades)</div>
            <div class="col col-xs-2 th-i ">Método de referencia </div>
            <div class="col col-xs-2 th-i ">Norma de Referencia </div>
            <div class="col col-xs-1 th-i ">Valor de Referencia </div>
            <div class="col col-xs-1 th-i ">Resultado</div>
            
        </div>
        <?php } ?>
        <?php if ($Area == 'Fisicoquímico'){ ?>
        <div class="row head-i row-head">
            <div class="col col-xs-3  th-i ">Parámetro</div>
            <div class="col col-xs-2 th-i ">Método </div>
            <div class="col col-xs-2  th-i ">Norma de Referencia </div>
            <div class="col col-xs-2 th-i  text-center">Valor de Referencia </div>
            <div class="col col-xs-1  th-i  text-center">Resultado</div>
               
        </div>
        <?php } ?>
        <div class="<?php echo $clase_datos ?>">
        <?php 
            $ObRes        ='true';
            $StatusCumple = 'true'; 
            $Cumple       = 'true';
            $items        = count($NParametros);
            $i=0;
            $l=0;
            $j=0;
            foreach ($NParametros as $Parametro => $value) {
                $Parametro   = $Muestras ->getParametros($value);
                $i++;
                if ($Comparador[$i-1]==10){
                    $Limites = $Limite[$l+1].'|'.$Limite[$l+2];
                }
                else{
                    $Limites=$Limite[$l];   
                }               
                $l=$i*3;
                $ValorReferencia = SetReferencia($Comparador[$i-1], $Limites) ;
                $TipoP           = isset($Tipo[$i-1]) ? $Tipo[$i-1] : '';
 
                if ($TipoP!=5){
                $Resultado       = isset($Resultados[$j]) ? $Resultados[$j] : 'NR';
                $Resultado       = trim($Resultado, ' ');
                $Resultado       = ($Resultado!="") ? $Resultado : 'NR';
                $Resultado       = isset($Resultados[$j]) ? $Resultados[$j] : 'NR'; 
 
                $j               = str_pad($j,2,"0",STR_PAD_LEFT ); 
                if ($Resultado==''){ $Resultado = 'NR'; }
                  
                $j++;

                if(isset($ResComparador[$j-1])){
                    $ResComp = SetResComparador($ResComparador[$j-1]);
                }
                else{
                   $ResComp = '';
                }
                $Clase_obs ='A';
                if ($ResComp   =='='){ $ResComp='';}
                if ($Resultado == 'NR'){
                    $ResultadoComp='NR'; $Clase_obs='NR';
                   
                }
                else { 
                    $ResultadoComp = $ResComp.$Resultado; 
                 }
                 
                ?>
            <?php if ($Area == 'Microbiológico'){ ?>
            <div class="row par bbl">
                <div class="col col-xs-4 td-i col-td-i ">
                    <?php echo $Parametro ?>
                </div>
                <div class="col col-xs-2 col-td-i td-i">
                    <?php echo $Metodo[$i-1] ?>
                </div>
                <div class="col col-xs-2 col-td-i td-i">
                    <?php echo $Norma[$i-1] ?>
                </div>
                <div class="col col-xs-1 col-td-i td-i">
                    <?php echo $ValorReferencia ?>
                </div>                                            
                <div class="col col-xs-1 td-i col-td-i">
                    <?php                    
                        echo formato($ResultadoComp);
                    ?>
                     
                </div>                                            
                    
            </div>
 
            <?php } ?>
            <?php if ($Area == 'Fisicoquímico'){ ?>
            <div class="row par bbl">
                <div class="col col-xs-3 td-i col-tdi  "> <?php echo $Parametro ?></div>
                <div class="col col-xs-2 td-i col-tdi "> <?php echo $Metodo[$i-1] ?></div>
                <div class="col col-xs-2 td-i col-tdi text-center"><?php echo $Norma[$i-1] ?> </div>
                <div class="col col-xs-2 td-i col-tdi text-center"><?php echo $ValorReferencia ?> </div>
                 
                <?php 
                    if ($Parametro== "IRAPI (%)"){
                ?>
                <div class="col col-xs-1 td-i col-tdi text-center"><?php echo formato($ResultadoComp)  ?> </div>          
                <?php 
                }
                else{ ?>
                <div class="col col-xs-1 td-i col-tdi text-center"><?php echo formato($ResultadoComp) ?> 
                </div>
                
                    <?php } ?>
            </div>
            <?php } ?>
 
            <?php
                 
            }//Tipo
 
        };

        ?>
        </div>
 
        <div class="row" style="padding-top: 10px; padding-bottom: 1px">
            <div class="col col-xs-12" style="font-size: 1.1em; font-weight: bold;">
                Fecha de ensayo:<span id="fecha-ensayo"><?php echo $Fecha_result ?></span>
            </div>
        </div>
    </div>
    <span class="col col-xs-12 text-center" style="width: 100%; font-weight: bold; font-size: 1em; padding:20px">
        Para generar el informe, primero debe ser revisado y aprobado por el personal autorizado...
    </span>
    <div class="text-center">
         
    <div id="revision1" class="btn btn-primary <?php if($revision1==1) echo 'btn-success disabled' ?> hidden"
                        data-id="<?php echo $id; ?>"
                        data-cn="<?php echo $cn; ?>" >
        Revisión de recepción de muestra-OK
    </div>
    <div id="revision2" class="btn btn-primary <?php if($revision2==1) echo 'btn-success disabled' ?> hidden" 
                        data-id="<?php echo $id; ?>"
                        data-cn="<?php echo $cn; ?>">
        Revisión de resultados-OK
    </div>    
    </div>
</div> 
 
</div>
<script>
    $( "input[type='checkbox']" ).change(function() {
        params={};
        params.id       = $(this).attr('data-id');
        params.cons     = $(this).attr('data-cn');
        params.action   = 'updateIncertidumbre';
                 
        if($(this).is(':checked'))
            params.estado = 1;
        else
            params.estado = 0;
        $.post("../resources/QueryS_Informes.php", params,function(data){ console.log(data) })
    }); 
    $("#revision1").click(function() {
        params={};
        params.id       = $(this).attr('data-id');
        params.cons     = $(this).attr('data-cn');
        params.action   = 'updateRevision1';
        $("#revision1").addClass("disabled");
        $("#revision1").addClass("btn-success");        
        $.post("../resources/QueryS_Informes.php", params,function(data){ 
            console.log(data)   
            if(data==1){
                $('.generar').removeClass('hidden');
                $('.generarInf').removeClass('hidden');
            }
        })
    });
    $("#revision2").click(function() {
        params={};
        params.id       = $(this).attr('data-id');
        params.cons     = $(this).attr('data-cn');
        params.action   = 'updateRevision2';

        $("#revision2").addClass("disabled");
        $("#revision2").addClass("btn-success");
        $.post("../resources/QueryS_Informes.php", params,function(data){ 
             
            if(data==1){
                $('.generar').removeClass('hidden');
                $('.generarInf').removeClass('hidden');
            }
        })
    });
    $( document ).ready(function() {
        params={};
        params.id       = $("#datos").attr('data-id');
        params.cons     = $("#datos").attr('data-cn');
        params.user     = $("#usuario_logeado").attr('data-id');
        params.action   = 'getRevision';
        $.post("../resources/QueryS_Informes.php", params,function(data){ 
            datos=data.split(',');
            revision =datos[0]
            permiso_rev_recepcion  = datos[1]
            permiso_rev_resultados = datos[2]
            
            if(permiso_rev_recepcion=='true'){
                //$('#revision1').removeClass('hidden');
                $('#revision1').addClass('hidden');
            }
            else {
                $('#revision1').addClass('hidden');
            }
            if(permiso_rev_resultados=='true'){
                $('#revision2').removeClass('hidden');
            }
            else {
                $('#revision2').addClass('hidden');
            }
             
            if(revision==1){
                $('.generar').removeClass('hidden');
                $('.generarInf').removeClass('hidden');
                $('.generarInf2').removeClass('hidden');
            }
            else{
                $('.generar').addClass('hidden');
                $('.generarInf').addClass('hidden');                
                $('.generarInf2').addClass('hidden');                
            }
        })
 
    }); 
</script>
