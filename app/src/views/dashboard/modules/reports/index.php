<?php

use App\services\Session;
    
    Session::check();
    $user = $_SESSION['session'];
    $thisModule = 3;
    Session::checkPermissions($thisModule);

    if(!isset($r)) {
        require __DIR__ . "/../../header.php";
        return require __DIR__ ."/reports.php";
    }

    if(isset($r['users'])) {
        return require __DIR__ ."/templates/report_users.php";
    }

    if(isset($r['profiles'])) {
        return require __DIR__ ."/templates/report_profiles.php";
    }

?>