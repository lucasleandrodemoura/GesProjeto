

    <!-- Título e botão para inserir novo registro -->
    <div class="header">
        <h3 class="header_title"><?=$titulo?></h3>    
        <div class="clearfix"></div>
    </div>
    
    
       
    
 <!-- Tabela de conteúdo -->
 
      <div class="row">
          
      
          
          <?php foreach ($menus_favoritos as $item){ ?>
            
          <div class="col-sm-6 col-md-4">
              <div class="thumbnail">
                  <div class="caption">
                      <h4><i class="<?= $item->icone ?>"></i><?= $item->descricao ?></h4>
                      <p><?=$item->titulo?></p>
                      <a href="<?= $item->link ?>" class="btn btn-primary" role="button" id="Link_<?= $item->codigo_menu ?>">Abrir</a>
                  </div>
              </div>
          </div>
          <?php } ?>

      </div>
     
 
  
