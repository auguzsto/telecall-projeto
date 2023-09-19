<?php

use App\controllers\ReportController;
use App\services\Session;
    
    Session::check();
    $user = $_SESSION['session'];
    Session::isAdmin($user);

    $reportController = new ReportController();

    $betweenBegin = isset($_POST['betweenBegin']) ? $_POST['betweenBegin'] : date('Y-m-d');
    $betweenFinal = isset($_POST['betweenFinal']) ? $_POST['betweenFinal'] : date('Y-m-d');

?>

<?php include __DIR__ . "/modules/header.php"; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Relatórios</h1>  
    </div>
    <div>
        <form action="/dashboard/reports/gen" method="post" target="_blank">
            <select name="table" id="report">
                <option value="users">Usuários</option>
            </select>
            <select name="where" id="report">
                <option value="created_at">Criado em</option>
                <option value="updated_at">Atualizado em</option>
                <option value="deleted_at">Deletado em</option>
            </select>
            <input type="date" name="betweenBegin" id="" value="<?php echo $betweenBegin ?>" required>
            <input type="date" name="betweenFinal" id="" value="<?php echo $betweenFinal ?>" required>
            <button type="submit" name="action">Gerar</button>
        </form>
        <?php 

        if(isset($_POST['action'])) {

            $reports = $reportController->byTableBetweenDateCreated("*", $_POST['table'], $_POST['where'], $_POST['betweenBegin'], $_POST['betweenFinal']);

            $_SESSION['reports'] = $reports;
        } 

        ?>
    </div>
</main>
<?php include __DIR__ . "/modules/footer.php"; ?>