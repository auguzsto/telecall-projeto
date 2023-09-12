<?php

namespace App\models;
use App\models\User;

    class Address {
        private int $id;
        private User $user;
        private string $type;
        private string $cep;
        private string $street;
        private string $number;
        private string $created_at;
        private string $updated_at;
        private string $deleted_at;

        public static function fromMap(array $map): Address {
            $address = new self();
            isset($map['id']) ? $address->setId($map['id']) : null;
            $address->setUser(User::fromMap($map['user']));
            $address->setType($map['type']);
            $address->setCep($map['cep']);
            $address->setStreet($map['street']);
            $address->setNumber($map['number']);
            isset($map['created_at']) ? $address->setCreated_at($map['created_at']) : $address->setCreated_at(date("Y-m-d H:m:s"));

            return $address;
        }

        public function setId(int $id): void {
            $this->id = $id;
        }

        public function setUser(User $user): void {
            $this->user = $user;
        }

        public function setType(string $type): void {
            $this->type = $type;
        }

        public function setCep(string $cep): void {
            $this->cep = $cep;
        }
        
        public function setStreet(string $street): void {
            $this->street = $street;
        }

        public function setNumber(string $number): void {
            $this->number = $number;
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

        public function getUser(): User {
            return $this->user;
        }

        public function getType(): string {
            return $this->type;
        }

        public function getCep(): string {
            return $this->cep;
        }

        public function getStreet(): string {
            return $this->street;
        }

        public function getNumber(): string {
            return $this->number;
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