<?php

namespace App\models;

    class User {
        
        private int $id;
        private int $isAdmin;
        private string $first_name;
        private string $last_name;
        private string $email;
        private string $password;
        private string $phone;
        private string $cpf;
        private string $cep;
        private string $created_at;
        private string $updated_at;
        private string $deleted_at;

        public function setId(int $id): void {
            $this->id = $id;
        }

        public function setIsAdmin(bool $isAdmin): void {
            $this->isAdmin = $isAdmin;
        }

        public function setFirstName(string $first_name): void {
            $this->first_name = $first_name;
        }

        public function setLastName(string $last_name): void {
            $this->last_name = $last_name;
        }

        public function setEmail(string $email): void {
            $this->email = $email;
        }

        public function setPassword(string $password): void {
            $this->password = $password;
        }

        public function setPhone(string $phone): void {
            $this->phone = $phone;
        }

        public function setCpf(string $cpf): void {
            $this->cpf = $cpf;
        }

        public function setCep(string $cep): void {
            $this->cep = $cep;
        }

        public function setCreated_at(string $created_at): void {
            $this->created_at = $created_at;
        }

        public function setUpdated_at(string $updated_at): void {
            $this->updated_at = $updated_at;
        }

        public function setDeleted_at(string $deleted_at): void {
            $this->deleted_at = $deleted_at;
        }

        public function getId(): int {
            return $this->id;
        }

        public function getIsAdmin(): int {
            return $this->isAdmin;
        }

        public function getFirstName(): string {
            return $this->first_name;
        }

        public function getLastName(): string {
            return $this->last_name;
        }

        public function getEmail(): string {
            return $this->email;
        }

        public function getPassword(): string {
            return $this->password;
        }

        public function getPhone(): string {
            return $this->phone;
        }

        public function getCpf(): string {
            return $this->cpf;
        }

        public function getCep(): string {
            return $this->cep;
        }

        public function getCreated_at(): string {
            return $this->created_at;
        }
        
        public function getUpdate_at(): string {
            return $this->updated_at;
        }

        public function getDeleted_at(): string {
            return $this->deleted_at;
        }
    }