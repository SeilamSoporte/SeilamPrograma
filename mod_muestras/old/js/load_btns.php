<?php

	include_once ("../clases/clasesMuestras.php");
	$id = $_POST['id'];
//	$Nro 		 =  isset($_POST['Nro']) ? $_POST['Nro']: 1 ;
//	$D_Muestra 	 =  new Muestras();
//	$Det_Muestras=  new Muestras();
//	$D_Muestra 	->  Muestra($id);	
	$CN 		 = Muestras::CNMuestras($id);
?>

<?php foreach($CN as $Detalles){ ?>
<button type="button" id="" data-id="<?php echo $Detalles['CN'] ?>" class="btn btn-primary load_muestra" data-toggle="" data-target="#informacion">
<?php echo "Muestra ".str_pad($id,3,"0",STR_PAD_LEFT ).'-'.$Detalles['CN']; ?>
</button>
<?php } ?>