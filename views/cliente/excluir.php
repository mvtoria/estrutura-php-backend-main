<?php

$id = filter_input(INPUT_GET, 'id');

if ($id) {

    include_once __DIR__ . '/../../DAO/ClienteDAO.php';

    $dao = new ClienteDAO();

    if ($dao->excluir((int)$id)) {
?>

        <div class="alert alert-primary" role="alert">
            Excluído com sucesso
        </div>

<?php
    }
}
?>

<meta http-equiv="refresh"
      content="1.5;URL=?p=clientes">