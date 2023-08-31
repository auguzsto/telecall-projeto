<?php

namespace App\controllers;

use App\models\User;
use App\services\Database;

    class UserController {
        
        public function create(User $user): void {
            $db = new Database();
            $db->insert("isadmin, first_name, last_name, email, password, phone, cep, cpf, created_at", "users", $user, [
                $user->getIsAdmin(),
                $user->getFirstName(), 
                $user->getLastName(),
                $user->getEmail(),
                password_hash($user->getPassword(), PASSWORD_BCRYPT),
                $user->getPhone(),
                $user->getCep(),
                $user->getCpf(),
                $user->getCreated_at(),
            ]);
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