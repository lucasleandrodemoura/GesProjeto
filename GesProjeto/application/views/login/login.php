<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
               
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><img src="imagens/logomarca.jpg" width="100%" id="logomarca" class="img"></h3>
                    </div>
                    
                    <div class="panel-body">
                         <?php echo form_open("login/logar"); ?>
                            <fieldset>
                                <div class="form-group">
                                    <label for="inputEmail" class="sr-only">Usuário</label>
                                    <input type="text" id="inputEmail" name="login" class="form-control" placeholder="Login" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword" class="sr-only">Senha</label>
                                     <input type="password" id="inputPassword" name="senha" class="form-control" placeholder="Senha" required>
                                </div>
                      
                                    
                                    <div class="form-group">
                                        <div class="col-6"><a href="<?= base_url() ?>login/recuperar_senha" style="text-align: center">Esqueci a senha</a></div>
                                        <div class="col-6"><a href="<?= base_url() ?>usuarios/cadastro" style="text-align: center">Cadastre-se</a></div>
                                    </div>
                         
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-primary btn-block" type="submit">Logar</button>
                                
                            </fieldset>
                         <?php echo form_close(); ?>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>

