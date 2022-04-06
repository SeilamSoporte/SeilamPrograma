$(document).ready(function(){ //cuando el html fue cargado iniciar
    $("#cargando").css("display", "none"); 

    $('.load_informe').click(function(){ 
    	var cons = $(this).attr('data-cons');
    	var id   = $(this).attr('data-id');
	
		caractereres = "0123456789abcdfghijklmnopqrstuvwxyzABFDFHIJKLMNOPQRSTUVWXYZ";
		longitud 	 = 5;
		nums		 = '1234567890';
		var token1 	 = aleatorio(nums, 4 );
		var token2 	 = aleatorio(nums, 6 );
		var token3 	 = aleatorio(nums, 6 );
		var multiplo = aleatorio(nums, 4 );
		
		a	 		 = multiplo;
		b 			 = id;  // id
		c 			 = a*b;
		e 			 = cons; // consecutivo
		var d 		 = "000000" + c;
		var f 		 = "00" + e;
		f 			 =  f.substring(f.length - 2, f.length); 
    	var l = c;
    	d 			 = d.substring(d.length - 6, d.length); 
    	//popupwnd('informe.php?id='+token1+d+token2+f+token3+a);
		
		//$('#view_informe').load('informe.php?id='+token1+d+token2+f+token3+a);
		$('#view_informe').load('informe.php?id='+b+'&cn='+cons);
		$('.generar').removeClass('hidden');
    	//VerInforme();
    })
		$("#volver").click(function(){
		        $("#form_insert").html('<form action="../index.php" id="form" name="form" method="post" style="display:none;"> <input type="text" name="valida" value="true" /></form>' );
		        $("#form").submit();
		});
		
		$('.generar').click(function(){
		   	var cons = $('#datos').attr('data-cn');
			var id   = $('#datos').attr('data-id');
			caractereres = "0123456789abcdfghijklmnopqrstuvwxyzABFDFHIJKLMNOPQRSTUVWXYZ";
			longitud 	 = 5;
			nums		 = '1234567890';
			var token1 	 = aleatorio(nums, 4 );
			var token2 	 = aleatorio(nums, 6 );
			var token3 	 = aleatorio(nums, 6 );
			var multiplo = aleatorio(nums, 4 );
			
			a	 		 = multiplo;
			b 			 = id;  // id
			c 			 = a*b;
			e 			 = cons; // consecutivo
			var d 		 = "000000" + c;
			var f 		 = "00" + e;
			f 			 =  f.substring(f.length - 2, f.length); 
			var l = c;
			d 			 = d.substring(d.length - 6, d.length); 
		
    		buscarPal('agua,aguas', '.FQ-Aguas'); /*AFQ*/
    		buscarPal('tratada,tratadas', '.MB-Aguas'); /*AMB*/
    		buscarPal('alimento,alimentos', '.MB-Alimentos'); /*ALMB*/
    		buscarPal('superficie,frotis', '.Frotis'); /*FR*/
    		buscarPal('placas,ambientes', '.Placas'); /*PL*/
    		//buscarPal('placas,ambientes', '.Placas');
    	
			//alert('Se generará un informe pdf');
			url = '../informePDF.php?id='+id+'&cn='+cons;
			window.open(url, '_blank');
			return false;
		});	
		
		
	 function buscarPal(texto, campo){
	    var textoSelArr  = $('#titulo').html().toLowerCase().split(" ");
        var palabras     = texto.split(",");
        $.each(textoSelArr, function(i){
            $.each(palabras, function(j){    
                if(textoSelArr[i] == palabras[j]){   
                	
					//$(campo).css('display', '')	;					
                  }
				  
                })  
            })  
    	}
	
		
}); // FIN DEL READY
function aleatorio(chars, long){
	var cod = "";
	for (x=0; x<long; x++){
		rand = Math.floor(Math.random()*chars.length);
		cod += chars.substr(rand, 1);
	}
	return cod;
}

function popupwnd(a)
{
	var b='no'; var c='no'; var d='no'; var e='no'; var l='no'; var g='no'; 
	var f=880;
	var m=screen.height-100;		
	var h=screen.width/2-f/2;
	var k=30;
	this.open(a,"","toolbar=yes,menubar=no,location=no,scrollbars=yes,resizable=no,status=no,left="+h+",top="+k+",width="+f+",height="+m);
}

function VerInforme(){
	var url= 'informe.php';
	var dialog=$('<div style="display:none" class="loading" ></div>').appendTo('body');
	dialog.dialog({
		close:function(event, ui){
			dialog.remove();
		},
		modal:true,
		title:'Informe de resultados',
		width:918,
		height:450
	});
	dialog.load(
		url,
		{},
		function(responseText, textStatus, XMLHttpRequest){
			dialog.removeClass('loading');
		}
	);
  }
