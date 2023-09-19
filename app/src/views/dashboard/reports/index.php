<?php

use App\services\Session;
    
    Session::check();
    $user = $_SESSION['session'];
    Session::isAdmin($user);

    if(isset($r['users'])) {
        return require __DIR__ ."/template_users.php";
    }

?>