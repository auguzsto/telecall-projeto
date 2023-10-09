<?php
use App\services\Logger;

    $reports = $_SESSION['reports'];

    switch($r['profiles']) {
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
    <title>Relatório de perfis <?= $type; ?> entre <?= $r['begin']; ?> à <?= $r['final']; ?></title>
    <link rel="stylesheet" href="/app/assets/css/bootstrap.min.css">
</head>
<body>
  <div class="d-flex justify-content-between p-2">
    <h2>Relatório de perfis <?= $type; ?> entre <?= $r['begin']; ?> à <?= $r['final']; ?></h2>
    <a onclick="window.print()"><div class="btn btn-dark d-print-none">Imprmir | PDF</div></a>
  </div>
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Criado em</th>
              <th>Alterado em</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($reports as $row): ?>
              <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['name']; ?></td>
                <td><?= $row['created_at']; ?></td>
                <td><?= $row['updated_at']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
<div class="col p-2">
  <h5>Total de resultados <?= count($reports); ?></h5>
</div>
</div>
</body>
</html>

<?php 
      Logger::createDatabaseLog($user->getEmail(), "seleção", "gerou relatório sobre perfis $type");
      unset($_SESSION['reports']);