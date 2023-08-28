<?php
use App\services\Router;

    Router::get("/", "app/src/views/index.php");
    Router::get("/login", "app/src/views/login.php");
    Router::get("/cadastro", "app/src/views/cadastro.php");