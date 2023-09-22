<?php

use App\models\GroupsPermissionsAcl;
use App\services\Session;
use App\controllers\GroupsPermissionsAclController;
    
    Session::check();
    $user = $_SESSION['session'];
    $groupsPermissionsAclController = new GroupsPermissionsAclController();
    $groupsPermissionsAcl = GroupsPermissionsAcl::fromMap($groupsPermissionsAclController->findById($r['id_group_acl'])[0]);

?>

<?php require __DIR__ . "/../modules/header.php" ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Grupo de acesso</h1><form method="post"><button class="btn btn-danger" name="action_delete">Excluir</button></form>
    </div>
    <form method="POST">
        <h5>Descrição</h5>
        <input class="form-control" type="text" value="<?php echo $groupsPermissionsAcl->getDescrition(); ?>" disabled>
        <h5>Este grupo poder ler dados?</h5>
        <select name="permission_read" id="" class="form-control">
            <?php 
                switch($groupsPermissionsAcl->getPermission_read()) {
                    case "Y":
                        echo "
                        <option value='N'>Não</option>
                        <option value='Y' selected>Sim</option>
                        ";
                    case "N":
                        echo "
                        <option value='N' selected>Não</option>
                        <option value='Y'>Sim</option>
                        ";
                }
            ?>
        </select>
        <h5>Este grupo poder criar dados?</h5>
        <select name="permission_create" id="" class="form-control">
            <option value="N">Não</option>
            <option value="Y">Sim</option>
        </select>
        <h5>Este grupo poder atualizar dados?</h5>
        <select name="permission_update" id="" class="form-control">
            <option value="N">Não</option>
            <option value="Y">Sim</option>
        </select>
        <h5>Este grupo poder deletar dados?</h5>
        <select name="permission_delete" id="" class="form-control">
            <option value="N">Não</option>
            <option value="Y">Sim</option>
        </select>
        
        <button class="form-control btn btn-dark mt-2 mb-2" name="action">Atualizar</button>
    </form>
</main>
<?php require __DIR__ . "/../modules/footer.php"; ?>

<?php

    if(isset($_POST['action_delete'])) {

        GroupsPermissionsAclController::checkIfUserThenPermissionToDelete($user);

    }

    if(isset($_POST['action'])) {

        
    }