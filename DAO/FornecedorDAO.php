<?php

declare(strict_types=1);

require_once '../models/Conn.php';
require_once '../models/Fornecedor.php';

class FornecedorDAO
{
    private PDO $conn;
    private string $tabela = "fornecedor";

    public function __construct()
    {
        $this->conn = new Conn();
    }

    private function texto(string $texto): string
    {
        return mb_strtoupper(trim($texto));
    }

    public function excluir(int $id): bool
    {
        $sql = "DELETE FROM {$this->tabela} WHERE id = ?";

        $executar = $this->conn->prepare($sql);
        $executar->bindValue(1, $id);

        return $executar->execute();
    }

    public function listar(): array
    {
        $sql = "SELECT * FROM {$this->tabela} ORDER BY razao_social";

        $executar = $this->conn->query($sql);

        return $executar->fetchAll(PDO::FETCH_ASSOC);
    }

    public function consultarPorID(int $id): ?Fornecedor
    {
        $sql = "SELECT * FROM {$this->tabela} WHERE id = ?";

        $executar = $this->conn->prepare($sql);
        $executar->bindValue(1, $id);
        $executar->execute();

        $dados = $executar->fetch(PDO::FETCH_ASSOC);

        if (!$dados) {
            return null;
        }

        $fornecedor = new Fornecedor();

        $fornecedor->setId($dados["id"]);
        $fornecedor->setRazaoSocial($dados["razao_social"]);
        $fornecedor->setEmail($dados["email"]);
        $fornecedor->setTelefone($dados["telefone"]);

        return $fornecedor;
    }

    public function salvar(Fornecedor $fornecedor): bool
    {
        if ($fornecedor->getId() == null) {

            $sql = "INSERT INTO fornecedor
                    (razao_social, email, telefone)
                    VALUES
                    (?, ?, ?)";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(
                1,
                $this->texto($fornecedor->getRazaoSocial())
            );

            $stmt->bindValue(
                2,
                $this->texto($fornecedor->getEmail())
            );

            $stmt->bindValue(
                3,
                $this->texto($fornecedor->getTelefone())
            );

        } else {

            $sql = "UPDATE fornecedor
                       SET razao_social = ?,
                           email = ?,
                           telefone = ?
                     WHERE id = ?";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(
                1,
                $this->texto($fornecedor->getRazaoSocial())
            );

            $stmt->bindValue(
                2,
                $this->texto($fornecedor->getEmail())
            );

            $stmt->bindValue(
                3,
                $this->texto($fornecedor->getTelefone())
            );

            $stmt->bindValue(
                4,
                $fornecedor->getId()
            );
        }

        return $stmt->execute();
    }
}