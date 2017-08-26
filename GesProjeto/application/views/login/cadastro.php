<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="container">
    <?php 
        if($dados) { 
            echo form_open("login/editar"); 
        }else{
            echo form_open("login/cadastrar"); 
        }
    ?>
    <div class="form-signin">
        
            <?php if($erro==1) { ?>
                <h4 class="form-signin-heading bg-danger">Usuário já cadastrado!</h4>
            <?php } ?>
            <?php if($erro==2) { ?>
                <h4 class="form-signin-heading bg-warning">E-mail já utilizado!</h4>
            <?php } ?>
            <label for="inputNome" class="sr-only">Nome</label>
            <input type="text" id="inputNome" autocomplete="off" name="nome" value="<?php if($dados) { print $dados->nome; } ?>" class="form-control" placeholder="Nome" required>
            <label for="inputLogin" class="sr-only">Usuário</label>
            <input type="text" id="inputLogin" autocomplete="off" name="login" value="<?php if($dados) { print $dados->login; } ?>" class="form-control" placeholder="Login" required>
            <label for="inputEmail" class="sr-only">E-mail</label>
            <input type="email" id="inputEmail" autocomplete="off" name="email" value="<?php if($dados) { print $dados->email; } ?>" class="form-control" placeholder="Email" required>
            <label for="inputPassword" class="sr-only">Senha</label>
            <input type="password" id="inputPassword" autocomplete="off" name="senha" value="<?php if($dados) { print $dados->senha; } ?>" class="form-control" placeholder="Senha" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit"><?php if($dados) { print "Salvar"; } else { print "Cadastrar"; } ?></button>
            
            
    </div>
    </form>
</div>   