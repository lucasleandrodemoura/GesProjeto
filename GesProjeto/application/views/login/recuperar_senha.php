<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
body {
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #eee;
}
</style>


<div class="container">
    <?php echo form_open("login/recuperar_confirmar"); ?>
    <div class="form-signin">
        
            <?php if($erro==1) { ?>
                <h4 class="form-signin-heading bg-danger">Pelo menos um dos campos deve ser preenchido</h4>
            <?php } ?>
            <?php if($erro==2) { ?>
                <h4 class="form-signin-heading bg-danger">Tentativa de acessos esgotadas. Por gentileza, solicite uma nova senha.</h4>
            <?php } ?>    
            <label for="inputEmail" class="sr-only">Login</label>
            <input type="text" id="inputEmail" name="login" class="form-control" placeholder="Login" autofocus>
            <label for="inputPassword" class="sr-only">ou E-mail</label>
            <input type="text" id="inputEmail" name="email" class="form-control" placeholder="E-mail">
            <button class="btn btn-lg btn-warning btn-block" type="submit">Recuperar</button>
            <a href="<?= base_url() ?>login" style="text-align: center">Cancelar</a>
    </div>
    </form>
</div>   