<?php

use App\controllers\AccessControlController;
use App\services\Session;

    Session::check();
    $user = $_SESSION['session'];
    Session::checkPermissions($user);

    $accessControlController = new AccessControlController();
    $accessControlList = $accessControlController->findAll();

?>

<?php require __DIR__ . "/../modules/header.php" ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="col">
          <h1 class="h2">List de controle de acesso</h1>
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
              <th>Criar</th>
              <th>Atualizar</th>
              <th>Deletar</th>
            </tr>
          </thead>
          <tbody>
            <?php

                foreach($accessControlList as $accessControl) {
                    $id = $accessControl['id'];
                    echo "
                    <tr>
                        <td>".$id."</td>
                        <td><a href='/dashboad/permissions/?id_acl=$id'>".$accessControl['description']."</a></td>
                        <td>".$accessControlController->translateValues($accessControl['permission_read'])."</td>
                        <td>".$accessControlController->translateValues($accessControl['permission_create'])."</td>
                        <td>".$accessControlController->translateValues($accessControl['permission_update'])."</td>
                        <td>".$accessControlController->translateValues($accessControl['permission_delete'])."</td>
                    </tr>
            ";
                }
            ?>
          </tbody>
        </table>
      </div>
</main>


<?php require __DIR__ . "/../modules/footer.php" ?>