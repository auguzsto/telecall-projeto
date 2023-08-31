<?php
use App\services\Router;

    Router::get("/", "app/src/views/index.php");
    Router::get("/login", "app/src/views/login.php");
    Router::get("/cadastro", "app/src/views/cadastro.php");

    //Services
    Router::get("/servicos/cpaas", "app/src/views/servicos/cpaas.php");
    Router::get("/servicos/eventos", "app/src/views/servicos/eventos.php");
    Router::get("/servicos/infra", "app/src/views/servicos/infra.php");
    Router::get("/servicos/internet", "app/src/views/servicos/internet.php");
    Router::get("/servicos/telefonia", "app/src/views/servicos/telefonia.php");
    Router::get("/servicos/mobilidade", "app/src/views/servicos/mobilidade.php");