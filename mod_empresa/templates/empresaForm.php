<?php
	//include_once ("./Clases/clasesEmpresa.php");
	$action 	= isset($_POST['action']) ? $_POST['action']: '';
	$id			= 1;

	$D_Empresa 	= new Empresa();
	$D_Empresa	->D_Empresa($id);
    $Logo		= $D_Empresa->Logo;
	if ($Logo=="")
	{
		$src_logo= "./imgs/no_logo.jpg";
	}
	else
	{
		$src_logo = "./imgs/".$Logo;
	}
?>	
		
		<form id="FormEmpresa" method="post" enctype="multipart/form-data"> 
			<div class="panel panel-primary">
				<div class="panel-heading">Datos de la empresa y configuración</div>
				<div class="panel-body">
					<div class="row">
						<div class="col col-md-4">
							<div class="input-group">
								<span class="primary input-group-addon" id="basic-addon-emp"><span class="fa fa-building-o"> </span> </span>
								<input type="text" name ="Empresa" id="Empresa" class="form-control" value="<?php echo $D_Empresa->Empresa;?>" placeholder="Nombre de la empresa o razón social" aria-describedby="basic-addon-emp">
							</div>
						</div>
						<div class="col col-md-4">
							<div class="input-group">
								<span class="primary input-group-addon" id="basic-addon-nit"><span class="glyphicon glyphicon-barcode"> </span> </span>
								<input type="text" id="Nit" class="form-control" value="<?php echo $D_Empresa->Nit;?>" placeholder="Nit" aria-describedby="basic-addon-nit">
							</div>
						</div>
													
						<div class="col col-md-4">
							<div class="input-group">
								<span class="primary input-group-addon" id="basic-addon-tel"><span class="glyphicon glyphicon-phone-alt"> </span> </span>
								<input type="text" id="Telefono" class="form-control" value="<?php echo $D_Empresa->Telefono;?>" placeholder="Teléfono" aria-describedby="basic-addon-tel">
							</div>
						</div>
							
					</div>
					
					<div class="row">
						<div class="col col-md-4">
							<div class="input-group">
								<span class="primary input-group-addon" id="basic-addon-dir"><span class="glyphicon glyphicon-map-marker"> </span> </span>
								<input type="text" id="Direccion" class="form-control" value="<?php echo $D_Empresa->Direccion;?>" placeholder="Dirección" aria-describedby="basic-addon-dir">
							</div>
						</div>
						<div class="col col-md-4">
							<div class="input-group">
									<!-- <label for="Email">Nit</label> -->
									<span class="primary input-group-addon" id="basic-addon-email">@</span>
									<input type="email" id="Email" class="form-control" value="<?php echo $D_Empresa->Email;?>" placeholder="Email" aria-describedby="basic-addon-email">
							</div>
						</div>
						
						<div class="col col-md-4">
							<div class="input-group">
									<span class="primary input-group-addon" id="basic-addon-dir"><span class="fa fa-internet-explorer"> </span> </span>
									<input type="text" id="Web" class="form-control" value="<?php echo $D_Empresa->Web;?>" placeholder="Página web" aria-describedby="basic-addon-email">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col col-md-4">
							<div class="input-group">
								<span class="primary input-group-addon" id="basic-addon-reg"><span class="fa fa-university"> </span> </span>
								<span class="input-group-addon primary" style="border-left:0px solid transparent">Régimen</span>
								<!--<input type="text" id="Régimen" class="form-control" placeholder="Dirección" aria-describedby="basic-addon-reg">-->
								<select class="form-control" id="Regimen" name="Regimen">
									<?php echo "<option " . ($D_Empresa->Regimen == 0 ? "selected " : '') . "value='0'> </option>";?>
									<?php echo "<option " . ($D_Empresa->Regimen == 1 ? "selected " : '') . "value='1'>Común</option>";?>
									<?php echo "<option " . ($D_Empresa->Regimen == 2 ? "selected " : '') . "value='2'>Simplificado </option>";?>
								</select> 
							</div>
						</div>
						<div class="col col-md-4">
								<label class="cargar_btn btn-primary btn">Cargar logo 
								  <span><input type="file" id="File_logo" name="file" value="<?php echo $src_logo ?>" onchange="cargaImg()"/></span>
								</label>
							<!--<input class="btn btn-primary" type="button" value="Cargar logo"> -->
						</div>
						<div class="col col-md-4">
							<div id="wb_Logo_image">
								<img style="width:150px;" src="<?php echo $src_logo ?>" id="Logo_image" alt="">
							</div>
						</div>

					</div>
					
				</div>		
								
			</div>
		</form>
		
		
