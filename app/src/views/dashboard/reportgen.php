<?php

use App\services\Session;

    Session::check();
    $user = $_SESSION['session'];
    Session::isAdmin($user);

    $reports = $_SESSION['reports'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório gerado</title>
</head>
<body>
    
</body>
</html>