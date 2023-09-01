<?php

use App\services\Session;
use App\services\Database;

    Session::check2FA();
    $user = $_SESSION['2fa'];
    $rand = rand(0, 2);

    $db = new Database();
    $asks = $db->select("ask_1, ask_2, ask_3", "asks_2fa")[0];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/app/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/app/assets/css/style.css">
    <title>Telecall</title>
</head>
<body>
<nav class="navbar navbar-extand-lg light bg-light shadow p-3 mb-5 bg-white rounded">
    <a href="/"><img src="app/assets/images/navbar.png" class="navbar brand img-fluid"></a>
</nav>
    <div class="container">
        <?php 

            switch($rand) {
                default:
                    echo "
                    <h1>$asks[$rand]?</h1>
                    <form method='POST'>
                        <input type='text' name='$rand'>
                        <input type='submit' name='action'>
                    </form>
                    ";
                break;

                case 1:
                    echo "
                    <h1>$asks[$rand]?</h1>
                    <form method='POST'>
                        <input type='date' name='$rand'>
                        <input type='submit' name='action'>
                    </form>
                    ";
            }
        ?>
    </div>
       
</body>
</html>
<?php

    if(isset($_POST['action'])) {

        if($_POST['0'] == $user->getMotherName()) {
            echo "true";
        }

        if($_POST['1'] == $user->getBirth()) {
            echo "true";
        }

        if($_POST['2'] == $user->getCep()) {
            echo "true";
        }
        
    }