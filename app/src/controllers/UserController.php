<?php

namespace App\controllers;

use PDOException;
use App\models\User;
use App\services\Logger;
use App\handlers\Handlers;
use App\services\Database;

    class UserController {
        
        public function create(User $user): void {
            try {
                $db = new Database();

                $columnsAndValues = [
                    "isadmin" => $user->getIsAdmin(),
                    "first_name" =>$user->getFirstName(), 
                    "last_name" => $user->getLastName(),
                    "mother_name" => $user->getMotherName(),
                    "email" => $user->getEmail(),
                    "password" => password_hash($user->getPassword(), PASSWORD_BCRYPT),
                    "phone" => $user->getPhone(),
                    "cpf" => $user->getCpf(),
                    "cep" => $user->getCep(),
                    "address" => $user->getAddress(),
                    "birth" => $user->getBirth(),
                    "created_at" => $user->getCreated_at(),
                ];

                $db->insert($columnsAndValues, "users");
                
                //Create basic token after register user.
                $authController = new AuthController();
                $authController->basicToken($user);

                Handlers::success("Sucesso", "Cadastro realizado");

            } catch (PDOException $e) {
                str_contains($e->getMessage(), "cpf") ? Handlers::warning("Atenção", "CPF já cadastrado.") : null;
                str_contains($e->getMessage(), "phone") ? Handlers::warning("Atenção", "Celular já cadastrado.") : null;
                str_contains($e->getMessage(), "email") ? Handlers::warning("Atenção", "E-mail já cadastrado.") : null;
                str_contains($e->getMessage(), "bith") ? Handlers::warning("Atenção", "Verifque sua data de nascimento.") : null;
            }

        }

        public function update(User $user): void {
            try {
                $userLogged = $_SESSION['session'];
                $db = new Database();

                $columnsAndValues = [
                    "email" => $user->getEmail(),
                    "cep" => $user->getCep(),
                    "address" => $user->getAddress(),
                    "phone" => $user->getPhone(),
                ];

                $db->update($columnsAndValues, "users", "id = ".$user->getId());

                Handlers::success("Atualizado", "Operação realizada com sucesso");

                Logger::createDatabaseLog($userLogged, $user->getId(), "atualização", "atualizou o usuário ".$user->getId());

                } catch (PDOException $e) {
                    str_contains($e->getMessage(), "cpf") ? Handlers::warning("Atenção", "CPF já cadastrado.") : null;
                    str_contains($e->getMessage(), "phone") ? Handlers::warning("Atenção", "Celular já cadastrado.") : null;
                    str_contains($e->getMessage(), "email") ? Handlers::warning("Atenção", "E-mail já cadastrado.") : null;
                    throw $e;
                }
        }

        public function updatePassword(User $user): void {
            try {
                $userLogged = $_SESSION['session'];
                $db = new Database();
                $authController = new AuthController();

                $columnsAndValues = [
                    "password" => password_hash($user->getPassword(), PASSWORD_BCRYPT),
                ];

                $db->update($columnsAndValues, "users", "id = ".$user->getId());
                $authController->updateToken($user);
                
                Handlers::success("Atualizado", "Operação realizada com sucesso");

                Logger::createDatabaseLog($userLogged, $user->getId(), "atualização", "atualizou a senha do usuário ". $user->getId());

                } catch (PDOException $e) {
                    Handlers::error("Falha", "Ocorreu um problema de execução", $e->getMessage());
                    throw $e;
                }
         }

        public function delete(User $user): void {
            try {
                $userLogged = $_SESSION['session'];
                $db = new Database();
                $user->setDeleted_at(date('Y-m-d H:i:s'));

                $columnsAndValues = [
                    "deleted_at" => $user->getDeleted_at(),
                ];

                $db->update($columnsAndValues, "users", "id = ".$user->getId());
                $db->update($columnsAndValues, "auth", "user_id =".$user->getId());

                Handlers::success("Atualizado", "Operação realizada com sucesso");

                Logger::createDatabaseLog($userLogged, $user->getId(), "exclusão", "deletou o usuário ".$user->getId());

                } catch (PDOException $e) {
                    Handlers::error("Falha", "Ocorreu um problema de execução", $e->getMessage());
                }
         }

        public function findAll(): array {
            $db = new Database();

            return $db->selectWhere("*", "users", "deleted_at IS NULL");
        }

        public function findByName(string $first_name): array {
            $db = new Database();

            return $db->selectWhereLike("*", "users", "deleted_at IS NULL and first_name", $first_name);
        }

        public function findById(int $id): array {
            $db = new Database();

            return $db->selectWhere("*", "users", "id = $id");
        }

        public function findByEmail(string $email): array {
            $db = new Database();

            return $db->selectWhere("*", "users", "email = '$email'");
        }
    }