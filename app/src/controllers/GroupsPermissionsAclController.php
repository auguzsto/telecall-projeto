<?php

namespace App\controllers;
use PDOException;
use App\services\Database;

    class GroupsPermissionsAclController {
        
        public function findById(int $id): array {
            try {
                $db = new Database();
                return $db->selectWhere("*", "groups_permissions_acl", "id = $id");

            } catch (PDOException $e) {
                throw $e;
            }
        }
    }