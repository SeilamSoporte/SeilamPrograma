<?php
/*
 * Autor: Wilfrank Badillo M
 */
include_once ("../session.php");
include_once ("../common/valsess.php");
include_once ("clases/clasesMuestras.php"); 
include_once ("../common/meses.php");

$action='index';
if(isset($_POST['action']))
{$action=$_POST['action'];}

$view = new stdClass();                         
$vista= new stdClass();
$view->disableLayout=false;                 

switch ($action)
{
    case 'index':
        $fecha  = getDate();
        $mes    = str_pad($fecha['mon'],2,'0',STR_PAD_LEFT);
        $año    = $fecha['year'];
        $hoy    = str_pad($fecha['mday'],2,'0',STR_PAD_LEFT); 
        $dia_d  = '01';
        $dia_h  = '31'; 
        if($hoy<16){
            $dias   = DiasXmes($mes-1);
            $dia_d  = ($dias-15) + $hoy;
            if($mes==1){
                $mes_d    = 12;
                $año_d    = $año-1; 
            }
            else{
                $año_d    = $año;
                $mes_d    = str_pad(($mes-1),2,'0',STR_PAD_LEFT); 
            }
        }
        else 
        {
            $dias   = DiasXmes($mes);
            $dia_d  = str_pad(($hoy-15),2,'0',STR_PAD_LEFT);
            $mes_d  = $mes;
            $año_d  = $año;
        }
        
        //$view->muestras     = Muestras::getMuestra(); 
        $view->contentTemplate= "templates/listGrid.php"; 
        break;
}

// si esta deshabilitado el layout solo imprime el template
if ($view->disableLayout==true)
    { include_once ($view->contentTemplate); }
else
    { include_once ('templates/layout.php'); } // el layout incluye el template adentro
