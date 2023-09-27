<?php

namespace App\controllers;
use Exception;
use App\models\Auth;
use App\models\User;
use App\services\Session;
use App\handlers\Handlers;
use App\services\Database;

    class AuthController {

        private string $table = "auth";
        
        public function signIn(string $email, string $password): void {
            try {
                $db = new Database();

                $encode = base64_encode($email.':'.hash('SHA256', $password));
                $auth = $db->selectWhere("*", $this->table, "deleted_at IS NULL and basic_token = '$encode'")[0];

                if($auth['basic_token'] != $encode) {
                    throw new Exception("Usuário ou senha incorretos.");

                } else {
                    $user_id = $auth['user_id'];
                    $map = $db->selectWhere("*", "users", "id = $user_id")[0];
                    Session::twoFactorAuthentication(User::fromMap($map));
                    
                }

            } catch (Exception $e) {
                Handlers::warning("Falha", $e->getMessage());
                throw $e;
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

                $db->insert($columnsAndValues, $this->table);

            } catch (Exception $e) {
               Handlers::error("Problema", "Erro ao criar token de autenticação", $e->getMessage());
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

                $db->update($columnsAndValues, $this->table, "user_id = ".$user->getId());

            } catch (Exception $e) {
                Handlers::error("Problema", "Erro ao atualizar token de autenticação", $e->getMessage());
                throw $e;
            }
        }
        
    }