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

    //2FA
    Router::get("/2FA", "app/src/views/2FA.php");

    //Dashboard
    Router::get("/dashboard/", "app/src/views/dashboard/index.php");
    Router::get("/dashboard/profile", "app/src/views/dashboard/profile.php");
    Router::get("/dashboard/changepassword", "app/src/views/dashboard/changepassword.php");
    Router::get("/dashboard/log", "app/src/views/dashboard/log.php");
    //Dashboard reports
    Router::get("/dashboard/reports", "app/src/views/dashboard/reports.php");
    Router::get("/dashboard/reports/:params", "app/src/views/dashboard/reports/index.php");
    Router::get("/dashboard/user/:params", "app/src/views/dashboard/users/index.php");
    Router::get("/dashboard/signout", "app/src/views/dashboard/signout.php");