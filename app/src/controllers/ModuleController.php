<?php

namespace App\controllers;
use App\services\Database;
use Exception;

    class ModuleController {

        public static function findById(int $id): array {
            try {
                $db = Database::getInstace();
                return $db->select("*", "modules")->where("id = $id")->toArray()[0];

            } catch (Exception $e) {
                throw $e;
            }
        }

        public static function findAll(): array {
            try {
                $db = Database::getInstace();
                return $db->select("*", "modules")->orderDesc("id")->toArray();

            } catch (Exception $e) {
                throw $e;
            }
        }

    }