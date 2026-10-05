<?php

$id = filter_input(INPUT_GET, 'id');

if ($id) {

    include_once __DIR__ . '/../../models/Categoria.php';

    $cat = new Categoria();
    $cat->setID($id);

    if ($cat->excluir()) {
?>

        <div class="alert alert-primary" role="alert">
            Excluído com sucesso
        </div>

<?php
    }
}
?>

<meta http-equiv="refresh"
      content="1.5;URL=?p=categorias">