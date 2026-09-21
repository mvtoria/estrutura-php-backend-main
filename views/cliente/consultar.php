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

            <table class="table table-striped table-sm">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php

                    include_once '../../Controller/ClienteController.php';

                    $controller = new ClienteController();

                    $dados = $controller->listar();

                    if ($dados) {

                        foreach ($dados as $mostrar) {
                    ?>

                    <tr>

                        <td><?= $mostrar['id'] ?></td>
                        <td><?= $mostrar['nome'] ?></td>
                        <td><?= $mostrar['email'] ?></td>

                        <td>

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
                    }
                    ?>

                </tbody>

            </table>

        </div>

    </div>

</div>