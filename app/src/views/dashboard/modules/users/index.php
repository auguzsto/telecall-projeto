<?php

use App\services\Session;
    
    Session::check();
    $user = $_SESSION['session'];
    $thisModule = 1;
    Session::checkPermissions($thisModule);

    if(!isset($r)) {
        return require __DIR__ ."/list.php";
    }

    if(isset($r['id'])) {
        return require __DIR__ ."/edit.php";
    }

    if(isset($r['name'])) {
        return require __DIR__ ."/search.php";
    }

    if(isset($r['email'])) {
        return require __DIR__ ."/search.php";
    }

    if(isset($r['cpf'])) {
        return require __DIR__ ."/search.php";
    }

    if(isset($r['changepassword'])) {
        return require __DIR__ ."/changepassword.php";
    }

?>