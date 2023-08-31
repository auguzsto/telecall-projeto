<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="app/assets/css/style.css">
    <title>Telecall</title>
</head>
<body>
<nav class="navbar navbar-extand-lg light bg-light shadow p-3 mb-5 bg-white rounded">
    <a href="/"><img src="app/assets/images/navbar.png" class="navbar brand img-fluid"></a>
    <a href="/cadastro" class="text-primary"><b>Fazer cadastro</b></a>
</nav>
    <div class="container">
        <div class="row no-gutters">
            <div class="col-xl-6">
                <img src="app/assets/images/bg-login.png" alt="" id="bg-login" class="img-fluid">
            </div>
            <div class="col-sm-6">
                <p class="center"><img src="app/assets/images/cardTopLogin.png" alt=""></p>
                <div class="card">
                    <div class="card-header text-lg-center">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST" name="action">
                            <div id="error" class="rounded bg-error border-danger text-danger text-center justify-content-center mt-3 mb-3"></div>
                            <label for=""><h4>E-mail:</h4></label>
                            <br>
                            <input type="text" name="email" id="user" placeholder="Seu e-mail" class="form-control" onkeypress="" required autocomplete="off">
                            <label for="" class="labelLogin"><h4>Senha:</h4></label>
                            <br>
                            <input type="password" name="password" id="password" placeholder="Sua senha." class="form-control" required>
                            <div id="error" class="rounded bg-error border-danger text-danger text-center justify-content-center mt-3 mb-3"></div>
                            <input type="submit" name="action" id="sendAuth" class="form-control btn-primary" onclick="" value="Acessar"></input>
                        </form>
                        <br>
                       <p><a href="" class="text-primary">Esqueceu a senha?</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
                <hr>
                <div class="col">
                    
                </div>
                
            </div>
        </div>

    </div>
</body>
</html>
<script src="app/assets/js/jquery.slim.min.js"></script>
<script src="app/assets/js/popper.min.js"></script>
<script src="app/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="app/assets/js/auth.js"></script>

<?php 

use App\controllers\AuthController;


    if(isset($_POST['action'])) {

        $authController = new AuthController();

        $authController->signIn($_POST['email'], $_POST['password']);
    }

?>