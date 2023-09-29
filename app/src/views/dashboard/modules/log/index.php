<?php

use App\services\Logger;
use App\services\Session;
    
    Session::check();
    $user = $_SESSION['session'];

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
              <th>Usuário responsável</th>
              <th>Descrição</th>
              <th>Tipo</th>
              <th>ID de entidade alterada</th>
              <th>Feito em</th>
            </tr>
          </thead>
          <tbody>
            <?php $logs = Logger::get(); ?>
            <?php foreach($logs as $log): ?>
              <tr>
                <td>(<?= $log['user_id'] ?>) <?= $log['user_email'] ?></td>
                <td><?= $log['description'] ?></td>
                <td><?= $log['type_log'] ?></td>
                <td><?= $log['changed_entity_id'] ?></td>
                <td><?= $log['created_at'] ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
    </div>
</main>
<?php require __DIR__ . "/../../footer.php"; ?>