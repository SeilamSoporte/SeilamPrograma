<?php 
    $DateArray  = getdate();
    $hoy        = $DateArray['year'].'-'.str_pad($DateArray['mon'],2,"0",STR_PAD_LEFT ).'-'.str_pad($DateArray['mday'],2,"0",STR_PAD_LEFT );

?>
<style>
	.margin{
		margin:15px;
	}	
	input.fechas{
		width: 200px;
		margin:auto;
	}
	.btn{
        margin-bottom: 5px;
        width: 200px;
	}
    .btn-fq{
        width: 200px;
    }
    .botones{
        padding: 10px;
    }


</style>

<div class="row">
	<div class="col col-md-12">
		
	</div>
</div>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h2 class="panel-title">Ordenes de servicio</h2>
  </div>
  <div class="panel-body">
    <div class="row margin text-center">
    	<div class="col col-md-12 margin">
    		Seleccione el rango de fecha para cargar las ordenes de servicio pendientes
    	</div>
    	<div class="col col-sm-4">
    		<div class="col col-lg-12"><strong>Desde:</strong></div>
    		<input type="text" name="fecha_desde" id="fecha_desde" class="form-control fechas" value="<?php echo $hoy ?>">
    	</div>
    	<div class="col col-sm-4 text-center">
    		<div class="col col-lg-12"><strong>Hasta:</strong></div>
    		<input type="text" name="fecha_hasta" id="fecha_hasta" class="form-control fechas" value="<?php echo $hoy ?>">
    	</div>
        
        <div class="col col-sm-4 text-center">
    		<div class="col col-lg-12">&nbsp;</div>
    		<a class="btn btn-primary" role="button" id="btn_load">
              Cargar Ordenes
            </a> 
    	</div>
    </div>
  </div>
</div>

<div id="botones" class="panel panel-primary botones text-center">

</div>