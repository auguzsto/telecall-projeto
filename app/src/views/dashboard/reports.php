<?php

use App\services\Session;
use App\services\Database;
    
    Session::check();
    $user = $_SESSION['session'];
    Session::isAdmin($user);

    $db = new Database();

    $logs = $db->select("*", "log");

?>

<?php include __DIR__ . "/modules/header.php"; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Relatórios</h1>  
    </div>
    Here button with params to report.
</main>
<?php include __DIR__ . "/modules/footer.php"; ?>