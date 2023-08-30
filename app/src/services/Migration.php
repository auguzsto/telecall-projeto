<?php

namespace App\services;
use App\services\Database;

    class Migration {

        public static function auto(string $fileSQL): void {
            $db = new Database();
            $query = file_get_contents("app/src/db/$fileSQL");
            $db->con()->query($query);
        }
    }