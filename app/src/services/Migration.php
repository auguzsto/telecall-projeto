<?php

namespace App\services;
use App\config\Config;
use App\handlers\Handlers;
use App\services\Database;
use PDOException;

require __DIR__ . "/../../../config.php";

    class Migration {

        public static function auto(string $fileSQL, string $type): void {
            $db = new Database();
            global $config;

            switch($type) {

                case "default":
                    try {
                        $query = file_get_contents("app/src/db/$fileSQL");
                        $migration = str_replace(["CREATE TABLE", "INSERT INTO"], ["CREATE TABLE IF NOT EXISTS", "REPLACE INTO"], $query);
                        $db->query($migration);
                        break;
                        
                    } catch (PDOException $e) {
                        throw $e;
                    }
                
                case "rework":
                    $db->query("DROP DATABASE ". $config['database']);
                    
                    $query = file_get_contents("app/src/db/$fileSQL");
                    $migration = str_replace(["CREATE TABLE", "INSERT INTO"], ["CREATE TABLE IF NOT EXISTS", "REPLACE INTO"], $query);
                    $db->query($migration);
                    break;
            }
        }
    }