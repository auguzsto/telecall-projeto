<?php 

namespace App\services;

    class Router {
        public static function get(string $path, string $view) {
            $request = $_SERVER['REQUEST_URI'];

            switch($request) {
                case $path:
                    include $view;
                    die;
                
                case str_contains($path, ":params") && str_contains($request, "?"):
                    $r = $_REQUEST;
                    include $view;
                    die;
            }
        }
    }
