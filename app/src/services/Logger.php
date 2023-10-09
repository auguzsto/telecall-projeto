<?php

namespace App\services;

use App\handlers\Handlers;
use App\models\User;
use Exception;

    class Logger {

        public static function createDatabaseLog(string $author, string $type, string $description): void {
            try {
                $db = Database::getInstace();

                $columnsAndValues = [
                    "author" => $author,
                    "type" => $type,
                    "description" => $description,
                    "created_at" => date("Y-m-d H:i:s"),
                ];

                $db->insert($columnsAndValues, "log");

            } catch (Exception $e) {
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

        public static function get(): array {
            try {
                $db = Database::getInstace();
                return $db->select("*", "log")->orderDesc("created_at")->toArray();
                
            } catch (Exception $e) {
                throw $e;
            }
        }
    }