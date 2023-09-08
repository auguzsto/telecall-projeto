<?php

use App\services\Migration;
    
    error_reporting(0); // SET 0 FOR PROD, SET -1 FOR DEVELOPEMENT

    require __DIR__ . '/vendor/autoload.php';

    require __DIR__ . '/app/routes/routes.php';

    Migration::auto("db_29082023_6.php", "default");