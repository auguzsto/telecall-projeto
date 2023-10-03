<?php

namespace App\models;
use App\controllers\UserController;
use App\models\User;

    class Auth {
        
        private int $id;
        private User $user;
        private string $basic_token;
        private string $created_at;
        private string $updated_at;
        private string $deleted_at;

        public static function fromMap(array $map): Auth {
            $auth = new self();
            $userController = new UserController();

            $user = User::fromMap($userController->findById($map['user_id']));
            $auth->setId($map['id']);
            $auth->setUser($user);
            $auth->setBasicToken($user);

            return $auth;
        }

        public function setId(int $id): void {
            $this->id = $id;
        }

        public function setUser(User $user): void {
            $this->user = $user;
        }

        public function setBasicToken(User $user): void {
            $this->basic_token = base64_encode($user->getEmail().":".hash("SHA256", $user->getPassword()));
        }

        public function setCreated_at(): void {
            $this->created_at = date('Y-m-d H:i:s');
        }

        public function setUpdated_at(): void {
            $this->updated_at = date('Y-m-d H:i:s');
        }

        public function setDeleted_at(): void {
            $this->deleted_at = date('Y-m-d H:i:s');
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

        public function getCreated_at(): string {
            return $this->created_at;
        }

        public function getUpdated_at(): string {
            return $this->updated_at;
        }

        public function getDeleted_at(): string {
            return $this->deleted_at;
        }
    }