<?php

$id = filter_input(INPUT_GET, 'id');

include_once __DIR__ . '/../../DAO/FornecedorDAO.php';

$dao = new FornecedorDAO();

$fornecedor = $dao->consultarPorID((int)$id);

?>

<h3 class="mt-3 text-primary">
    Alterar Fornecedor
</h3>

<div class="card shadow mt-3">

    <form method="post"
          name="formsalvar"
          id="formSalvar"
          class="m-3">

        <input type="hidden"
               name="id"
               value="<?= $fornecedor->getId() ?>">

        <div class="form-group row">

            <label for="txtnome"
                   class="col-sm-2 col-form-label">

                Nome

            </label>

            <div class="col-sm-10">

                <input type="text"
                       class="form-control"
                       id="txtnome"
                       name="txtnome"
                       value="<?= $fornecedor->getNome() ?>">

            </div>

        </div>

        <div class="form-group row">

            <label for="txtcidade"
                   class="col-sm-2 col-form-label">

                Cidade

            </label>

            <div class="col-sm-10">

                <input type="text"
                       class="form-control"
                       id="txtcidade"
                       name="txtcidade"
                       value="<?= $fornecedor->getCidade() ?>">

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

    $fornecedor->setNome(filter_input(INPUT_POST, "txtnome"));
    $fornecedor->setCidade(filter_input(INPUT_POST, "txtcidade"));

    if ($dao->salvar($fornecedor)) {
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