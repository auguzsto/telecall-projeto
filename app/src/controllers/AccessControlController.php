<?php

namespace App\controllers;
use App\handlers\Handlers;
use App\models\Module;
use App\models\Profile;
use App\services\Database;
use App\services\Logger;
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

        public static function getPermissionByProfileAndModule(Profile $profile, int $module_id): array {
            try {
                $db = new Database();
                $profile_id = $profile->getId();
                return $db->select("*", "profiles_modules_acl")->where("profile_id = $profile_id")->and("module_id = $module_id")->toArray()[0];

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
                        "permission_read" => "N",
                        "permission_create" => "N",
                        "permission_update" => "N",
                        "permission_delete" => "N",
                    ];

                    $db->insert($columnsAndValues, "profiles_modules_acl");
                    
                }

                Handlers::success("Feito", "Permissões criadas.");

            } catch (Exception $e) {
                throw $e;
            }
        }

        public static function updatePermissionInProfile(array $columnsAndValues, Profile $profile, int $module_id): void {
            try {
                
                $db = new Database();
                $profile_id = $profile->getId();

                $db->update($columnsAndValues, "profiles_modules_acl", "module_id = $module_id AND profile_id = $profile_id");
                ProfileController::update($profile);

                Handlers::success("Feito", "Permissões atulizadas.");

            } catch (Exception $e) {
                throw $e;
            }
        }
        
    }