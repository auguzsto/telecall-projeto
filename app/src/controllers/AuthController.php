<?php

namespace App\controllers;
use App\handlers\Handlers;
use App\models\Auth;
use App\models\User;
use App\services\Session;
use App\services\Database;

    class AuthController {
        
        public function signIn(string $email, string $password): void {
            try {
                $db = new Database();

                $encode = base64_encode($email.':'.hash('SHA256', $password));
                $auth = $db->selectWhere("*", "auth", "basic_token = '$encode'")[0];

                if($auth['basic_token'] != $encode) {
                    Handlers::error("Falha!", "Usuário ou senha inválidos.");

                } else {
                    $user_id = $auth['user_id'];
                    $map = $db->selectWhere("*", "users", "id = $user_id")[0];
                    Session::twoFactorAuthentication(User::fromMap($map));
                    
                }

            } catch (\Throwable $e) {
                throw $e;
            }
        }

        public function basicToken(Auth $auth): void {
            try {
                $db = new Database();
                $userController  = new UserController();
                $user = $auth->getUser();

                $user->setId($userController->findByEmail($user->getEmail())[0]['id']);
                $auth->setBasicToken(base64_encode($user->getEmail().":".hash("SHA256", $user->getPassword())));
                
                $db->insert("user_id, basic_token", "auth", $auth, [
                    $user->getId(),
                    $auth->getBasicToken(),
                ]);

            } catch (\PDOException $e) {
                throw $e;
            }
        }
        
        public function updateToken(User $user): void {
            $db = new Database();
            $auth = new Auth();
            $auth->setBasicToken(base64_encode($user->getEmail().":".hash("SHA256", $user->getPassword())));

            $columns = [
                "basic_token" => $auth->getBasicToken(),
            ];

            

            $db->update($columns, "auth", "user_id = ".$user->getId());
        }
        
    }