<?php 

use App\controllers\UserController;
use App\services\Session;
    
    Session::check();
    $user = $_SESSION['session'];
    
    $userController = new UserController();
    $users = $userController->findAll();

?>

<?php require __DIR__ . "/../modules/header.php" ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="col">
          <h1 class="h2">Todos usuários</h1>
        </div>
        <div class="col d-flex justify-content-end">
          <?php include __DIR__ . "/../modules/input_search.php"; ?>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome completo</th>
              <th>Nome da mãe</th>
              <th>CPF</th>
              <th>Data de nascimento</th>
              <th>E-mail</th>
              <th>Celular</th>
              <th>Criado em</th>
              <th>Alterado em</th>
            </tr>
          </thead>
          <tbody>
            <?php

                foreach($users as $user) {
                    $id = $user['id'];
                    echo "
                    <tr>
                        <td>".$user['id']."</td>
                        <td><a href='/dashboad/user/?id=$id'>".$user['first_name']." ".$user['last_name']."</a></td>
                        <td>".$user['mother_name']."</td>
                        <td>".$user['cpf']."</td>
                        <td>".$user['birth']."</td>
                        <td>".$user['email']."</td>
                        <td>".$user['phone']."</td>
                        <td>".$user['created_at']."</td>
                        <td>".$user['updated_at']."</td>
                    </tr>
            ";
                }
            ?>
          </tbody>
        </table>
      </div>
</main>


<?php require __DIR__ . "/../modules/footer.php" ?>