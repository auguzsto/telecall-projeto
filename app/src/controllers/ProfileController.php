<?php

namespace App\controllers;
use App\handlers\Handlers;
use App\models\Profile;
use App\services\Logger;
use Exception;
use App\services\Database;

    class ProfileController {

        public static function findById(string $id): array {
            try {
                $db = Database::getInstace();
                $find = $db->select("*", "profiles")->where("id = '$id'")->toArray()[0];
                
                if($find != null) {
                    return $find;
                }

                return $db->select("*", "profiles")->where("id = 'be73c606-eb68-47e7-80f6-457ca8f52e62'")->toArray()[0];

            } catch (Exception $e) {
                throw $e;
            }
        }

        public static function findByName(string $name): array {
            try {
                $db = Database::getInstace();
                return $db->select("*", "profiles")->where("name = '$name'")->orderDesc("id")->toArray()[0];

            } catch (Exception $e) {
                throw $e;
            }
        }

        public static function findAll(): array {
            try {
                $db = Database::getInstace();
                return $db->select("*", "profiles")->orderDesc("id")->toArray();

            } catch (Exception $e) {
                throw $e;
            }
        }

        public static function create(Profile $profile): void {
            try {
                
                $userLogged = $_SESSION['session'];
                $db = Database::getInstace();

                $columnsAndValues = [
                    "name" => $profile->getName(),
                    "created_at" => date("Y-m-d H:i:s"),
                ];

                $db->insert($columnsAndValues, "profiles");

                Handlers::success("Feito", "Perfil criado.");
                $profileCreated = Profile::fromMap(ProfileController::findByName($profile->getName()));

                Logger::createDatabaseLog($userLogged->getEmail(), "inserção", "criou um novo perfil ID ". $profileCreated->getId());

            } catch (Exception $e) {
                throw $e;
            }
        }

        public static function update(Profile $profile): void {
            try {
                
                $db = Database::getInstace();
                $uuid = $profile->getId();

                $columnsAndValues = [
                    "name" => $profile->getName(),
                    "updated_at" => date("Y-m-d H:i:s"),
                ];

                $db->update($columnsAndValues, "profiles", "id = '$uuid'");

            } catch (Exception $e) {
                throw $e;
            }
        }

        public static function delete(Profile $profile): void {
            try {

                $userLogged = $_SESSION['session'];
                $db = Database::getInstace();
                $uuid = $profile->getId();

                $columnsAndValues = [
                    "deleted_at" => date("Y-m-d H:i:s"),
                ];

                $db->update($columnsAndValues, "profiles", "id = '$uuid'");

                Handlers::success("Feito", "Perfil excluído.");

                Logger::createDatabaseLog($userLogged->getEmail(), "exclusão", "excluiu o perfil ID ". $profile->getId());

            } catch (Exception $e) {
                throw $e;
            }
        }
    }