<?php 

	$id 		  		= $_GET['id'];
	$cn 				= $_GET['sp'];
	$nd					= $_GET['nd'];
	
	$view  				= new stdClass(); 
	$Muestras			= new Muestras();
	$Muestras 			->Muestra($id);

	$Muestras 			->DetallesMuestras($id, $cn);
	$CI_SP 				= $Muestras 			->CI;
	$conIncertidumbreSP = $Muestras 			->CI;

	$ParametroId		= $Muestras 			->Parametro;

	$Parametrizacion 	= $Muestras 			->getParametrizacion($ParametroId)[0];//getParametrizacion($ParametroId)[0];
	$Categoria 			= $Muestras 			->getCategoria($Parametrizacion['Categoria']); 

	$Area 				= $Parametrizacion['Area'];
	$Clase 				= $Muestras 			->getClase($Parametrizacion['Clase']);
	$Clase 				= $Muestras 			->Clase;
	$NParametros		= explode("|",$Parametrizacion['Parametros']);	
	$Metodo 			= explode("|",$Parametrizacion['Metodo']);
	$Norma 				= explode("|",$Parametrizacion['Norma']);
	$Comparador 		= explode("|",$Parametrizacion['Comparador']);
	$Limite 			= explode("|",$Parametrizacion['Limite']);
	$Tipo 				= explode("|",$Parametrizacion['Tipo']);
	$Results			= $Muestras 			->getResultados($id,$cn);
	$Results 	 		= $Muestras 			->Resultados;//explode("|",$Results['Resultados']);
	$Resultados 		= explode("|",$Results);
	$Fecha_result 		= $Muestras 			->Fecha_result;//$Results['Fecha'];
	$ResComparador 		= $Muestras 			->ResComparador;
	$ResComparador 		= explode("|",$ResComparador);
	$EstadoM 			= $Muestras 			->Estado;

    $view->contentTemplate= '../templates/cont_sp.php'; // seteo el template que se va a mostrar

?>

<?php include_once ($view->contentTemplate);?>
