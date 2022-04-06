
$(document).ready(function(){ //cuando el html fue cargado iniciar
    //añado la posibilidad de editar al presionar sobre edit
    $("#cargando").css("display", ""); 
    CargarTabla();
    $(".table").css("display", "");

    $(".busqueda").on("change",function(){
    	buscar();
    });

    $('.editCliente').on("click",function()
	{
		var id=$(this).attr('data-id');
		params={};
        params.id=id;
        $('#FormCliente').load('templates/clienteForm.php', params,function(){
		
        })
	});

	$('.delete').on("click",function(event)
    {
        event.preventDefault();
		var id=$(this).attr('data-id');
		params={};
        params.id=id;
        params.action="eliminarCliente";
		params.mensaje="Está seguro de eliminar el cliente: ";
        $('#confirma').load('./templates/dialogs.php', params,function(){
	    })
    })

	$(document).on("click","#btn-agregar",function(){
		$.post("./templates/contactoInput.html" ,function(htmlexterno){
			$("#Campos_contacto").append(htmlexterno);
		});
	});
	
	$(document).on('click', "#btn-agregar-sede",function(){
		$.post("templates/sedesInput.html" ,function(htmlexterno){
			$("#Campos_sedes").append(htmlexterno);
		});			
	});
	
// Evento que selecciona la fila y la elimina 
	$(document).on("click",".eliminar",function(){
		var parent = $(this).parents().get(0);
			$(parent).remove();
	});
	
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	});

		
	$(document).on("click","#Guardar_cliente", function(event){
		event.preventDefault();
		
		var id				= $(this).attr('data-id');	
		datos				= {};					//Definicion del contenedor que enviará los datos del formulario como parametros
		datos.id			= id;//<?php echo $id ?>;
		datos.action		= "saveCliente"; 
		datos.empresa		= $("#Empresa")	.val();
		datos.nit			= $("#Nit")		.val();
		datos.telefono		= $("#Telefono").val();
		datos.email			= $("#Email")	.val();
		datos.web			= $("#Web")		.val();
		datos.direccion		= $("#Direccion").val();
		datos.ciudad		= $("#Ciudad")	.val();
		datos.regimen		= $("#Regimen")	.val();
		
		contactos 			= {};
		var total_c			=0;
		$(".contacto")		.each(function(i){ total_c++ ; });
		
		contactos.nombre	= Array();
		contactos.celular	= Array();
		contactos.email		= Array();
		contactos.cargo		= Array();
		contactos.action	= "saveContactos"; 
		
		$(".Nombre_c")		.each(function(i){ contactos.nombre[i]	=$(this).val(); });
		$(".Celular_c")		.each(function(i){ contactos.celular[i]	=$(this).val(); });
		$(".Email_c")		.each(function(i){ contactos.email[i]	=$(this).val(); });
		$(".Cargo_c")		.each(function(i){ contactos.cargo[i]	=$(this).val(); });
		
		/*contactos.nombre;
		contactos.celular;
		contactos.email;
		contactos.cargo;
		*/
		contactos.id= id;
		contactos.idc=0;
		
		sedes				= {};
		sedes.sede			= Array();
		sedes.ciudad		= Array();
		sedes.telefono		= Array();
		sedes.direccion		= Array();
		sedes.action		= "saveSedes"; 
		
		$(".SedeS")			.each(function(i){ sedes.sede[i]		=$(this).val(); });
		$(".CiudadS")		.each(function(i){ sedes.ciudad[i]		=$(this).val(); });
		$(".TelefonoS")		.each(function(i){ sedes.telefono[i]	=$(this).val(); });
		$(".DireccionS")	.each(function(i){ sedes.direccion[i]	=$(this).val(); });
		
		/*sedes.sede;
		sedes.ciudad;
		sedes.telefono;
		sedes.direccion;
		*/

		sedes.id= id;
		sedes.idc=0;
		//alert(sedes.id);
		$.post("./resources/QueryS_Clientes.php", datos, function(data)
		{
			var Data=data.split(",");
			if (contactos.id ==0){
				contactos.idc 	= Data[2];
				sedes.idc		= Data[2];
				//sedes.id		= Data[2];
				}
			$("#cancelar").html("Cerrar");
			$.post("./resources/QueryS_Clientes.php", contactos, function(data)
			{
			var dataCont=data;
				//alert(sedes.idc);
				$.post("./resources/QueryS_Clientes.php", sedes, function(data)
				{
					var documento = $(document.body);
					if (data == 0 && dataCont==0 && Data[1]== 0){
						
						BootstrapDialog.show({
							title: 'Atención', 
							message: "<span class='glyphicon glyphicon-exclamation-sign' style='font-size:15px'></span> No se ha realizado ningun cambio.",						
							buttons:[{ label: 'Ok',
										action: function(dialogRef){dialogRef.close();}	
									}]
							});
						documento.attr("class","modal-opened");
						}
					else{
						
						BootstrapDialog.show({
							title: 'Atención', 
							message:"<span class='glyphicon glyphicon-ok'> </span> Los cambios se guardaron exitosamente.", 
							type:"type-success",
							buttons:[{ label: 'Ok',
										action: function(dialogRef){dialogRef.close(); $("#FormCliente").modal('toggle'); 
										//$("#tabla-clientes").load("./templates/tablaClientes.php");								
										location.reload();
										}	
									}]
							});
							//
						} 				
					
				});	//Sedes
			}); //Contactos
		});	//Cliente
	})//Guardar_cliente


$('[data-toggle="modal"]').tooltip()
	
})// Fin de ready	

function eliminar(id)
{
		params={};
        params.id=id;
        params.action="deleteCliente";
		
		$.post('./resources/QueryS_Clientes.php', params,function(data){
			//alert(data);
			//$("#tabla-clientes").load("./templates/tablaClientes.php")
			location.reload();			
        })
}

function CargarTabla(){

    $.post("./clases/buscar.php", {valorBusqueda: 'Todo'}, function(mensaje) {
            $("#cargando").css("display", "none");
            $("#tabla-clientes").html(mensaje);
        }); 

}

function buscar() {
    var textoBusqueda = $("input#filter").val();

        if (textoBusqueda != "") {
        $.post("./clases/buscar.php", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#tabla-clientes").html(mensaje);
        }); 
    } else { 
    	CargarTabla();
	};

};


/////////////////////////////////////////////////////////
function Editar(id){
	//var id=$(this).attr('data-id');
	event.preventDefault();
	params={};
    params.id=id;
    $('#FormCliente').load('templates/clienteForm.php', params,function(){
	
    })
}

function Eliminar(id){
	event.preventDefault();
	//var id=$(this).attr('data-id');
	params={};
    params.id=id;
    params.action="eliminarCliente";
	params.mensaje="Está seguro de eliminar el cliente: ";
    $('#confirma').load('./templates/dialogs.php', params,function(){
	})
}

