<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Projetos</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url()?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Cadastros
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?= base_url()?>Projeto">Projetos</a>
          <a class="dropdown-item" href="<?= base_url()?>Setor">Setor</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Configurações
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?= base_url()?>Estruturador">Estruturador de Dados</a>
          <a class="dropdown-item" href="<?= base_url()?>Pais">Países</a>
          <a class="dropdown-item" href="<?= base_url()?>Estado">Estados</a>
          <a class="dropdown-item" href="<?= base_url()?>Cidade">Cidades</a>
        </div>
        
          
          
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url()?>Usuarios/meus_dados">Meus dados</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="<?= base_url()?>Login/logout">Sair</a>
      </li>
    </ul>
  </div>
</nav>