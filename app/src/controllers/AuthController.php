<?php

namespace App\controllers;
use App\models\Auth;
use App\models\User;
use App\services\Session;
use App\services\Database;

    class AuthController {
        
        public function signIn(string $email, string $password): void {
            try {
                $db = new Database();

                $encode = base64_encode($email.':'.hash('SHA256', $password));
                $auth = $db->selectWhere("*", "auth", "basic_token = '$encode'")[0];

                if($auth['basic_token'] != $encode) {
                    header("Location: /login");

                } else {
                    $user_id = $auth['user_id'];
                    $map = $db->selectWhere("*", "users", "id = $user_id")[0];
                    Session::create($this->createUser($map));
                    
                }

            } catch (\Throwable $e) {
                throw $e;
            }
        }

        private function createUser(array $map): User {
                $user = new User();
                $user->setId($map['id']);
                $user->setIsAdmin($map['isadmin']);
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

        public function basicToken(Auth $auth): void {
            try {
                $db = new Database();
                $userController  = new UserController();
                $user = $auth->getUser();

                $auth->getUser()->setId($userController->findByEmail($user->getEmail())[0][0]);
                $auth->setBasicToken(base64_encode($user->getEmail().":".hash("SHA256", $user->getPassword())));
                
                $db->insert("user_id, basic_token", "auth", $auth, [
                    $auth->getUser()->getId(),
                    $auth->getBasicToken(),
                ]);

            } catch (\PDOException $e) {
                throw $e;
            }
        }
        
    }