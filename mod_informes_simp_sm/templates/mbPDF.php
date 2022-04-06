<?php 
	$D_Empresa 			= new Empresa();
	$D_Empresa			->D_Empresa(1);
	$Logo				= $D_Empresa 			->Logo;
	$Nombre_empresa   	=$D_Empresa 			->Empresa;
	$Direccion_empresa	=$D_Empresa 			->Direccion;
	$Telefono_empresa 	=$D_Empresa 			->Telefono;
	$Correo_empresa   	=$D_Empresa 			->Email;	
	$id 		  		= $_GET['id'];
	$cn 				= $_GET['mb'];
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
	$conIncertidumbreMB = $Muestras 			->CI;

	$Codigo 			= $Muestras 			->Codigo_M;
	$Codigo 	       .= "-".$Muestras 		->Consecutivo; 	
	$Descripcion		= $Muestras 			->Descripcion;
	$EmpaqueId			= $Muestras 			->Empaque;
	$Hora_recoleccion 	= $Muestras 			->Hora_rec;
	
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

	$Parametrizacion 	= $Muestras 			->getParametrizacion($ParametroId)[0];//getParametrizacion($ParametroId)[0];
	$Categoria 			= $Muestras 			->getCategoria($Parametrizacion['Categoria']); //ListaCategoria($Parametrizacion['Categoria']);
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

	$Results			= $Muestras 			->getResultados($id,$mb);
	$Results 	 		= $Muestras 			->Resultados;
	$Resultados 		= explode("|",$Results);
	$Fecha_result 		= $Muestras 			->Fecha_result;//$Results['Fecha'];
	$ResComparador 		= $Muestras 			->ResComparador;
	
	$IncertsMB 			= $Muestras 			->Incertidumbres;
	$IncertidumbresMB	= explode("|",$IncertsMB);

	$ResComparador 		= explode("|",$ResComparador);
	$EstadoM 			= $Muestras 			->Estado;
	$Fecha_prod 		= $Muestras 			->Fecha_prod;
	$Fecha_produccion 	= ($Fecha_prod==0)? 'NA' : $Fecha_prod ;
	$Fecha_venc		    = $Muestras 			->Fecha_venc;
	$Fecha_vencimiento	= ($Fecha_venc==0) ? 'NA' : $Fecha_venc;

	$Lote				= $Muestras 			->Lote;
	$Medio				= $Muestras 			->Medio;

 	$Clase_obs = 'N';
    $Clase_obs = (buscarPal('agua,aguas,alimento,alimentos', $Titulo)==true) ? 'A' : $Clase_obs;
    $Clase_obs = (buscarPal('superficie,frotis', $Titulo)==true) ? 'F' : $Clase_obs;
    $Clase_obs = (buscarPal('placas,placa,ambientes', $Titulo)==true) ? 'P' : $Clase_obs;
    $Clase_obs = (buscarPal('higiene,control', $Titulo)==true) ? 'P' : $Clase_obs;

    $Detalles  		= $Muestras ->loadDetalles($id,$nd) ;

	$Observaciones 	= isset($Detalles[0]) ? $Detalles[0]['Observaciones']: ''; 
	$Anotaciones   	= isset($Detalles[0]) ? $Detalles[0]['Anotaciones']: 'No reporta'; 
	$Detalles  		= isset($Detalles[0]) ? explode("|",$Detalles[0]['Detalles']) :'';

	function formato($valor){
		$str   = strval($valor); 		// Se convierte a string
		$split = explode('.', $str);
		$dec   = count($split);  	    //Indagammos si posee decimales
		$comp  = substr($str, 0,1);
		return (str_replace('.', ',', $str));
	}
	
	$TextTitulo   = strtolower($Titulo); 
    $view->contentTemplate= '../templates/cont_mb.php'; // seteo el template que se va a mostrar
	$src_logo = "../../mod_empresa/imgs/".$Logo;	
?>


	<div class="box">
		<div class="row resultados">
			<div class="col col-xs-12 centrado hd">EXAMENES MICROBIOLÓGICOS Y MOHOS</div>
		</div>
		<div class="row head-i">
			<div class="col col-xs-4 th-i">Parámetro</div>
			<div class="col col-xs-3 th-i" style="width: 120px">Método </div>
			<div class="col col-xs-1 th-i" style="padding-right: 10px; width: 10.5%">Norma de Referencia </div>
			<div class="col col-xs-1 th-i" style="padding-right: 10px">Valor de Referencia </div>
			<div class="col col-xs-1 th-i" >Resultado</div>
			<?php if($conIncertidumbreMB==true){ ?>
				<div class="col col-xs-1 th-i" style="width: 100px">Incertidumbre </div>
			<?php } ?> 
			<!-- <div class="col col-xs-1 th-i">Detalle </div> -->
		</div>
		<div >
		<?php 
			$StatusCumple= 'true';
			$Cumple 	 = 'true';
			$items = count($NParametros);
	/*		foreach ($D_campo as $k => $val) {
				$Resultado[$k]	 = isset($val) ? $val : 'NR';
			}
*/
			$l=0;
			$i=0;
			$j=0;
			foreach ($NParametros as $Parametro => $value) {
				$Parametro 	 = $Muestras ->getParametros($value);
			$i++;
			if ($Comparador[$i-1]==10){
					$Limites = $Limite[$l+1].'|'.$Limite[$l+2];
				}
				else{
					$Limites=$Limite[$l];	
				}
				$l=$i*3;
				$ValorReferencia = SetReferencia($Comparador[$i-1], $Limites);
				$TipoP 			 = isset($Tipo[$i-1]) ? $Tipo[$i-1] : '';
				if ($TipoP!=5){
					$Resultado 	 = isset($Resultados[$j]) ? $Resultados[$j] : 'NR';	
					if ($Resultado==''){
						$Resultado = 'NR';
					} 	 

					$IncertidumbreMB = isset($IncertidumbresMB[$j]) ? $IncertidumbresMB[$j] : 'NR';
					$IncertidumbreMB = trim($IncertidumbreMB, ' ');
					$IncertidumbreMB = ($IncertidumbreMB!="") ? $IncertidumbreMB : 'NR';

					$j = str_pad($j,2,"0",STR_PAD_LEFT ); 
					$j++;
					
					if(isset($ResComparador[$j-1])){
						$ResComp = SetResComparador($ResComparador[$j-1]);
					}
					else{
						$ResComp = '';
					}
					if ($ResComp   =='='){ $ResComp='';}
					if ($Resultado == 'NR'){$ResultadoComp='NR';}
					else { $ResultadoComp = $ResComp.$Resultado; }
					
				?>
			<div class="row" style="line-height: 0.8em">
				<div class="col col-xs-4 td-i" style="width:30%"> 	 <?php echo $Parametro ?></div>
				
				<div class="col col-xs-3 td-i"  style="width:120px">		 <?php echo $Metodo[$i-1] ?></div>

				<div class="col col-xs-1 td-i" style=" width:12%"> <?php echo $Norma[$i-1] ?> </div>
				<div class="col col-xs-1 td-i" style="text-align: center; width:11.5%">	 <?php echo formato($ValorReferencia) ?></div>
				<div class="col col-xs-1 td-i" style="text-align: center">	<?php echo formato($ResultadoComp) ?> </div>
				<?php if($conIncertidumbreMB==true){ ?>
					<div class="col col-xs-1 td-i" style="width: 100px; text-align: center;"> <?php echo formato($IncertidumbreMB) ?></div>
				<?php } ?> 
<!-- 			
<div class="col col-xs-1 td-i">
					<?php echo $Detalles[$Ndet] == 1 ? "Cumple" : "No cumple" ?>
			    </div> 
-->
			</div>
			<?php  
			$Ndet++;	
			}//Tipo		
		}
		include_once 'templates/spPDF.php';
		?>

		</div>
	</div>
