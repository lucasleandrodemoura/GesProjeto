

    <!-- Título e botão para inserir novo registro -->
    <div class="header">
        <h3 class="header_title">Lista de prêmios</h3>    
        <div class="clearfix"></div>
    </div>
    
    
       
    
 <!-- Tabela de conteúdo -->
 
      <div class="row">
          
      
          <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>Data sorteio</th>
                      <th>Número</th>
                      <th>Premio</th>
                  </tr>
              </thead>
          <?php foreach ($dados as $item){ ?>
               <tr>
                      <td><?=$item->data_sorteio?></td>
                      <td><?=$item->numero?></td>
                      <td><?=$item->premio?></td>
                  </tr>
          <?php } ?>
          </table>

          
      </div>
     
 
  
