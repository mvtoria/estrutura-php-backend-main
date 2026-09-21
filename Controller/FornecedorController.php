<?php

declare(strict_types=1);

require_once "../model/Fornecedor.php";
require_once "../dao/FornecedorDAO.php";

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
        $this->fornecedor->setNome(
            filter_input(INPUT_POST, "txtnome")
        );

        $this->fornecedor->setCidade(
            filter_input(INPUT_POST, "txtcidade")
        );

        return $this->dao->salvar($this->fornecedor);
    }
}