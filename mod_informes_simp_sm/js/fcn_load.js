	$('.verMuestras').click(function(){
		//window.location = 'verMuestras.php';
		var token = Math.round(Math.random()*(1000000000 - 100000023) + 100000023);  
		var id      = $(this).attr('data-id')*token;
		var form  = '<form action="templates/verMuestrasParaInformes.php" id="form" name="form" method="post" style="display:none;">';
		var inputs= '<input type="text" name="id" value="'+id+'" />';
		inputs	  = inputs +  '<input type="text" name="token" value="'+token+'" />'
        $("#form_insert").html( form+inputs+'</form>');
        $("#form").submit();

	});

	$(function () {
		$('[data-toggle="modal"]').tooltip()
	});

	