<?php

declare(strict_types=1);

require_once __DIR__ . '/../models/Fornecedor.php';
require_once __DIR__ . '/../DAO/FornecedorDAO.php';

class FornecedorController
{
    private Fornecedor $fornecedor;
    private FornecedorDAO $dao;

    public function __construct()
    {
        $this->fornecedor = new Fornecedor();
        $this->dao = new FornecedorDAO();
    }

    public function listar(): array
    {
        return $this->dao->listar();
    }

    public function salvar(): bool
    {
        $this->fornecedor->setRazaoSocial(filter_input(INPUT_POST, "txtrazao_social"));
        $this->fornecedor->setEmail(filter_input(INPUT_POST, "txtemail"));
        $this->fornecedor->setTelefone(filter_input(INPUT_POST, "txttelefone"));

        return $this->dao->salvar($this->fornecedor);
    }
}