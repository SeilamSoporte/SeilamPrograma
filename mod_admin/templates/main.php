		<style>
			.btn-menu
			{
				margin: 10px;
			}
			.bt{
				vertical-align: top;
			}

		</style>
		<div class="panel panel-primary">
			<div class="panel-heading"><strong>Administración de datos</strong></div>
			<div id="menu">
				<button type="button" class="btn btn-md btn-primary btn-menu" id="categorias" >
				  <span class="fa fa-list-alt fa-2x" aria-hidden="true">&nbsp;</span><span class="bt" ">Categorías de muestras</span>
				</button>

				<button type="button" class="btn btn-md btn-primary btn-menu" id="clases" >
				  <span class="fa fa-list-alt fa-2x" aria-hidden="true">&nbsp;</span><span class="bt" ">Clases de muestras</span>
				</button>

				<button type="button" class="btn btn-md btn-primary btn-menu" id="parametros" >
				  <span class="fa fa-list-alt fa-2x" aria-hidden="true">&nbsp;</span><span class="bt" ">Parámetros de muestras</span>
				</button>
				
				<button type="button" class="btn btn-md btn-primary btn-menu" id="equipos" >
				  <span class="fa fa-list-alt fa-2x" aria-hidden="true">&nbsp;</span><span class="bt" ">Equipos</span>
				</button>

				<button type="button" class="btn btn-md btn-primary btn-menu" id="firmas" aria-label="Left Align" >
				  <span class="fa fa-edit fa-2x" aria-hidden="true">&nbsp;</span><span class="bt" ">Firmas de informes</span>
				</button>
				
				<button type="button" class="btn btn-md btn-primary btn-menu hide" id="frases" aria-label="Left Align" >
				  <span class="fa fa-edit fa-2x" aria-hidden="true">&nbsp;</span><span class="bt" ">Frases para informes</span>
				</button>

			</div>
		</div>
		
		<div id="form_insert"></div>
		
		<div class="panel panel-primary" id="panel-contenido"> </div>
	    