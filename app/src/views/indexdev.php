<?php
use App\services\ACL;

    session_start();

    var_dump(ACL::checkIfUserThenPermissionToRead(0));
    