<?php

namespace App\controllers;

use PDOException;
use App\models\Auth;
use App\models\User;
use App\handlers\Handlers;
use App\services\Database;

    class UserController {
        
        public function create(User $user): void {
            try {
                $db = new Database();
                $db->insert("isadmin, first_name, last_name, mother_name, email, password, phone, cpf, birth, created_at", "users", $user, [
                $user->getIsAdmin(),
                $user->getFirstName(), 
                $user->getLastName(),
                $user->getMotherName(),
                $user->getEmail(),
                password_hash($user->getPassword(), PASSWORD_BCRYPT),
                $user->getPhone(),
                $user->getCpf(),
                $user->getBirth(),
                $user->getCreated_at(),
            ]);
            
            //Create basic token after register user.
            $auth = new Auth();
            $authController = new AuthController();

            $auth->setUser($user);
            $authController->basicToken($auth);

            Handlers::success("Sucesso", "Cadastro realizado");

            } catch (PDOException $e) {
                $m = $e->getMessage();
                str_contains($m, 'birth') ? Handlers::warning("Atenção", "Verifique sua data de nascimento") : null;
                str_contains($m, 'phone') ? Handlers::warning("Atenção", "Número de celular já cadastrado") : null;
                str_contains($m, 'cpf') ? Handlers::warning("Atenção", "CPF já cadastrado") : null;
                str_contains($m, 'email') ? Handlers::warning("Atenção", "E-mail já cadastrado") : null;
            }

        }

        public function update(User $user): void {
           try {
            $db = new Database();
            $authController = new AuthController();

            $columns = [
                "password" => password_hash($user->getPassword(), PASSWORD_BCRYPT)
            ];

            $db->update($columns, "users", "id = ".$user->getId());
            $authController->updateToken($user);

            Handlers::success("Atualizado", "Operação realizada com sucesso");
            
           } catch (PDOException $e) {
               Handlers::error("Falha", "Ocorreu um problema de execução");
           }
        }

        public function delete(User $user): void {
            try {
             $db = new Database();
             $user->setDeleted_at(date('Y-m-d H:m:s'));
             
             $columns = [
                 "deleted_at" => $user->getDeleted_at(),
             ];
 
             $db->update($columns, "users", "id = ".$user->getId());
 
             Handlers::success("Atualizado", "Operação realizada com sucesso");
             
            } catch (PDOException $e) {
                Handlers::error("Falha", "Ocorreu um problema de execução");
            }
         }

         public function reactive(User $user): void {
            try {
             $db = new Database();
 
             $columns = [
                 "deleted_at" => NULL,
             ];
 
             $db->update($columns, "users", "id = ".$user->getId());
 
             Handlers::success("Atualizado", "Operação realizada com sucesso");
             
            } catch (PDOException $e) {
                Handlers::error("Falha", "Ocorreu um problema de execução");
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