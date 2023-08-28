<?php

    use Phroute\Phroute\RouteCollector;
    use Phroute\Phroute\Dispatcher;

    $router = new RouteCollector();

    $router->get('/', function(){
        include "app/src/views/index.html";
    });

    $dispatcher =  new Dispatcher($router->getData());

    echo $dispatcher->dispatch('GET', '/');