<?php

namespace App\controllers;
use App\models\Auth;
use App\services\Database;
use App\services\Router;

    class AuthController {
        
        public function signIn(string $email, string $password): void {
            $db = new Database();
            $auth = new Auth();

            $basic_token = base64_encode($email.":".hash("SHA256", $password));
            $auth->setBasicToken($db->selectWhere("*", "auth", "basic_token = '$basic_token'")[0]['basic_token']);
            
            if($auth->getBasicToken() != null) {
                $this->session();
            }
        }

        private function session(): void {
            
        }

        public function basicToken(Auth $auth): void {
            try {
                $db = new Database();
                $userController  = new UserController();
                $user = $auth->getUser();

                $auth->getUser()->setId($userController->findByEmail($user->getEmail())[0][0]);
                $auth->setBasicToken(base64_encode($user->getEmail().":".hash("SHA256", $user->getPassword())));
                
                $db->insert("user_id, basic_token", "auth", $auth, [
                    $auth->getUser()->getId(),
                    $auth->getBasicToken(),
                ]);

            } catch (\PDOException $e) {
                throw $e;
            }
        }
        
    }