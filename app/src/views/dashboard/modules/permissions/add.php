<?php

use App\controllers\AccessControlController;
use App\controllers\ProfileController;
use App\models\Profile;
use App\services\ACL;
use App\services\Session;
    
    Session::check();
    $user = $_SESSION['session'];

?>

<?php require __DIR__ . "/../../header.php"; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Criar perfil</h1>
    </div>
    <form method="POST">
        <h5>Nome</h5>
        <input class="form-control" type="text" name="name_profile" required>
        
        <button class="form-control btn btn-dark mt-2 mb-2" name="action">Adicionar</button>
    </form>
</main>
<?php require __DIR__ . "/../../footer.php"; ?>

<?php 

    if(isset($_POST['action'])) {

        $profile = new Profile();
        $profile->setName($_POST['name_profile']);
        
        ACL::checkIfUserThenPermissionToInsert($thisModule);

        ProfileController::create($profile);
        $profile->setId(ProfileController::findByName($profile->getName())['id']);
        
        AccessControlController::createPermissionsDefault($profile);

    }

?>