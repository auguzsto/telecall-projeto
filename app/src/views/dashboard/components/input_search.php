<div class="col d-flex justify-content-end">
    <form method="POST" class="form-inline">
    <input type="text" name="name" class="form-control" placeholder="Procurar por nome" required>
    <input type="submit" value="OK" class="btn btn-dark" name="action">
    </form>
</div>

<?php

    if(isset($_POST['action'])) {
      
      $name = urlencode($_POST['name']);
      header("Location: /dashboard/user/?name=$name");

    }