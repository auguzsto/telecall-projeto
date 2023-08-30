<?php

namespace App\controllers;

use App\models\User;
use App\services\Database;

    class UserController {
        
        public function create(User $user): void {
            $db = new Database();
            $db->insert("isadmin, first_name, last_name, email, password, phone, cep, cpf", "users", $user, [
                $user->getIsAdmin(),
                $user->getFirstName(), 
                $user->getLastName(),
                $user->getEmail(),
                password_hash($user->getPassword(), PASSWORD_BCRYPT),
                $user->getPhone(),
                $user->getCep(),
                $user->getCpf(),
            ]);
            
        }
    }