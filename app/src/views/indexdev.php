<?php

use App\models\Auth;
use App\models\User;

    $entity = new Auth();
    $user = new User();

    $array = (array) $user;
    $numberValues = substr(str_repeat("?,", count($array)), 0, -1);

    print count($array);
    