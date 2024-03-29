<?php
use App\services\Router;

    Router::get("/", "app/src/views/index.php");
    Router::get("/login", "app/src/views/modules/auth/login.php");
    Router::get("/cadastro", "app/src/views/modules/auth/cadastro.php");

    //Services
    Router::get("/services/cpaas", "app/src/views/modules/services/cpaas.php");
    Router::get("/services/eventos", "app/src/views/modules/services/eventos.php");
    Router::get("/services/infra", "app/src/views/modules/services/infra.php");
    Router::get("/services/internet", "app/src/views/modules/services/internet.php");
    Router::get("/services/telefonia", "app/src/views/modules/services/telefonia.php");
    Router::get("/services/mobilidade", "app/src/views/modules/services/mobilidade.php");

    //2FA
    Router::get("/2FA", "app/src/views/modules/auth/2FA.php");

    //Dashboard
    Router::get("/dashboard/", "app/src/views/dashboard/index.php");
    Router::get("/dashboard/profile", "app/src/views/dashboard/modules/profile/profile.php");
    Router::get("/dashboard/changepassword", "app/src/views/dashboard/modules/profile/changepassword.php");
    //Dashboard log
    Router::get("/dashboard/log", "app/src/views/dashboard/modules/log/index.php");
    //Dashboard users
    Router::get("/dashboard/users", "app/src/views/dashboard/modules/users/index.php");
    Router::get("/dashboard/users/:params", "app/src/views/dashboard/modules/users/index.php");
    //Dashboard reports
    Router::get("/dashboard/reports", "app/src/views/dashboard/modules/reports/index.php");
    Router::get("/dashboard/reports/:params", "app/src/views/dashboard/modules/reports/index.php");
    //Dashboard permissions
    Router::get("/dashboard/permissions", "app/src/views/dashboard/modules/permissions/index.php");
    Router::get("/dashboard/permissions/:params", "app/src/views/dashboard/modules/permissions/index.php");
    //Dashboard signout
    Router::get("/dashboard/signout", "app/src/views/dashboard/signout.php");