
<div class="container-fluid">
    <?php if($titulo){?>
    <div class="row">
        <div class="col-lg-11">
            <h3><?=$titulo?></h3>
        </div>
        <div class="col-lg-1">
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
    <?php } ?>
    <div class="row">
          
          <div class="col-lg-12 table-responsive">
               <?php if($tabela){?>
                <?=$tabela?>
              <?php } ?>
          </div>    
          
      </div>
  </div>   

 
  
