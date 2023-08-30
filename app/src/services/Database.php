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

        public function runQuery(string $query) {
            $pdo = $this->connect();
            $pdo->query($query);
        }

        public function select(string $columns, string $table): array {
            $pdo = $this->connect();
            $query = "SELECT $columns FROM $table";
            return $pdo->query($query)->fetchAll();
        }
    }