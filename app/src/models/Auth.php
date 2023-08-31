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

        public function setBasicToken(string $basic_token): void {
            $this->basic_token = $basic_token;
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