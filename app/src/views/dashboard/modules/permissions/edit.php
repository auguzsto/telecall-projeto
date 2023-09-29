<?php

use App\controllers\AccessControlController;
use App\controllers\ModuleController;
use App\controllers\ProfileController;
use App\models\Module;
use App\models\Profile;
use App\services\ACL;
use App\services\Session;
    
    Session::check();
    $user = $_SESSION['session'];
    $profile = Profile::fromMap(ProfileController::findById($r['profile_id']));
    $permissons = AccessControlController::getPermissionsByProfile($profile);

    function checked(string $permisson): string {
        return $permisson != "Y" ? '' : 'checked';
    }

?>

<?php require __DIR__ . "/../../header.php"; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Permissões do <?= $profile->getName(); ?></h1><form method="post"><button class="btn btn-danger" name="action_delete">Excluir</button></form>
    </div>
    <div class="table-responsive">
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
            <?php foreach($permissons as $row): ?>
              <tr>
                <?php $module = Module::fromMap(ModuleController::findById($row['module_id'])) ?>
                <td><?= ucfirst($module->getName()); ?></td>
                <td><input type="checkbox" name="permission_read" <?= checked($row['permission_read']); ?>></td>
                <td><input type="checkbox" name="permission_create" <?= checked($row['permission_create']); ?>></td>
                <td><input type="checkbox" name="permission_update" <?= checked($row['permission_update']); ?>></td>
                <td><input type="checkbox" name="permission_delete" <?= checked($row['permission_delete']); ?>></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    
</main>
<?php require __DIR__ . "/../../footer.php"; ?>

<?php

    if(isset($_POST['action_delete'])) {

        ACL::checkIfUserThenPermissionToDelete($thisModule);
    }

    if(isset($_POST['action'])) {

        ACL::checkIfUserThenPermissionToUpdate($thisModule);
        
    }