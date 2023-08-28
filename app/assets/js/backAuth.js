var user = document.querySelector('input[name=user]');
    var password = document.querySelector('input[name=password]');
    if(user.value == '11111111111' && password.value == 'unisuam'){
        window.location.href = 'cliente/index.html';
    } else if(user.value == '22222222222' && password.value == 'admin'){
        window.location.href = 'admin/index.html';
    } else {
        password.setCustomValidity('Senha ou usuário incorreto');
    }

    var dbUsers = ['11111111111', '1', '22222222222', 'admin'];
    var user = document.getElementById('user');
    var password = document.getElementById('password');
    if(user.value == dbUsers[0] && password.value == dbUsers[1]) {
       window.location.href = 'cliente/index.html';
    } else {
        
    }