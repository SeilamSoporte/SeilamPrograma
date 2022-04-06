<?php 
 
if(isset($_POST['refresh'])){
    $desde  = "'".($_POST['desde'])."'";
    $hasta  = "'".($_POST['hasta'])."'";
    include ("../clases/clasesMuestras.php");
    $view = new stdClass();     
}
else{
    $desde  = "'".$año_d."-".$mes_d."-".$dia_d."'";
    $hasta  = "'".$año."-".$mes."-".$dia_h."'";
}
 
$view->muestras       = Muestras::getMuestraList($desde, $hasta); // tree todos los clientes

//$view->muestras       = Muestras::getMuestra();
function RamdonChar($leng){
    return substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0,$leng);  
} 
?>
        <div class="panel panel-primary">
            <div class="panel-heading"><strong>Lista de muestras</strong></div>
            <div id="tabla-muestras">
            <!-- <div id="usuario_logeado" data-user="<?php echo $usuario_logeado ?>" ></div> -->
            <table class="table table-hover footable" data-filter="#filter" border="0">   
                <thead>
                        <th class="head" data-class="expand">
                            Código de ingreso
                        </th>
                        <th class="head" data-hide="phone">
                            Cliente
                        </th>
                        
                        <th class="head" data-hide="phone">
                            Sede
                        </th>

                        <th class="head" data-hide="phone">
                            Fecha de ingreso
                        </th>
                        <th class="head" data-hide="phone">
                            Fecha de recolección
                        </th>
                        <th class="head" style="text-align: center; width: 95px">
                            Ver informe
                        </th>
                        <th class="head" style="text-align: center; max-width: 30px">
                            Impreso
                        </th>
                        <th class="head" style="text-align: center; max-width: 100px">
                            Simplificado
                        </th>
                </thead>
                <tbody>
 
                    <?php foreach ($view->muestras as $muestra):  // uso la otra sintaxis de php para templates 
                        $Sede        = Muestras::getSede($muestra['Cliente']);
                        $Sede        = explode("|",$Sede)[$muestra['Sede']];
                    ?>
                        <tr>
                            <td><?php echo $muestra['Codigo']; ?></td>
                            <td style="max-width:400px;"><?php echo $muestra['Nombre_cliente'];?></td>
                            <td style="max-width:300px;"><?php echo $Sede;?></td>
                            <td><?php echo $muestra['Fecha_Ingreso'];?></td>
                            <td><?php echo $muestra['Fecha_Recoleccion'];?></td>
                            <td style="padding-left:1px; padding-right:1px; text-align: center">
                                <a class="verMuestras" id="verMuestras" data-id="<?php echo $muestra['Id']; ?>" href="#"> 
                                    <div class="btn btn-primary glyphicon glyphicon-th-list" data-toggle="modal" data-placement="top" title="Ver informes" id="verMuestras" style="margin-top: 0px;" ></div>
                                </a>
                            </td>
                            <td>
                                <div class="checkbox print">
                                    <input type="checkbox" class="printed filled-in" id="<?php echo 'M'.$muestra['Id'];?>" <?php echo $muestra['Print']==1 ? 'checked' : '' ?> data-id="<?php echo $muestra['Id']; ?>" />
                                    <label for="<?php echo 'M'.$muestra['Id'];?>"></label>
                                </div>                                
                            </td>
                            <td>
                                <div class="checkbox print simplif">
                                    <input type="checkbox" class="simplificado filled-im simp" id="<?php echo 'S'.$muestra['Id'];?>" <?php echo $muestra['simp']==1 ? 'checked' : '' ?> data-id="<?php echo $muestra['Id']; ?>" />
                                    <label for="<?php echo 'S'.$muestra['Id'];?>"></label>
                                </div>                                
                            </td>
                        </tr>
                         
                    <?php endforeach; ?>      
                </tbody>
            </table>  
            </div>
        </div>
        <div id="form_insert"></div>
 
            <script src="../js/jquery-2.2.2.min.js"></script>
            <script src="../js/jq-ui/jquery-ui.js"></script>
            <script src="../js/bootstrap.min.js"></script>
            <script src="../js/bootstrap-dialog.min.js"></script>
             
            <script src="../js/footable/footable.js"></script>
            <script src="../js/footable/footable.sortable.js"></script>
            <script src="../js/footable/footable.filter.js"></script>
            <script src="js/fcn_load.js"></script>
            <script>
                $(function() {
                  $('table').footable();
                });
                     
                $('.printed').click(function(){
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
                    $.post("./resources/QueryS_Informes.php", params,function(data){ });
                });
                $('.simplificado').click(function(){
                    params       = {};
                    params.estado= $(this).is(':checked');
                    params.id    = $(this).attr('data-id');
                    params.action= 'updateSimp';
                    var estado   = $(this).is(':checked');
                    if (estado==true){
                        params.estado = 1;
                    }
                    else{
                        params.estado = 0;   
                    }
                    $.post("./resources/QueryS_Informes.php", params,function(data){ });
                });         
        </script> 