<?php 

	$D_Empresa 			= new Empresa();
	$D_Empresa			->D_Empresa(1);
	$Logo				= $D_Empresa 			->Logo;
	$Nombre_empresa   	=$D_Empresa 			->Empresa;
	$Direccion_empresa	=$D_Empresa 			->Direccion;
	$Telefono_empresa 	=$D_Empresa 			->Telefono;
	$Correo_empresa   	=$D_Empresa 			->Email;

	$id 		  		= $_GET['id'];
	$cn 				= $_GET['fq'];
	$mb 				= $_GET['mb'];	
	$fq 		  		= $_GET['fq'];
	$sp 				= $_GET['sp'];
	$nd					= $_GET['nd'];

	$Remisiones 		= $id.'-'.$mb.' / '.$id.'-'.$fq.' / '.$id.'-'.$sp;

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

	$Muestras 			->DetallesMuestras($id, $cn);	
	$Codigo 			= $Muestras 			->Codigo_M;
	$Codigo 	       .= "-".$Muestras 		->Consecutivo; 	
	
	$Descripcion		= $Muestras 			->Descripcion;
	$EmpaqueId			= $Muestras 			->Empaque;
	$Hora_recoleccion 	= $Muestras 			->Hora_rec;
	
	$D_campo 			= explode("|",$Muestras ->Datos_campo);

	$Caracteristicas	= explode("|",$Muestras ->Caracteristicas);
	$color				= isset($Caracteristicas[0]) ? $Caracteristicas[0]:'';
	$olor				= isset($Caracteristicas[1]) ? $Caracteristicas[1]:'';
	$aspecto			= isset($Caracteristicas[2]) ? $Caracteristicas[2]:'';

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
	$Empaque 			= $Muestras 			->Empaque_name;
	$ParametroId		= $Muestras 			->Parametro;

	$Parametrizacion 	= $Muestras 			->getParametrizacion($ParametroId)[0];//
	$Categoria 			= $Muestras 			->getCategoria($Parametrizacion['Categoria']); //
	$Categoria 			= $Muestras 			->Categ;  
	$Titulo 			= strtoupper($Parametrizacion['Area'].' '.$Categoria);
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
	$Fecha_prod 		= $Muestras 			->Fecha_prod;
	$Fecha_produccion 	= ($Fecha_prod==0)? 'NA' : $Fecha_prod ;
	$Fecha_venc		    = $Muestras 			->Fecha_venc;
	$Fecha_vencimiento	= ($Fecha_venc==0) ? 'NA' : $Fecha_venc;
	$Lote				= $Muestras 			->Lote;
	$Medio				= $Muestras 			->Medio;
	$Firmas 			= $Muestras 			->getFirmas();
	$TextTitulo   		= strtolower($Titulo); 
    $view->contentTemplate= '../templates/cont_fq.php'; // seteo el template que se va a mostrar
	$src_logo 			= "../../mod_empresa/imgs/".$Logo;	

    $Detalles  			= $Muestras ->loadDetalles($id,$nd) ;
	$Observaciones 		= isset($Detalles[0]) ? $Detalles[0]['Observaciones']:''; 
	if ($Observaciones==''){
		$Observaciones  ='Para mejor comprensión de los resultados comuníquese con su asesor.';
	}
?>
<div class="" role="document">
	<div class="">
			<div id="contenido-informe">
				<?php include_once ($view->contentTemplate);?>
			</div>
    </div> <!-- doc content-->
</div>
