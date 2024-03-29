$(document).ready(function() {
    $("#cpf").mask('000.000.000-00', {reverse: false});
    $("#celular").mask('(00) 0 0000-0000', {reverse: false});
    $("#cep").mask('00000-000', {reverse: false});
});

let repassord = document.querySelector('#rePassword');
let password = document.getElementById('password');
let cep = document.getElementById('cep');
let address = document.getElementById('address');

repassord.addEventListener('change', function (e) {
    
    if(e.target.value != password.value) {
        e.target.classList.add("border", "border-danger");
        document.querySelector('#error-password').innerHTML = "<h6 class='p-1 text-danger'>Senhas não coincidem</h6>";
    } else {
        e.target.classList.remove("border", "border-danger");
        document.querySelector('#error-password').innerHTML = "";
    }
});

async function getAddressByCep(cep) {
    const options = {
        method: "GET",
        mode: "cors",
        headers: {
            'content-type': 'application/json;charset=utf-8',
        }
    }

    const response = await fetch('https://brasilapi.com.br/api/cep/v1/'+cep, options);
    return response.json();
}

function handlerAddress(logradouro, bairro, localidade, uf) {
    return logradouro+", "+bairro+", "+localidade+", "+uf;
}

cep.addEventListener('keyup', async function (e) {

    if(e.target.value.length >= 8) {
        var dataAddress = await getAddressByCep(e.target.value);

        try {
            let handlerAddres = handlerAddress(dataAddress.street, dataAddress.neighborhood, dataAddress.city, dataAddress.state);

            if(handlerAddres != "undefined, undefined, undefined, undefined") {
                return address.value = handlerAddres;
            }

            throw "Não foi possível localizar endereço";
            

        } catch (error) {
            address.value = error;
        }
    }

});
