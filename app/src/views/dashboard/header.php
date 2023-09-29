<?php

use App\services\ACL;

    function showTools(int $thisModule, $tool): string {
        return ACL::checkIfUserThenPermissionToRead($thisModule) ? print $tool : '';
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/app/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/app/assets/css/style.css">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="/app/assets/css/dashboard.css" rel="stylesheet">
    <title>Telecall</title>
</head>
<body>
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Olá, <?= $user->getFirstName(); ?></a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="/dashboard/signout">Sair</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="/dashboard/">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <?php showTools(0, 
          '<li class="nav-item">
            <a class="nav-link" href="/dashboard/profile">
              <span data-feather="bar-chart-2"></span>
              Perfil
            </a>
          </li>');?>
          <?php showTools(1, 
          '<li class="nav-item">
            <a class="nav-link" href="/dashboard/users">
              <span data-feather="bar-chart-2"></span>
              Usuários
            </a>
          </li>');?>
          <?php showTools(2, 
          '<li class="nav-item">
            <a class="nav-link" href="/dashboard/log">
              <span data-feather="bar-chart-2"></span>
              Log de alterações
            </a>
          </li>');?>
          <?php showTools(3, 
          '<li class="nav-item">
            <a class="nav-link" href="/dashboard/reports">
              <span data-feather="bar-chart-2"></span>
              Relatórios
            </a>
          </li>');?>
          <?php showTools(4, 
          '<li class="nav-item">
            <a class="nav-link" href="/dashboard/permissions">
              <span data-feather="bar-chart-2"></span>
              Perfils
            </a>
          </li>');?>
        </ul>
      </div>
    </nav>