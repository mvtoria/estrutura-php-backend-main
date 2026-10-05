<h3 class="mt-3 text-primary">
    Funcionários
</h3>

<div class="card shadow mt-3">

    <form method="post"
          name="formsalvar"
          id="formSalvar"
          class="m-3">

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
                       placeholder="Nome">

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

            <label for="txtcargo"
                   class="col-sm-2 col-form-label">
                Cargo
            </label>

            <div class="col-sm-10">

                <input type="text"
                       class="form-control"
                       id="txtcargo"
                       name="txtcargo"
                       placeholder="Cargo">

            </div>

        </div>

        <div class="form-group row">

            <div class="col-sm-10">

                <input type="submit"
                       class="btn btn-primary"
                       name="btnsalvar"
                       value="Cadastrar">

            </div>

            <a href="?p=funcionarios"
               class="btn btn-danger">
                Cancelar
            </a>

        </div>

    </form>

</div>

<?php

if (filter_input(INPUT_POST, 'btnsalvar')) {

    $nome = filter_input(INPUT_POST, 'txtnome');
    $email = filter_input(INPUT_POST, 'txtemail');
    $cargo = filter_input(INPUT_POST, 'txtcargo');

    include_once __DIR__ . '/../../models/Funcionario.php';

    $func = new Funcionario();

    $func->setID(NULL);
    $func->setNome($nome);
    $func->setEmail($email);
    $func->setCargo($cargo);

    // SEM PROCEDURE
    if ($func->inserir()) {
?>

        <div class="alert alert-primary mt-3" role="alert">
            Funcionário - cadastro efetuado com sucesso.
        </div>

        <meta http-equiv="refresh"
              content="0.5;URL=?p=funcionarios">

<?php
    } else {
?>

        <div class="alert alert-danger mt-3" role="alert">
            Funcionário - erro ao cadastrar.
        </div>

<?php
    }
}
?>