<?php

use App\services\Logger;
use App\services\Session;
    
    Session::check();
    $user = $_SESSION['session'];
    $thisModule = 2;
    Session::checkPermissions($thisModule);

?>

<?php require __DIR__ . "/../../header.php"; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Log de alterações</h1>  
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Autor</th>
              <th>Tipo</th>
              <th>Descrição</th>
              <th>Feito em</th>
            </tr>
          </thead>
          <tbody>
            <?php $logs = Logger::get(); ?>
            <?php foreach($logs as $log): ?>
              <tr>
                <td><?= $log['author'] ?></td>
                <td><?= $log['type'] ?></td>
                <td><?= $log['description'] ?></td>
                <td><?= $log['created_at'] ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
    </div>
</main>
<?php require __DIR__ . "/../../footer.php"; ?>