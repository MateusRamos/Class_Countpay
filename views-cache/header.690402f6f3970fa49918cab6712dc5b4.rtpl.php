<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-BR">

<head>

  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Countpay</title>

  <!-- Icones utilizado no Projeto -->
  <link href="../../res/site/assets/img/favicon.png" rel="icon">
  <link href="../../res/site/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../res/site/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../res/site/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../res/site/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../res/site/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../../res/site/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../../res/site/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../../res/site/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@500&display=swap" rel="stylesheet">
  

  <!-- Icones de Bancos Brasileiros -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/matheusmcuba/icones-bancos-brasileiros@1.1/dist/all.css">

  <!-- Arquivo CSS do Countpay -->
  <link href="../../res/site/assets/css/style.css" rel="stylesheet">

      <!-- Arquivo CSS do Countpay -->
      <link href="../res/site/assets/css/style2.css" rel="stylesheet">

      <!-- ===== Link Swiper's CSS ===== -->
      <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  
      <!-- ===== Fontawesome CDN Link ===== -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />


</head>

<body>
  <!-- ======= Cabe??alho ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <!-- ======= Sidebar - Menu Vertical ======= -->
    <div class="d-flex align-items-center justify-content-between">
      <!-- Inicio Logo -->
      <a href="/" class="logo d-flex align-items-center">
        <img src="../../res/site/assets/img/logo.png" alt="">
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- Fim Logo -->
    
    <!-- Inicio Busca -->
    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Pesquisar" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div>
    <!-- Fim Busca -->

    <!-- Inicio Icone de Busca com tela reduzida -->
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li>
        <!-- Fim Icone de Busca com tela reduzida -->

        <li class="nav-item dropdown">


        <!-- Inicio Perfil -->
        <li class="nav-item dropdown pe-3">

          <!-- Inicio Perfil Imagem Icone -->
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2">Configura????es</span>
          </a>
          <!-- Fim Perfil Imagem Icone -->

          <!-- Inicio Informa????es do Perfil -->
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li>
              <a class="dropdown-item d-flex align-items-center" href="/perfil">
                <i class="bi bi-person"></i>
                <span>Meu Perfil</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="/mudar_senha">
                <i class="bi bi-gear"></i>

                <span>Mudar senha</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="/sair">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sair</span>
              </a>
            </li>

          </ul>
          <!-- Fim Informa????es do Perfil -->
        </li>
        <!-- Fim Perfil -->

      </ul>
    </nav>
    <!-- Fim do Sidebar - Menu Vertical -->

  </header>
  <!-- Fim do Cabe??alho -->
  
  <!-- ======= Inicio do Menu Lateral ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <!-- Inicio Dashboard -->
      <li class="nav-item">
        <a class="nav-link " href="/">
          <i class="bx bxs-dashboard"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- Fim Dashboard -->

      <!-- Inicio da Lista do Menu -->

      <!-- Inicio Proje????o Futuras -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#projecao" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart-fill"></i><span>Proje????es Futuras</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>

        <ul id="projecao" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/projecao">
              <i class="bx bxs-chevron-right"></i><span>Proje????o</span>
            </a>
          </li>
        </ul>

      </li>
      <!-- Fim Proje????o Futuras -->

      <!-- Inicio Carteira -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#carteira" data-bs-toggle="collapse" href="#">
          <i class="bx bxs-wallet"></i><span>Carteira</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>

        <ul id="carteira" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/conta">
              <i class="bx bxs-chevron-right"></i><span>Contas</span>
            </a>
          </li>

          <li>
            <a href="/cartao">
              <i class="bx bxs-chevron-right"></i><span>Cart??es</span>
            </a>
          </li>
        </ul>

      </li>
      <!-- Fim Carteira -->

      <!-- Inicio Lan??amentos -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bx bxs-dollar-circle"></i><span>La??amentos</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>

        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/lancamento/receita">
              <i class="bx bxs-chevron-right"></i><span>Receita</span>
            </a>
          </li>

          <li>
            <a href="/lancamento/despesa">
              <i class="bx bxs-chevron-right"></i><span>Despesa</span>
            </a>
          </li>

          <li>
            <a href="/lancamento/transferencia">
              <i class="bx bxs-chevron-right"></i><span>Transfer??ncia</span>
            </a>
          </li>

          <li>
            <a href="/lancamento/historico">
              <i class="bx bxs-chevron-right"></i><span>Historico de Lan??amento</span>
            </a>
          </li>
        </ul>

      </li>
      <!-- Fim Lan??amentos -->

      <!-- Inicio Metas -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bx bxs-bar-chart-square"></i><span>Metas</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          
          <li>
            <a href="/metas/criar">
              <i class="bx bxs-chevron-right"></i><span>Criar Nova Meta</span>
            </a>
          </li>

          <li>
            <a href="/minhasmetas">
              <i class="bx bxs-chevron-right"></i><span>Minhas Metas</span>
            </a>
          </li>

        </ul>
      </li>
      <!-- Fim Metas -->

      <li>
        <hr class="dropdown-divider text-secondary">
      </li>
      <!-- Titulo do Menu Lateral -->
      <li class="nav-heading">Utilit??rios</li>

      <!-- Inicio Perfil -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="/perfil">
          <i class="bx bxs-id-card"></i>
          <span>Perfil</span>
        </a>
      </li>
      <!-- Fim Perfil -->

      <!-- Inicio Contato -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="/contato">
          <i class="bx bxs-envelope"></i>
          <span>Contato</span>
        </a>
      </li>
      <!-- Fim Contato -->

    </ul>

  </aside>
  <!-- Fim do Menu Lateral -->
