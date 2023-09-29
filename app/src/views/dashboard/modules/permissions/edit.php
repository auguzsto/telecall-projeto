<?php

use App\controllers\AccessControlController;
use App\controllers\ModuleController;
use App\controllers\ProfileController;
use App\models\Module;
use App\models\Profile;
use App\services\Session;
    
    Session::check();
    $user = $_SESSION['session'];
    $profile = Profile::fromMap(ProfileController::findById($r['profile_id']));
    $permissons = AccessControlController::getPermissionsByProfile($profile);
    
    $modules = [
      "profile" => AccessControlController::getPermissionByProfileAndModule($profile, 1),
      "users" => AccessControlController::getPermissionByProfileAndModule($profile, 2),
      "logs" => AccessControlController::getPermissionByProfileAndModule($profile, 3),
      "reports" => AccessControlController::getPermissionByProfileAndModule($profile, 4),
      "profiles" => AccessControlController::getPermissionByProfileAndModule($profile, 5),
    ];

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
              <tr>
                <td>Perfil</td>
                  <td><input type="checkbox" name="permission_read_profile" <?= checked($modules['profile'][3]); ?>></td>
                  <td><input type="checkbox" name="permission_create_profile" <?= checked($modules['profile'][2]); ?>></td>
                  <td><input type="checkbox" name="permission_update_profile" <?= checked($modules['profile'][4]); ?>></td>
                  <td><input type="checkbox" name="permission_delete_profile" <?= checked($modules['profile'][5]); ?>></td>
              </tr>
              <tr>
                <td>Usuários</td>
                  <td><input type="checkbox" name="permission_read_users" <?= checked($modules['users'][3]); ?>></td>
                  <td><input type="checkbox" name="permission_create_users" <?= checked($modules['users'][2]); ?>></td>
                  <td><input type="checkbox" name="permission_update_users" <?= checked($modules['users'][4]); ?>></td>
                  <td><input type="checkbox" name="permission_delete_users" <?= checked($modules['users'][5]); ?>></td>
              </tr>
              <tr>
                <td>Logs</td>
                  <td><input type="checkbox" name="permission_read_logs" <?= checked($modules['logs'][3]); ?>></td>
                  <td><input type="checkbox" name="permission_create_logs" <?= checked($modules['logs'][2]); ?>></td>
                  <td><input type="checkbox" name="permission_update_logs" <?= checked($modules['logs'][4]); ?>></td>
                  <td><input type="checkbox" name="permission_delete_logs" <?= checked($modules['logs'][5]); ?>></td>
              </tr>
              <tr>
                <td>Relatórios</td>
                  <td><input type="checkbox" name="permission_read_reports" <?= checked($modules['reports'][3]); ?>></td>
                  <td><input type="checkbox" name="permission_create_reports" <?= checked($modules['reports'][2]); ?>></td>
                  <td><input type="checkbox" name="permission_update_reports" <?= checked($modules['reports'][4]); ?>></td>
                  <td><input type="checkbox" name="permission_delete_reports" <?= checked($modules['reports'][5]); ?>></td>
              </tr>
              <tr>
                <td>Perfis</td>
                  <td><input type="checkbox" name="permission_read_profiles" <?= checked($modules['profiles'][3]); ?>></td>
                  <td><input type="checkbox" name="permission_create_profiles" <?= checked($modules['profiles'][2]); ?>></td>
                  <td><input type="checkbox" name="permission_update_profiles" <?= checked($modules['profiles'][4]); ?>></td>
                  <td><input type="checkbox" name="permission_delete_profiles" <?= checked($modules['profiles'][5]); ?>></td>
              </tr>
            </tbody>
          </table>
          <button class="form-control btn btn-dark mt-2 mb-2" name="action">Adicionar</button>
        </form>
      </div>   
</main>
<?php require __DIR__ . "/../../footer.php"; ?>
<?php

    if(isset($_POST['action'])) {

      $columnsAndValuesProfile = [
        "permission_read" => $_POST['permission_read_profile'] != "on" ? "N": "Y",
        "permission_create" => $_POST['permission_create_profile'] != "on" ? "N": "Y",
        "permission_update" => $_POST['permission_update_profile'] != "on" ? "N": "Y",
        "permission_delete" => $_POST['permission_delete_profile'] != "on" ? "N": "Y",
      ];

      $columnsAndValuesUsers= [
        "permission_read" => $_POST['permission_read_users'] != "on" ? "N": "Y",
        "permission_create" => $_POST['permission_create_users'] != "on" ? "N": "Y",
        "permission_update" => $_POST['permission_update_users'] != "on" ? "N": "Y",
        "permission_delete" => $_POST['permission_delete_users'] != "on" ? "N": "Y",
      ];

      $columnsAndValuesLogs= [
        "permission_read" => $_POST['permission_read_logs'] != "on" ? "N": "Y",
        "permission_create" => $_POST['permission_create_logs'] != "on" ? "N": "Y",
        "permission_update" => $_POST['permission_update_logs'] != "on" ? "N": "Y",
        "permission_delete" => $_POST['permission_delete_logs'] != "on" ? "N": "Y",
      ];

      $columnsAndValuesReports= [
        "permission_read" => $_POST['permission_read_reports'] != "on" ? "N": "Y",
        "permission_create" => $_POST['permission_create_reports'] != "on" ? "N": "Y",
        "permission_update" => $_POST['permission_update_reports'] != "on" ? "N": "Y",
        "permission_delete" => $_POST['permission_delete_reports'] != "on" ? "N": "Y",
      ];

      $columnsAndValuesProfiles= [
        "permission_read" => $_POST['permission_read_profiles'] != "on" ? "N": "Y",
        "permission_create" => $_POST['permission_create_profiles'] != "on" ? "N": "Y",
        "permission_update" => $_POST['permission_update_profiles'] != "on" ? "N": "Y",
        "permission_delete" => $_POST['permission_delete_profiles'] != "on" ? "N": "Y",
      ];

      AccessControlController::updatePermissionInProfile($columnsAndValuesProfile, $profile, $modules['profile'][1]);
      AccessControlController::updatePermissionInProfile($columnsAndValuesUsers, $profile, $modules['users'][1]);
      AccessControlController::updatePermissionInProfile($columnsAndValuesLogs, $profile, $modules['logs'][1]);
      AccessControlController::updatePermissionInProfile($columnsAndValuesReports, $profile, $modules['reports'][1]);
      AccessControlController::updatePermissionInProfile($columnsAndValuesProfiles, $profile, $modules['profiles'][1]);

    }