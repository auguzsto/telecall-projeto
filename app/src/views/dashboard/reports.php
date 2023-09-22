<?php

use App\controllers\ReportController;
use App\services\Session;
    
    Session::check();
    $user = $_SESSION['session'];
    Session::checkPermissions($user);

    $reportController = new ReportController();

?>

<?php include __DIR__ . "/modules/header.php"; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Relatórios</h1>  
    </div>
    <div>
        <form method="post" target="_blank" class="input-group">
            <select name="table" id="report" class="form-control">
                <option value="users">Usuários</option>
            </select>
            <select name="where" id="report" class="form-control">
                <option value="created_at">Criados em</option>
                <option value="updated_at">Atualizados em</option>
                <option value="deleted_at">Deletados em</option>
            </select>
            <input type="date" name="betweenBegin" id="" value="<?php echo date('Y-m-d'); ?>" class="form-control" required>
            <input type="date" name="betweenFinal" id="" value="<?php echo date('Y-m-d'); ?>" class="form-control" required>
            <button type="submit" name="action" class="form-control btn btn-primary">Gerar relatório</button>
        </form>
        <?php 

        if(isset($_POST['action'])) {

            $table = $_POST['table'];
            $where = $_POST['where'];
            $betweenBegin = $_POST['betweenBegin'];
            $betweenFinal = $_POST['betweenFinal'];

            $reports = $reportController->byTableBetweenDate("*", $table, $where, $betweenBegin, $betweenFinal);

            $_SESSION['reports'] = $reports;
            
            header("Location: /dashboard/reports/?$table=$where&begin=$betweenBegin&final=$betweenFinal");
            
        } 

        ?>
    </div>
</main>
<?php include __DIR__ . "/modules/footer.php"; ?>