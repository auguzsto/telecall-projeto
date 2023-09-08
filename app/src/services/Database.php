<?php

namespace App\services;

use App\handlers\Handlers;
use PDO;
use PDOException;
use PDOStatement;
use App\config\Config;

    class Database {

        public function __construct() {
           $this->con();
        }

        protected function conToMigration(): PDO {
            try {
                $host = Config::$dbhost;
                $port = Config::$dbport;
                $dbuser = Config::$dbuser;
                $dbpassword = Config::$dbpassword;

                $pdo = new PDO("mysql:host=$host:$port;", "$dbuser", "$dbpassword");
                return $pdo;

            } catch (PDOException $e) {
                throw $e;
            }
        }

        private function con(): PDO {

            $host = Config::$dbhost;
            $port = Config::$dbport;
            $dbname = Config::$dbdatabase;
            $dbuser = Config::$dbuser;
            $dbpassword = Config::$dbpassword;

            try {
                $pdo = new PDO("mysql:host=$host:$port;dbname=$dbname", "$dbuser", "$dbpassword");
                return $pdo;
                
            } catch (PDOException $e) {
                return $this->conToMigration();
            }
        }

        public function query(string $query): PDOStatement {
            $pdo = $this->con();
            return $pdo->query($query);
        }

        public function insert(string $columns, string $table, mixed $entity, array $setValues) {
            $pdo = $this->con();
            $array = (array) $entity;
            $numberValues = substr(str_repeat("?,", count($array)), 0, -1);

            $pdo->prepare("INSERT INTO $table ($columns) VALUES ($numberValues)")->execute($setValues);
        }

        public function select(string $columns, string $table): array {
            $pdo = $this->con();
            
            return $pdo->query("SELECT $columns FROM $table")->fetchAll();
        }

        public function selectWhere(string $columns, string $table, string $whereCondition): array {
            $pdo = $this->con();
            
            return $pdo->query("SELECT $columns FROM $table WHERE $whereCondition")->fetchAll();
        }
    }