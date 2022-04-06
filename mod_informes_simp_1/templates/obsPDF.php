<?php 
    $Detalles  			= $Muestras ->loadDetalles($id,$nd) ;	
	$Observaciones 		= isset($Detalles[0]) ? $Detalles[0]['Observaciones']:''; 
	if ($Observaciones==''){
		$Observaciones  ='Para mejor comprensión de los resultados comuníquese con su asesor.';
	}
?>
<div class="row">
	<div class="col col-xs-12 centrado hd">OBSERVACIONES</div>
	<div class="col col-xs-12 centrado">***<span><?php echo $Observaciones ?> ***</span></div>
</div>

