<?php

namespace App\controllers;
use App\models\Profile;
use App\services\Database;
use Exception;

    class AccessControlController {

        public static function getPermissionsByProfile(Profile $profile): array {
            try {
                $db = new Database();
                $profile_id = $profile->getId();
                return $db->query("
                    SELECT 
                        *
                    FROM 
                        profiles_modules_acl pma
                    WHERE pma.profile_id = $profile_id ORDER BY module_id ASC")->fetchAll();
                    
            } catch (Exception $e) {
                throw $e;
            }
        }
        
    }