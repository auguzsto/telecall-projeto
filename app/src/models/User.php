<?php

namespace App\models;
use App\models\Model;
use App\models\Profile;
use App\controllers\ProfileController;

    class User extends Model {
        private Profile $profile;
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

        public static function fromMap(array $map): User {
            $user = new self();
            isset($map['id']) ? $user->setId($map['id']) : null;
            $user->setProfile(Profile::fromMap($user->getArrayProfileById($map['profile_id'])));
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

        public function getArrayProfileById(string $profile_id): array {
            return ProfileController::findById($profile_id);
        }
        
        public function setProfile(Profile $profile): void {
            $this->profile = $profile;
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

        public function getProfile(): Profile {
            return $this->profile;
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

}