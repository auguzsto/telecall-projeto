<?php

use App\controllers\UserController;
use App\handlers\Handlers;
use App\services\Session;
    
    Session::check();
    $user = $_SESSION['session'];

?>

<?php include __DIR__ . "/modules/header.php"; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Alterar senha</h1>  
    </div>
    <form method="POST">
        <h5>Senha atual</h5>
        <input class="form-control" type="password" name="current-password" required>
        <h5>Nova senha</h5>
        <input class="form-control" type="password" name="new-password" required>
        <h5>Repita a nova senha</h5>
        <input class="form-control" type="password" name="re-password" required>
        <button class="form-control btn btn-dark mt-2 mb-2" name="action">Atualizar</button>
    </form>
</main>
<?php include __DIR__ . "/modules/footer.php"; ?>

<?php

    if(isset($_POST['action'])) {

        $userController = new UserController();
        $currentPassword = password_verify($_POST['current-password'], $user->getPassword());
        $password = $_POST['new-password'];
        $repassword = $_POST['re-password'];

        if($currentPassword != $user->getPassword() || $password != $repassword) {
            return Handlers::warning('Atenção','Refaça o procedimento para alterar a senha, algo está incorreto.');
        }

        $user->setPassword($_POST['new-password']);
        $userController->updatePassword($user);
    }