	<?php if ($Area=='Microbiológico'){ ?>
	<div class="box caracteristicas">
		<div class="row ">
			<div class="col col-xs-12 text-center hd" style="padding-bottom:0">
				CARACTERÍSTICAS ORGANOLÉPTICAS
			</div>
		</div>
		<div class="row">
			<div class="col col-xs-4" style="padding-top:0"><span class="th-c">Color:	 </span> <?php echo $color ?> </div>
			<div class="col col-xs-4" style="padding-top:0"><span class="th-c">Olor:	 </span> <?php echo $olor ?> </div>
			<div class="col col-xs-4" style="padding-top:0"><span class="th-c">Aspecto:</span> <?php echo $aspecto ?> </div>		
		</div>
	</div>
	<?php } 
	else{
		echo '';
	}?>
	
