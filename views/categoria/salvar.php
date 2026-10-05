<h3 class="mt-3 text-primary">
    Categoria
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
                       placeholder="Categoria">

            </div>

        </div>

        <div class="form-group row">

            <label for="txtinformacoes"
                   class="col-sm-2 col-form-label">
                Informações
            </label>

            <div class="col-sm-10">

                <textarea name="txtinformacoes"
                          id="txtinformacoes"
                          rows="3"
                          placeholder="Informações aqui"
                          class="form-control"></textarea>

            </div>

        </div>

        <div class="form-group row">

            <div class="col-sm-10">

                <input type="submit"
                       class="btn btn-primary"
                       name="btnsalvar"
                       value="Cadastrar">

            </div>

            <a href="?p=categorias"
               class="btn btn-danger">
                Cancelar
            </a>

        </div>

    </form>

</div>

<?php

if (filter_input(INPUT_POST, 'btnsalvar')) {

    $nome = filter_input(INPUT_POST, 'txtnome');
    $info = filter_input(INPUT_POST, 'txtinformacoes');

    include_once __DIR__ . '/../../models/Categoria.php';

    $cat = new Categoria();

    $cat->setID(NULL);
    $cat->setNome($nome);
    $cat->setInformacoes($info);

    // SEM PROCEDURE
    if ($cat->inserir()) {
?>

        <div class="alert alert-primary mt-3" role="alert">
            Categoria - cadastro efetuado com sucesso.
        </div>

        <meta http-equiv="refresh"
              content="0.2;URL=?p=categorias">

<?php
    } else {
?>

        <div class="alert alert-danger mt-3" role="alert">
            Categoria - erro ao cadastrar.
        </div>

<?php
    }
}
?>