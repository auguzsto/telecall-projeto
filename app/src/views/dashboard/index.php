<?php

use App\services\Session;
    
    Session::check();
    $user = $_SESSION['session'];

    if($user->getIsAdmin() == 0) {
      return header('Location: ./profile');
    }

?>

<?php include __DIR__ . "/modules/header.php"; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="col">
          <h1 class="h2">Dashboard</h1>
        </div>
        <div class="col d-flex justify-content-end">
          <form method="POST" class="form-inline">
            <input type="text" name="name" class="form-control" placeholder="Procurar por nome" required>
            <input type="submit" value="OK" class="btn btn-dark" name="action">
          </form>
        </div>
      </div>
      <?php require __DIR__ . "/stats.php"; ?>
</main>

<?php include __DIR__ . "/modules/footer.php"; ?>

<?php

    if(isset($_POST['action'])) {
      
      $name = urlencode($_POST['name']);
      header("Location: /dashboard/user/?name=$name");

    }

