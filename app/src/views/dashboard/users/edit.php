<?php

use App\controllers\AccessControlController;
use App\models\User;
use App\services\Session;
use App\controllers\UserController;
    
    Session::check();
    $user = $_SESSION['session'];

    $userController = new UserController();
    $userById = User::fromMap($userController->findById($r['id'])[0]);
    $accessControlController = new AccessControlController();
    $accessControlList = $accessControlController->findAll();

?>

<?php require __DIR__ . "/../modules/header.php" ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Perfil</h1><form method="post"><button class="btn btn-danger" name="action_delete">Excluir</button></form>
    </div>
    <form method="POST">
        <h5>CPF</h5>
        <input class="form-control" type="text" value="<?php echo $userById->getCpf(); ?>" disabled>
        <h5>Nome</h5>
        <input class="form-control" type="text" value="<?php echo $userById->getFirstName(); ?>" disabled>
        <h5>Último nome</h5>
        <input class="form-control" type="text" value="<?php echo $userById->getLastName(); ?>" disabled>
        <h5>Senha</h5>
        <div class="input-group"><input class="form-control" type="password" value="<?php echo $user->getPassword(); ?>" disabled><a href="/dashboard/user/?changepassword=<?php echo $r['id']; ?>"><div class="btn btn-dark">Alterar senha</div></a></div>
        <h5>E-mail</h5>
        <input class="form-control" type="text" name="email" value="<?php echo $userById->getEmail(); ?>">
        <h5>Permissões</h5>
        <select name="id_access_control" id="" class="form-control">
            <?php 

                foreach($accessControlList as $permissions) {
                    $id = $permissions['id'];
                    $description = $permissions['description'];
                    $selected = $userById->getAccessControl()->getId() == $id ? "selected" : "";
                    echo "
                        <option value='$id' $selected>$description</option>
                    ";
                }

            ?>
        </select>
        <h5>CEP</h5>
        <input class="form-control" id="cep" name="cep" type="text" value="<?php echo $userById->getCep(); ?>">
        <h5>Celular</h5>
        <input class="form-control" id="celular" name="phone" type="text" value="<?php echo $userById->getPhone(); ?>">
        <h5>Endereço completo</h5>
        <input class="form-control" type="text" name="address" value="<?php echo $userById->getAddress(); ?>">
        <button class="form-control btn btn-dark mt-2 mb-2" name="action">Atualizar</button>
    </form>
</main>
<?php require __DIR__ . "/../modules/footer.php"; ?>

<?php

    if(isset($_POST['action_delete'])) {

        AccessControlController::checkIfUserThenPermissionToDelete($user);

        $userController = new UserController();
        $userController->delete($userById);
    }

    if(isset($_POST['action'])) {

        AccessControlController::checkIfUserThenPermissionToUpdate($user);

        $userController = new UserController();

        $userById->getAccessControl()->setId($_POST['id_access_control']);
        $userById->setEmail($_POST['email']);
        $userById->setPhone($_POST['phone']);
        $userById->setCep($_POST['cep']);
        $userById->setAddress($_POST['address']);

        $userController->update($userById);
    }