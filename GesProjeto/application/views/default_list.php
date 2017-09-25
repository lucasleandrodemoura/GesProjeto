
 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
                    <h1><?=$titulo?></h1>
                    <?php
                        $data = array(
                          "name"=>"botao_novo",
                          "class"=>"btn btn-default",
                          "onclick"=>"javascript:Novo();"
                        );
                        print form_button($data, "Novo");
                    ?>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                
                    
                    <div class="col-lg-12 table-responsive">
                        <?php if($tabela){?>
                         <?=$tabela?>
                       <?php } ?>
                    </div>    
                    
              
            </div>
 </div>
