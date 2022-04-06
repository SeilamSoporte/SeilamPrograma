	function guardar()
	{
		datos				= {};					//Definicion del contenedor que enviará los datos del formulario como parametros
		datos.id			= 1;//<?php echo $id ?>;
		//alert(datos.id);
		datos.action		= "saveEmpresa"; 
	
		datos.empresa		= $("#Empresa")		.val();	
		datos.nit			= $("#Nit")			.val();
		datos.telefono		= $("#Telefono")	.val();
		datos.regimen		= $("#Regimen")		.val();
		datos.email			= $("#Email")		.val();
		datos.direccion		= $("#Direccion")	.val();
		datos.web			= $("#Web")			.val();
		datos.logo			="";

		var logo			= $("#File_logo")	.val();
		if( logo!="" ){	
			datos.logo		= $("#File_logo")[0].files[0].name;
		}
				 
		$.post("./resources/QueryS_Empresa.php", datos, function(data)
		{
			//alert(data);
			var Data=data.split(",");
			if (logo !=""){ save_img();	}
			$('#mensaje_modal').html(Data[0])			
		});
	}
	

	 function save_img()
	 {
		var formData = new FormData($("#FormEmpresa")[0]);
            var ruta = "./resources/SaveImg.php";
            $.ajax({
					url: ruta,
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,
					success: function(datos)
					{
						if (datos!="Ok")
						{alert(datos);}
					}
				});
	 }
	 
	function cargaImg() {
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("File_logo").files[0]);
		oFReader.onload = function (oFREvent) {
			document.getElementById("Logo_image").src = oFREvent.target.result;
		};
	}
	
