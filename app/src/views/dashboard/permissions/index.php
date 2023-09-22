<?php

use App\services\Session;

    Session::check();
    $user = $_SESSION['session'];
    Session::checkPermissions($user);

    if(!isset($r)) {
        return require __DIR__ ."/list.php";
    }

    if(isset($r['add_group_acl'])) {
        return require __DIR__ ."/add.php";
    }