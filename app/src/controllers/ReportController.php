<?php

namespace App\controllers;
use Exception;
use App\services\Database;

    class ReportController {
        
        public function byTableBetweenDate(string $columns, string $table, string $where, string $betweenBegin, $betweenFinal): array {
            try {
                
                $db = new Database();
                return $db->selectDataBetweenDate($columns, $table, $where, $betweenBegin, $betweenFinal);
                
            } catch (Exception $e) {
                throw $e;
            }
        }
    }