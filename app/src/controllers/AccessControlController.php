<?php

namespace App\controllers;
use App\handlers\Handlers;
use App\models\Module;
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

        public static function createPermissionsDefault(Profile $profile): void {
            try {
                $db = new Database();
                $modules = ModuleController::findAll();

                foreach($modules as $row) {
                    $module = Module::fromMap(ModuleController::findById($row['id']));
                
                    $columnsAndValues = [
                        "profile_id" => $profile->getId(),
                        "module_id" => $module->getId(),
                        "permission_read" => "Y",
                        "permission_create" => "N",
                        "permission_update" => "Y",
                        "permission_delete" => "N",
                    ];

                    $db->insert($columnsAndValues, "profiles_modules_acl");
                    
                }

                Handlers::success("Feito", "Perfil criado.");

            } catch (Exception $e) {
                throw $e;
            }
        }
        
    }