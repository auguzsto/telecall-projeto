<?php

namespace App\services;

use Exception;
use App\handlers\Handlers;

    class ACL {

        public static function checkIfUserThenPermissionToRead(int $thisModule): bool {
            try {

                $permission = (object) $_SESSION['permissions'][$thisModule];

                if($permission->permission_read != "Y") {
                    return false;
                }

                return true;

            } catch (Exception $e) {
                Handlers::warning("Negado", $e->getMessage());
                throw $e;
            }
        }
        
        public static function checkIfUserThenPermissionToInsert(int $thisModule): void {
            try {

                $permission = (object) $_SESSION['permissions'][$thisModule];

                if($permission->permission_create != "Y") {
                    throw new Exception("Você não possui permissão para inserção");
                }

            } catch (Exception $e) {
                Handlers::warning("Negado", $e->getMessage());
                throw $e;
            }
        }

        public static function checkIfUserThenPermissionToExecute(int $thisModule): void {
            try {

                $permission = (object) $_SESSION['permissions'][$thisModule];

                if($permission->permission_execute != "Y") {
                    throw new Exception("Você não possui permissão para executar.");
                }

            } catch (Exception $e) {
                Handlers::warning("Negado", $e->getMessage());
                throw $e;
            }
        }


        public static function checkIfUserThenPermissionToUpdate(int $thisModule): void {
            try {

                $permission = (object) $_SESSION['permissions'][$thisModule];

                if($permission->permission_update != "Y") {
                    throw new Exception("Você não possui permissão para atualizar.");
                }

            } catch (Exception $e) {
                Handlers::warning("Negado", $e->getMessage());
                throw $e;
            }
        }

        public static function checkIfUserThenPermissionToDelete(int $thisModule): void {
            try {

                $permission = (object) $_SESSION['permissions'][$thisModule];

                if($permission->permission_delete != "Y") {
                    throw new Exception("Você não possui permissão para deletar.");
                }

            } catch (Exception $e) {
                Handlers::warning("Negado", $e->getMessage());
                throw $e;
            }
        }
    }