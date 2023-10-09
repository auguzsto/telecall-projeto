<?php

use App\services\Migration;
    
    error_reporting(0); // SET 0 FOR PROD, SET -1 FOR DEVELOPEMENT
    date_default_timezone_set("America/Sao_Paulo"); // DEFAULT CONFIG HOURS 

    require __DIR__ . '/vendor/autoload.php';

    require __DIR__ . '/app/routes/routes.php';

    Migration::auto("db_09102023.php", "default");