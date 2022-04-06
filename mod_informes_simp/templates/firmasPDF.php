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
        $Img1    = '../mod_usuarios/imgs/'.$Muestras->Firma1['foto'];
        $Img2    = '../mod_usuarios/imgs/'.$Muestras->Firma2['foto'];
        $Img3    = '../mod_usuarios/imgs/'.$Muestras->Firma3['foto'];

        
?>
<div class="row">
	<div class="col col-xs-4 centrado">

	</div>
	<div class="col col-xs-4 centrado">
		<img src="<?php echo $Img2 ?>" alt="" height="50">
	</div>
	<div class="col col-xs-4 centrado">
		<img src="<?php echo $Img3 ?>" alt="" height="50"
			style=" align:bottom">
	</div>
</div>
<div class="row">
	<div class="col col-xs-4 centrado">

		<!--<strong>Autorización del Informe de Ensayos</strong> -->
		<span style="font-size: 0.75em">
			[Fecha de impresión: <span id="fecha-impresion"><?php echo date('Y-m-d')  ?>]</span></span>

		<!--<p><img src="../imgs/Firma1N.png" style="width:60"></p>-->
		<strong><?php //echo $Firma1N?></strong>
	</div>
	<div class="col col-xs-4 centrado">
		<!--<p><img src="../imgs/Firma2N.png" style="width:60"></p>-->
		<strong><?php echo $Firma2N ?></strong>
	</div>
	<div class="col col-xs-4 centrado">
		<!--<p><img src="../imgs/Firma3N.png" style="width:60"></p>-->
		<strong><?php echo $Firma3N ?></strong>
	</div>
</div>
<div class="row">
	<div class="col col-xs-4 centrado">
		<?php //echo$Cargo1?>
	</div>
	<div class="col col-xs-4 centrado">
		<?php echo $Cargo2 ?>
	</div>
	<div class="col col-xs-4 centrado">
		<?php echo $Cargo3 ?>
	</div>
</div>
<div class="row">
	<div class="col col-xs-12 centrado">
		----[ FINAL DEL INFORME ]----
	</div>
</div>