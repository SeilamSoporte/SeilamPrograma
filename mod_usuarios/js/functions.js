
$(document).ready(function(){ //cuando el html fue cargado iniciar
    //añado la posibilidad de editar al presionar sobre edit
    $('.editUsuario').click(function(event){
		event.preventDefault();
        var id=$(this).attr('data-id');
		params={};
        params.id=id;
        params.action="editUsuarios";
        $('#FormUsuario').load('templates/usuarioForm.php', params,function(){
			
        })
		event.preventDefault();
    })

    $('.delete').click(function(){
        //event.preventDefault();
		var id=$(this).attr('data-id');
		//alert(id);
		params={};
        params.id=id;
        params.action="eliminarUsuario";
		params.mensaje="Está seguro de eliminar el ususario: ";
        $('#confirma').load('./templates/dialogs.php', params,function(){
			//alert("Ok");
        })
		event.preventDefault();
    })
    $('#btn_fltn').click(function(){
        var id=0;//$(this).attr('data-id');
		params={};
        params.id=id;
        //params.action="editClient";
        $('#FormUsuario').load('templates/usuarioForm.php', params,function(){
			//document.getElementById("Nombre").value=id;
            //$('#FormUsuario').show();
        })
    })	
})	

function eliminar(id)
{
		params={};
        params.id=id;
        params.action="deleteUsuario";
		
		//params.mensaje="Está seguro de eliminar el ususario: ";
        $.post('./resources/QueryS_Usuarios.php', params,function(data){
			$("#tabla-usuarios").load("./templates/tabla-usuarios.php")	
        })
 }
function cargaImg() {
	var oFReader = new FileReader();
	oFReader.readAsDataURL(document.getElementById("User_foto").files[0]);
	oFReader.onload = function (oFREvent) {
	document.getElementById("User_image").src = oFREvent.target.result;
	};
}

$(function () {
	$('[data-toggle="modal"]').tooltip()
});
