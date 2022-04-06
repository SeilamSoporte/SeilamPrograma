<?php
/*
 * Autor: Wilfrank Badillo M
 */
include_once ("../session.php");
include_once ("../common/valsess.php");
include_once ("clases/clasesMuestras.php");	// incluyo las clases a ser usadas
include_once ("../common/meses.php");

$action='index';
if(isset($_POST['action']))
{$action=$_POST['action'];}

$view = new stdClass(); 						// creo una clase standard para contener la vista
$vista= new stdClass();
$view->disableLayout=false;					// marca si usa o no el layout , si no lo usa imprime directamente el template

// para no utilizar un framework y simplificar las cosas uso este switch
switch ($action)
{
    case 'index':
        $fecha  = getDate();
        $mes    = str_pad($fecha['mon'],2,'0',STR_PAD_LEFT);
        $año    = $fecha['year'];
        $hoy    = str_pad($fecha['mday'],2,'0',STR_PAD_LEFT);
        $dia_d  = '01';
        $dia_h  = '31'; 
        if($hoy<8){
            $dias   = DiasXmes($mes-1);
            $dia_d  = ($dias-7) + $hoy;
            if($mes==1){
                $mes_d  = 12;
                $año_d  = $año-1; 
            }
            else{
                $mes_d  = str_pad(($mes-1),2,'0',STR_PAD_LEFT); 
                $año_d  = $año; 
            }
        }
        else 
        {
            $dias   = DiasXmes($mes);
            $dia_d  = str_pad(($hoy-7),2,'0',STR_PAD_LEFT);
            $mes_d  = $mes;
            $año_d  = $año;
        }
        $view->contentTemplate= "templates/listaFGrid.php"; // seteo el template que se va a mostrar
        break;
    case 'refreshGrid':
        $view->disableLayout  = true; // no usa el layout
        $view->muestras       = Muestras::getMuetra();
        $view->contentTemplate= "templates/listaFGrid.php"; // seteo el template que se va a mostrar
        break;
    default :
}

// si esta deshabilitado el layout solo imprime el template
if ($view->disableLayout==true)
{include_once ($view->contentTemplate);}
else
{include_once ('templates/layout.php');} // el layout incluye el template adentro
