<?php

namespace App\controllers;

use App\models\User;
use App\services\Database;

    class UserController {
        
        public function create(User $user): void {
            $db = new Database();
            $db->insert("isadmin, first_name, last_name, mother_name, email, password, phone, cpf, cep, address, birth, created_at", "users", $user, [
                $user->getIsAdmin(),
                $user->getFirstName(), 
                $user->getLastName(),
                $user->getMotherName(),
                $user->getEmail(),
                password_hash($user->getPassword(), PASSWORD_BCRYPT),
                $user->getPhone(),
                $user->getCpf(),
                $user->getCep(),
                $user->getAddress(),
                $user->getBirth(),
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