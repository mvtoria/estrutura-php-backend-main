<?php

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    echo '<div class="alert alert-danger mt-3">Fornecedor não encontrado.</div>';
    exit;
}

include_once __DIR__ . '/../../Controller/FornecedorController.php';

$controller = new FornecedorController();
$fornecedor = $controller->consultarPorID($id);

if (!$fornecedor) {
    echo '<div class="alert alert-danger mt-3">Fornecedor não encontrado.</div>';
    exit;
}

?>

<h3 class="mt-3 text-primary">
    Alterar Fornecedor
</h3>

<div class="card shadow mt-3">

    <form method="post"
          name="formalterar"
          id="formAlterar"
          class="m-3">

        <input type="hidden"
               name="txtid"
               value="<?= $fornecedor->getId() ?>">

        <div class="form-group row">
            <label for="txtrazao_social"
                   class="col-sm-2 col-form-label">
                Razão Social
            </label>

            <div class="col-sm-10">
                <input type="text"
                       class="form-control"
                       id="txtrazao_social"
                       name="txtrazao_social"
                       value="<?= htmlspecialchars($fornecedor->getRazaoSocial()) ?>"
                       placeholder="Razão Social">
            </div>
        </div>

        <div class="form-group row">
            <label for="txtemail"
                   class="col-sm-2 col-form-label">
                Email
            </label>

            <div class="col-sm-10">
                <input type="email"
                       class="form-control"
                       id="txtemail"
                       name="txtemail"
                       value="<?= htmlspecialchars($fornecedor->getEmail()) ?>"
                       placeholder="Email">
            </div>
        </div>

        <div class="form-group row">
            <label for="txttelefone"
                   class="col-sm-2 col-form-label">
                Telefone
            </label>

            <div class="col-sm-10">
                <input type="text"
                       class="form-control"
                       id="txttelefone"
                       name="txttelefone"
                       value="<?= htmlspecialchars($fornecedor->getTelefone()) ?>"
                       placeholder="Telefone">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <input type="submit"
                       class="btn btn-primary"
                       name="btnsalvar"
                       value="Salvar">
            </div>

            <a href="?p=fornecedores"
               class="btn btn-danger">
                Cancelar
            </a>
        </div>

    </form>
</div>

<?php

if (filter_input(INPUT_POST, 'btnsalvar')) {

    if ($controller->salvar()) {
?>

        <div class="alert alert-primary mt-3" role="alert">
            Fornecedor - alteração efetuada com sucesso.
        </div>

        <meta http-equiv="refresh"
              content="0.2;URL=?p=fornecedores">

<?php
    } else {
?>

        <div class="alert alert-danger mt-3" role="alert">
            Fornecedor - erro ao alterar.
        </div>

<?php
    }
}

?>