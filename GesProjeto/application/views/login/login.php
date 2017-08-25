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
        
            <?php if($erro==1) { ?>
                <h4 class="form-signin-heading bg-danger">Login ou senha incorreto!</h4>
            <?php } ?>
            <?php if($erro==2) { ?>
                <h4 class="form-signin-heading bg-warning">Nova senha enviada para o seu e-mail se o mesmo existir!</h4>
            <?php } ?>
            <?php if($erro==3) { ?>
                <h4 class="form-signin-heading bg-warning">Usuário cadastrado com sucesso!</h4>
            <?php } ?>
            <label for="inputEmail" class="sr-only">Usuário</label>
            <input type="text" id="inputEmail" name="login" class="form-control" placeholder="Login" required autofocus>
            <label for="inputPassword" class="sr-only">Senha</label>
            <input type="password" id="inputPassword" name="senha" class="form-control" placeholder="Senha" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Logar</button>
            <br>
            <div class="row">
                <div class="col-6"><a href="<?= base_url() ?>login/recuperar_senha" style="text-align: center">Esqueci a senha</a></div>
                <div class="col-6"><a href="<?= base_url() ?>login/cadastro" style="text-align: center">Cadastre-se</a></div>
            </div>
            
            
    </div>
    </form>
</div>   