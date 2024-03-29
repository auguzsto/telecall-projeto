<?php

namespace App\services;
use App\controllers\AccessControlController;
use App\models\User;

    class Session {

        public static function create(User $user) {
            session_start();

            $_SESSION['session'] = $user;
            $_SESSION['permissions'] = AccessControlController::getPermissionsByProfile($user->getProfile());

            Logger::createDatabaseLog($user->getEmail(), "signIn", "realizou acesso no sistema");
            header("Location: /dashboard/");
        }

        public static function twoFactorAuthentication(User $user) {
            session_start();

            $_SESSION['2fa'] = $user;
            header("Location: /2FA");
        }

        public static function check2FA() {
            session_start();

            if($_SESSION['2fa'] == null) {
                return header("Location: /dashboard/");
            }
        }

        public static function check() {
            session_start();

            if($_SESSION['session'] == null) {
                return header("Location: /login");
            }
            
        }

        public static function checkPermissions($thisModule) {
            
            if(!ACL::checkIfUserThenPermissionToRead($thisModule)) {
                return header("Location: /dashboard/profile");
            }
            
        }

        public static function destroy() {
            session_start();
            session_destroy();
            session_unset();
            header("Location: /login");
        }
    }