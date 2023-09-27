<?php 

use App\controllers\UserController;
    
    $userController = new UserController();
    $users = $userController->findAll();

?>

<?php require __DIR__ . "/../../header.php"; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="col">
          <h1 class="h2">Todos usuários</h1>
        </div>
        <div class="col d-flex justify-content-end">
        <?php require __DIR__ . "/../../components/input_search.php"; ?>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome completo</th>
              <th>Nome materno</th>
              <th>CPF</th>
              <th>Data de nascimento</th>
              <th>E-mail</th>
              <th>Celular</th>
              <th>Criado em</th>
              <th>Alterado em</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($users as $row): ?>
              <tr>
                <td><?= $row['id']; ?></td>
                <td>
                  <a href='/dashboad/users/?id=<?= $row['id'] ?>'>
                    <?= $row['first_name']; ?> <?= $row['last_name']; ?>
                  </a>
                </td>
                <td><?= $row['mother_name']; ?></td>
                <td><?= $row['cpf']; ?></td>
                <td><?= $row['birth']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['phone']; ?></td>
                <td><?= $row['created_at']; ?></td>
                <td><?= $row['updated_at']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
</main>


<?php require __DIR__ . "/../../footer.php"; ?>