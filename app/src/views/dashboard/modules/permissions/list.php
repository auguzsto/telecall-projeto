<?php

use App\controllers\ProfileController;
use App\services\Session;

    Session::check();
    $user = $_SESSION['session'];
    $profiles = ProfileController::findAll();

?>

<?php require __DIR__ . "/../../header.php"; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="col">
          <h1 class="h2">Perfis e permissões</h1>
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
              <th>Perfil</th>
              <th>Criado em</th>
              <th>Atualizado em</th>
              <th>Desativado em</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($profiles as $row): ?>
              <tr>
                <td><?= $row['id'] ?></td>
                <td><a href='/dashboad/permissions/?profile_id=<?= $row['id']; ?>'><?= $row['name']; ?></a></td>
                <td><?= $row['created_at']; ?></td>
                <td><?= $row['updated_at']; ?></td>
                <td><?= $row['deleted_at']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
</main>


<?php require __DIR__ . "/../../footer.php"; ?>