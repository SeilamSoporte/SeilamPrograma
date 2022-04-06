<?php 

$Cliente 			= $Muestras 			->Nombre_cliente;
$ClienteId 			= $Muestras 			->Cliente;
$Nombres 			= explode("|", $Muestras->Nombres);
$Encargado			= $Nombres[0];
$Recolectado		= $Nombres[1];
$Fecha_ingreso		= $Muestras 			->Fecha_I;
$IdSede 	  		= $Muestras 			->Sede;
$Sedes	 			= Muestras::getSedes($ClienteId)[0];	
$Sede_cliente		= explode("|", $Sedes['Sede'])[$IdSede];
$Sede_cliente 		= ($Sede_cliente==' ' || $Sede_cliente=='' ) ? '-' : $Sede_cliente;
$Encargado 			= $Encargado!='' ? $Encargado : '-';
$Remisiones	 		= $id.'-'.$mb.' / '.$id.'-'.$fq.' / '.$id.'-'.$sp;
$Detalles  			= $Muestras ->loadDetalles($id,$nd) ;
$Anotaciones   		= isset($Detalles[0]) ? $Detalles[0]['Anotaciones']: 'Sin observaciones';
$Anotaciones 		= ($Anotaciones=='') ? 'Sin observaciones':$Anotaciones;	
		
$D_Cliente 			= new Clientes();
$D_Cliente 			->getCliente($ClienteId);

$Telefono_cliente	= $D_Cliente 			->Telefono;
$Muestras 			->DetallesMuestras($id, $fq);	
$Descripcion		= $Muestras 			->Descripcion;

function formato_hora($valor){

	$str   = strval($valor); 		// Se convierte a string
	
	return $comp  = substr($str, 0,5);
	
}
$hora_rec = formato_hora($Muestras->Hora_rec);
?>
<br>

<div class="box" style="font-size:0.7rem">
<div class="row">
	<div class="col col-xs-12 centrado hd">
		DATOS GENERALES DEL CLIENTE Y MUESTRA
	</div>
</div>
<div class="row">
	<div class="col col-xs-2 th" style="width: 100px">Cliente/Empresa:</div>
	<div class="col col-xs-6 td"><?php echo $Cliente ?></div>
	<div class="col col-xs-2 th" style="width: 100px">Teléfono:</div>
	<div class="col td "><span id="telefono"><?php echo $Telefono_cliente ?></span></div>			
</div>
<div class="row">
	<div class="col col-xs-2 th" style="width: 100px">Responsable:</div>
	<div class="col col-xs-6 td"><span id="direccion"><?php echo $Encargado ?></span> </div>
	<div class="col col-xs-1 th" style="width: 100px">Sede:</div>
	<div class="col td"><span id="sede"><?php echo $Sede_cliente ?></span></div>
</div>

<div class="row">	
	<div class="col col-xs-2 th" style="width: 100px">Muestreador:</div>
	<div class="col col-xs-6 td"><span id="sede"><?php echo $Recolectado ?></span></div>
	<div class="col col-xs-2 th" style="width: 100px">Fecha de ingreso:</div>
	<div class="col td"><span id="encargado"><?php echo $Fecha_ingreso ?></span></div>		
</div>
<div class="row">	
	<div class="col col-xs-2 th" style="width: 100px">Descripción:</div>
	<div class="col col-xs-6 td"><span id="sede"><?php echo $Descripcion!='' ? $Descripcion : '-' ?></span></div>
	<div class="col col-xs-2 th" style="width: 100px">Remisiones:</div>
	<div class="col td"><span id="encargado"><?php echo $Remisiones!='' ? $Remisiones :'- ' ?></span></div>		
</div>
</div>
<div class="box">
<div class="row">
	<div class="col col-xs-2 th" style="width: 150px">Observaciones del muestreo:</span></div>
	<div class="col col-xs-5 td"> <?php echo $Anotaciones ?> </div>
	<div class="col col-xs-2 th" style="width: 100px">Hora de muestreo:</div>
	<div class="col col-xs-2 td"> <?php echo substr($hora_rec,0,5);?> </div>
</div>
</div>