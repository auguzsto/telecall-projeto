<?php

use App\controllers\AccessControlController;
use App\models\AccessControl;
use App\services\Session;
    
    Session::check();
    $user = $_SESSION['session'];
    Session::checkPermissions($user);

?>

<?php require __DIR__ . "/../modules/header.php" ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Criar controle de acesso</h1>
    </div>
    <form method="POST">
        <h5>Nome</h5>
        <input class="form-control" type="text" name="description" required>
        <div class="input-group">
        </div>
        <h5>Este grupo poder ler dados?</h5>
        <select name="permission_read" id="" class="form-control">
            <option value="Y">Sim</option>
            <option value="N">Não</option>
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
        <button class="form-control btn btn-dark mt-2 mb-2" name="action">Adicionar</button>
    </form>
</main>
<?php require __DIR__ . "/../modules/footer.php"; ?>

<?php 

        if(isset($_POST['action'])) {

            AccessControlController::checkIfUserThenPermissionToInsert($user);
            AccessControlController::checkIfUserThenPermissionToUpdate($user);

            $accessControlController = new AccessControlController();
            $accessControl = new AccessControl(
                0, 
                $_POST['description'], 
                $_POST['permission_create'],
                $_POST['permission_read'],
                $_POST['permission_update'],
                $_POST['permission_delete'],
            );

            $accessControlController->create($accessControl);
        }

?>