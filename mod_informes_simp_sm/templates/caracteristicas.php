	<?php 
		$Muestras			= new Muestras();
		$Muestras 			->Muestra($id);
		$Muestras 			->DetallesMuestras($id, $mb);
	
		$Caracteristicas	= explode("|",$Muestras ->Caracteristicas);
		$color				= isset($Caracteristicas[0]) ? $Caracteristicas[0]:'';
		$olor				= isset($Caracteristicas[1]) ? $Caracteristicas[1]:'';
		$aspecto			= isset($Caracteristicas[2]) ? $Caracteristicas[2]:'';
	?>
	<div class="box caracteristicas">
		<div class="row ">
			<div class="col col-xs-12 text-center hd" style="padding-bottom:0">
				CARACTERÍSTICAS ORGANOLÉPTICAS
			</div>
		</div>
		<div class="row">
			<div class="col col-xs-4" style="padding-top:0"><span class="th-i">Color:	 </span> <?php echo $color ?> </div>
			<div class="col col-xs-4" style="padding-top:0"><span class="th-i">Olor:	 </span> <?php echo $olor ?> </div>
			<div class="col col-xs-4" style="padding-top:0"><span class="th-i">Aspecto:</span> <?php echo $aspecto ?> </div>		
		</div>
	</div>
	
