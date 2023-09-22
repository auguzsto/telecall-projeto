<?php

namespace App\controllers;
use Exception;
use PDOException;
use App\models\User;
use App\handlers\Handlers;
use App\services\Database;

    class GroupsPermissionsAclController {

        public function findAll(): array {
            try {
                $db = new Database();
                return $db->select("*", "groups_permissions_acl");

            } catch (PDOException $e) {
                throw $e;
            }
        }
        
        public function findById(int $id): array {
            try {
                $db = new Database();
                return $db->selectWhere("*", "groups_permissions_acl", "id = $id");

            } catch (PDOException $e) {
                throw $e;
            }
        }

        public static function checkIfUserThenPermissionToInsert(User $user): void {
            try {

                if($user->getGroupsPermissionsAcl()->getPermission_create() != "Y") {
                    throw new Exception("Você não possui permissão para inserção");
                }

            } catch (Exception $e) {
                Handlers::warning("Negado", $e->getMessage());
                throw $e;
            }
        }


        public static function checkIfUserThenPermissionToUpdate(User $user): void {
            try {

                if($user->getGroupsPermissionsAcl()->getPermission_update() != "Y") {
                    throw new Exception("Você não possui permissão para atualização");
                }

            } catch (Exception $e) {
                Handlers::warning("Negado", $e->getMessage());
                throw $e;
            }
        }

        public static function checkIfUserThenPermissionToDelete(User $user): void {
            try {

                if($user->getGroupsPermissionsAcl()->getPermission_update() != "Y") {
                    throw new Exception("Você não possui permissão para exclusão");
                }

            } catch (Exception $e) {
                Handlers::warning("Negado", $e->getMessage());
                throw $e;
            }
        }
    }