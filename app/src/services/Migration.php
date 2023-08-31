<?php

namespace App\services;
use App\services\Database;

    class Migration {

        public static function auto(string $fileSQL, string $type): void {
            $db = new Database();

            switch($type) {

                case "default":
                    $query = file_get_contents("app/src/db/$fileSQL");
                    $migration = str_replace("CREATE TABLE", "CREATE TABLE IF NOT EXISTS", $query);
                    $db->query($migration);
                    break;
                
                case "replace":
                    $query = file_get_contents("app/src/db/$fileSQL");
                    $migration = str_replace("CREATE TABLE", "CREATE OR REPLACE TABLE", $query);
                    $db->query($migration);
                    break;
            }
        }
    }