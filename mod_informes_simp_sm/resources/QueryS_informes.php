<?php
include_once ("../clases/clasesInformes.php");	// incluyo las clases a ser usadas						
$action='';
if(isset($_POST['action']))
{$action=$_POST['action'];}

switch ($action)
{
	case 'updatePrint':
		
		$id 		= intval($_POST['id']);
		$estado 	= intval($_POST['estado']);
		$Muestras	= new Muestras($id);
		
		$Muestras-> setId($id);
    	$Muestras-> updateEstado($estado);
		echo $Muestras-> updatePrint();
        break;
    case 'updateOrden':
    	$id 		= intval($_POST['id']);
    	$datos 		= $_POST['datos'];  
		$Muestras	= new Muestras($id);
		
		echo $Muestras-> updateOrden($datos,$id);
        break;
    case 'loadOrden':
    	$id 		= intval($_POST['id']);
    	$n 			= $_POST['ndatos'];  
		$Muestras	= new Muestras($id);
		$datos 		= $Muestras-> loadOrden($id);
		$datos 		= explode("|", $datos[0]["Orden"]);
		$data 		= [];
		$nf			= $n*3;
		$ni			= $nf-3;

		for ($in=$ni; $in<$nf; $in++){
			$data[$in] = $datos[$in];
		}
		echo $data= implode(",", $data);
        break;
     case 'loadDetalles':
    	$id 		= intval($_POST['id']);
    	$n 			= $_POST['ndatos'];  
		$Muestras	= new Muestras($id);
		$datos 		= $Muestras-> loadOrden($id);
		$datos 		= explode("|", $datos[0]["Detalles"]);
		$data 		= [];
		$nf			= $n*3;
		$ni			= $nf-3;

		for ($in=$ni; $in<$nf; $in++){
			$data[$in] = $datos[$in];
		}
		echo $data= implode(",", $data);
        break;
       
    case 'updateDetalles':
    	$id 		= intval($_POST['id']);
    	$nd 		= intval($_POST['nd']);
    	$datos 		= $_POST['datos'];  
		$Muestras	= new Muestras($id);
		
		echo $Muestras-> updateDetalles($datos,$id,$nd);
        break;
    case 'updateObservaciones':
    	$id 		= intval($_POST['id']);
    	$nd 		= intval($_POST['nd']);
    	$datos 		= $_POST['datos'];  
		$Muestras	= new Muestras($id);
		echo $Muestras-> updateObservaciones($datos,$id,$nd);
        break;
    case 'updateAnotaciones':
    	$id 		= intval($_POST['id']);
    	$nd 		= intval($_POST['nd']);
    	$datos 		= $_POST['datos'];  
		$Muestras	= new Muestras($id);
		echo $Muestras-> updateAnotaciones($datos,$id,$nd);
        break;
}
?>