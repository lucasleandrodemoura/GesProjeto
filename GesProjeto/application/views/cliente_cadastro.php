
<div class="container">
    <!-- Título e botão para inserir novo registro -->
    <div class="header">
        <h3 class="header_title">taeteatea</h3>    
        <div class="clearfix"></div>
    </div>
   
    
    
    
    <?php
        
        print form_open("home/cadastrar");
        print "nome";
        print form_input("nome");
        print form_input("cidade");
        print form_input("estado");
        print form_submit("Gravar","tetçtak");
        print form_close();
    ?>
    
    <table class="table table-striped">
        <tr>
            <td>Codigo</td>
            <td>Nome</td>
            <td>Cidade</td>
            <td>Estado</td>
        </tr>
        <?php foreach($dados as $item) { ?>
        <tr>
            <td><?=$item->codigo?></td>
            <td><?=$item->nome?></td>
            <td><?=$item->cidade?></td>
            <td><?=$item->estado?></td>
        </tr>
        <?php } ?>
        
    </table>
  </div>   
 
  
