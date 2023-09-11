<?php

namespace App\models;

use App\models\User;

    class Auth {
        
        private int $id;
        private User $user;
        private string $basic_token;


        public function setId(int $id): void {
            $this->id = $id;
        }

        public function setUser(User $user): void {
            $this->user = $user;
        }

        public function setBasicToken(User $user): void {
            $this->basic_token = base64_encode($user->getEmail().":".hash("SHA256", $user->getPassword()));
        }

        public function getId(): int {
            return $this->id;
        }

        public function getUser(): User {
            return $this->user;
        }

        public function getBasicToken(): string {
            return $this->basic_token;
        }
    }