<?php

use App\services\Migration;

    require __DIR__ . '/vendor/autoload.php';

    require 'app/routes/routes.php';

    Migration::auto("db_29082023_4.php", "default");
   