<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/app/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/app/assets/css/style.css">
    <script type="text/javascript" src="/app/assets/js/auth.js"></script>
    <title>Telecall</title>
</head>
<body>
<nav class="navbar navbar-extand-lg light bg-light shadow p-3 mb-5 bg-white rounded">
    <a href="/"><img src="/app/assets/images/navbar.png" class="navbar brand img-fluid"></a>
    <a href="/login" class="text-primary"><b>Acessar conta</b></a>
</nav>
    <div class="container">
       <div class="row no-gutters">
            <div class="col-sm-" id="widthCol">
                <div class="card-group">
                    <div class="card">
                        <div class="card-header">
                            <img src="/app/assets/images/iconRegister.png" alt="" class="card-register"><span class="font-card-register"><b> Registrar</b></span>
                        </div>
                        
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-" id="widthCol2">
                                 <form method="POST" name="action">

                                     <h5>CPF: *</h5>
                                     <input type="text" name="cpf" id="cpf" placeholder="Apenas números são permitidos." class="form-control" maxlength="14" autocomplete="off" value="<?php echo $_POST['cpf']; ?>">

                                     <h5>Senha: *</h5>
                                     <input type="password" name="password" id="password" placeholder="Digite sua senha." class="form-control">

                                     <h5>Repita a senha: *</h5>
                                     <input type="password" name="rePassword" id="rePassword" placeholder="Digite sua senha novamente." class="form-control">

                                     <h5>Nome: *</h5>
                                     <input type="text" name="first_name" id="first_name" placeholder="Seu primeiro nome" class="form-control" value="<?php echo $_POST['first_name']; ?>">

                                     <h5>Último nome: *</h5>
                                     <input type="text" name="last_name" id="last_name" placeholder="Seu último nome" class="form-control" value="<?php echo $_POST['last_name']; ?>">

                                     <h5>Email: *</h5>
                                     <input type="email" name="email" id="email" placeholder="Seu email" class="form-control" value="<?php echo $_POST['email']; ?>" required>
                                     
                                     <h5>Nome materno: *</h5>
                                     <input type="text" name="mother_name" id="maternoCompleto" placeholder="Digite o nome materno completo." class="form-control" value="<?php echo $_POST['mother_name']; ?>" required>

                                     <h5>Data de nascimento: *</h5>
                                     <input type="date" name="birth" id="dataNascimento" placeholder="Insira sua data de nascimento." class="form-control" value="<?php echo $_POST['birth']; ?>" required>    
                                </div>
                                
                                <div class="col-sm-" id="widthCol2">
                                 <h5>Gênero: *</h5>
                                 <select name="genero" id="genero" class="form-control">
                                    <option value="1" selected="selected"></option>
                                     <option value="2">Masculino</option>
                                     <option value="3">Feminino</option>
                                     <option value="4">Prefiro não dizer</option>
                                 </select>
                                 <h6 class="text-danger" id="generoError"></h6>   
                                 
                                 <h5>Celular: *</h5>
                                 <input type="text" maxlength="14" name="phone" id="celular" placeholder="Digite seu número de celular com DDD." class="form-control" autocomplete="off" value="<?php echo $_POST['phone']; ?>" required>

                                 <h5>Telefone fixo: </h5>
                                 <input type="text" name="telefoneFixo" placeholder="Digite seu telefone fixo." class="form-control">

                                 <h5>Endereço completo: *</h5>
                                 <input type="text" id="enderecoCompleto" name="address" placeholder="Digite seu endereço completo." class="form-control" autocomplete="off" value="<?php echo $_POST['address']; ?>" required>

                                 <h5>CEP: *</h5>
                                 <input type="text" maxlength="8" name="cep" id="cep" placeholder="Digite seu CEP." class="form-control" value="<?php echo $_POST['cep']; ?>" required>

                                 <label for=""></label>
                                 <input type="submit" class="form-control btn-primary border" id="enviarCadastro" name="action" onclick="" value="Registrar"></input>

                                 </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
</body>
</html>
<script src="/app/assets/js/jquery.slim.min.js"></script>
<script src="/app/assets/js/jquery.mask.min.js"></script>
<script src="/app/assets/js/popper.min.js"></script>
<script src="/app/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/app/assets/js/register.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php 

use App\models\User;
use App\controllers\UserController;

    if(isset($_POST['action'])) {
        $map = [
            "first_name" => $_POST['first_name'],
            "last_name" => $_POST['last_name'],
            "mother_name" => $_POST['mother_name'],
            "email" => $_POST['email'],
            "password" => $_POST['password'],
            "phone" => $_POST['phone'],
            "cpf" => $_POST['cpf'],
            "cep" => $_POST['cep'],
            "address" => $_POST['address'],
            "birth" => $_POST['birth'],
            "created_at" => date('Y-m-d H:i:s'),
        ];
        
        $userController = new UserController();

        $userController->create(User::fromMap($map));
    }

?>