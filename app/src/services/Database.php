<?php

namespace App\services;

use PDO;
use PDOException;

    class Database {

        public function __construct() {
            $this->connect();
        }

        private function connect(): PDO {
            try {
                $pdo = new PDO("mysql:host=localhost;dbname=telecall", "root", "password");
                return $pdo;
                
            } catch (PDOException $e) {
                throw $e;
            }
        }

        public function select(string $columns, string $table): array {
            $pdo = $this->connect();
            return $pdo->query("SELECT $columns FROM $table")->fetchAll();
        }
    }