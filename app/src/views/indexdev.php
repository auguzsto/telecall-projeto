<?php

    $fileSQL = "db_22092023.php";
    $query = file_get_contents("app/src/db/$fileSQL");
    $migration = str_replace(["CREATE TABLE", "INSERT INTO"], ["CREATE TABLE IF NOT EXISTS", "REPLACE INTO"], $query);
    
    echo $migration;