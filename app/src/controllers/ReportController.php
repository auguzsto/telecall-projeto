<?php

namespace App\controllers;
use App\handlers\Handlers;
use PDOException;
use App\services\Database;

    class ReportController {
        
        public function byTableBetweenDate(string $columns, string $table, string $where, string $betweenBegin, $betweenFinal): array {
            try {
                $db = new Database();

                return $db->selectDataBetweenDate($columns, $table, $where, $betweenBegin, $betweenFinal);
                
            } catch (PDOException $e) {
                Handlers::error("Contate o administrador", "Não foi possível gerar relatório", $e->getMessage());
                throw $e;
            }
        }
    }