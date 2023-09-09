<?php 

namespace App\services;

    class Router {
        public static function get(string $path, string $view) {
            $request = $_SERVER['REQUEST_URI'];
            $requestParts = explode('/',explode('?',$request)[0]);
            // altere a chave do array aqui caso precise
            // (ex: URI = "/index.php/dir" -> $requestParts[0] = index.php -> $requestParts[1] = "dir"
            $chaveDoArray=2; // essa chave funciona no servidor bult-int do php, em um servidor com redirecionamento pro index.php use a chave 1
            switch($requestParts[$chaveDoArray]) { 
                case $path:
                    include $view;
                    break;
            }
        }
    }
