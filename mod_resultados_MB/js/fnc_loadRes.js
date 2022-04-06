		   $(".edit").click(function(){
	        var token = Math.round(Math.random()*(1000000000 - 100000023) + 100000023); 
	        var id    = $(this).attr('data-id')*token + token;
	        var desde  = $(this).attr('desde');
	        var hasta  = $(this).attr('hasta');   
	        var fecha_d= desde;
	        var fecha_h= hasta;
	        var form   = '<form action="templates/editarResultados.php" id="form" name="form" method="post" style="display:none">';
	        var inputs = '<input type="text" name="id" value="'+id+'" /> <input type="text" name="t-ram" value="'+token+'" /> <input type="text" name="fecha_d" value="'+fecha_d+'" /> <input type="text" name="fecha_h" value="'+fecha_h+'" /> ';

	        $("#SendForm").html(form+inputs+'</form>');
	        $("#form").submit();
		    });
		   
			$(function () {
				$('[data-toggle="modal"]').tooltip()
			});