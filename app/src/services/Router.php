<?php 

namespace App\services;

    class Router {
        public static function get(string $path, string $view) {
            $request = $_SERVER['REQUEST_URI'];

            switch($request) {
                case $path:
                    include $view;
                    break;
            }
        }
    }