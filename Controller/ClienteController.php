<?php

declare(strict_types=1);

require_once "../model/Cliente.php";
require_once "../dao/ClienteDAO.php";

class ClienteController
{
    private Cliente $cliente;
    private ClienteDAO $dao;

    public function __construct()
    {
        $this->cliente = new Cliente();
        $this->dao = new ClienteDAO();
    }

    public function listar(): array
    {
        return $this->dao->listar();
    }

    public function salvar(): bool
    {
        $this->cliente->setNome(
            filter_input(INPUT_POST, "txtnome")
        );

        $this->cliente->setEmail(
            filter_input(INPUT_POST, "txtemail")
        );

        return $this->dao->salvar($this->cliente);
    }
}