<?php

namespace App\controllers;

use Exception;
use App\models\User;
use App\services\Logger;
use App\handlers\Handlers;
use App\services\Database;

    class UserController {

        private string $table = "users";
        
        public function create(User $user): void {
            try {
                $db = Database::getInstace();

                $columnsAndValues = [
                    "profile_id" => $user->getProfile()->getId(),
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

                $db->insert($columnsAndValues, $this->table);
                
                //Create basic token after register user.
                $authController = new AuthController();
                $authController->basicToken($user);

                Handlers::success("Sucesso", "Cadastro realizado");

            } catch (Exception $e) {
                str_contains($e->getMessage(), "cpf") ? Handlers::warning("Atenção", "CPF já cadastrado.") : null;
                str_contains($e->getMessage(), "phone") ? Handlers::warning("Atenção", "Celular já cadastrado.") : null;
                str_contains($e->getMessage(), "email") ? Handlers::warning("Atenção", "E-mail já cadastrado.") : null;
                str_contains($e->getMessage(), "bith") ? Handlers::warning("Atenção", "Verifque sua data de nascimento.") : null;
                throw $e;
            }

        }

        public function update(User $user): void {
            try {
                $userLogged = $_SESSION['session'];
                $db = Database::getInstace();
                $uuid = $user->getId();

                $columnsAndValues = [
                    "profile_id" => $user->getProfile()->getId(),
                    "email" => $user->getEmail(),
                    "cep" => $user->getCep(),
                    "address" => $user->getAddress(),
                    "phone" => $user->getPhone(),
                ];

                $db->update($columnsAndValues, $this->table, "id = '$uuid'");

                Handlers::success("Atualizado", "Operação realizada com sucesso");

                Logger::createDatabaseLog($userLogged->getEmail(), "atualização", "atualizou o usuário $uuid");

                } catch (Exception $e) {
                    str_contains($e->getMessage(), "cpf") ? Handlers::warning("Atenção", "CPF já cadastrado.") : null;
                    str_contains($e->getMessage(), "phone") ? Handlers::warning("Atenção", "Celular já cadastrado.") : null;
                    str_contains($e->getMessage(), "email") ? Handlers::warning("Atenção", "E-mail já cadastrado.") : null;
                    throw $e;
                }
        }

        public function updatePassword(User $user): void {
            try {
                $userLogged = $_SESSION['session'];
                $db = Database::getInstace();
                $authController = new AuthController();
                $uuid = $user->getId();

                $columnsAndValues = [
                    "password" => password_hash($user->getPassword(), PASSWORD_BCRYPT),
                ];

                $db->update($columnsAndValues, $this->table, "id = '$uuid'");
                $authController->updateToken($user);
                
                Handlers::success("Atualizado", "Operação realizada com sucesso");

                Logger::createDatabaseLog($userLogged->getEmail(), "atualização", "atualizou a senha do usuário ID $uuid");

                } catch (Exception $e) {
                    throw $e;
                }
         }

        public function delete(User $user): void {
            try {
                $userLogged = $_SESSION['session'];
                $db = Database::getInstace();
                $user->setDeleted_at(date('Y-m-d H:i:s'));
                $uuid = $user->getId();

                $columnsAndValues = [
                    "deleted_at" => $user->getDeleted_at(),
                ];

                $db->update($columnsAndValues, $this->table, "id = '$uuid'");
                $db->update($columnsAndValues, "auth", "user_id = '$uuid'");

                Handlers::success("Atualizado", "Operação realizada com sucesso");

                Logger::createDatabaseLog($userLogged->getEmail(), "exclusão", "excluiu o usuário ID $uuid");

                } catch (Exception $e) {
                    throw $e;
                }
         }

        public function findAll(): array {
            $db = Database::getInstace();
            return $db->select("*", $this->table)->orderDesc("created_at")->toArray();
        }

        public function findAllByName(string $first_name): array {
            $db = Database::getInstace();
            return $db->select("*", $this->table)->where("first_name")->like("$first_name")->orderDesc("created_at")->toArray();;
        }

        public function findAllByCpf(string $cpf): array {
            $db = Database::getInstace();
            return $db->select("*", $this->table)->where("cpf")->like("$cpf")->orderDesc("created_at")->toArray();;
        }

        public function findAllByEmail(string $email): array {
            $db = Database::getInstace();
            return $db->select("*", $this->table)->where("email")->like("$email")->orderDesc("created_at")->toArray();
        }

        public function findById(string $id): array {
            $db = Database::getInstace();
            return $db->select("*", $this->table)->where("id = '$id'")->toArray()[0];
        }


        public function findByEmail(string $email): array {
            $db = Database::getInstace();
            return $db->select("*", $this->table)->where("email = '$email'")->orderDesc("id")->toArray()[0];
        }
    }