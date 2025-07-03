<!-- <?php
// view/_sidebar.php
// Este arquivo contém apenas o HTML e PHP da sidebar Offcanvas.
?>

<div class="offcanvas offcanvas-start custom-sidebar" tabindex="-1" id="sidebarResponsive" aria-labelledby="sidebarResponsiveLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="sidebarResponsiveLabel">SFP-GZ</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body d-flex flex-column">
    <ul class="navbar-nav fs-5 flex-grow-1">
      <li class="nav-item">
        <a class="nav-link" href="index.php?principal">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?inserir_lancamento">Lançamentos</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-bs-auto-close="outside" href="#" id="navbarDropdownCadastros" role="button" data-bs-toggle="dropdown" aria-expanded="false">Cadastros</a>
        <ul class="dropdown-menu">
          <li><a href="index.php?inserir_banco" class="dropdown-item">Bancos</a></li>
          <li><a href="index.php?inserir_bandeira" class="dropdown-item">Bandeiras de cartões</a></li>
          <li><a href="index.php?inserir_cartao" class="dropdown-item">Cartões</a></li>
          <li><a href="index.php?inserir_forma" class="dropdown-item">Formas de rec/pag</a></li>
          <li><a href="index.php?inserir_plano" class="dropdown-item">Plano de contas</a></li>
          <li><a href="index.php?inserir_usuario" class="dropdown-item">Usuários</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-bs-auto-close="outside" href="#" id="navbarDropdownConsultas" role="button" data-bs-toggle="dropdown" aria-expanded="false">Consultas</a>
        <ul class="dropdown-menu">
          <li><a href="index.php?consultar_lancamento" class="dropdown-item">Lançamentos</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a href="index.php?consultar_banco" class="dropdown-item">Bancos</a></li>
          <li><a href="index.php?consultar_bandeira" class="dropdown-item">Bandeiras de cartões</a></li>
          <li><a href="index.php?consultar_cartao" class="dropdown-item">Cartões</a></li>
          <li><a href="index.php?consultar_forma" class="dropdown-item">Formas de rec/pag</a></li>
          <li><a href="index.php?consultar_plano" class="dropdown-item">Plano de contas</a></li>
          <li><a href="index.php?consultar_usuario" class="dropdown-item">Usuários</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownRelatorios" role="button" data-bs-toggle="dropdown" aria-expanded="false">Relatórios</a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownRelatorios">
          <li><a class="dropdown-item" href="index.php?consultar_editora">Receitas/mês</a></li>
          <li><a class="dropdown-item" href="index.php?inserir_editora">Despesas/mês</a></li>
          <li><a class="dropdown-item" href="index.php?inserir_editora">Saldo/mês</a></li>
        </ul>
      </li>
    </ul>
    <ul class="navbar-nav fs-5 mt-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownSair" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-fill"></i><?php echo (isset($_SESSION['email']) ? $_SESSION['email'] : 'Usuário'); ?></a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownSair">
          <li><a class="dropdown-item" href="index.php?sair"><i class="bi bi-box-arrow-right"></i> Sair</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div> -->