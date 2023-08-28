<?php
use App\services\Router;

    $router = new Router();

    $router->get("/", "app/src/views/index.html");
    $router->get("/login", "app/src/views/login.html");