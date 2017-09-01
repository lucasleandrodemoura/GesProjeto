<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="container">
    <?php 
        if($dados) { 
            echo form_open("usuarios/editar"); 
        }else{
            echo form_open("usuarios/cadastrar"); 
        }
    ?>
    <div class="form-signin">
        
            <?php if($erro==1) { ?>
                <h4 class="form-signin-heading bg-danger">Usuário já cadastrado!</h4>
            <?php } ?>
            <?php if($erro==2) { ?>
                <h4 class="form-signin-heading bg-warning">E-mail já utilizado!</h4>
            <?php } ?>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="inputNome">Nome</label>
                    <input type="text" id="inputNome" autocomplete="off" name="nome" value="<?php if($dados) { print $dados->nome; } ?>" class="form-control" placeholder="Nome" required>
                </div><div class="form-group col-md-12">
                    <label for="inputLogin">Usuário</label>
                    <input type="text" id="inputLogin" autocomplete="off" name="login" value="<?php if($dados) { print $dados->login; } ?>" class="form-control" placeholder="Login" required>
                </div><div class="form-group col-md-12">
                    <label for="inputEmail">E-mail</label>
                    <input type="email" id="inputEmail" autocomplete="off" name="email" value="<?php if($dados) { print $dados->email; } ?>" class="form-control" placeholder="Email" required>
                </div><div class="form-group col-md-12">
                    <label for="inputPassword">Senha</label>
                    <input type="password" id="inputPassword" autocomplete="off" name="senha" value="<?php if($dados) { print $dados->senha; } ?>" class="form-control" placeholder="Senha" required>
                </div>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit"><?php if($dados) { print "Salvar"; } else { print "Cadastrar"; } ?></button>
            
            
    </div>
    </form>
</div>   