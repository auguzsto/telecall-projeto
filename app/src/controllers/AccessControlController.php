<?php

namespace App\controllers;
use App\models\AccessControl;
use Exception;
use PDOException;
use App\models\User;
use App\handlers\Handlers;
use App\services\Database;

    class AccessControlController {

        public function findAll(): array {
            try {
                $db = new Database();
                return $db->selectWhere("*", "access_control", "deleted_at IS NULL");

            } catch (PDOException $e) {
                throw $e;
            }
        }
        
        public function findById(int $id): array {
            try {
                $db = new Database();
                return $db->selectWhere("*", "access_control", "id = $id");

            } catch (PDOException $e) {
                throw $e;
            }
        }

        public function create(AccessControl $accessControl): void {
            try {
                $db = new Database();

                $columnsAndValues = [
                    "description" => $accessControl->getDescrition(),
                    "permission_create" => $accessControl->getPermission_create(),
                    "permission_read" => $accessControl->getPermission_read(),
                    "permission_update" => $accessControl->getPermission_update(),
                    "permission_delete" => $accessControl->getPermission_create(),
                ];

                $db->insert($columnsAndValues, "access_control");

                Handlers::success("Feito", "Operação realizada com sucesso");

            } catch (PDOException $e) {
                Handlers::error("Falha", "Ocorreu um erro inesperado", $e->getMessage());
            }
        }

        public function update(AccessControl $accessControl): void {
            try {
                $db = new Database();

                $columnsAndValues = [
                    "description" => $accessControl->getDescrition(),
                    "permission_create" => $accessControl->getPermission_create(),
                    "permission_read" => $accessControl->getPermission_read(),
                    "permission_update" => $accessControl->getPermission_update(),
                    "permission_delete" => $accessControl->getPermission_delete(),
                ];

                $db->update($columnsAndValues, "access_control", "id = ".$accessControl->getId());

                Handlers::success("Feito", "As permissões do grupo foram atualizadas");
            } catch (PDOException $e) {
                Handlers::error("Error", "Ocorrue uma falha inesperada", $e->getMessage());
                throw $e;
            }
        }

        public function delete(AccessControl $accessControl): void {
            try {
                $db = new Database();

                $columnsAndValues = [
                    "deleted_at" => date("Y-m-d H:i:s")
                ];

                $db->update($columnsAndValues, "access_control", "id = ".$accessControl->getId());

                Handlers::success("Feito", "A permissão foi deletada");

            } catch (PDOException $e) {
                Handlers::error("Error", "Ocorrue uma falha inesperada", $e->getMessage());
                throw $e;
            }
        }

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

                if($user->getAccessControl()->getPermission_update() != "Y") {
                    throw new Exception("Você não possui permissão para exclusão");
                }

            } catch (Exception $e) {
                Handlers::warning("Negado", $e->getMessage());
                throw $e;
            }
        }

        public function translateValue(string $permission): string {
            return $permission != "Y" ? "Não" : "Sim";
        }
    }