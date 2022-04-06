$(document).ready(function(){
	$(function () {
		$('[data-toggle="modal"]').tooltip()
	});

$('.editarCateg').click(function(){
	id 		 			= $(this).attr('data-id');
	categoria 			= $(this).attr('data-name');
	posicionTop			= $(this).position().top-50;
	$('.edit')			.css('top',posicionTop);	
	$('.edit')			.show();
	$('#input-cat') 	.val(categoria);
	$('#id-cat')		.val(id);
});

$('.editarClass').click(function(){
	id 		 			= $(this).attr('data-id');
	clase 	 			= $(this).attr('data-name');
	posicionTop			= $(this).position().top-50;
	$('.edit')			.css('top',posicionTop);	
	$('.edit')		  	.show();
	$('#input-class') 	.val(clase);
	$('#id-class')	  	.val(id);
});
$('.editarFrase').click(function(){
	id 		 			= $(this).attr('data-id');
	frase 	 			= $(this).attr('data-name');
	posicionTop			= $(this).position().top-50;
	$('.edit')			.css('top',posicionTop);	
	$('.edit')		  	.show();
	$('#input-frase') 	.val(frase);
	$('#id-frase')	  	.val(id);
});

$('.editarParam').click(function(){
	id 		 			= $(this).attr('data-id');
	parametro 			= $(this).attr('data-name');
	posicionTop			= $(this).position().top-50;
	$('.edit')			.css('top',posicionTop);
	$('.edit')		  	.show();
	$('#input-param') 	.val(parametro);
	$('#id-param')	  	.val(id);
});

$('.editarEquipo').click(function(){
	id 		   			= $(this).attr('data-id');
	parametro  			= $(this).attr('data-name');
	posicionTop			= $(this).position().top-50;
	$('.edit')			.css('top',posicionTop);
	$('.edit')		  	.show();
	$('#input-equipo')	.val(parametro);
	$('#id-equipo')	  	.val(id);
});

$('#save-cat').click(function(){
	datos  				= {};
	datos.valor 		= $('#input-cat').val();
	datos.id 			= $('#id-cat').val();
	datos.action 		= 'save';
	datos.tabla 		= 'categorias';
	$.post('resources/QueryS_Admin.php', datos, function(data){ 
		$("#panel-contenido").load("templates/categorias.php", params,function(){ });
	});
});

$('#save-class').click(function(){
	datos  				= {};
	datos.valor 		= $('#input-class').val();
	datos.id 			= $('#id-class').val();
	datos.action 		= 'save';
	datos.tabla 		= 'lista_clases';
	$.post('resources/QueryS_Admin.php', datos, function(data){ 
		$("#panel-contenido").load("templates/clases.php", params,function(){ });
	});
});
$('#save-frase').click(function(){
	datos  				= {};
	datos.valor 		= $('#input-frase').val();
	datos.id 			= $('#id-frase').val();
	datos.action 		= 'save';
	datos.tabla 		= 'observaciones';
	$.post('resources/QueryS_Admin.php', datos, function(data){ 
		$("#panel-contenido").load("templates/frases.php", params,function(){ });
	});
});
$('#save-param').click(function(){
	datos  				= {};
	datos.valor 		= $('#input-param').val();
	datos.id 			= $('#id-param').val();
	datos.action 		= 'save';
	datos.tabla 		= 'lista_parametros';
	$.post('resources/QueryS_Admin.php', datos, function(data){ 
		$("#panel-contenido").load("templates/parametros.php", params,function(){ });
	});
});

$('#save-equipo').click(function(){
	datos  				= {};
	datos.valor 		= $('#input-equipo').val();
	datos.id 			= $('#id-equipo').val();
	datos.action 		= 'save';
	datos.tabla 		= 'equipos';
	$.post('resources/QueryS_Admin.php', datos, function(data){ 
		$("#panel-contenido").load("templates/equipos.php", params,function(){ });
	});
});
$('#save-firmas').click(function(){
	datos  				= {};
	dialog 				= {};
	dialog.action 		= '1';
	datos.RMB 			= $('#RMB').val();
	datos.RFQ 			= $('#RFQ').val();
	datos.AMB 			= $('#AMB').val();
	datos.AFQ 			= $('#AFQ').val();
	dialog.mensaje  	= 'Las firmas se han guardado correctamente';
	dialog.action 		= '1';
	datos.action 		= 'save_firmas';
	$.post('resources/QueryS_Admin.php', datos, function(data){ 
		$('#informacion').load('templates/dialogs.php', dialog,function(){ });
		$("#panel-contenido").load("templates/firmas.php", params,function(){ });		
	});
});

$('#add-cat').click(function(){
	
	datos 			= {};
	dialog 			= {};
	datos.valor 	= $('#text-categoria').val();
	datos.action 	= 'insertar';
	datos.tabla 	= 'categorias';
	dialog.mensaje  = 'Si va a agregar una nueva categoría debe escribir algún valor, este campo no puede estar vacío';
	dialog.action 	= 'null';
	if(datos.valor  == "") { 
		$('#informacion').load('templates/dialogs.php', dialog,function(){ })
	}
	else{
		$.post('resources/QueryS_Admin.php', datos, function(data){ 
			$("#panel-contenido").load("templates/categorias.php", params,function(){ });
		});
	}
});


$('#add-class').click(function(){
	datos 			= {};
	dialog 			= {};
	datos.valor 	= $('#text-clase').val();
	datos.action 	= 'insertar';
	datos.tabla 	= 'lista_clases';
	dialog.mensaje  = 'Si va a agregar una nueva clase debe escribir algún valor, este campo no puede estar vacío';
	dialog.action 	= 'null';
	if(datos.valor  == "") { 
		$('#informacion').load('templates/dialogs.php', dialog,function(){ })
	}
	else{
		$.post('resources/QueryS_Admin.php', datos, function(data){ 
			dialog 			= {};
			dialog.mensaje  = 'Se ha agregado una nueva clase a la base de datos';
			dialog.action 	= '1';
			$('#informacion').load('templates/dialogs.php', dialog,function(){ 
				$("#panel-contenido").load("templates/clases.php", params,function(){ });
			})
			
		});
	}
});


$('#add-param').click(function(){
	datos 			= {};
	dialog 			= {};
	datos.valor 	= $('#text-param').val();
	datos.action 	= 'insertar';
	datos.tabla 	= 'lista_parametros';
	dialog.mensaje  = 'Si va a agregar un parametro debe escribir algún valor, este campo no puede estar vacío';
	dialog.action 	= 'null';
	if(datos.valor  == "") { 
		$('#informacion').load('templates/dialogs.php', dialog,function(){ })
	}
	else{
		$.post('resources/QueryS_Admin.php', datos, function(data){ 
			dialog 			= {};
			dialog.mensaje  = 'Se ha agregado un nuevo parametro a la base de datos';
			dialog.action 	= '1';
			$('#informacion').load('templates/dialogs.php', dialog,function(){ 
				$("#panel-contenido").load("templates/parametros.php", params,function(){ });
			})
			
		});
	}
});

$('#add-equipo').click(function(){
	datos 			= {};
	dialog 			= {};
	datos.valor 	= $('#text-equipo').val();
	datos.action 	= 'insertar';
	datos.tabla 	= 'equipos';
	dialog.mensaje  = 'Si va a agregar un equipo debe escribir algún valor, este campo no puede estar vacío';
	dialog.action 	= 'null';
	if(datos.valor  == "") { 
		$('#informacion').load('templates/dialogs.php', dialog,function(){ })
	}
	else{
		$.post('resources/QueryS_Admin.php', datos, function(data){ 
			dialog 			= {};
			dialog.mensaje  = 'Se ha agregado un nuevo equipo a la base de datos';
			dialog.action 	= '1';
			$('#informacion').load('templates/dialogs.php', dialog,function(){ 
				$("#panel-contenido").load("templates/equipos.php", params,function(){ });
			})
			
		});
	}
});

$('.delete').click(function(){
	dialog 			= {};
	dialog.dato 	= $(this).attr("data-name");
	dialog.id  		= $(this).attr("data-id");
	var tipo 		= $(this).attr("id");
	var msg_tipo 	= '';
	if (dialog.dato==""){
		dialog.dato='X';
	}
	
	switch	(tipo)
	{
		case 'eliminarparametro':
			msg_tipo 	= 'el parametro';
			dialog.tipo = 'parametro';
		break;
		case 'eliminarclase':
			msg_tipo 	= 'la clase';
			dialog.tipo = 'clase';
		break;
		case 'eliminarcategoria':
			msg_tipo 	= 'la categoría';
			dialog.tipo = 'categoria';
		break;
	}
	
	dialog.action   = 'eliminar';
	dialog.mensaje 	='Está seguro que desea eliminar '+ msg_tipo;
		$('#informacion').load('templates/dialogs.php', dialog,function(){ });
});

}) // FIN DEL READY 