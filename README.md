# Projeto acadêmico.

Implementação de back-end utilizando PHP. Proíbido a utilização de qualquer framework para realização deste projeto.

# Requerimentos
- PHP
    - ext-pdo
    - ext-pdo_mysql
- Composer
- MySQL ou MariaDB

# Como correr o projeto?
Certifique que tenha os requerimentos necessários acima. Na pasta raíz do projeto, faça os seguintes passos.
1. Configure as variáveis, em **/app/src/config/Config.php**, para conexão de acordo com seu banco de dados.
```
    public static string $dbhost = "LOCALHOST";
    public static string $dbport = "PORTA";
    public static string $dbuser = "USUÁRIO";
    public static string $dbpassword = "SENHA";
```
2. Instale as depedências via composer.
```
composer install
```
3. Rode o servidor web nativo do php.
```
php -S 0.0.0.0:8000 -t .
```

## Contexto.
Uma Empresa de Telefonia e Telecomunicações fez um estudo de viabilidade para divulgação de seus
produtos e serviços e identificou a necessidade de construir um site.
A partir de então, encomendou um projeto educacional e pedagógico para elaboração do site através
de ferramentas de desenvolvimento Back-End a fim de identificar a oportunidade de evolução do
sistema.

## Perfis de usuário
- [x] Perfil administrativo (Master)
- [x] Perfil comum (Usuário)

## Funcionalidades
- [x] Login - (Master | Comum)
    - Tela de Login deve possuir os campos Login e
Senha. A tela deve ter a opção de tipo de
perfil que o usuário pretende se logar. O tipo
de perfil deve ser master ou usuário comum.
A tela também deverá ter um link para o
cadastro de usuário.
- [x] Tratamento de erros - (Master | Comum)
    - Tela de erro quando algo inesperado
acontece, como por exemplo, erro na
autenticação do usuário.
- [x] Autenticação de dois fatores (2FA)
- [x] Dashboard - (Master | Comum)
    - Deve ter menu com as opções relacionadas
ao acesso de cada perfil logado (lembre-se
que o menu do usuário master possui mais
opções que o menu do usuário comum) e
outras informações relacionadas à Empresa
de Telefonia.
- [ ] Consulta de usuário - (Master)
    - Essa tela deve apresentar a lista de usuários
do sistema. A tela deverá ter um campo de
pesquisa, onde o usuário master poderá
pesquisar por uma substring (pedaço do
nome do usuário comum). Assim, a lista
deverá apresentar a lista de todos os
usuários comuns que contém a substring
como parte de seu nome.
- [x] Cadastro de usuário - (Master | Comum)
    - Campo para cadastrar usuário comum.
Somente o usuário comum poderá se
cadastrar pelo sistema. Já o usuário master é
criado dentro do próprio banco de dados, via
script sql.
- [ ] Alteração de senha - (Master | Comum)
    - Somente o usuário comum poderá alterar a
senha dele próprio
- [ ] Modelo do banco de dados - (Master | Comum)
    - Essa tela deverá ter uma imagem com a
modelagem do banco de dados utilizada para
este sistema.
- [ ] Inserir botão para baixar lista de usuários no formato PDF. (Master)

## Sobre 2FA
A tela deve ter os seguintes campos:
A tela deve apresentar um campo de resposta para uma das seguintes perguntas:

- Qual o nome da sua mãe?
- Qual a data do seu nascimento?
- Qual o CEP do seu endereço?
A tela deve apresentar um botão de envio.

Regras para submeter o formulário.
- A resposta deve ser preenchida.
- A geração da pergunta deve ser aleatória e o usuário deve responder de acordo com o valor
correspondente que cadastrado no Banco de Dados.
