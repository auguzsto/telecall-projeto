<?php

use App\services\Session;

    Session::check();
    $user = $_SESSION['session'];
    Session::checkPermissions($user);

    $reports = $_SESSION['reports'];

    switch($r['users']) {
      case "created_at":
        $type = "criados";
        break;

      case "updated_at":
        $type = "atualizados";
        break;

      case "deleted_at":
        $type = "detalados";
        break;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de usuários <?php echo $type; ?> entre <?php echo $r['begin']; ?> à <?php echo $r['final']; ?></title>
    <link rel="stylesheet" href="/app/assets/css/bootstrap.min.css">
</head>
<body>
  <div class="d-flex justify-content-between p-2">
    <h2>Relatório de usuários <?php echo $type; ?> entre <?php echo $r['begin']; ?> à <?php echo $r['final']; ?></h2>
    <a onclick="window.print()"><div class="btn btn-dark d-print-none">Imprmir | PDF</div></a>
  </div>
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome completo</th>
              <th>Nome materno</th>
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

                foreach($reports as $report) {
                    $id = $report['id'];
                    echo "
                    <tr>
                        <td>".$report['id']."</td>
                        <td>".$report['first_name']." ".$report['last_name']."</a></td>
                        <td>".$report['mother_name']."</td>
                        <td>".$report['cpf']."</td>
                        <td>".$report['birth']."</td>
                        <td>".$report['email']."</td>
                        <td>".$report['phone']."</td>
                        <td>".$report['created_at']."</td>
                        <td>".$report['updated_at']."</td>
                    </tr>
            ";
                }
            ?>
          </tbody>
        </table>
      </div>
<div class="col p-2">
  <h5>Total de resultados <?php echo count($reports); ?></h5>
</div>
</div>
</body>
</html>

<?php 

      unset($_SESSION['reports']);