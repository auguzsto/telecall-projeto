<?php

namespace App\services;

use App\models\User;

    class Session {

        public static function create(User $user) {
            session_start();
            $_SESSION['session'] = $user;
            header("Location: /dashboard/");
        }

        public static function check() {
            session_start();

            if($_SESSION['session'] == null) {
                return header("Location: /login");
            }
            
        }

        public static function destroy() {
            session_start();

            session_destroy();

            header("Location: /login");
        }
    }