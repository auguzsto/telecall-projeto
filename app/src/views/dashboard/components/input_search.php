<div class="col d-flex justify-content-end">
    <form method="POST" class="input-group">
      <select name="columns" id="" class="form-control">
        <option value="name">Por nome</option>
        <option value="cpf">Por CPF</option>
        <option value="email">Por e-mail</option>
      </select>
      <input type="text" name="value" class="form-control" placeholder="Digite a procura" required>
      <input type="submit" value="OK" class="btn btn-dark" name="action">
    </form>
</div>

<?php

use App\services\Logger;

    if(isset($_POST['action'])) {

      $columns = $_POST['columns'];
      $value = urlencode($_POST['value']);

      Logger::createDatabaseLog($user->getEmail(), "seleção", "pesquisou por ".strtoupper($columns)." que contenha $value");
      header("Location: /dashboard/users/?$columns=$value");

    }