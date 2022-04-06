
 
$(document).ready(function(){ //cuando el html fue cargado iniciar

    //añado la posibilidad de editar al presionar sobre edit
    $('.editUsuario').click(function(){
        var id=$(this).attr('data-id');
		params={};
        params.id=id;
        params.action="editClient";
        $('#FormUsuario').load('templates/usuarioGrid.php', params,function(){
			
        })
    })


    $('#btn_fltn').click(function(){
        var id=0;//$(this).attr('data-id');
		params={};
        params.id=id;
        //params.action="editClient";
        $('#FormUsuario').load('templates/usuarioGrid.php', params,function(){
			//document.getElementById("Nombre").value=id;
            //$('#FormUsuario').show();
        })
    })
})	

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