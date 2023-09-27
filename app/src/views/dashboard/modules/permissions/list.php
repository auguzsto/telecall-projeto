<?php

use App\controllers\AccessControlController;
use App\services\Session;

    Session::check();
    $user = $_SESSION['session'];
    Session::checkPermissions($user);

    $accessControlController = new AccessControlController();
    $accessControls = $accessControlController->findAll();

?>

<?php require __DIR__ . "/../../header.php"; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="col">
          <h1 class="h2">Lista de controle de acesso</h1>
        </div>
        <div>
          <a href="/dashboard/permissions/?add_acl"><div class="btn btn-dark">Adicionar</div></a>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>ID</th>
              <th>Descrição</th>
              <th>Ler</th>
              <th>Executar</th>
              <th>Criar</th>
              <th>Atualizar</th>
              <th>Deletar</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($accessControls as $row): ?>
              <tr>
                <td><?= $row['id'] ?></td>
                <td><a href='/dashboad/permissions/?id_acl=<?= $row['id']; ?>'><?= $row['description']; ?></a></td>
                <td><?= $row['permission_read']; ?></td>
                <td><?= $row['permission_execute']; ?></td>
                <td><?= $row['permission_create']; ?></td>
                <td><?= $row['permission_update']; ?></td>
                <td><?= $row['permission_delete']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
</main>


<?php require __DIR__ . "/../../footer.php"; ?>