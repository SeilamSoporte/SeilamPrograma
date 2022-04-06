<?php

include_once ("../clases/clasesParametros.php");	// incluyo las clases a ser usadas

$action='';
if(isset($_POST['action']))
{$action=$_POST['action'];}

//include_once ("SaveImg.php");					// incluyo script para guardar imagen de foto


$view= new stdClass(); 							// creo una clase standard para contener la vista
$view->disableLayout=false;						// marca si usa o no el layout , si no lo usa imprime directamente el template

switch ($action)
{
	case 'saveParametro':
        // limpio todos los valores antes de guardarlos
        // si por las dudas venga algo raro        
		$id=intval($_POST['id']);
		/*$nombre=cleanString($_POST['Nombre']);	*/
		$codigo		= $_POST['codigo'];
        $area		= $_POST['area'];
        $categoria	= $_POST['categoria'];
        $clase		= $_POST['clase'];
		$params	 	= $_POST['parametro'];
		$norma 		= $_POST['norma'];
		$comparador	= $_POST['comparador'];
		$limite 	= $_POST['limite'];
		$metodo		= $_POST['metodo'];
		$referencia	= $_POST['referencia'];
		$tipo 		= $_POST['tipo'];
		$equipo		= $_POST['equipo'];
		$solucion   = $_POST['solucion'];

		$Parametros	= new Parametros($id);
		
		$Parametros	-> setId($id);
        $Parametros	-> setCodigo($codigo);
        $Parametros	-> setArea($area);
        $Parametros	-> setCategoria($categoria);
		$Parametros	-> setClase($clase);
		$Parametros	-> setParams($params);
		$Parametros	-> setNorma($norma);
		$Parametros	-> setComparador($comparador);		
		$Parametros	-> setLimite($limite);
		$Parametros	-> setMetodo($metodo);
		$Parametros	-> setReferencia($referencia);
		$Parametros	-> setTipo($tipo);
		$Parametros	-> setEquipo($equipo);
		$Parametros	-> setSolucion($solucion);				
		echo $Parametros -> save();
        break;

    case 'deleteParametro':
        $id			=  intval($_POST['id']);
        $Parametros	=  new Parametros($id);
		$Parametros	-> setId($id);
		echo $Parametros->delete();
		break;
	case 'readParametro_full':
		$id 		= $_POST['id'];
		$Parametros	=  new Parametros();
		echo $Parametros -> codParametro_full($id);
		//echo $Parametros;
		break;

	case 'readParametros':
		$id 		= $_POST['id'];
		$Parametros	=  new Parametros();
		echo $Parametros -> codParametro($id);
		break;
	case 'readParametro':
		$id 		= $_POST['id'];
		$Parametros	=  new Parametros();
		echo $Parametros -> codParametro($id);
		break;

   default :
}

?>