<?php

namespace App\services;
use App\config\Config;
use App\services\Database;

require __DIR__ . "/../../../config.php";

    class Migration {

        public static function auto(string $fileSQL, string $type): void {
            $db = new Database();
            global $config;

            switch($type) {

                case "default":
                    $query = file_get_contents("app/src/db/$fileSQL");
                    $migration = str_replace("CREATE TABLE", "CREATE TABLE IF NOT EXISTS", $query);
                    $db->query($migration);
                    break;
                
                case "rework":
                    $db->query("DROP DATABASE ". $config['database']);
                    
                    $query = file_get_contents("app/src/db/$fileSQL");
                    $migration = str_replace("CREATE TABLE", "CREATE OR REPLACE TABLE", $query);
                    $db->query($migration);
                    break;
            }
        }
    }