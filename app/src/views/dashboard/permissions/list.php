<?php

use App\controllers\GroupsPermissionsAclController;
use App\services\Session;

    Session::check();
    $user = $_SESSION['session'];
    Session::checkPermissions($user);

    $groupsPermissionsAcl = new GroupsPermissionsAclController();
    $groups = $groupsPermissionsAcl->findAll();

?>

<?php require __DIR__ . "/../modules/header.php" ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="col">
          <h1 class="h2">Grupos de acessos</h1>
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

                foreach($groups as $group) {
                    $id = $group['id'];
                    echo "
                    <tr>
                        <td>".$id."</td>
                        <td><a href='/dashboad/permissions/?id_group_acl=$id'>".$group['description']."</a></td>
                        <td>".$group['permission_read']."</td>
                        <td>".$group['permission_create']."</td>
                        <td>".$group['permission_update']."</td>
                        <td>".$group['permission_delete']."</td>
                    </tr>
            ";
                }
            ?>
          </tbody>
        </table>
      </div>
</main>


<?php require __DIR__ . "/../modules/footer.php" ?>