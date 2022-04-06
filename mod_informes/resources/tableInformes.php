<?php
    //include_once("../resources/fn_limites.php") ; 
    //include_once ("../Clases/clasesMuestras.php");
    $D_Muestra   = new Muestras();
    $Det_Muestras= new Muestras();
    $D_Muestra  -> Muestra($id); 
    $D_params    = new Muestras();
    $Empaques    = new Muestras();
    $Clientes    = new Clientes(); 
    
    $Clientes    ->getCliente($D_Muestra->Cliente);   
    $CN          = Muestras::CNMuestras($id);
    $Datos       = Muestras::MuestraParametro($id);
    $CNro        = count($Datos);
    $Nro         = ($CNro>0) ? $Datos[0]['CN'] : 0;
    $Simp        = $D_Muestra->Simplificado;
    $Sede        = $D_Muestra->getSede($D_Muestra->Cliente);
    $Sede        = explode("|",$Sede)[$D_Muestra->Sede];
    
?>
 
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="modal-title">Vista e impresión de informes de resultados</h4> 
            </div>      
             
            <div class="panel-body">
                <!-- <form action="" id="FormMuest" method="post" enctype="multipart/form-data"> -->
                    <div class="defualt codigoI" data-id="<?php echo $D_Muestra->Codigo ?>" style="text-align:center"><strong>CÓDIGO DE INGRESO Nº <?php echo str_pad($D_Muestra->Codigo,4,"0",STR_PAD_LEFT ) ?></strong></div>
                        <div class="row">
                            <div class="col col-md-12">
                                <table>
                                    <tr>
                                        <td>
                                            <strong>Cliente/Empresa: </strong>
                                        </td>
                                        <td>
                                            <?php  echo $Clientes->ClientesN;  ?>
                                        </td>
                                    <tr>
                                    </tr>
                                        <td>
                                            <strong>Fecha de ingreso:     </strong>
                                        </td>
                                        <td>
                                            <?php echo $D_Muestra->Fecha_I ?>  
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Sede:</strong> 
                                        </td>
                                        <td>
                                            <?php echo $Sede ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                             
                        <div class="row">
                            <div class="col-col-md-12" style="text-align:center; width:100%; border:0px solid #000; padding:10px">
                                <span >MUESTRAS INGRESADAS</span>
                            </div>
                        </div>
                         
                        <div class="row">
                            <div class="col col-md-12">                   
                                <?php foreach($Datos as $Detalles){ ?>
                                <?php 
                                    $EstadoM = Muestras::getResultados($id,$Detalles['CN']);
                                    $estado  = isset($EstadoM[0]['Estado']);
                                    $color    = ($estado=='Reportado') ? 'btn-success' : 'btn-primary';
                                 ?>
                                    <button type="button" id="" data-id ="<?php echo $id ?>" data-cons="<?php echo $Detalles['CN'] ?>" class="btn load_informe <?php echo $color ?>" data-toggle="" data-target="#informe">
                                        <?php echo "Muestra ".str_pad($id,3,"0",STR_PAD_LEFT ).'-'.$Detalles['CN']; ?>
                                    </button>
                                <?php } 
                                ?>
                            </div>
                        </div>
                        <br>
                        <div id="form-datos">
                        </div>
        </div> <!-- panel body -->
    </div> <!-- modal content -->
  <div id="view_informe" class="panel panel-primary"> </div>