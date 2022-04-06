
<?php

function Load_limite($comparador,$limite){
  switch($comparador)
  {
    case '1':
      return "<".$limite;
    break;
    case '2':
      return ">".$limite;
    break;  
    case '3':
      return "<=".$limite;
    break;
    case '4':
      return ">=".$limite;
    break;
    case '5':
      return "=".$limite;
    break;
    case '6':
      return $limite."/100mL";
    case '7':
      return $limite."/200mL";
    break;
  }
}

	include_once ("../../mod_parametros/Clases/clasesParametros.php");
	
  $view             = new stdClass(); 
  $D_Parametros     = new Parametros();
  $view->parametros =Parametros::getParametros(); 
  $params           =Parametros::Lista_Parametros();

?>
  
<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel" style="padding-left: 18px;">Lista de parámetros</h4>
        <form class="navbar-form navbar-left" role="search">
          <div class="form-group form-control" style="margin-top:6px; ">
          <input type="text" id="filter" class="busqueda" placeholder="Buscar" style="width:20em;">
          <span class="glyphicon glyphicon-search"></span>
          </div>
        </form>
      </div>
   
      
      <div class="modal-body">

        <table class="table table-hover footable" data-filter="#filter" >
          <thead class="primary">
            <tr>
              <th> Código </th>
              <th> Área </th>
              <th> Categoría </th>
              <th> Clase </th>
              <th> Parámetros </th>
              <th> Límites</th>
              <th> Método</th>
              <th> Referencia</th>
            </tr>
          </thead>
          <tbody>
          
            <?php foreach ($view->parametros as $parametro): 
              $cod_param    = split("\|", $parametro['Parametros']);
              $limites      = split("\|", $parametro['Limite']);
              $comparadores = split("\|", $parametro['Comparador']);
              $metodos      = split("\|", $parametro['Metodo']);
              $referencia   = split("\|", $parametro['Referencia']);
              $i =0;
            ?>
            <tr>
              <td> <?php echo $parametro['Codigo']; ?> </td>
              <td> <?php echo $parametro['Area']; ?> </td>
              <td> <?php echo $parametro['Categoria']; ?> </td>
              <td> <?php echo $parametro['Clase']; ?> </td>
               
              <td> 
                <?php foreach ($cod_param as $cod): ?>
                    <div class="row"> 
                      <?php echo $params[$cod]['Nombre']; ?> 
                      <?php// echo Load_parametro($cod); ?>
                    </div> 
                    <?php endforeach; ?>
              </td>
              <td> 
                <?php foreach ($limites as $limit): ?>
                    <div class="row">  
                      <?php echo Load_limite($comparadores[$i], $limites[$i]); 
                      $i++;?>
                    </div> 
                    <?php endforeach; ?>
              </td>
              
              <td> 
                <?php foreach ($metodos as $metod): ?>
                    <div class="row">  
                      <?php echo $metod; 
                      $i++;?>
                    </div> 
                    <?php endforeach; ?>
              </td>
                            <td> 
                <?php foreach ($referencia as $ref): ?>
                    <div class="row">  
                      <?php echo $ref; 
                      $i++;?>
                    </div> 
                    <?php endforeach; ?>
              </td>

            </tr>
            <?php endforeach; ?>
          </tbody> 
        </table>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->   
  <script>
    $(function() {
      $('table').footable();
    });
  </script> 
}
