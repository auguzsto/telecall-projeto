<?php

namespace App\controllers;
use App\services\Database;
use Exception;

    class ModuleController {

        public static function findById(int $id): array {
            try {
                $db = new Database();
                return $db->selectWhere("*", "modules", "id = ". $id);

            } catch (Exception $e) {
                throw $e;
            }
        }

    }