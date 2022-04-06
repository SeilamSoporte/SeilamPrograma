$(document).ready(function(){ 
//$('#botones').load('templates/botones.php','',function(){});
	var jQueryDatePickerOptions =
	{
	    dateFormat: 'yy-mm-dd',
	    changeMonth: false,
	    changeYear: true,
	    showButtonPanel: false,
	    showAnim: 'slide'
	};
	$("#fecha_desde").datepicker(jQueryDatePickerOptions);
	$("#fecha_hasta").datepicker(jQueryDatePickerOptions);
	$('#btn_load').click(function(){
		var fechas = {};

		fechas.desde = $("#fecha_desde").val();
		fechas.hasta = $("#fecha_hasta").val();
		
		$('#botones').fadeOut(300, function(){
			$.post("resources/consult.php",fechas,function(data){
				var datos = {};
				datos.desde = fechas.desde;
				datos.hasta = fechas.hasta;
				datas 		= data.split(',');
				datos.NMB 	= datas[0];
				datos.NFQ 	= datas[1];
				datos.NVol 	= datas[2];
				datos.NIones= datas[3];
				datos.NDC 	= datas[4];
				datos.NA 	= datas[5];
				datos.NCH 	= datas[6];
				$('#botones').load('templates/botones.php',datos ,function(){});
				$('#botones').fadeIn(300);	
			});
			
		});
	});

	$('#MB_btn').click(function(){
		url = 'ordendeservicioMB.php';
		window.open(url, '_blank');
		return false;
	});
});//Ready