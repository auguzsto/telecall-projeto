<?php

use App\services\Session;
use App\services\Database;

    Session::check2FA();
    $user = $_SESSION['2fa'];

    $db = new Database();
    $asks = $db->select("ask_1, ask_2, ask_3", "asks_2fa")[0];
    $rand = rand(0, 2);
    $tagIdByRand = $rand == 2 ? "cep" : null;

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
    <a href="/"><img src="/app/assets/images/navbar.png" class="navbar brand img-fluid"></a>
</nav>
    <div class="container">
        <?php 

            switch($rand) {
                default:
                    echo "
                    <h1>$asks[$rand]?</h1>
                    <form method='POST'>
                        <input type='text' class='form-control' name='$rand' id='$tagIdByRand'>
                        <input type='submit' class='form-control btn btn-primary mt-2' value='Confirmar' name='action'>
                    </form>
                    ";
                break;

                case 1:
                    echo "
                    <h1>$asks[$rand]?</h1>
                    <form method='POST'>
                        <input type='date' class='form-control' name='$rand'>
                        <input type='submit' class='form-control btn btn-primary mt-2' value='Confirmar' name='action'>
                    </form>
                    ";
            }
        ?>
    </div>
       
</body>
</html>
<script src="/app/assets/js/jquery.slim.min.js"></script>
<script src="/app/assets/js/jquery.mask.min.js"></script>
<script>
    $(document).ready(function() {
    $("#cep").mask('00000-000', {reverse: false});
});
</script>
<?php

    if(isset($_POST['action'])) {

        if($_POST['0'] == $user->getMotherName()) {
            unset($_SESSION['2fa']);
            Session::create($user);
        }

        if($_POST['1'] == $user->getBirth()) {
            unset($_SESSION['2fa']);
            Session::create($user);
        }

        if($_POST['2'] == $user->getCep()) {
            unset($_SESSION['2fa']);
            Session::create($user);
        }
        
    }