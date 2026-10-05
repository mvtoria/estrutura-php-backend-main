<?php

$id = filter_input(INPUT_GET, 'id');

if ($id) {

    include_once __DIR__ . '/../../models/Funcionario.php';

    $func = new Funcionario();
    $func->setID($id);

    if ($func->excluir()) {
?>

        <div class="alert alert-primary" role="alert">
            Excluído com sucesso
        </div>

<?php
    }
}
?>

<meta http-equiv="refresh"
      content="1.5;URL=?p=funcionarios">