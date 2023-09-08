<?php 

use App\controllers\UserController;

    $userController = new UserController();

    $users = $userController->findAll();

?>
<h2>Usuários</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome completo</th>
              <th>Nome da mãe</th>
              <th>CPF</th>
              <th>Data de nascimento</th>
              <th>E-mail</th>
              <th>Celular</th>
              <th>Criado em</th>
              <th>Alterado em</th>
            </tr>
          </thead>
          <tbody>
            <?php

                foreach($users as $user) {
                    echo "
                    <tr>
                        <td>".$user['id']."</td>
                        <td>".$user['first_name']." ".$user['last_name']."</td>
                        <td>".$user['mother_name']."</td>
                        <td>".$user['cpf']."</td>
                        <td>".$user['birth']."</td>
                        <td>".$user['email']."</td>
                        <td>".$user['phone']."</td>
                        <td>".$user['created_at']."</td>
                        <td>".$user['updated_at']."</td>
                    </tr>
            ";
                }
            ?>
          </tbody>
        </table>
      </div>