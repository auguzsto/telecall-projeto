<?php

use App\services\Session;
    
    Session::check();
    $user = $_SESSION['session'];

?>

<?php include __DIR__ . "/modules/header.php"; ?>

<div>
    <h1>
        Olá, <?php echo $user->getFirstName(); ?>
    </h1>
</div>

