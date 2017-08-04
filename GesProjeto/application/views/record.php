<script type="text/javascript">
    function FecharJanela() {
      top.window.jCadastros.close();
    }
    function Excluir(src){
          if(confirm("Você deseja excluir este registro?")){
              location.href = src;
              
          }
      }
</script>
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
            
            
            print form_open($action,array("name"=>"form_record_default"));
                
                $quantidade_campos = count($dados);
                for($contagem = 0; $contagem < $quantidade_campos; $contagem++){

                    print '<div class="col-sm-6">';
                        print helperCustom_campoFormulario($dados[$contagem]);
                    print '</div>';

                }      
                
              

                
                print '<div class="clearfix"></div>';
                print '<br>';
                print form_button("btn_voltar", "Fechar", "class='btn btn-default' onclick='javascript:FecharJanela();'");
                if($botao_excluir)
                    print form_button("btn_excluir", "Excluir", "class='btn btn-danger' onclick=javascript:Excluir('".base_url()."".$voltar."/excluir?".$key."');");
                if($botao_editar)
                    print form_submit("btn_editar", "Atualizar", "class='btn btn-warning'");
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