<?php

use App\services\Session;
use App\services\Database;

    Session::check2FA();
    $user = $_SESSION['2fa'];
    $rand = rand(0, 2);

    $db = new Database();
    $asks = $db->select("ask_1, ask_2, ask_3", "asks_2fa")[0];
    
    $responses = [
        $user->getMotherName(),
        $user->getBirth(),
        $user->getCep(),
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
    </h1>
    <form method="POST">
        <?php

            if($asks[$rand] != "Qual a data do seu nascimento") {
                echo '<input type="text" name="response">';
            } else {
                echo '<input type="date" name="response">';
            }

        ?>
        <input type="submit" name="action" value="Confirmar">
    </form>
</body>
</html>
<?php

    if(isset($_POST['action'])) {

        for($i = 0; $i < count($responses); $i++) {
            if($responses[$i] == $_POST['response']) {
                $_SESSION['2fa'] = null;
                Session::create($user);
                
            } else {
                header("Location: /2FA");
            }
        }

    }