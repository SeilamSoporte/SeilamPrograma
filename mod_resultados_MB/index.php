<?php
/*
 * Autor: Wilfrank Badillo M
 */
include_once ("../session.php");
include_once ("../common/valsess.php");
include_once ("../common/meses.php");

include_once ("clases/clasesResultadosMB.php");	// incluyo las clases a ser usadas
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
        $dia_h  = $hoy; 
        $mes_h  = $mes;
        $año_h  = $año;
        if($hoy<8){
            $dias   = DiasXmes($mes-1);
            $dia_d  = ($dias-7) + $hoy;
            if($mes==1){
                $mes_d  =12;
                $año_d  = $año-1; 
            }
            else{
                $mes_d =  str_pad($mes-1,2,'0',STR_PAD_LEFT);
                $año_d = $año;   
            }
        }
        else 
        {
            $dias   = DiasXmes($mes);
            $dia_d  = str_pad(($hoy-7),2,'0',STR_PAD_LEFT);
            $mes_d  = $mes;
            $año_d  = $año;
        }

        if(isset($_POST['back'])){
            $desde   = $_POST['desde'];
            $hasta   = $_POST['hasta'];
            $f_desde =  explode('-', $desde);
            $dia_d   = $f_desde[2];
            $mes_d   = $f_desde[1];
            $año_d   = $f_desde[0];
            $f_hasta =  explode('-', $hasta);
            $dia_h   = $f_hasta[2];
            $mes_h   = $f_hasta[1];
            $año_h   = $f_hasta[0];        
        }
        //$view->muestras     = Muestras::getMuestra(); // tree todos los clientes
        $view->contentTemplate= "templates/muestrasGrid.php"; // seteo el template que se va a mostrar
        break;
    case 'refreshGrid':
        $view->disableLayout  = true; // no usa el layout
        $view->muestras       = Muestras::getMuetra();
        $view->contentTemplate= "templates/muestrasGrid.php"; // seteo el template que se va a mostrar
        break;
    case 'saveMuestra':
        // limpio todos los valores antes de guardarlos
        // por las dudas venga algo raro
        $id			= intval($_POST['id']);
        $muestra	= new Muestra($id);
        $muestra   -> setCodigo ($_POST['codigo']);
        $muestra   -> setCliente($_POST['cliente']);
        $muestra   -> setFecha_I($_POST['FechaIngreso']);
        $muestra   -> setFecha_R($_POST['FechaRecoleccion']);
        $muestra   -> setCliente($_POST['Nombres']);

        $muestra   -> save();
        break;
    case 'newMuestra':
        $view->usuario          = new Usuarios();
        $view->label            = 'Nuevo Usuario';
        $view->disableLayout    = true;
        $view->contentTemplate  = "templates/parametrosForm.php"; // seteo el template que se va a mostrar
        break;
    case 'editClient':
        $editId=intval($_POST['id']);
        $view->label='Editar Usuario';
        $view->usuario=new Usuarios($editId);
        $view->disableLayout=true;
        $view->contentTemplate="templates/parametrosForm.php"; // seteo el template que se va a mostrar
        break;
    case 'deleteClient':
        $id=intval($_POST['id']);
        $client=new Usuarios($id);
        $client->delete();
        die; // no quiero mostrar nada cuando borra , solo devuelve el control.
        break;
    default :
}

// si esta deshabilitado el layout solo imprime el template
if ($view->disableLayout==true)
{include_once ($view->contentTemplate);}
else
{include_once ('templates/layout.php');} // el layout incluye el template adentro
