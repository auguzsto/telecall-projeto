<?php

namespace App\controllers;

use App\handlers\Handlers;
use App\models\User;
use App\services\Database;
use PDOException;

    class UserController {
        
        public function create(User $user): void {
            try {
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

                Handlers::success("Sucesso", "Cadastro realizado");

            } catch (PDOException $e) {
                $m = $e->getMessage();
                echo $m;
                str_contains($m, 'birth') ? Handlers::warning("Atenção", "Verifique sua data de nascimento") : null;
                str_contains($m, 'phone') ? Handlers::warning("Atenção", "Número de celular já cadastrado") : null;
                str_contains($m, 'cpf') ? Handlers::warning("Atenção", "CPF já cadastrado") : null;
                str_contains($m, 'email') ? Handlers::warning("Atenção", "E-mail já cadastrado") : null;
            }

        }

        public function findAll(): array {
            $db = new Database();

            return $db->select("*", "users");
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