<?php

namespace App\services;

    class Logger {
        
        public static function createInFolderLog(string $origin, string $getMessageException): void {
            $date = date("Y-m-d");
            $dateInLog = date("Y-m-d H:m:s");
            $log = "Origem: $origin - $dateInLog - $getMessageException\n";

            file_put_contents("./logs/log_".$date.".txt", $log, FILE_APPEND);
        }
    }