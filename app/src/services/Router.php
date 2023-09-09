<?php 

namespace App\services;

    class Router {
        public static function get(string $path, string $view) {
            $request = $_SERVER['REQUEST_URI'];
            $requestParts = explode('/',explode('?',$request)[0]);
            switch($requestParts[0]) {
                case $path:
                    include $view;
                    break;
            }
        }
    }
