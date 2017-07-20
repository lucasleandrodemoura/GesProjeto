
<div class="x_panel">
    <!-- Título e botão para inserir novo registro -->
    <div class="x_title">
        <h3><?=$titulo?></h3>
            <?php if($novo) { ?>
                <ul class="nav navbar-right">
                    <li><button class="btn btn-success" id="btn_cadastrar" onclick="window.location.href='<?= base_url()."".$novo?>'" title="Cadastrar">Novo</button></li>
                </ul>
            <?php } ?>
            <div class="clearfix"></div>
    </div>
 
    <!-- Filtro -->
    <?php 
    
        if(count($dados["filtros"])>0){
            print "<div class='x_panel'>";
            $contagem = 0;
            print form_open($src);
            $cont = 0;
            print "<div class='row'>";
            foreach ($dados["filtros"] as $campo){
                print "<div class='col-md-3'>";    
                    print helperCustom_campoFormulario($campo);
                print "</div>";       
             
            }
            
            print "<div class='col-md-3' align='left'>";
                print form_submit("procurar", "Procurar","class='btn btn-default'");
            print "</div>";
            echo form_close();
            print "</div>";
        }
    ?>
    
    
 <!-- Tabela de conteúdo -->
  <div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <?php foreach($dados["cabecalho"] as $item) { ?>
                        <th><?= $item ?></th>
                    <?php } ?>
                        <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                    <tr>     
                        <?php 
                        //Valida se vem registro do DATASOURCE
                        if($dados["dados"]!=""){
                            //Percorre todos os registros
                            foreach($dados["dados"] as $item=>$k) { 
                                foreach($k as $valor) { 
                                    if(is_array($valor)){
                                        $linkPrimary = "";
                                        foreach($valor as $labelPrimary=>$valorPrimary){
                                            if($linkPrimary!=""){
                                                $linkPrimary="&";
                                            }
                                            $linkPrimary.=$labelPrimary."=".$valorPrimary;
                                        }
                                    }
                                    else{
                                ?>
                                            <td><?= $valor ?></td>
                                <?php   }
                                
                                } ?>
                                <td>
                                    <a href='<?=$src."/cadastro?".$linkPrimary?>' class="btn btn-default" title="Alterar"><i class="fa fa-edit" name=""></i></a>
                                    <a href='<?=$src."/excluir?".$linkPrimary?>' class="btn btn-danger" title="Excluir"><i class="fa fa-trash" name=""></i></a>
                                </td>
                                
                            <?php 
                            
                            } 
                        } 
                            ?>
                    </tr>
            </tbody>
        </table>
    </div>      
  </div>
</div>