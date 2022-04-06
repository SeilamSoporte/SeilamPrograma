<?php 

function recuperaId($ide){
	$id_des 	= $ide ;
	$str 		= substr($ide, 4, 6);
	$mul 		= substr($ide, 24);
	$id  		= $str/$mul ;
	return $id;
}

function recuperaCon($ide){
	$id_des 	= $ide ;
	$con = intval(substr($ide, 16,2));
	return $con;
}
function unidadCt($UId){
	switch ($UId) {
		case '0':
			return "mL";
			break;
		case '1':
			return "g";
			break;
		case '2':
			return "mL";
			break;
		
		default:
			return "";
			break;
	}
}

function EstadoT($Id){
	switch ($Id) {
		case '1':
			return "Seco";
			break;
		case '2':
			return "Húmedo";
			break;
		case '3':
			return "Lluvioso";
			break;
		
		default:
			return "";
			break;
	}
}
	function buscar($cadena, $word ){
		return strpos($cadena, $word);
	}

	include_once '../clases/clasesInformes.php';
	$D_Empresa 			= new Empresa();
	$D_Empresa			->D_Empresa(1);
	$Logo				= $D_Empresa 			->Logo;
	$Nombre_empresa   	=$D_Empresa 			->Empresa;
	$Direccion_empresa	=$D_Empresa 			->Direccion;
	$Telefono_empresa 	=$D_Empresa 			->Telefono;
	$Correo_empresa   	=$D_Empresa 			->Email;

	$str_id 		  	= $_GET['id'];
	$id 			  	= recuperaId ($str_id);
	$cn 				= recuperaCon($str_id);
	$view  				= new stdClass(); 
    
	$Muestras			= new Muestras();
	$Muestras 			->Muestra($id);
	
	$NroInforme			= $Muestras 			->Codigo;
	$NroInforme		   .= '-'.$cn;
	$Cliente 			= $Muestras 			->Nombre_cliente;
	$ClienteId 			= $Muestras 			->Cliente;
	$Nombres 			= explode("|", $Muestras->Nombres);
	$Encargado			= $Nombres[0];
	$Recolectado		= $Nombres[1];
	$Fecha_ingreso		= $Muestras 			->Fecha_I;
	$Fecha_recoleccion	= $Muestras 			->Fecha_R;
	$Hora_ingreso		= $Muestras 			->Hora_I;
	
	$D_Cliente 			= new Clientes();
	$D_Cliente 			->getCliente($ClienteId);
	$Direccion_cliente  = $D_Cliente 			->Direccion; 
	$Sede_cliente		= $D_Cliente 			->Sede;
	$Telefono_cliente	= $D_Cliente 			->Telefono;

	//$Muestras			= new Muestras();
	$Muestras 			->DetallesMuestras($id, $cn);
	
	$Codigo 			= $Muestras 			->Codigo_M;
	$Codigo 	       .= "-".$Muestras 		->Consecutivo; 	
	$Descripcion		= $Muestras 			->Descripcion;
	$EmpaqueId			= $Muestras 			->Empaque;
	$Hora_recoleccion 	= $Muestras 			->Hora_rec;
	$D_campo 			= explode("|",$Muestras ->Datos_campo);

	$horaI 				= strtotime($Hora_ingreso);
	$horaI 				= date("H:i" , $horaI);
	$horaR 				= strtotime($Hora_recoleccion);
	$horaR 				= date("H:i" , $horaR);
	$Fecha_Hora_I 		= $Fecha_ingreso.', '. $horaI ;
	$Fecha_Hora_R 	 	= $Fecha_recoleccion.', '.$horaR;
	$TemperaturaIngreso = $Muestras 			->Temperatura.' ºC';
	$UnidadCant 		= $Muestras 			->Unidad; 	
	$UnidadCant 		= unidadCt($UnidadCant);	
	$Cantidad			= $Muestras 			->Cantidad;
	$Cantidad			= ($Cantidad=="") ? "-" : $Cantidad.' '.$UnidadCant;
	$Estado 			= $Muestras 			->Estado_tiempo ;
	$Estado 			= EstadoT($Estado);
	$LugarM				= $Muestras 			->Lugar;
	$Observaciones 		= $Muestras 			->Observaciones;
	$Empaque 			= $Muestras 			->getEmpaque($EmpaqueId);
	$ParametroId		= $Muestras 			->Parametro;
	$Parametrizacion 	= $Muestras 			->getParametrizacion($ParametroId)[0];
	$Titulo 			= strtoupper($Parametrizacion['Area'].' '.$Parametrizacion['Categoria']);
	$Clase 				= $Parametrizacion['Clase'];
	$NParametros		= explode("|",$Parametrizacion['Parametros']);	
	$Metodo 			= explode("|",$Parametrizacion['Metodo']);
	$Norma 				= explode("|",$Parametrizacion['Norma']);
//	if ($D_campo[0]=="" && $D_campo[1]=="" && $D_campo[2]=="" ){ $Datos_campo="-"; }
	$Datos_campo		= (buscar($Titulo, 'ALIMENTO')==true) ? "NA" : 'Cloro Res:'.$D_campo[0] . 'ppm / pH:' . $D_campo[1]. ' / Temperatura:'.$D_campo[2].'ºC'; 
	$Estado 		    = (buscar($Titulo, 'ALIMENTO')==true) ? "NA" : $Estado ; 

    $view->contentTemplate= '../templates/contenido.php'; // seteo el template que se va a mostrar
	

?>
<!--
<!DOCTYPE html>
<html lang="es">
-->
<?php 
$html= '
  <head>
    <meta charset="utf-8">
	    <meta http-equiv="Content-Type" content="text/html">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Informe <?php echo "-".$id."-".$cn ?></title>
		<link href="../../fonts/font-awesome.min.css" rel="stylesheet">
		<link href="../../css/bootstrap.css" rel="stylesheet">
		<!-- <link href="../../css/btn_floating.css" rel="stylesheet"> -->
		<link href="../css/estilos_inf.css" rel="stylesheet">
    	<script src="../../js/jquery-2.2.2.min.js"></script>
		<script src="../../js/printThis.js"></script>
		<script src="../../js/jspdf.js"></script>
	</head>

<body>
<div class="margen-top"></div>

<div class="doc" role="document">
	<div class="doc-content">
    	<div class="doc-header">
			<div class="navbar-collapse navbar-fixed-top" id="menu">
			  <ul class="nav navbar-nav navbar-right">
				<li class="" id="pdf_li">
					<a href="#" id="pdf" class="btn-cmd" data-toggle="modal" data-placement="bottom" title="Generar pdf">
						<i class="fa fa-file-pdf-o fa-2x ">&nbsp;</i>
					</a>
				</li>
				<li class="" id="print_li">
					<a href="#" id="print" class="btn-cmd print-i" data-toggle="modal" data-placement="bottom" title="Imprimir informe">
						<i class="fa fa-print fa-2x ">&nbsp;</i>
					</a>
				</li>
			  </ul>
			</div><!-- /.navbar-collapse -->		  
      	</div>
      	<div class="doc-body">
			<div class="report">
				<div id="contenido-informe">
					<?php include_once ($view->contentTemplate);?>
				</div>
			</div>
        </div> <!-- doc Body-->
    </div> <!-- doc content-->
  </div>
</body>
'?>
<!--
</html>
-->
<?php 
	include_once '../mpdf/mpdf.php';
	$mpdf= new mPDF();
	$mpdf->WriteHTML($html);
	$mpdf->output();
	exit;
?>
		