<?php

namespace App\services;

use Exception;
use App\models\User;
use App\handlers\Handlers;

    class ACL {
        
        public static function checkIfUserThenPermissionToInsert(User $user): void {
            try {

                if($user->getAccessControl()->getPermission_create() != "Y") {
                    throw new Exception("Você não possui permissão para inserção");
                }

            } catch (Exception $e) {
                Handlers::warning("Negado", $e->getMessage());
                throw $e;
            }
        }

        public static function checkIfUserThenPermissionToExecute(User $user): void {
            try {

                if($user->getAccessControl()->getPermission_execute() != "Y") {
                    throw new Exception("Você não possui permissão para inserção");
                }

            } catch (Exception $e) {
                Handlers::warning("Negado", $e->getMessage());
                throw $e;
            }
        }


        public static function checkIfUserThenPermissionToUpdate(User $user): void {
            try {

                if($user->getAccessControl()->getPermission_update() != "Y") {
                    throw new Exception("Você não possui permissão para atualização");
                }

            } catch (Exception $e) {
                Handlers::warning("Negado", $e->getMessage());
                throw $e;
            }
        }

        public static function checkIfUserThenPermissionToDelete(User $user): void {
            try {

                if($user->getAccessControl()->getPermission_delete() != "Y") {
                    throw new Exception("Você não possui permissão para exclusão");
                }

            } catch (Exception $e) {
                Handlers::warning("Negado", $e->getMessage());
                throw $e;
            }
        }
    }