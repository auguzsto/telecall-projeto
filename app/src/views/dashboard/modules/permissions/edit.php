<?php

use App\controllers\AccessControlController;
use App\handlers\Handlers;
use App\models\AccessControl;
use App\services\ACL;
use App\services\Session;
    
    Session::check();
    $user = $_SESSION['session'];
    $accessControlController = new AccessControlController();
    $accessControl = AccessControl::fromMap($accessControlController->findById($r['id_acl'])[0]);

?>

<?php require __DIR__ . "/../../header.php"; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Controle de acesso</h1><form method="post"><button class="btn btn-danger" name="action_delete">Excluir</button></form>
    </div>
    <form method="POST">
        <h5>Descrição</h5>
        <input class="form-control" type="text" value="<?php echo $accessControl->getDescrition(); ?>" disabled>
        <h5>Este grupo poder ler dados?</h5>
        <select name="permission_read" id="" class="form-control">
            <?php 
                switch($accessControl->getPermission_read()) {
                    case "Y":
                        echo "
                            <option value='N'>Não</option>
                            <option value='Y' selected>Sim</option>
                        ";
                        break;
    
                        case "N":
                            echo "
                            <option value='N' select>Não</option>
                            <option value='Y'>Sim</option>
                        ";
                        break;
                }
            ?>
        </select>
        <h5>Este grupo poder executar dados?</h5>
        <select name="permission_execute" id="" class="form-control">
            <?php 
                switch($accessControl->getPermission_execute()) {
                    case "Y":
                        echo "
                            <option value='N'>Não</option>
                            <option value='Y' selected>Sim</option>
                        ";
                        break;
    
                        case "N":
                            echo "
                            <option value='N' select>Não</option>
                            <option value='Y'>Sim</option>
                        ";
                        break;
                }
            ?>
        </select>
        <h5>Este grupo poder criar dados?</h5>
        <select name="permission_create" id="" class="form-control">
            <?php 
                switch($accessControl->getPermission_create()) {
                    case "Y":
                        echo "
                            <option value='N'>Não</option>
                            <option value='Y' selected>Sim</option>
                        ";
                        break;
    
                        case "N":
                            echo "
                            <option value='N' select>Não</option>
                            <option value='Y'>Sim</option>
                        ";
                        break;
                }
            ?>
        </select>
        <h5>Este grupo poder atualizar dados?</h5>
        <select name="permission_update" id="" class="form-control">
            <?php 
                switch($accessControl->getPermission_update()) {
                    case "Y":
                        echo "
                            <option value='N'>Não</option>
                            <option value='Y' selected>Sim</option>
                        ";
                        break;
    
                        case "N":
                            echo "
                            <option value='N' select>Não</option>
                            <option value='Y'>Sim</option>
                        ";
                        break;
                }
            ?>
        </select>
        <h5>Este grupo poder deletar dados?</h5>
        <select name="permission_delete" id="" class="form-control">
            <?php 
                switch($accessControl->getPermission_delete()) {
                    case "Y":
                        echo "
                            <option value='N'>Não</option>
                            <option value='Y' selected>Sim</option>
                        ";
                    break;

                    case "N":
                        echo "
                        <option value='N' select>Não</option>
                        <option value='Y'>Sim</option>
                    ";
                    break;

                }
            ?>
        </select>
        <button class="form-control btn btn-dark mt-2 mb-2" name="action">Atualizar</button>
    </form>
</main>
<?php require __DIR__ . "/../../footer.php"; ?>

<?php

    if(isset($_POST['action_delete'])) {

        ACL::checkIfUserThenPermissionToDelete($user);
        $accessControlController->delete($accessControl);
    }

    if(isset($_POST['action'])) {

        ACL::checkIfUserThenPermissionToUpdate($user);
        
        $accessControl->setPermission_create($_POST['permission_create']);
        $accessControl->setPermission_execute($_POST['permission_execute']);
        $accessControl->setPermission_delete($_POST['permission_delete']);
        $accessControl->setPermission_read($_POST['permission_read']);
        $accessControl->setPermission_update($_POST['permission_update']);

        $accessControlController->update($accessControl);
    }