<?php

use App\controllers\AccessControlController;
use App\controllers\ModuleController;
use App\controllers\ProfileController;
use App\models\AccessControl;
use App\models\Module;
use App\models\Profile;
use App\services\ACL;
    
    $profile = Profile::fromMap(ProfileController::findById($r['profile_id']));
    $permissons = AccessControlController::getPermissionsByProfile($profile);
    $modulesAll = ModuleController::findAll();

    function checked(string $permisson): string {
        return $permisson != "Y" ? '' : 'checked';
    }

    function value(string $permisson): string {
      return $permisson != "Y" ? "N" : "Y";
    }

?>

<?php require __DIR__ . "/../../header.php"; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Permissões do <?= $profile->getName(); ?></h1><form method="post"><button class="btn btn-danger" name="action_delete">Excluir</button></form>
    </div>
    <div class="table-responsive">
        <form method="POST">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>Módulos</th>
                <th>Ler</th>
                <th>Criar</th>
                <th>Atualizar</th>
                <th>Deletar</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($permissons as $row): $accessControl = AccessControl::fromMap($row) ?>
                <tr>
                  <?php $module = $accessControl->getModule(); ?>
                  <td><?= $module->getName(); ?></td>
                  <td><input type="checkbox" name="read-<?= $module->getId(); ?>" id="" <?= checked($accessControl->getPermission_read()); ?>></td>
                  <td><input type="checkbox" name="create-<?= $module->getId(); ?>" id="" <?= checked($accessControl->getPermission_create()); ?>></td>
                  <td><input type="checkbox"  name="update-<?= $module->getId(); ?>" id="" <?= checked($accessControl->getPermission_update()); ?>></td>
                  <td><input type="checkbox" name="delete-<?= $module->getId(); ?>" id="" <?= checked($accessControl->getPermission_delete()); ?>></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
          <button class="form-control btn btn-dark mt-2 mb-2" name="action">Atualizar</button>
        </form>
      </div>   
<?php require __DIR__ . "/../../footer.php"; ?>
<?php

    if(isset($_POST['action_delete'])) {

      ACL::checkIfUserThenPermissionToDelete($thisModule);
      ProfileController::delete($profile);

    }

    if(isset($_POST['action'])) {

      ACL::checkIfUserThenPermissionToUpdate($thisModule);

      foreach($permissons as $row) {
        $accessControl = AccessControl::fromMap($row);
        $module = $accessControl->getModule();
        $read = "read-" . $module->getId();
        $create = "create-" . $module->getId();
        $update = "update-" . $module->getId();
        $delete = "delete-" . $module->getId();

        $columnsAndValues = [
          str_replace($read, "permission_read", $read) => $_POST[$read] != "on" ? "N": "Y",
          str_replace($create, "permission_create", $create) => $_POST[$create] != "on" ? "N": "Y",
          str_replace($update, "permission_update", $update) => $_POST[$update] != "on" ? "N": "Y",
          str_replace($delete, "permission_delete", $delete) => $_POST[$delete] != "on" ? "N": "Y",
        ];
        
        AccessControlController::updatePermissionInProfile($columnsAndValues, $profile, $module->getId());

      }
    }
  ?>
</main>