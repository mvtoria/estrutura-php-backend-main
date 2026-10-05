<h3 class="mt-3 text-primary">
    Fornecedor
</h3>

<div class="card shadow mt-3">

    <form method="post"
          name="formsalvar"
          id="formSalvar"
          class="m-3">

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
                       placeholder="Telefone">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <input type="submit"
                       class="btn btn-primary"
                       name="btnsalvar"
                       value="Cadastrar">
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

    include_once __DIR__ . '/../../Controller/FornecedorController.php';

    $controller = new FornecedorController();

    if ($controller->salvar()) {
?>

        <div class="alert alert-primary mt-3" role="alert">
            Fornecedor - cadastro efetuado com sucesso.
        </div>

        <meta http-equiv="refresh"
              content="0.2;URL=?p=fornecedores">

<?php

    } else {

?>

        <div class="alert alert-danger mt-3" role="alert">
            Fornecedor - erro ao cadastrar.
        </div>

<?php

    }
}

?>