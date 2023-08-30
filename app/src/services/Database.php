<?php

namespace App\services;

use PDO;
use PDOException;

    class Database {

        public function __construct() {
            $this->con();
        }

        public function con(): PDO {
            try {
                $pdo = new PDO("mysql:host=localhost;dbname=telecall", "root", "password");
                return $pdo;
                
            } catch (PDOException $e) {
                throw $e;
            }
        }

        public function insert(string $columns, string $table, mixed $entity, array $setValues) {
            $pdo = $this->con();
            $array = (array) $entity;
            $numberValues = substr(str_repeat("?,", count($array)), 0, -1);

            $pdo->prepare("INSERT INTO $table ($columns) VALUES ($numberValues)")->execute($setValues);
        }

        public function select(string $columns, string $table): array {
            $pdo = $this->con();
            
            return $pdo->prepare("SELECT $columns FROM $table")->fetchAll();
        }
    }