<?php

namespace App\services;

use App\handlers\Handlers;
use App\models\User;
use PDOException;

    class Logger {

        public static function createDatabaseLog(User $user,int $changed_entity_id, string $type_log, string $description): void {
            try {
                $db = new Database();

                $columnsAndValues = [
                    "user_id" => $user->getId(),
                    "type_log" => $type_log,
                    "changed_entity_id" => $changed_entity_id,
                    "description" => $description,
                    "created_at" => date("Y-m-d H:i:s"),
                ];

                $db->insert($columnsAndValues, "log");

            } catch (PDOException $e) {
                Handlers::error("Error", "Erro ao tentar gerar log", $e->getMessage());
                throw $e;
            }
        }
        
        public static function createInFolderLog(string $getMessageException): void {
            $origin = $_SERVER['PATH_INFO'];
            $date = date("Y-m-d");
            $dateInLog = date("Y-m-d H:i:s");
            $log = "Origem: $origin - $dateInLog - $getMessageException\n";

            file_put_contents("./logs/log_".$date.".txt", $log, FILE_APPEND);
        }
    }