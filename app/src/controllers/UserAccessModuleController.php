<?php

namespace App\controllers;
use PDOException;
use App\models\User;
use App\models\Module;
use App\services\Database;
use App\models\AccessControl;
use App\models\UserAccessModule;
use App\controllers\ModuleController;
use App\controllers\AccessControlController;

    class UserAccessModuleController {

        public function create(UserAccessModule $userAccessModule): void {
            try {
                $db = new Database();

                $columnsAndValues = [
                    "id_access_control" => $userAccessModule->getAccessControl()->getId(),
                    "user_id" => $userAccessModule->getUser()->getId(),
                    "module_id" => $userAccessModule->getModule()->getId(),
                ];

                $db->insert($columnsAndValues, "access_control_modules_users");

            } catch (PDOException $e) {
                throw $e;
            }
        }
        
        public function getRules(User $user): UserAccessModule {
            try {
                $db = new Database();

                $userAccessModule = new UserAccessModule();
                $accessControlController = new AccessControlController();
                $modulesController = new ModuleController();

                $findUserAccessModule = $db->selectWhere("*", "access_control_modules_users", "userd_id = ". $user->getId());
                
                $userAccessModule->setAccessControl(AccessControl::fromMap($accessControlController->findById($findUserAccessModule[0]['id_access_control'])));
                $userAccessModule->setUser($user);
                $userAccessModule->setModule(Module::fromMap($modulesController->findById($findUserAccessModule[0]['module_id'])));

                return $userAccessModule;

                 
            } catch (PDOException $e) {
                throw $e;
            }
        } 
    }