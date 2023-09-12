<?php

namespace App\models;

    class User {
        
        private int $id;
        private int $isAdmin;
        private string $first_name;
        private string $last_name;
        private string $mother_name;
        private string $email;
        private string $password;
        private string $phone;
        private string $cpf;
        private string $cep;
        private string $address;
        private string $birth;
        private string $created_at;
        private string $updated_at;
        private string $deleted_at;

        public static function fromMap(array $map): User {
            $user = new self();
            isset($map['id']) ? $user->setId($map['id']) : null;
            isset($map['isadmin']) ? $user->setIsAdmin($map['isadmin']) : $user->setIsAdmin(0);
            $user->setFirstName($map['first_name']);
            $user->setLastName($map['last_name']);
            $user->setMotherName($map['mother_name']);
            $user->setEmail($map['email']);
            $user->setPassword($map['password']);
            $user->setPhone(strval($map['phone']));
            $user->setCpf($map['cpf']);
            $user->setCep($map['cep']);
            $user->setAddress($map['address']);
            $user->setBirth($map['birth']);
            $user->setCreated_at($map['created_at']);

            return $user;
    }

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

        public function setMotherName(string $mother_name): void {
            $this->mother_name = $mother_name;
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

        public function setAddress(string $address): void {
            $this->address = $address;
        }
        public function setBirth(string $birth): void {
            $this->birth = $birth;
        }

        public function setCreated_at(string $date): void {
            $this->created_at = $date;
        }

        public function setUpdated_at(string $date): void {
            $this->updated_at = $date;
        }

        public function setDeleted_at(string $date): void {
            $this->deleted_at = $date;
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

        public function getMotherName(): string {
            return $this->mother_name;
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

        public function getAddress(): string {
            return $this->address;
        }

        public function getBirth(): string {
            return $this->birth;
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