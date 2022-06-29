function checkUser(){
    const dbUsers = ['11111111111', '22222222222'];
    const dbPassword = ['123', 'admin'];
    for(var c = 0; c < dbUsers.length; c < dbPassword.length){
       if(dbUsers[c] == document.getElementById('user').value && dbPassword[c] == document.getElementById('password').value){
            if(dbUsers[1] == document.getElementById('user').value) {
                window.location.href = 'admin/index.html';
            } else {
                window.location.href = 'cliente/index.html';
            }
       } else {
            var e = 0;
            const button = document.getElementById('sendAuth');
            document.getElementById('error').innerHTML = 'Senha ou usuário inválidos';
            button.addEventListener('click', () => {
                e++;
                if(e > 4) {
                    document.getElementById('error').innerHTML = 'Você excedeu o limite de tentativas. Tente novamente em alguns instantes...',
                    setTimeout(() => {
                        document.getElementById('sendAuth').disabled = false,
                        window.location.href = 'login.html';
                    }, 6000)
                } 
            })
       }
       c++;
    }
}

function checkRegister() {
    var cpf = document.getElementById('cpf');
    if(!cpf.value) {
        cpf.focus()
        document.getElementById('cpfError').innerHTML = 'Não esqueça de por seu CPF.';
    } else if(cpf.value.length <= 10){
        document.getElementById('cpfError').innerHTML = 'Digite seu CPF completo.';
    } else {
        document.getElementById('cpfError').innerHTML = '';
    }
    var senha = document.getElementById('senha');
    if(!senha.value) {
        senha.focus()
        document.getElementById('senhaError').innerHTML = 'Você esqueceu de digitar uma senha.';
    } else if(senha.value.length < 7) {
        document.getElementById('senhaError').innerHTML = 'A senha deve conter, no mínimo, 8 carácteres';
    } else {
        document.getElementById('senhaError').innerHTML = '';
    }
    var resenha = document.getElementById('resenha');
    if(!resenha.value) {
        resenha.focus()
        document.getElementById('resenhaError').innerHTML = 'Repita a sua senha.';
    } else if(senha.value != resenha.value) {
        document.getElementById('resenhaError').innerHTML = 'As senhas devem ser iguais';
    } else {
        document.getElementById('resenhaError').innerHTML = '';
    }
    var nomeCompleto = document.getElementById('nomeCompleto');
    if(!nomeCompleto.value) {
        nomeCompleto.focus()
        document.getElementById('nomeCompletoError').innerHTML = 'Digite seu nome completo.';
    } else if(nomeCompleto.value.length < 10) {
        document.getElementById('nomeCompletoError').innerHTML= 'Por favor, digite seu nome completo';
    } else {
        document.getElementById('nomeCompletoError').innerHTML = '';
    }
    var maternoCompleto = document.getElementById('maternoCompleto');
    if(!maternoCompleto.value) {
        maternoCompleto.focus()
        document.getElementById('maternoCompletoError').innerHTML = 'Digite o nome completo.';
    } else if(maternoCompleto.value.length < 10) {
        document.getElementById('maternoCompletoError').innerHTML= 'Por favor, digite o nome completo'
    } else {
        document.getElementById('maternoCompletoError').innerHTML = '';
    }
    var dataNascimento = document.getElementById('dataNascimento');
    if(!dataNascimento.value) {
        dataNascimento.focus()
        document.getElementById('dataNascimentoError').innerHTML = 'Insira sua data de nascimento.';
    } else {
        document.getElementById('dataNascimentoError').innerHTML = '';
    }
    var genero = document.getElementById('genero');
    var valor = genero.options[genero.selectedIndex].text;
    if(!valor){
        genero.focus()
        document.getElementById('generoError').innerHTML = 'Selecione um gênero.';
    } else {
        document.getElementById('generoError').innerHTML = '';
    }
    var celular = document.getElementById('celular');
    if(!celular.value) {
        celular.focus()
        document.getElementById('celularError').innerHTML = 'Digite seu número de celular.';
    } else if(celular.value.length < 11){
        document.getElementById('celularError').innerHTML = 'Insira um número de celular válido';
    } else {
        document.getElementById('celularError').innerHTML = '';
    }
    var enderecoCompleto = document.getElementById('enderecoCompleto');
    if(!enderecoCompleto.value) {
        enderecoCompleto.focus()
        document.getElementById('enderecoCompletoError').innerHTML = 'Digite seu endereço completo.';
    } else if(enderecoCompleto.value.length < 15) {
        document.getElementById('enderecoCompletoError').innerHTML = 'Insira o endereço com rua, município, estado e número, lote ou complemento';
    } else {
        document.getElementById('enderecoCompletoError').innerHTML = '';
    }
    var cep = document.getElementById('cep');
    if(!cep.value) {
        cep.focus()
        document.getElementById('cepError').innerHTML = 'Digite seu CEP.';
    } else if (cep.value.length < 7) {
        document.getElementById('cepError').innerHTML = 'Insira um CEP válido';
    } else {
        document.getElementById('cepError').innerHTML = '';
    }
    if(cpf.value && senha.value && resenha.value && nomeCompleto.value && dataNascimento.value && genero.value && celular.value && enderecoCompleto.value && cep){
        window.location.href = "cliente/index.html";
    }
}

function somenteNumero(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    //var regex = /^[0-9.,]+$/;
    var regex = /^[0-9.]+$/;
    if( !regex.test(key) ) {
       theEvent.returnValue = false;
       if(theEvent.preventDefault) theEvent.preventDefault();
    }
 }

ScrollReveal().reveal('.default', {
    delay: 200,
    distance: '10px',
    duration: 1000,
    origin: 'top',
});

ScrollReveal().reveal('.showHidden', {
    delay: 500,
    easing: 'cubic-bezier(0.5, 0, 0, 1)'
});