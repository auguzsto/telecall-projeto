<?php

namespace App\controllers;
use App\handlers\Handlers;
use App\models\Profile;
use Exception;
use App\services\Database;

    class ProfileController {

        public static function findById(int $id): array {
            try {
                $db = new Database();
                return $db->selectWhere("*", "profiles", "id = ". $id)[0];

            } catch (Exception $e) {
                throw $e;
            }
        }

        public static function findByName(string $name): array {
            try {
                $db = new Database();
                return $db->selectWhere("*", "profiles", "name = '$name'")[0];

            } catch (Exception $e) {
                throw $e;
            }
        }

        public static function findAll(): array {
            try {
                $db = new Database();
                return $db->select("*", "profiles");

            } catch (Exception $e) {
                throw $e;
            }
        }

        public static function create(Profile $profile): void {
            try {
                $db = new Database();

                $columnsAndValues = [
                    "name" => $profile->getName(),
                ];

                $db->insert($columnsAndValues, "profiles");

            } catch (Exception $e) {
                throw $e;
            }
        }

        public static function delete(Profile $profile): void {
            try {
                $db = new Database();

                $columnsAndValues = [
                    "deleted_at" => date("Y-m-d H:i:s"),
                ];

                $db->update($columnsAndValues, "profiles", "id = " . $profile->getId());

                Handlers::success("Feito", "Perfil excluído.");

            } catch (Exception $e) {
                throw $e;
            }
        }
    }