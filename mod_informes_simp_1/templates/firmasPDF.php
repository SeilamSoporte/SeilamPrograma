<?php 
	$Muestras			= new Muestras();
	$Muestras 			->Muestra($id);

	$Firmas = $Muestras ->getFirmas();
	$Firma1			= $Muestras->Firma1;
	$Firma2			= $Muestras->Firma2;
	$Firma3			= $Muestras->Firma3;
		
		$Firma1N = $Muestras->Firma1['Nombre'].' '.$Muestras->Firma1['Apellido'];
		$Cargo1  = $Muestras->Firma1['Cargo'];
		$Firma2N = $Muestras->Firma2['Nombre'].' '.$Muestras->Firma2['Apellido'];
		$Cargo2  = $Muestras->Firma2['Cargo'];
		$Firma3N = $Muestras->Firma3['Nombre'].' '.$Muestras->Firma3['Apellido'];
		$Cargo3  = $Muestras->Firma3['Cargo'];
?>
<br>
<br>
<div class="row">
	<div class="col col-xs-4 centrado">
		<strong><?php echo $Firma1N ?></strong>
	</div>
	<div class="col col-xs-4 centrado">
		<strong><?php echo $Firma2N ?></strong>
	</div>
	<div class="col col-xs-4 centrado">
		<strong><?php echo $Firma3N ?></strong>
	</div>
</div>
<div class="row">
	<div class="col col-xs-4 centrado">
		<?php echo$Cargo1 ?>
	</div>
	<div class="col col-xs-4 centrado">
		<?php echo $Cargo2 ?>
	</div>
	<div class="col col-xs-4 centrado">
		<?php echo $Cargo3 ?>
	</div>
</div>