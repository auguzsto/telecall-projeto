<?php

use App\models\User;
use App\services\ACL;
use App\handlers\Handlers;
use App\controllers\UserController;
use App\controllers\AccessControlController;

    $userController = new UserController();
    $userById = User::fromMap($userController->findById($r['id'])[0]);

    $accessControlController = new AccessControlController();
    $accessControls = $accessControlController->findAll();

?>

<?php require __DIR__ . "/../../header.php"; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Perfil</h1><form method="post"><button class="btn btn-danger" name="action_delete">Excluir</button></form>
    </div>
    <form method="POST">
        <h5>CPF</h5>
        <input class="form-control" type="text" value="<?= $userById->getCpf(); ?>" disabled>
        <h5>Nome</h5>
        <input class="form-control" type="text" value="<?= $userById->getFirstName(); ?>" disabled>
        <h5>Último nome</h5>
        <input class="form-control" type="text" value="<?= $userById->getLastName(); ?>" disabled>
        <h5>Senha</h5>
        <div class="input-group"><input class="form-control" type="password" value="<?= $user->getPassword(); ?>" disabled><a href="/dashboard/users/?changepassword=<?= $r['id']; ?>"><div class="btn btn-dark">Alterar senha</div></a></div>
        <h5>E-mail</h5>
        <input class="form-control" type="text" name="email" value="<?= $userById->getEmail(); ?>">
        <h5>Permissões</h5>
        <select name="id_access_control" id="" class="form-control">

            <?php foreach($accessControls as $row): ?>
                <?= $selected = $userById->getAccessControl()->getId() == $row['id'] ? "selected" : ""; ?>
                <option value='<?= $row['id'] ?>' <?= $selected ?>>
                    <?= $row['description'] ?>
                </option>
           <?php endforeach; ?>
           
        </select>
        <h5>CEP</h5>
        <input class="form-control" id="cep" name="cep" type="text" value="<?= $userById->getCep(); ?>">
        <h5>Celular</h5>
        <input class="form-control" id="celular" name="phone" type="text" value="<?= $userById->getPhone(); ?>">
        <h5>Endereço completo</h5>
        <input class="form-control" type="text" name="address" value="<?= $userById->getAddress(); ?>">
        <button class="form-control btn btn-dark mt-2 mb-2" name="action">Atualizar</button>
    </form>
</main>
<?php require __DIR__ . "/../../footer.php"; ?>

<?php

    if(isset($_POST['action_delete'])) {
        ACL::checkIfUserThenPermissionToDelete($user);

        $userController = new UserController();
        $userController->delete($userById);
    }

    if(isset($_POST['action'])) {
        ACL::checkIfUserThenPermissionToUpdate($user);

        $userController = new UserController();

        $userById->getAccessControl()->setId($_POST['id_access_control']);
        $userById->setEmail($_POST['email']);
        $userById->setPhone($_POST['phone']);
        $userById->setCep($_POST['cep']);
        $userById->setAddress($_POST['address']);

        $userController->update($userById);
    }