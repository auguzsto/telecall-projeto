<?php


use App\models\User;
use App\services\Session;
use App\controllers\UserController;
    
    Session::check();
    $user = $_SESSION['session'];

    $userController = new UserController();
    $userById = User::fromMap($userController->findById($r['id'])[0]);

?>

<?php include __DIR__ . "/modules/header.php"; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Editar</h1>  
    </div>
    <form method="POST">
        <h5>CPF</h5>
        <input class="form-control" type="text" value="<?php echo $userById->getCpf(); ?>" disabled>
        <h5>Nome</h5>
        <input class="form-control" type="text" value="<?php echo $userById->getFirstName(); ?>" disabled>
        <h5>Último nome</h5>
        <input class="form-control" type="text" value="<?php echo $userById->getLastName(); ?>" disabled>
        <h5>Senha</h5>
        <input class="form-control" type="password" value="<?php echo $userById->getPassword(); ?>">
        <h5>E-mail</h5>
        <input class="form-control" type="text" value="<?php echo $userById->getEmail(); ?>">
        <h5>CEP</h5>
        <input class="form-control" type="text" value="<?php echo $userById->getCep(); ?>">
        <h5>Celular</h5>
        <input class="form-control" type="text" value="<?php echo $userById->getPhone(); ?>">
        <h5>Endereço completo</h5>
        <input class="form-control" type="text" value="<?php echo $userById->getAddress(); ?>">
    </form>
</main>

<?php

    include __DIR__ . "/modules/footer.php";