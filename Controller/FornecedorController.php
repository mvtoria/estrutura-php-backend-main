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

    public function consultarPorID(int $id): ?Fornecedor
    {
        return $this->dao->consultarPorID($id);
    }

    public function salvar(): bool
    {
        $this->fornecedor->setRazaoSocial(
            filter_input(INPUT_POST, "txtrazao_social") ?? ""
        );

        $this->fornecedor->setEmail(
            filter_input(INPUT_POST, "txtemail") ?? ""
        );

        $this->fornecedor->setTelefone(
            filter_input(INPUT_POST, "txttelefone") ?? ""
        );

        $id = filter_input(INPUT_POST, "txtid", FILTER_VALIDATE_INT);

        if ($id !== false && $id !== null) {
            $this->fornecedor->setId($id);
        }

        return $this->dao->salvar($this->fornecedor);
    }
}