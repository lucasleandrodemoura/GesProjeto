
<div class="x_panel">
    <div class="x_title">
        <h3><?=$titulo?></h3>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <?php if(validation_errors()!=''){ ?>
            <div class="bg bg-danger alert-danger"><b><?= validation_errors()?></b></div>
        <?php } ?>
        <?php
            
            
            print form_open($action);
                
                $quantidade_campos = count($dados);
                for($contagem = 0; $contagem < $quantidade_campos; $contagem++){

                    print '<div class="col-md-3">';
                        print helperCustom_campoFormulario($dados[$contagem]);
                        
                    print '</div>';

                }      
                
                
                
                print '<div class="clearfix"></div>';
                print '<br>';
                print form_button("btn_voltar", "Voltar", "class='btn btn-default' onclick=window.location.href='".base_url()."".$voltar."'");
                if($botao_excluir)
                    print form_submit("btn_excluir", "Excluir", "class='btn btn-danger'");
                if($botao_editar)
                    print form_submit("btn_editar", "Editar", "class='btn btn-warning'");
                if($botao_inserir)
                    print form_submit("btn_inserir", "Inserir", "class='btn btn-success'");
                
                print form_close();
                
        ?>
    
    </div>
        
</div>

<?php 
//Inclui os JQuery de mascara, se tiver configurado para o campo
$quantidade_campos = count($dados);
                for($contagem = 0; $contagem < $quantidade_campos; $contagem++){
                    if($dados[$contagem]->getMascara()!=""){
?>
                 
                        <script language="JavaScript" type="text/javascript">
                           //Aplica as mascaras nos campos especificos

                               jQuery(function($){
                                    $("#<?=$dados[$contagem]->getColuna()?>").mask("<?=$dados[$contagem]->getMascara()?>");
                               });

                         </script>
<?php
                    }
                }
?>  