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
    <a href="/" class="text-primary"><b>Acessar conta</b></a>
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
                                 <form action="" method="POST" name="">
                                     <h5>CPF: *</h5>
                                     <input type="text" name="cpf" id="cpf" placeholder="Apenas números são permitidos." class="form-control" maxlength="11" onkeypress="somenteNumero();" autocomplete="off">
                                     <h6 class="text-danger" id="cpfError"></h6>
                                     <h5>Senha: *</h5>
                                     <input type="password" name="password" id="senha" placeholder="Digite sua senha." class="form-control">
                                     <h6 class="text-danger" id="senhaError"></h6>
                                     <h5>Repita a senha: *</h5>
                                     <input type="password" name="rePassword" id="resenha" placeholder="Digite sua senha novamente." class="form-control">
                                     <h6 class="text-danger" id="resenhaError"></h6>      
                                     <h5>Nome completo: *</h5>
                                     <input type="text" name="nomeCompleto" id="nomeCompleto" placeholder="Digite seu nome completo." class="form-control">
                                     <h6 class="text-danger" id="nomeCompletoError"></h6>
                                     <h5>Nome materno: *</h5>
                                     <input type="text" name="maternoCompleto" id="maternoCompleto" placeholder="Digite o nome materno completo." class="form-control">
                                     <h6 class="text-danger" id="maternoCompletoError"></h6>    
                                     <h5>Data de nascimento: *</h5>
                                     <input type="date" name="dataNascimento" id="dataNascimento" placeholder="Insira sua data de nascimento." class="form-control">
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
                                 <input type="text" maxlength="14" name="celular" id="celular" placeholder="Digite seu número de celular com DDD." class="form-control" onkeypress="somenteNumero();" autocomplete="off" value="+55">
                                 <h6 class="text-danger" id="celularError"></h6> 
                                 <h5>Telefone fixo: </h5>
                                 <input type="text" name="telefoneFixo" placeholder="Digite seu telefon fixo." class="form-control" onkeypress="somenteNumero();">
                                 <h5>Endereço completo: *</h5>
                                 <input type="text" id="enderecoCompleto" name="endereço" placeholder="Digite seu endereço completo." class="form-control" autocomplete="off">
                                 <h6 class="text-danger" id="enderecoCompletoError"></h6>
                                 <h5>CEP: *</h5>
                                 <input type="text" maxlength="8" name="cep" id="cep" placeholder="Digite seu CEP." class="form-control" onkeypress="somenteNumero();">
                                 <h6 class="text-danger" id="cepError"></h6>
                                 <label for=""></label>
                                 <button class="form-control btn-primary border" id="enviarCadastro" name="enviarCadastro" onclick="checkRegister(); return false">Registrar</button>
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
