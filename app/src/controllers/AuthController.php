<?php

namespace App\controllers;
use PDOException;
use App\models\Auth;
use App\models\User;
use App\services\Session;
use App\handlers\Handlers;
use App\services\Database;

    class AuthController {
        
        public function signIn(string $email, string $password): void {
            try {
                $db = new Database();

                $encode = base64_encode($email.':'.hash('SHA256', $password));
                $auth = $db->selectWhere("*", "auth", "deleted_at IS NULL and basic_token = '$encode'")[0];

                if($auth['basic_token'] != $encode) {
                    throw new PDOException("Usuário ou senha inválidos.");

                } else {
                    $user_id = $auth['user_id'];
                    $map = $db->selectWhere("*", "users", "id = $user_id")[0];
                    Session::twoFactorAuthentication(User::fromMap($map));
                    
                }

                throw new PDOException("Ocorreu um erro inesperado");

            } catch (PDOException $e) {
                Handlers::warning("Falha",  $e->getMessage());
            }
        }

        public function basicToken(User $user): void {
            try {
                $db = new Database();
                $auth = new Auth();
                $userController  = new UserController();

                $user->setId($userController->findByEmail($user->getEmail())[0]['id']);
                $auth->setBasicToken($user);
                $auth->setCreated_at();
                
                $columnsAndValues = [
                    "user_id" => $user->getId(),
                    "basic_token" => $auth->getBasicToken(),
                    "created_at" => $auth->getCreated_at(),
                ];

                $db->insert($columnsAndValues, "auth");

            } catch (PDOException $e) {
               Handlers::error("Error", "Erro ao criar token de autenticação", $e->getMessage());
               throw $e;
            }
        }
        
        public function updateToken(User $user): void {
            try {
                $db = new Database();
                $auth = new Auth();

                $auth->setBasicToken($user);

                $columnsAndValues = [
                    "basic_token" => $auth->getBasicToken(),
                ];

                $db->update($columnsAndValues, "auth", "user_id = ".$user->getId());

            } catch (PDOException $e) {
                Handlers::error("Error", "Erro ao atualizar token de autenticação", $e->getMessage());
                throw $e;
            }
        }
        
    }