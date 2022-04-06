<?php
include_once("../clases/clasesMuestras.php");	// incluyo las clases a ser usadas
$action='';
if (isset($_POST['action'])) {
    $action=$_POST['action'];
}

$view= new stdClass(); 							// creo una clase standard para contener la vista
$view->disableLayout=false;						// marca si usa o no el layout , si no lo usa imprime directamente el template

switch ($action) {
    case 'insertNuevaM':
        $id 	   	   = intval($_POST['id']);
        $CN 	   	   = intval($_POST['Nro']);
        $parametro 	   = intval($_POST['parametro']);
        $acta 	   	   = $_POST['acta'];
        $temperatura   = $_POST['temperatura'];
        $hora 		   = $_POST['hora_ingreso'];
        
        $Muestras	   = new Muestras($id);
        $Muestras-> setCodigo_M($id);
        $Muestras-> setConsecutivo($CN);
        $Muestras-> setParametro($parametro);
        $Muestras-> setActa($acta);
        $Muestras-> setHora_rec($hora);
        $Muestras-> setTemperatura($temperatura);
        echo $Muestras -> insert_m();
        break;
    case 'updateM': 	//Actualizar muestreo
        
        $id 	   	   = intval($_POST['codigo_M']);
        $codigo_M 	   = str_pad($id, 3, "0", STR_PAD_LEFT);
        $cliente	   = intval($_POST['cliente']);
        $fecha_ingreso = $_POST['fecha_ingreso'];
        $fecha_recolec = $_POST['fecha_recolec'];
        $nombres 	   = $_POST['nombres'];
        $sede 	 	   = $_POST['sede'];
        $hora_ingreso  = $_POST['hora_ingreso'];
        
        $Muestras	= new Muestras($id);
        
        $Muestras-> setId($id);
        $Muestras-> setCliente($cliente);
        $Muestras-> setFecha_I($fecha_ingreso);
        $Muestras-> setFecha_R($fecha_recolec);
        $Muestras-> setCodigo($codigo_M);
        $Muestras-> setNombres($nombres);
        $Muestras-> setHoraI($hora_ingreso);
        $Muestras-> setSede($sede);
        echo $Muestras -> save_muestra();
        break;
    case 'insertM': 	//Insertar nuevo muestreo
        
        $id 	   	   = intval($_POST['codigo_M']);
        $codigo_M 	   = $id;//str_pad($id,8,"0",STR_PAD_LEFT );
        $cliente	   = intval($_POST['cliente']);
        $fecha_ingreso = $_POST['fecha_ingreso'];
        $fecha_recolec = $_POST['fecha_recolec'];
        $nombres 	   = $_POST['nombres'];
        $sede 	 	   = $_POST['sede'];
        $hora_ingreso  = $_POST['hora_ingreso'];

        $Muestras	= new Muestras();
        
        $Muestras-> setId($id);
        $Muestras-> setCliente($cliente);
        $Muestras-> setFecha_I($fecha_ingreso);
        $Muestras-> setFecha_R($fecha_recolec);
        $Muestras-> setCodigo(Muestras::LastMo()+1);
        $Muestras-> setNombres($nombres);
        $Muestras-> setHoraI($hora_ingreso);
        $Muestras-> setSede($sede);
        echo $Muestras -> save_muestra();
        break;

    case 'updatePrint':
        
        $id 		= intval($_POST['id']);
        $estado 	= intval($_POST['estado']);
        $Muestras	= new Muestras($id);
        
        $Muestras-> setId($id);
        $Muestras-> updateEstado($estado);
        
        echo $Muestras-> updatePrint();
        break;

    case 'updateMuestras':	//Actualizar cada muestra dentro de un muestreo
        
        $id 		= intval($_POST['codigo_M']);
        $Nro 		= $_POST['Nro'];
        $codigo_M 	= intval($_POST['codigo_M']);
        $parametro  = $_POST['parametro'];
        $acta		= $_POST['acta'];
        $descripcion= $_POST['descripcion'];
        $observacion= $_POST['observacion'];
        $temperatura= $_POST['temperatura'];
        $lote	 	= $_POST['lote'];
        $fechaprod 	= $_POST['fechaprod'];
        $fechavenc	= $_POST['fechavenc'];
        $cantidad 	= $_POST['cantidad'];
        $empaque	= $_POST['empaque'];
        $hora 		= $_POST['hora_rec'];
        $medio 		= $_POST['medio'];
        $est_tiempo = isset($_POST['estado_tiempo']) ? $_POST['estado_tiempo']:1 || $_POST['estado_tiempo']!='' ? $_POST['estado_tiempo']:1;
        $lugar 		= $_POST['lugar'];
        $unidad 	= $_POST['unidad'];
        $datos_campo= isset($_POST['datosencampo']) ? $_POST['datosencampo']: '';
        $comparador_dc= isset($_POST['comparadordatosencampo']) ? $_POST['comparadordatosencampo']: '';
        $caracteristicas= isset($_POST['caracteristicas']) ? $_POST['caracteristicas']: '';
        
        $cambio = $_POST['cambio'];
        date_default_timezone_set('America/Bogota');
        $fecha_cambio = Date('Y-m-d H:i:s');
        $usuario_cambio = $_POST['usuario_cambio'];

        $Muestras	= new Muestras($id);
        
        $Muestras-> setId($id);
        $Muestras-> setCodigo_M($codigo_M);
        $Muestras-> setParametro($parametro);
        $Muestras-> setConsecutivo($Nro);
        $Muestras-> setActa($acta);
        $Muestras-> setDescripcion($descripcion);
        $Muestras-> setObservacion($observacion);
        $Muestras-> setTemperatura($temperatura);
        $Muestras-> setLote($lote);
        $Muestras-> setFechaProd($fechaprod);
        $Muestras-> setFechaVenc($fechavenc);
        $Muestras-> setCantidad($cantidad);
        $Muestras-> setEmpaque($empaque);
        $Muestras-> setHora_rec($hora);
        $Muestras-> setCampo($datos_campo);
        $Muestras-> setComparador($comparador_dc);
        $Muestras-> setEstado($est_tiempo);
        $Muestras-> setLugar($lugar);
        $Muestras-> setUnidad($unidad);
        $Muestras-> setCaracteristicas($caracteristicas);
        $Muestras-> setCambio($cambio);
        $Muestras-> setFechaCambio($fecha_cambio);
        $Muestras-> setUsuarioCambio($usuario_cambio);

        echo $Muestras -> updateDetMuestra();
        break;

    case 'insertDetMuestra':
        // limpio todos los valores antes de guardarlos
        // si por las dudas venga algo raro
        $id 		= intval($_POST['id']);
        $Nro 		= intval($_POST['Nro']);

        $codigo_M 	= intval($_POST['codigo_M']);
        $parametro  = $_POST['parametro'];
        $acta		= $_POST['acta'];
        $descripcion= $_POST['descripcion'];
        $observacion= $_POST['observacion'];
        $temperatura= $_POST['temperatura'];
        $lote	 	= $_POST['lote'];
        $fechaprod 	= $_POST['fechaprod'];
        $fechavenc	= $_POST['fechavenc'];
        $cantidad 	= $_POST['cantidad'];
        $empaque	= $_POST['empaque'];
        $hora 		= $_POST['hora_rec']; ///
        $medio 		= $_POST['medio'];
        $est_tiempo = $_POST['estado_tiempo'];
        $lugar 		= $_POST['lugar'];
        $unidad 	= $_POST['unidad'];
        $datos_campo= isset($_POST['datosencampo']) ? $_POST['datosencampo']: '';
        $caracteristicas= isset($_POST['caracteristicas']) ? $_POST['caracteristicas']: '';
        $comparador_dc= isset($_POST['comparadordatosencampo']) ? $_POST['comparadordatosencampo']: '';
        $Muestras	= new Muestras($id);
        
        $Muestras-> setId($id);
        $Muestras-> setCodigo_M($codigo_M);
        $Muestras-> setParametro($parametro);
        $Muestras-> setConsecutivo($Nro);
        $Muestras-> setActa($acta);
        $Muestras-> setDescripcion($descripcion);
        $Muestras-> setObservacion($observacion);
        $Muestras-> setTemperatura($temperatura);
        $Muestras-> setLote($lote);
        $Muestras-> setFechaProd($fechaprod);
        $Muestras-> setFechaVenc($fechavenc);
        $Muestras-> setCantidad($cantidad);
        $Muestras-> setEmpaque($empaque);
        $Muestras-> setHora_rec($hora);
        $Muestras-> setCampo($datos_campo);
        $Muestras-> setComparador($comparador_dc);
        $Muestras-> setEstado($est_tiempo);
        $Muestras-> setLugar($lugar);
        $Muestras-> setUnidad($unidad);
        $Muestras-> setCaracteristicas($caracteristicas);
    
        //echo "OK";
        echo $Muestras -> insertDetMuestra();
        break;

    case 'readParametro':
        $id			   =  intval($_POST['id']);
        $Parametro	   =  new Muestras();
        $Retorno =  isset($Parametro-> getParametros($id)[0]) ? $Parametro-> getParametros($id)[0]:'  ';
        echo $Retorno[1];
        break;
    case 'deleteMuestra':
        $id			  =  intval($_POST['id']);
        $Muestras	  =  new Muestras();
        $Muestras	  -> setId($id);
        echo $Muestras-> delete();
        break;
    case 'load_sedes':
        $id 		  = intval($_POST['id']);
        $sedes 		  = new Clientes();
        return $sedes->getSedes($id)[0];
        break;
   default:
}

// si esta deshabilitado el layout solo imprime el template
/*if ($view->disableLayout==true)
{include_once ($view->contentTemplate);}
else
{include_once ('templates/layout.php');} // el layout incluye el template adentro
*/
