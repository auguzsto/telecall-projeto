<?php

namespace App\services;

use App\models\User;

    class Logger {

        public static function createDatabaseLog(User $user, string $type_log): void {
            $db = new Database();

            $columnsAndValues = [
                "user_id" => $user->getId(),
                "type_log" => $type_log,
                "created_at" => date("Y-m-d H:m:s"),
            ];

            $db->insert($columnsAndValues, "log");
        }
        
        public static function createInFolderLog(string $getMessageException): void {
            $origin = $_SERVER['PATH_INFO'];
            $date = date("Y-m-d");
            $dateInLog = date("Y-m-d H:m:s");
            $log = "Origem: $origin - $dateInLog - $getMessageException\n";

            file_put_contents("./logs/log_".$date.".txt", $log, FILE_APPEND);
        }
    }