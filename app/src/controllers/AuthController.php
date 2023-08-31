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
                $basic_token = $db->selectWhere("*", "auth", "basic_token = '$encode'")[0]['basic_token'];

                if($basic_token != null) {
                        $user_id = $db->selectWhere("*", "auth", "basic_token = '$basic_token'")[0]['user_id'];
                        $map = $db->selectWhere("*", "users", "id = $user_id")[0];
    
                        Session::create($this->createUser($map));
                        
                } else {
                    header("Location: /login");
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
                $user->setEmail($map['email']);
                $user->setPassword($map['password']);
                $user->setPhone(strval($map['phone']));
                $user->setCep($map['cep']);
                $user->setCpf($map['cpf']);
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