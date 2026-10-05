<?php

$id = filter_input(INPUT_GET, 'id');

include_once __DIR__ . '/../../DAO/ClienteDAO.php';

$dao = new ClienteDAO();

$cliente = $dao->consultarPorID((int)$id);

?>

<h3 class="mt-3 text-primary">
    Alterar Cliente
</h3>

<div class="card shadow mt-3">

    <form method="post"
          name="formsalvar"
          id="formSalvar"
          class="m-3">

        <input type="hidden"
               name="id"
               value="<?= $cliente->getId() ?>">

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
                       value="<?= $cliente->getNome() ?>">

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
                       value="<?= $cliente->getEmail() ?>">

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
                    value="<?= $cliente->getTelefone() ?>">

            </div>

        </div>

        <div class="form-group row">

            <div class="col-sm-10">

                <input type="submit"
                       class="btn btn-primary"
                       name="btnsalvar"
                       value="Salvar">

            </div>

            <a href="?p=clientes"
               class="btn btn-danger">

                Cancelar

            </a>

        </div>

    </form>

</div>

<?php

if (filter_input(INPUT_POST, 'btnsalvar')) {

    $cliente->setNome(filter_input(INPUT_POST, "txtnome"));
    $cliente->setEmail(filter_input(INPUT_POST, "txtemail"));
    $cliente->setTelefone(filter_input(INPUT_POST, "txttelefone"));

    if ($dao->salvar($cliente)) {
?>

        <div class="alert alert-primary mt-3" role="alert">

            Cliente - alteração efetuada com sucesso.

        </div>

        <meta http-equiv="refresh"
              content="0.2;URL=?p=clientes">

<?php
    } else {
?>

        <div class="alert alert-danger mt-3" role="alert">

            Cliente - erro ao alterar.

        </div>

<?php
    }
}
?>