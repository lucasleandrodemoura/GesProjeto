<div id="menu_lateral" class="sidebar" style="">

  <ul class="nav nav-sidebar">
    
    <li>
      <a href="<?=base_url()?>" class="" data-toggle="" title="Início"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <span class="link_menu">Início</span></a>
    </li>
    
    
    <?php 
    
    foreach($menus as $item) { ?>
    
    
        <li class="dropdown">
          <a href="#menu_<?= $item["codigo_menu"]; ?>" class="dropdown-toggle" data-toggle="collapse" title="<?= $item["descricao"]; ?>">
              <span class="<?= $item["icone"]; ?>" aria-hidden="true"></span> 
              <span class="link_<?= $item["codigo_menu"]; ?>"><?= $item["descricao"]; ?></span> 
              <span class="caret"></span>
          </a>
            
          <ul id="menu_<?= $item["codigo_menu"]; ?>" class="nav nav-submenu collapse in">
            <?php foreach($item["filhos"] as $item_filho) { ?>
                  <?php $url = $this->uri->segment(1); ?>
                  <li class="<?php if($url==$item_filho["link"]) {print "active"; } ?>" id="sub_<?= $item_filho["codigo_menu"]; ?>">
                      <a title="<?= $item_filho["descricao"]; ?>" href="<?= base_url()?><?= $item_filho["link"]; ?>">
                          <i class="<?= $item_filho["icone"]; ?>"></i>
                          <span class="link_menu"><?= $item_filho["descricao"]; ?></span>
                      </a>
                  </li>

            <?php } ?>
          </ul>
        </li>
    
    
    <?php }  ?>
    
            
  </ul>

  <ul class="nav sidebar-recolher"> 
    <li><a href="#" id="menu-toggle"><span id="main_icon" class="glyphicon glyphicon-align-justify"></span></a></li>
  </ul>
</div>

<script type="text/javascript">
  jQuery("#menu-toggle").click(function(e) {
    e.preventDefault();
    jQuery("#menu_lateral").toggleClass("sidebar-active");
	jQuery("#conteudo").toggleClass("container-active");
  });
</script>


<div id="conteudo" class="container-fluid">
<div class="content">
    
        <div class="col-md-12">
            <div class="block-grid">