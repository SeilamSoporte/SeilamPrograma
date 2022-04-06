<?php

include_once ("../clases/clasesResultadosFQ.php");	// incluyo las clases a ser usadas

$action='';
if(isset($_POST['action']))
{$action=$_POST['action'];}

$view= new stdClass(); 							// creo una clase standard para contener la vista
$view->disableLayout=false;						// marca si usa o no el layout , si no lo usa imprime directamente el template

switch ($action)
{
	case 'consulta':
		$id 	   	   = intval($_POST['codigo_M']);	
		$codigo_M 	   = str_pad($id,3,"0",STR_PAD_LEFT );
		$CN  		   = $_POST['Nro'];
		$Resultados	   = new Muestras();
		$Result = $Resultados  -> getResultados($codigo_M, $CN);
		echo count($Result);
		break;
	case 'insertNuevoR':
		$id 	   	   = intval($_POST['codigo_M']);
		$codigo_M 	   = str_pad($id,3,"0",STR_PAD_LEFT );
		$CN 	   	   = intval($_POST['Nro']);
		$resultados    = $_POST['resultado'];
		$ResComparador = $_POST['ResComparador'];
		$fechaR 	   = $_POST['fechaR'];
		$incertidumbres=$_POST['incertidumbre'];
		$Muestras	   = new Muestras();
		$Muestras-> setCodigo_M($codigo_M);
        $Muestras-> setConsecutivo($CN);
        $Muestras-> setResultados($resultados);
        $Muestras-> setIncertidumbres($incertidumbres);
        $Muestras-> setResComparador($ResComparador);
        $Muestras-> setFechaR($fechaR);
        //$Muestras-> setCaracteristicas($caracteristicas);
        //echo $codigo_M ;
        echo $Muestras -> insert_r();
		break;
	case 'updateResults': 	//Actualizar resultados
		$id 	   	   = intval($_POST['codigo_M']);	
		$codigo_M 	   = $id;//str_pad($id,3,"0",STR_PAD_LEFT );
		$resultados    = $_POST['resultado'];
		$CN  		   = $_POST['Nro'];
		$ResComparador = $_POST['ResComparador'];
		$incertidumbres= $_POST['incertidumbre'];
		$fechaR 	   = $_POST['fechaR'];
		$Muestras	= new Muestras();
		
        $Muestras-> setCodigo_M($codigo_M);
		$Muestras-> setConsecutivo($CN);
        $Muestras-> setResultados($resultados);
        $Muestras-> setIncertidumbres($incertidumbres);
        $Muestras-> setResComparador($ResComparador);
        $Muestras-> setFechaR($fechaR);
		echo $Muestras -> updateResult();
        break;
    case 'reportar':
        $id			   = intval($_POST['id']);
        $cn 		   = intval($_POST['Nro']);
        $Marca 		   = new Muestras();
		echo $Marca-> Reportar($id,$cn);
		break;  
    case 'readParametro':
        $id			   =  intval($_POST['id']);
        $Parametro	   =  new Muestras();
		$Retorno = $Parametro-> getParametrosN($id);
		print_r($Retorno);
		break;    
    case 'deleteMuestra':
        $id			  =  intval($_POST['id']);
        $Muestras	  =  new Muestras();
		$Muestras	  -> setId($id);
		echo $Muestras-> delete();
		break;
   default :
}
?>