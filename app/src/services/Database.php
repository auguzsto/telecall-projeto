<?php

namespace App\services;

use App\handlers\Handlers;
use PDO;
use PDOException;
use PDOStatement;
use App\config\Config;

    class Database {

        public function __construct() {
            $this->doCon();
        }

        private function doCon(): void {
            try {
                $this->con();
            } catch (PDOException $e) {
                Handlers::error("Sem conexão", "Não foi possível conectar ao banco de dados, verifique se os dados de conexão estão corretos.");
            }
        }

        private function conToMigration(): PDO {
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

        public function update(array $columns, string $table, string $where) {
            $pdo = $this->con();
            $set = implode("=?, ", array_keys($columns));
            $pdo->prepare("UPDATE $table SET $set = ? WHERE $where")->execute(array_values($columns));
            $pdo->prepare("UPDATE $table SET updated_at = ? WHERE $where")->execute([date('Y-m-d H:i:s')]);
        }

        public function select(string $columns, string $table): array {
            $pdo = $this->con();
            
            return $pdo->query("SELECT $columns FROM $table")->fetchAll();
        }

        public function selectWhere(string $columns, string $table, string $whereCondition): array {
            $pdo = $this->con();
            
            return $pdo->query("SELECT $columns FROM $table WHERE $whereCondition")->fetchAll();
        }
        public function selectWhereLike(string $columns, string $table, string $where, string $value): array {
            $pdo = $this->con();
            
            return $pdo->query("SELECT $columns FROM $table WHERE $where LIKE '%$value%'")->fetchAll();
        }
    }