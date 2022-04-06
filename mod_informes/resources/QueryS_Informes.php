<?php
include_once ("../clases/clasesInformes.php");  // incluyo las clases a ser usadas                      
$action='';
if(isset($_POST['action']))
{$action=$_POST['action'];}
 
switch ($action)
{
    case 'updatePrint':     
        $id         = intval($_POST['id']);
        $estado     = intval($_POST['estado']);
        $Muestras   = new Muestras($id);
         
        $Muestras-> setId($id);
        $Muestras-> updateEstado($estado);
        echo $Muestras-> updatePrint();
        break;
    case 'updateSimp':
        $id         = intval($_POST['id']);
        $simp       = intval($_POST['estado']);
        $Muestras   = new Muestras($id);
        $Muestras-> setId($id);
        $Muestras-> setSimp($simp);
        echo $Muestras-> updateTipoInforme();
        break;
    case 'updateIncertidumbre':     
        $id         = intval($_POST['id']);
        $cn         = intval($_POST['cons']);       
        $estado     = intval($_POST['estado']);
        $Muestras   = new Muestras($id);
         
        $Muestras-> setId($id);
        $Muestras-> setCn($cn);
        $Muestras-> setIncert($estado);
        $Muestras-> updateIncertidumbre();
        break;        
    case 'updateRevision1':     
        $id         = intval($_POST['id']);
        $cn         = intval($_POST['cons']);       
        $Muestras   = new Muestras($id);
         
        $Muestras-> setId($id);
        $Muestras-> setCn($cn);
        $Muestras-> setRevision1("1");
        $Muestras-> updateRevision1();
        echo $data = $Muestras-> getRevision($id,$cn);
        break;                
    case 'updateRevision2':     
        $id         = intval($_POST['id']);
        $cn         = intval($_POST['cons']);       
        $Muestras   = new Muestras($id);
         
        $Muestras-> setId($id);
        $Muestras-> setCn($cn);
        $Muestras-> setRevision2("1");
        $Muestras-> updateRevision2();
        $Muestras-> setRevision1("1");
        $Muestras-> updateRevision1();
        echo $data = $Muestras-> getRevision($id,$cn);
        break; 
    case 'getRevision':     
        $id         = intval($_POST['id']);
        $cn         = intval($_POST['cons']);
        $usuario    = $_POST['user'];   
        $Muestras   = new Muestras($id);
        $permisos = $Muestras-> getPermisos($usuario);
    //  echo $permisos[10]; 
        $revision = $Muestras-> getRevision($id,$cn);
        $data = $revision.','.$permisos[10].','.$permisos[11];
        echo $data; 
        break; 
}
?>