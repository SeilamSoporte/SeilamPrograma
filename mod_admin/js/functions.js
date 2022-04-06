$(document).ready(function(){ //cuando el html fue cargado iniciar
	
	$(function () {
		$('[data-toggle="modal"]').tooltip()
	});

	$("#categorias").click(function(){
	id=0;	
	actions			= {};
	actions.action 	="loadData";
	actions.tabla 	= "categorias";
	params      	= {};
    params.id   	= id;
    params.call 	= true;
    	$.post('resources/QueryS_Admin.php', actions, function(data){ });

		$("#panel-contenido").load("templates/categorias.php", params,function(){

    	});
	
	});

	$("#clases").click(function(){
	id=0;	
	actions			= {};
	actions.action 	="loadData";
	actions.tabla 	= "lista_clases";
	params      	= {};
    params.id   	= id;
   
    	$.post('resources/QueryS_Admin.php', actions, function(data){ });
		$("#panel-contenido").load("templates/clases.php", params,function(){ 	});
	
	});

	$("#parametros").click(function(){
	id=0;	
	actions			= {};
	actions.action 	="loadData";
	actions.tabla 	= "lista_parametros";
	params      	= {};
    params.id   	= id;
   
    	$.post('resources/QueryS_Admin.php', actions, function(data){ });
		$("#panel-contenido").load("templates/parametros.php", params,function(){ 	});
	
	});

	$("#equipos").click(function(){
	id=0;	
	actions			= {};
	actions.action 	="loadData";
	actions.tabla 	= "lista_equipos";
	params      	= {};
    params.id   	= id;
   
    	$.post('resources/QueryS_Admin.php', actions, function(data){ });
		$("#panel-contenido").load("templates/equipos.php", params,function(){ 	});
	
	});

	$("#firmas").click(function(){
	id=0;	
	actions			= {};
	actions.action 	="loadData";
	actions.tabla 	= "lista_firmas";
	params      	= {};
    params.id   	= id;
   
    	$.post('resources/QueryS_Admin.php', actions, function(data){ });
		$("#panel-contenido").load("templates/firmas.php", params,function(){ 	});
	
	});
	
	$("#frases").click(function(){
	id=0;	
	actions			= {};
	actions.action 	="loadData";
	actions.tabla 	= "observaciones";
	params      	= {};
    params.id   	= id;
   
    	$.post('resources/QueryS_Admin.php', actions, function(data){ });
		$("#panel-contenido").load("templates/frases.php", params,function(){ 	});
	
	});
	$('.verMuestras').click(function(){
		//window.location = 'verMuestras.php';
		var token = Math.round(Math.random()*(1000000000 - 100000023) + 100000023);  
		var id    = $(this).attr('data-id')*token;
		var form  = '<form action="templates/verMuestrasParaInformes.php" id="form" name="form" method="post" style="display:none;">';
		var inputs= '<input type="text" name="id" value="'+id+'" />';
		inputs	  = inputs +  '<input type="text" name="token" value="'+token+'" />'
        $("#form_insert").html( form+inputs+'</form>');
        $("#form").submit();

	})

}) // FIN DEL READY 

