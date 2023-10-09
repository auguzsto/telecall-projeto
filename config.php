<?php

    global $config;
    
    $config['host'] = "mariadb";    // Change the host to 'mariadb' if you are using docker compose.
    $config['port'] = "3306";       // Make sure there is no service on port 3306 if you use docker compose.
    $config['user'] = "root";
    $config['password'] = "password";
    $config['database'] = "grp_16_bangu_noite";