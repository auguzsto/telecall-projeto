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

                $encode = $this->encode($email, $password);
                $auth = Auth::fromMap($this->findByEncode($encode));
                
                Session::twoFactorAuthentication($auth->getUser());

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

        private function findByEncode(string $encode): array {
            try {
                $db = new Database();
                $find = $db->select("*", $this->table)->where("basic_token = '$encode'")->toArray()[0];

                if(empty($find)) {
                    throw new Exception("Usuário ou senha incorretos.");
                }

                return $find;

            } catch (Exception $e) {
                throw $e;
            }
        }

        private function encode(string $email, string $password): string {
            return base64_encode($email.':'.hash('SHA256', $password));
        }
        
    }