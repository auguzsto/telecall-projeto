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
                                 <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" name="action">
                                     <h5>CPF: *</h5>
                                     <input type="text" name="cpf" id="cpf" placeholder="Apenas números são permitidos." class="form-control" maxlength="14" onkeypress="" autocomplete="off">
                                     <h6 class="text-danger" id="cpfError"></h6>
                                     <h5>Senha: *</h5>
                                     <input type="password" name="password" id="senha" placeholder="Digite sua senha." class="form-control">
                                     <h6 class="text-danger" id="senhaError"></h6>
                                     <h5>Repita a senha: *</h5>
                                     <input type="password" name="rePassword" id="resenha" placeholder="Digite sua senha novamente." class="form-control">
                                     <h6 class="text-danger" id="resenhaError"></h6>      
                                     <h5>Nome: *</h5>
                                     <input type="text" name="first_name" id="fist_name" placeholder="Seu primeiro nome" class="form-control">
                                     <h6 class="text-danger" id=""></h6>
                                     <h5>Último nome: *</h5>
                                     <input type="text" name="last_name" id="last_name" placeholder="Seu último nome" class="form-control">
                                     <h5>Email: *</h5>
                                     <input type="text" name="email" id="email" placeholder="Seu email" class="form-control">
                                     <h6 class="text-danger" id=""></h6>
                                     <h5>Nome materno: *</h5>
                                     <input type="text" name="mother_name" id="maternoCompleto" placeholder="Digite o nome materno completo." class="form-control">
                                     <h6 class="text-danger" id="maternoCompletoError"></h6>    
                                     <h5>Data de nascimento: *</h5>
                                     <input type="date" name="birth" id="dataNascimento" placeholder="Insira sua data de nascimento." class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                     <h6 class="text-danger" id="dataNascimentoError"></h6>    
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
                                 <input type="text" maxlength="14" name="phone" id="celular" placeholder="Digite seu número de celular com DDD." class="form-control" onkeypress="somenteNumero();" autocomplete="off" value="+55">
                                 <h6 class="text-danger" id="celularError"></h6> 
                                 <h5>Telefone fixo: </h5>
                                 <input type="text" name="telefoneFixo" placeholder="Digite seu telefone fixo." class="form-control" onkeypress="somenteNumero();">
                                 <h5>Endereço completo: *</h5>
                                 <input type="text" id="enderecoCompleto" name="address" placeholder="Digite seu endereço completo." class="form-control" autocomplete="off">
                                 <h6 class="text-danger" id="enderecoCompletoError"></h6>
                                 <h5>CEP: *</h5>
                                 <input type="text" maxlength="8" name="cep" id="cep" placeholder="Digite seu CEP." class="form-control" onkeypress="somenteNumero();">
                                 <h6 class="text-danger" id="cepError"></h6>
                                 <label for=""></label>
                                 <input type="submit" class="form-control btn-primary border" id="enviarCadastro" name="action" onclick="" value="Registrar"></input>
                                 <h6 class="text-success" id="checkAll"></h6>
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
<script src="/app/assets/js/popper.min.js"></script>
<script src="/app/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/app/assets/js/auth.js"></script>

<?php 

use App\models\Auth;
use App\models\User;
use App\controllers\AuthController;
use App\controllers\UserController;

    if(isset($_POST['action'])) {
        $user = new User();
        $userController = new UserController();
        
        $user->setIsAdmin(0);
        $user->setFirstName($_POST['first_name']);
        $user->setLastName($_POST['last_name']);
        $user->setMotherName($_POST['mother_name']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->setPhone(strval($_POST['phone']));
        $user->setCpf($_POST['cpf']);
        $user->setCep($_POST['cep']);
        $user->setAddress($_POST['address']);
        $user->setBirth($_POST['birth']);
        $user->setCreated_at(date('Y-m-d H:i:s'));

        $userController->create($user);

        $auth = new Auth();
        $authController = new AuthController();

        $auth->setUser($user);
        $authController->basicToken($auth);
    }

?>