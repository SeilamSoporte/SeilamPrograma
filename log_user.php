  <?php
  $action_page = $_GET["action"];
  $id          = $_GET["id"];
  echo $id_r   = isset($_GET["id_r"]) ? $_GET["id_r"] : '';

  if ($id=='0')
  {
  ?>
  <div class="modal-dialog login-panel" role="document" data-id="<?php echo $action_page ?>">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <i class="fa fa-sheqel fa-2x logo_header">&nbsp;</i>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Login de usuario</h4>
      </div>
      <form action="clases/validate.php" method="post" name="loginform" target="_parent" id="loginform">      
      <div class="modal-body">
          <div class="form-group">
            <!-- <label for="recipient-name" class="control-label">Usuario:</label> -->
            <input type="text" placeholder="Usuario" class="form-control login" id="username" name="username">
          </div>
          <div class="form-group">
            <!-- <label for="message-text" class="control-label">Contraseña:</label> -->
            <input type="password" placeholder="Password" class="form-control login" id="password" name="password">
          </div>
          <div class="text-danger" id="Error">  </div>
             
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="login_btn">Entrar</button>
      </div></form><div id="form_insert"> </div> 
    </div>
  </div>
</div>
<script src="js/functions_loguser.js"></script>
<?php 
}
else {
?>
    <div class="modal-dialog login-panel" role="document" >
    <div class="modal-content">
      <div class="modal-header bg-red">
        <i class="fa fa-sheqel fa-2x logo_header">&nbsp;</i>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">¡Error de acceso!</h4>
      </div>
      
      <div class="modal-body">
          <span class="text-danger">El usuario </span> <span class="text-usuario"><i><u> <?php echo $id ?></u></i> <span class="text-danger"> no tiene permiso para ingresar a este módulo. </span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="login_btn">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<?php
}
?>