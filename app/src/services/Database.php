<?php

namespace App\services;

use App\handlers\Handlers;
use Exception;
use PDO;
use PDOStatement;

require __DIR__ . "/../../../config.php";

    class Database {

        public function __construct() {
            $this->doCon();
        }

        private function doCon(): void {
            try {
                $this->con();

            } catch (Exception $e) {
                Handlers::error("Sem conexão", "Não foi possível conectar ao banco de dados. <br/> Verifique se os dados de conexão estão corretos.", $e->getMessage());
                throw $e;
            }
        }
        
        private function con(): PDO {
            try {
                global $config;
                $host = $config['host'];
                $port = $config['port'];
                $dbname = $config['database'];
                $dbuser = $config['user'];
                $dbpassword = $config['password'];

                $pdo = new PDO("mysql:host=$host:$port;dbname=$dbname", "$dbuser", "$dbpassword");
                return $pdo;
                
            } catch (Exception $e) {
                $pdo = new PDO("mysql:host=$host:$port;", "$dbuser", "$dbpassword");
                return $pdo;
            }
        }

        public function query(string $query): PDOStatement {
            try {
                $pdo = $this->con();
                return $pdo->query($query);

            } catch (Exception $e) {
                throw $e;
            }
        }

        public function insert(array $columnsAndValues, string $table): void {
            try {
                $pdo = $this->con();
                $columns = implode(", ", array_keys($columnsAndValues));
                $values = implode(", :", array_keys($columnsAndValues));
                
                $pdo->prepare("INSERT INTO $table ($columns) VALUES (:$values)")->execute($columnsAndValues);

            } catch (Exception $e) {
                Handlers::error("Problema", "Não foi possível inserir dados. <br/> Entre em contato com o administrador.", $e->getMessage());
                throw $e;
            }
        }

        public function update(array $columnsAndValues, string $table, string $where): void {
            try {
                $pdo = $this->con();
                $set = implode("=?, ", array_keys($columnsAndValues));
    
                $pdo->prepare("UPDATE $table SET $set = ? WHERE $where")->execute(array_values($columnsAndValues));
                $pdo->prepare("UPDATE $table SET updated_at = ? WHERE $where")->execute([date('Y-m-d H:i:s')]);

            } catch (Exception $e) {
                Handlers::error("Problema", "Não foi possível atualizar dados. <br/> Entre em contato com o administrador.", $e->getMessage());
                throw $e;
            }
        }

        public function select(string $columns, string $table): array {
            try {
                $pdo = $this->con();
                return $pdo->query("SELECT $columns FROM $table WHERE deleted_at IS NULL ORDER BY id DESC")->fetchAll();

            } catch (Exception $e) {
                Handlers::error("Problema", "Não foi possível recuperar dados. Entre em contato com o adinistrador.", $e->getMessage());
                throw $e;
            }
        }

        public function selectWhere(string $columns, string $table, string $whereCondition): array {
            try {
                $pdo = $this->con();
                return $pdo->query("SELECT $columns FROM $table WHERE $whereCondition AND deleted_at IS NULL")->fetchAll();

            } catch (Exception $e) {
                Handlers::error("Problema", "Não foi possível recuperar dados. <br/> Entre em contato com o administrador.", $e->getMessage());
                throw $e;
            }
        }
        public function selectWhereLike(string $columns, string $table, string $where, string $value): array {
            try {
                $pdo = $this->con();
                return $pdo->query("SELECT $columns FROM $table WHERE $where LIKE '%$value%'")->fetchAll();

            } catch (Exception $e) {
                Handlers::error("Problema", "Não foi possível recuperar dados. Entre em contato com o adinistrador.", $e->getMessage());
                throw $e;
            }
        }

        public function selectDataBetweenDate(string $columns, string $table, string $where, string $betweenBegin, string $betweenFinal): array {
            try {
                $pdo = $this->con();
                return $pdo->query("SELECT $columns FROM $table WHERE date($where) BETWEEN '$betweenBegin' AND '$betweenFinal' ORDER BY $where DESC")->fetchAll();

            } catch (Exception $e) {
                Handlers::error("Problema", "Inesperado", $e->getMessage());
                throw $e;
            }
        }
    }