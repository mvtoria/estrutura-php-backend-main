<?php

declare(strict_types=1);

require_once __DIR__ . '/../models/Cliente.php';
require_once __DIR__ . '/../DAO/ClienteDAO.php';

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
        $this->cliente->setNome(filter_input(INPUT_POST, "txtnome"));
        $this->cliente->setEmail(filter_input(INPUT_POST, "txtemail"));
        $this->cliente->setTelefone(filter_input(INPUT_POST, "txttelefone"));

        return $this->dao->salvar($this->cliente);
    }
}