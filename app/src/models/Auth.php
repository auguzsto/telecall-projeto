<?php

namespace App\models;
use App\models\User;
use App\models\Model;
use App\controllers\UserController;

    class Auth extends Model {

        private User $user;
        private string $basic_token;

        public static function fromMap(array $map): Auth {
            $auth = new self();
            $userController = new UserController();

            $user = User::fromMap($userController->findById($map['user_id']));
            $auth->setId($map['id']);
            $auth->setUser($user);
            $auth->setBasicToken($user);

            return $auth;
        }

        public function setUser(User $user): void {
            $this->user = $user;
        }

        public function setBasicToken(User $user): void {
            $this->basic_token = base64_encode($user->getEmail().":".hash("SHA256", $user->getPassword()));
        }

        public function getUser(): User {
            return $this->user;
        }

        public function getBasicToken(): string {
            return $this->basic_token;
        }
        
    }