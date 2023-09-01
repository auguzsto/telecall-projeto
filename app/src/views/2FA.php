<?php

use App\models\User;
use App\services\Session;
use App\services\Database;

    Session::check2FA();
    $user = $_SESSION['2fa'];
    $rand = rand(0, 2);

    $db = new Database();
    $asks = $db->select("ask_1, ask_2, ask_3", "asks_2fa")[0];
    
    $responses = [
        $asks[0] => $user->getMotherName(),
        $asks[1] => $user->getBirth(),
        $asks[2] => $user->getCep(),
    ];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telecall - 2FA</title>
</head>
<body>
    <h1>
        <?php 
            echo $asks[$rand];
        ?>?
        <br/>
    </h1>
    <form action="" method="POST">
        <input type="text" name="response" placeholder="Digite sua resposta">
        <input type="submit" name="action" value="Confirmar">
    </form>
</body>
</html>
<?php echo $responses[$asks[$rand]]; ?>
<?php
    if(isset($_POST['action'])) {

        if($_POST['response'] == $responses[$asks[$rand]]) {
            $_SESSION['2fa'] = null;
            Session::create($user);
        } else {
            header("Location: /2FA");
        }
    }