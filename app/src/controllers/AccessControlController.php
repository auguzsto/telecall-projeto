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

            } catch (Exception $e) {
                throw $e;
            }
        }
        
        public function findById(int $id): array {
            try {
                $db = new Database();
                return $db->selectWhere("*", "access_control", "id = $id");

            } catch (Exception $e) {
                throw $e;
            }
        }

        public function create(AccessControl $accessControl): void {
            try {
                $db = new Database();

                $columnsAndValues = [
                    "description" => $accessControl->getDescrition(),
                    "permission_create" => $accessControl->getPermission_create(),
                    "permission_execute" => $accessControl->getPermission_execute(),
                    "permission_read" => $accessControl->getPermission_read(),
                    "permission_update" => $accessControl->getPermission_update(),
                    "permission_delete" => $accessControl->getPermission_create(),
                ];

                $db->insert($columnsAndValues, "access_control");

                Handlers::success("Feito", "Operação realizada com sucesso");

            } catch (Exception $e) {
                Handlers::error("Falha", "Ocorreu um erro inesperado", $e->getMessage());
                throw $e;
            }
        }

        public function update(AccessControl $accessControl): void {
            try {
                $db = new Database();

                $columnsAndValues = [
                    "description" => $accessControl->getDescrition(),
                    "permission_create" => $accessControl->getPermission_create(),
                    "permission_execute" => $accessControl->getPermission_execute(),
                    "permission_read" => $accessControl->getPermission_read(),
                    "permission_update" => $accessControl->getPermission_update(),
                    "permission_delete" => $accessControl->getPermission_delete(),
                ];

                $db->update($columnsAndValues, "access_control", "id = ".$accessControl->getId());

                Handlers::success("Feito", "As permissões do grupo foram atualizadas");
                
            } catch (Exception $e) {
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

            } catch (Exception $e) {
                Handlers::error("Error", "Ocorrue uma falha inesperada", $e->getMessage());
                throw $e;
            }
        }

        public function translateValue(string $permission): string {
            return $permission != "Y" ? "Não" : "Sim";
        }
    }