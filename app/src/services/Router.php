<?php 

namespace App\services;

    class Router {
        public function get(string $path, string $view) {
            if ($_SERVER['REQUEST_URI'] != $path) {
                return print "Page not found. 404";
            }

            require $view;
        }
    }