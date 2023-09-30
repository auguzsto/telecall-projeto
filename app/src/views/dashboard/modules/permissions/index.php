<?php

use App\services\Session;

    Session::check();
    $user = $_SESSION['session'];
    $thisModule = 4;
    Session::checkPermissions($thisModule);

    if(!isset($r)) {
        return require __DIR__ ."/list.php";
    }

    if(isset($r['add_profile'])) {
        return require __DIR__ ."/add.php";
    }

    if(isset($r['profile_id'])) {
        return require __DIR__ ."/edit.php";
    }