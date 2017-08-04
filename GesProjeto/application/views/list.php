
<div class="x_panel">
    <!-- Título e botão para inserir novo registro -->
    <div class="x_title">
        <h3><?=$titulo?></h3>
        <ul class="nav navbar-right">
            <li>
            <?php if($botaoVoltar!="") { ?>
                
                    <button class="btn btn-default" id="btn_voltar" onclick="javascript:location.href='<?= base_url()."".$botaoVoltar?>'" title="Voltar">Voltar</button>
                
            <?php } ?>
            <?php if($novo) { ?>
                
                    <button class="btn btn-success" id="btn_cadastrar" onclick="javascript:Cadastros('<?= base_url()."".$novo?>');" title="Cadastrar">Novo</button>
                
            <?php } ?>
            </li>
        </ul>
            <div class="clearfix"></div>
    </div>
 
    <!-- Filtro -->
    <?php 
    
        if(count($dados["filtros"])>0){
            print "<div class='x_panel'>";
            $contagem = 0;
            
            $linkPrimary = "";
            if($this->input->get()){
                foreach($this->input->get() as $labelPrimary=>$valorPrimary){
                    if($linkPrimary!=""){
                        $linkPrimary="&";
                    }
                        $linkPrimary.=$labelPrimary."=".$valorPrimary;
                }
            }
            
            print form_open($src."?".$linkPrimary);
            $cont = 0;
            print "<div class='row'>";
            foreach ($dados["filtros"] as $campo){
                print "<div class='col-md-3'>";    
                    $campo->setNulo("YES");
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
                     
                        <?php 
                        //Valida se vem registro do DATASOURCE
                        if($dados["dados"]!=""){
                            //Percorre todos os registros
                            
                            
                            foreach($dados["dados"] as $item=>$k) {
                                $contagem = 0;
                                $primary_key = "";
                                $descricao_principal = "";
                                print "<tr>";
                                foreach($k as $valor) { 
                                    if($contagem==0){
                                        $primary_key=$valor;
                                    }
                                    if($contagem==1){
                                        $descricao_principal=$valor;
                                    }
                                    
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
                                $contagem++;
                                }
                             
                                print "<td>";
                                
                                if(is_array($acoes)){
                                    foreach ($acoes as $ka){
                                        
                                        
                                        ?>
                                            
                                                <a href="<?=$ka["link"]."?".$linkPrimary?>" class="btn btn-default" title="<?=$ka["title"]?>"><i class="<?=$ka["icon"]?>" name="<?=$ka["title"]?>"></i></a>
                                           
                                        <?php
                                    
                                    }
                                    
                                }
                                
                                
                                if($editar==TRUE){
                                ?>
                                
                                    <a href="javascript:Cadastros('<?=$src."/cadastro?".$linkPrimary?>');" class="btn btn-default" title="Alterar"><i class="fa fa-edit" name=""></i></a>
                              
                               
                            <?php 
                                }
                                if($seleciona==TRUE){
                              ?>     
                              
                                    <a href='javascript:thisJanela.seleciona(<?=$primary_key?>,"<?=$descricao_principal?>");' class="btn btn-default" title="Selecionar"><i class="fa fa-search" name=""></i></a>
                              
                                <?php 
                                }
                                print "</td>";
                                print "</tr>";
                            } 
                        } 
                            ?>
                    
            </tbody>
        </table>
    </div>      
  </div>
</div>