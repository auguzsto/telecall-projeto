<?php
namespace App\controllers;
use PDOException;
use App\services\Database;

    class ModuleController {

        public function findById(int $id): array {
            try {
                $db = new Database();

                return $db->selectWhere("*", "modules", "id = $id");
            } catch (PDOException $e) {
                throw $e;
            }
        }
    }