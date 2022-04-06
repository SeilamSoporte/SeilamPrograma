<?php 
	
include_once("../clases/clasesOrden.php");
include_once("Tipos_param.php");

//$desde = '2016-12-1';
//$hasta = '2016-12-16';
$desde      = $_POST['desde'] ;
$hasta      = $_POST['hasta'] ;
//$tipo 	  	= FQ;

$NMB	 	= 0; # MB Productos
$NFQ		= 0;
$NVol 		= 0;
$NIones 	= 0;
$NDC 		= 0; 
$NA 		= 0; # MB Aguas
$NCH		= 0; # MB COntrol Higiene

$Muestra   	= new Muestras();
$Muestras  	= Muestras::getMuestra($desde,$hasta);
$Parametros = new Muestras();

foreach ($Muestras as $Muestra_d){
	$DParametros = $Parametros->getParametros($Muestra_d['Parametro']); 
	$NPArray 	 = explode("|",$DParametros[0]['Tipo']);
	$NCArray 	 = explode("|",$DParametros[0]['Categoria']);

	#if(in_array('1', $NPArray))	{$NMB++;};
	if((in_array('2', $NCArray) || in_array('3', $NCArray) || in_array('6', $NCArray)) && in_array('1', $NPArray) )	{$NMB++;};

	if(in_array('1', $NCArray))	{$NCH++;};
	if((in_array('4', $NCArray) || in_array('5', $NCArray)) && in_array('1', $NPArray) )	{$NA++;};

	if(in_array('2', $NPArray))	{$NFQ++;};
	if(in_array('3', $NPArray))	{$NVol++;};
	if(in_array('4', $NPArray))	{$NIones++;};
	if(in_array('5', $NPArray))	{$NDC++;};

}

echo  $NMB.','.$NFQ.','.$NVol.','.$NIones.','.$NDC.','.$NA.','.$NCH;
//var_dump($Num);

?>