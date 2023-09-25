<?php

use App\services\Session;
    
    Session::check();
    $user = $_SESSION['session'];
    Session::checkPermissions($user);

    if(!isset($r)) {
        return require __DIR__ ."/reports.php";
    }

    if(isset($r['users'])) {
        return require __DIR__ ."/templates/report_users.php";
    }

?>