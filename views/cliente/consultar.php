<div class="col-sm-12 mb-4">

    <div class="card shadow mb-4">

        <div class="table-responsive-sm mt-4">

            <h3 class="ml-3">
                Listar Clientes

                <a class="btn btn-success float-right mb-3 mr-3"
                   href="?p=add/cliente">

                    <i class="bi bi-database-fill-add"></i>

                </a>
            </h3>

            <form method="get" action="index.php" class="m-3">

                <input type="hidden" name="p" value="clientes">

                <label for="pesquisa">Pesquisar cliente:</label>

                <div class="input-group mb-3">

                    <input type="text"
                        class="form-control"
                        id="pesquisa"
                        name="pesquisa"
                        placeholder="Digite o nome do cliente"
                        value="<?= htmlspecialchars($_GET['pesquisa'] ?? '') ?>">

                    <div class="input-group-append">

                        <button type="submit" class="btn btn-primary">
                            PESQUISAR
                        </button>

                    </div>

                </div>

            </form>

            <table class="table table-striped table-sm">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                    </tr>
                </thead>

                <tbody>

                    <?php

                    include_once __DIR__ . '/../../Controller/ClienteController.php';

                    $controller = new ClienteController();

                    $pesquisa = trim($_GET['pesquisa'] ?? '');

                    if ($pesquisa !== '') {
                        $dados = $controller->pesquisar($pesquisa);
                    } else {
                        $dados = $controller->listar();
                    }

                    if ($dados) {

                        foreach ($dados as $mostrar) {
                    ?>

                    <tr>

                        <td><?= $mostrar['id'] ?></td>
                        <td><?= $mostrar['nome'] ?></td>
                        <td><?= $mostrar['email'] ?></td>
                        <td><?= $mostrar['telefone'] ?></td>

                        <td>

                            <a href="?p=alterar/cliente&id=<?=$mostrar['id'] ?>"
                            class="btn btn-primary"
                            title="Alterar">

                            <i class="bi bi-pencil"></i>

                            </a> 

                            <a href="?p=excluir/cliente&id=<?= $mostrar['id'] ?>"
                               class="btn btn-danger"
                               title="Excluir"
                               onclick="return confirm('Tem certeza que deseja excluir?')">

                                <i class="bi bi-x-circle"></i>

                            </a>

                        </td>

                    </tr>

                                        <?php
                        }
                    } else {
                    ?>

                        <tr>
                            <td colspan="4" class="text-center">
                                Nenhum cliente encontrado.
                            </td>
                        </tr>

                    <?php
                    }
                    ?>

                </tbody>

            </table>

        </div>

    </div>

</div>