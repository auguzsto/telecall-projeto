<?php

namespace App\controllers;
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
    }