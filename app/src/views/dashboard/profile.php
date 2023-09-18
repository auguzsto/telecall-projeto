<?php

use App\controllers\UserController;
use App\services\Session;
    
    Session::check();
    $user = $_SESSION['session'];

?>

<?php include __DIR__ . "/modules/header.php"; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Perfil</h1>  
    </div>
    <form method="POST">
        <h5>CPF</h5>
        <input class="form-control" type="text" value="<?php echo $user->getCpf(); ?>" disabled>
        <h5>Nome</h5>
        <input class="form-control" type="text" value="<?php echo $user->getFirstName(); ?>" disabled>
        <h5>Último nome</h5>
        <input class="form-control" type="text" value="<?php echo $user->getLastName(); ?>" disabled>
        <h5>Senha</h5>
        <div class="input-group"><input class="form-control" type="password" name="password" value="<?php echo $user->getPassword(); ?>" disabled><a href="/dashboard/changepassword"><div class="btn btn-dark">Alterar senha</div></a></div>
        <h5>E-mail</h5>
        <input class="form-control" type="text" name="email" value="<?php echo $user->getEmail(); ?>">
        <h5>CEP</h5>
        <input class="form-control" type="text" name="cep" value="<?php echo $user->getCep(); ?>">
        <h5>Celular</h5>
        <input class="form-control" type="text" name="phone" value="<?php echo $user->getPhone(); ?>">
        <h5>Endereço completo</h5>
        <input class="form-control" type="text" name="address" value="<?php echo $user->getAddress(); ?>">
        <button class="form-control btn btn-dark mt-2 mb-2" name="action">Atualizar</button>
    </form>
</main>
<?php include __DIR__ . "/modules/footer.php"; ?>

<?php

    if(isset($_POST['action'])) {

        $userController = new UserController();

        $user->setEmail($_POST['email']);
        $user->setPhone($_POST['phone']);
        $user->setCep($_POST['cep']);
        $user->setAddress($_POST['address']);

        $userController->update($user);
    }