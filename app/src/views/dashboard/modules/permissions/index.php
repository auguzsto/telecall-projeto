<?php

use App\services\Session;

    Session::check();
    $user = $_SESSION['session'];

    if(!isset($r)) {
        return require __DIR__ ."/list.php";
    }

    if(isset($r['add_acl'])) {
        return require __DIR__ ."/add.php";
    }

    if(isset($r['id_acl'])) {
        return require __DIR__ ."/edit.php";
    }