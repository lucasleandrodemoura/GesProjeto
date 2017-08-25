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
    <?php echo form_open("login/cadastrar"); ?>
    <div class="form-signin">
        
            <?php if($erro==1) { ?>
                <h4 class="form-signin-heading bg-danger">Usuário já cadastrado!</h4>
            <?php } ?>
            <?php if($erro==2) { ?>
                <h4 class="form-signin-heading bg-warning">E-mail já utilizado!</h4>
            <?php } ?>
            <label for="inputNome" class="sr-only">Nome</label>
            <input type="text" id="inputNome" autocomplete="off" name="nome" class="form-control" placeholder="Nome" required>
            <label for="inputLogin" class="sr-only">Usuário</label>
            <input type="text" id="inputLogin" autocomplete="off" name="login" class="form-control" placeholder="Login" required>
            <label for="inputEmail" class="sr-only">E-mail</label>
            <input type="email" id="inputEmail" autocomplete="off" name="email" class="form-control" placeholder="Email" required>
            <label for="inputPassword" class="sr-only">Senha</label>
            <input type="password" id="inputPassword" autocomplete="off" name="senha" class="form-control" placeholder="Senha" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Cadastrar</button>
            
            
    </div>
    </form>
</div>   