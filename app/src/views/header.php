<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/app/assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="/app/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/app/assets/css/style.css">
    <script src="/app/assets/js/scrollreveal.js"></script>
    <title>Telecall</title>
</head>
<body>
  
<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid" id="navCliente">
        <div class="navbar-header">
        </div>
        <ul class="nav navbar-nav navbar-right ">
        <li><a href="/login" class="bg-primary rounded text-light" id="buttonCliente">Área do Cliente</a></li>
        </ul>
    </div>
</nav>
<nav class="navbar navbar-expand-lg bg-light navbar-light shadow p-3 mb-5 bg-white rounded">
    <a href="/"><img src="/app/assets/images/navbar.png" class="navbar brand img-fluid"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100vh">
          <li class="nav-item">
            <a class="nav-link text-primary bg-primary rounded text-light p-2" href="/services/cpaas">
            <i class="fas fa-cloud-arrow-up"></i> CPaaS
            </a>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-primary" href="/services/internet" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
              Internet
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
              <li><a class="dropdown-item" href="/services/internet">Internet Dedicada</a></li>
              <li><a class="dropdown-item" href="/services/internet">Banda Larga</a></li>
              <li><a href="/services/internet" class="dropdown-item">Wifi</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-primary" href="/services/telefonia" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
              Telefonia
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
              <li><a class="dropdown-item" href="/services/telefonia">PABX IP Virtual</a></li>
              <li><a class="dropdown-item" href="/services/telefonia">E1</a></li>
              <li><a href="/services/telefonia" class="dropdown-item">SIP TRUNK</a></li>
              <li><a href="/services/telefonia" class="dropdown-item">Números 0800 e 40XX</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-primary" href="/services/infra" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
              Rede e Infraestrutura
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
              <li><a class="dropdown-item" href="/services/infra">Ponto-a-Ponto</a></li>
              <li><a class="dropdown-item" href="/services/infra">MPLS</a></li>
              <li><a href="/services/infra" class="dropdown-item">Fibra Apagada e Dutos</a></li>
              <li><a href="/services/infra" class="dropdown-item">Co-location</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-primary" href="/services/mobilidade" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
              Mobilidade
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
              <li><a class="dropdown-item" href="/services/mobilidade">Celular empresarial</a></li>
              <li><a class="dropdown-item" href="/services/mobilidade">MVNA/E</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-primary" href="/services/eventos" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
              Eventos
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
              <li><a class="dropdown-item" href="/services/eventos">Serviços para Eventos</a></li>
              <li><a class="dropdown-item" href="/services/eventos">Eventos Telecall</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-primary" href="outraSolu.html" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
              Outras soluções
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
              <li><a class="dropdown-item" href="outraSolu.html">Activtrak</a></li>
            </ul>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control mr-2" type="search" placeholder="Posso te ajudar?" aria-label="Search">
          <button class="btn btn-outline-primary" type="submit">Procurar</button>
        </form>
      </div>
    </nav>
</nav>