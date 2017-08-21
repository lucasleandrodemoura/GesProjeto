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
    <?php echo form_open("login/logar"); ?>
    <div class="form-signin">
        <img class="img img-responsive img-rounded" src="<?= base_url() ?>imagens/logomarca.jpg">
            <?php if($erro==1) { ?>
                <h4 class="form-signin-heading bg-danger">Login ou senha incorreto!</h4>
            <?php } ?>
            <label for="inputEmail" class="sr-only">Usuário</label>
            <input type="text" id="inputEmail" name="login" class="form-control" placeholder="Login" required autofocus>
            <label for="inputPassword" class="sr-only">Senha</label>
            <input type="password" id="inputPassword" name="senha" class="form-control" placeholder="Senha" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Logar</button>
            <label for="linkEsqueci" class="sr-only"><a href="<?= base_url() ?>login/recuperarsenha">Esqueci a senha</a></label>
    </div>
    </form>
</div>   