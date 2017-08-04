<link rel="stylesheet" href="<?=base_url()?>Includes/css/style_spec.css">
<style type="text/css">
   
    body{
        padding-top: 51px;
    }
    .div_bar_semana{
        
        OVERFLOW-Y: auto; 
        WIDTH: 100%; 
        HEIGHT: 600px;
        
    }
    .td_table{
        TEXT-ALIGN: center; 
        PADDING-BOTTOM: 0px; 
        LINE-HEIGHT: 18px; 
        BORDER-RIGHT-WIDTH: 0px; 
        BACKGROUND-COLOR: #eeeeee; 
        PADDING-LEFT: 0px; 
        PADDING-RIGHT: 0px; 
        BORDER-TOP-WIDTH: 0px; 
        BORDER-BOTTOM-WIDTH: 0px; 
        FONT-SIZE: 11px; 
        VERTICAL-ALIGN: middle; 
        BORDER-LEFT-WIDTH: 0px; 
        PADDING-TOP: 0px; 
        BOX-SHADOW: none; 
    }
    
        
</style>


<script type="text/javascript">
    function jMapa(url) {
        top.window.jNo = new top.window.Janela("spec_mapa",url,"Mapa");
        top.window.jNo.autoCloseMaint("spec_mapa");
        top.window.jNo.autoSize();
        top.window.jNo.show();
    }
  var atualizar = true;  
  var timeout = setTimeout("fAtualizaPagina();",1000*300);
  
  function resetTimeout() {
    clearTimeout(timeout);
    timeout = setTimeout("fAtualizaPagina();",1000*300);
  }

  function limpaTimeout() {
    clearTimeout(timeout);
	atualizar = false;
	
  }

  function fAtualizaPagina(){
  	 if(atualizar){
	
	 	location.reload(true);
	 }
  }
  

</script>

<div id="cont">
    <div class="content">
        <div class="col-md-12">
            <div class="content">
                
                <div class="row">
                    <div class="table-responsive">
                        <table style="WIDTH: 100%; HEIGHT: 100%" class="table_structure">
                            <tr>
                                <td colspan="7" class="line-search">
                                    <div align="right">
                                        <ul class="pagination">
                                            <li><a href="?data_inicial=<?=date('Y-m-d', strtotime("-6 days",strtotime($data_inicial)))?>"><<</a></li>
                                            <li><a href="?data_inicial=<?=date('Y-m-d', strtotime("-1 days",strtotime($data_inicial)))?>"><</a></li>
                                            <li><a><?=date('d/m/Y', strtotime($data_inicial))?> até <?=date('d/m/Y', strtotime("+6 days",strtotime($data_inicial)))?></a></li>
                                            <li><a href="?data_inicial=<?=date('Y-m-d', strtotime("+1 days",strtotime($data_inicial)))?>">></a></li>
                                            <li><a href="?data_inicial=<?=date('Y-m-d', strtotime("+6 days",strtotime($data_inicial)))?>">>></a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <?php 
                                    $data = $data_inicial;   
                                    $diasemana = 
                                            array('Domingo', 
                                                'Segunda-feira', 
                                                'Terça-feira', 
                                                'Quarta-feira', 
                                                'Quinta-feira', 
                                                'Sexta-feira', 
                                                'Sabado');
                                    
                                    while($data!=$data_final)
                                    { 
                                ?>
                                
                                        <th class="td_table"><?=date('d/m', strtotime($data))."-".$diasemana[date('w', strtotime($data))]?></th>
                                        
                                <?php 
                                        $data = date('Y-m-d', strtotime("+1 days",strtotime($data)));
                                    } ?>
                               
                            </tr>
                            
                            <tr>
                                <?php 
                                    $data = $data_inicial;   
                                    $diasemana = 
                                            array('Domingo', 
                                                'Segunda-feira', 
                                                'Terça-feira', 
                                                'Quarta-feira', 
                                                'Quinta-feira', 
                                                'Sexta-feira', 
                                                'Sábado');
                                    
                                    while($data!=$data_final)
                                    { 
                                ?>
                                    <td style="POSITION: relative;">

                                        <?php
                                        foreach ($dados[$data] as $item) {
                                            
                                        ?>
                                        <div id="<?=date('w', strtotime($data))?>" class="div_bar_semana <?php if($data==date("Y-m-d")) { print "hoje"; } ?>">



                                                <div id="ticker-dia_<?=date('w', strtotime($data))?>" class="ticker">
                                                    <div class="ticker-heading"><b><?= $item->getCodigo_pedido()->getLocalEntrega()->getCliente()->getNome_cliente() ?></b></div>
                                                        <div class="ticker-body">
                                                            <div class="caixa_nome_vendedor"><b>Vendedor:</b> <?= $item->getCodigo_pedido()->getLocalEntrega()->getVendedor()->getNome() ?></div>
                                                            <div class="caixa_nome_estrutura"><b>Estrutura:</b> <?= $item->getCodigo_pedido()->getTipoEstruturas()->getDescricao() ?> </div>
                                                            <div class="caixa_quantidade_label"><b>Quantidade:</b> <?= $item->getQuantidade() ?> </div>
                                                            <div class="caixa_nome_endereco"><b><?= $item->getCodigo_pedido()->getLocalEntrega()->getEndereco() ?></b></div>
                                                            <div class="caixa_nome_produto"><b><?= $item->getCodigo_produto()->getDescricao() ?></b></div>
                                                            <?php if($item->getCodigo_pedido()->getObservacao()!="") { ?>
                                                                <div class="ticker-obs">
                                                                    <b>Obs:</b> <?= $item->getCodigo_pedido()->getObservacao() ?>
                                                                </div>
                                                            <?php } ?>
                                                        </div>

                                                    <div class="ticker-footer">
                                                        <a href="javascript:jMapa('<?= base_url()?>Painel/mapa/<?= $item->getCodigo_pedido()->getCodigo_pedido() ?>');" 
                                                           id="Panel_painel_concretoPanel_terca_feiragrid_terca_feiraLinkMapa_" 
                                                           class="btn btn-default" title="Mapa até a obra">
                                                           <i class="fa fa-map-marker" aria-hidden="true"></i> Mapa
                                                        </a>
                                                    </div>
                                                </div>

                                        </div>

                                    </td>
                                
                                      <?php 
                                      }
                                        $data = date('Y-m-d', strtotime("+1 days",strtotime($data)));
                                    } ?>
                               
                                
                                
                               
                            
                        </table>
                    </div>
                </div>
     
 
  
