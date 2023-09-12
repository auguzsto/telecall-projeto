<?php

namespace App\controllers;

use App\handlers\Handlers;
use App\models\User;
use App\services\Database;
use PDOException;

    class AddressController {
        
        public function create(User $user): void {
            try {

                
            } catch (PDOException $e) {
                Handlers::error("Error", "Ocorreu um erro de execução");
            }
        }
    }