<?php

declare(strict_types=1);

require_once '../model/Conn.php';
require_once '../model/Cliente.php';

class ClienteDAO
{
    private PDO $conn;
    private string $tabela = "cliente";

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
        $sql = "SELECT * FROM {$this->tabela} ORDER BY nome";
        $executar = $this->conn->query($sql);
        return $executar->fetchAll(PDO::FETCH_ASSOC);
    }

    public function consultarPorID(int $id): ?Cliente
    {
        $sql = "SELECT * FROM {$this->tabela} WHERE id = ?";
        $executar = $this->conn->prepare($sql);
        $executar->bindValue(1, $id);
        $executar->execute();
        $dados = $executar->fetch(PDO::FETCH_ASSOC);

        if (!$dados) {
            return null;
        }

        $cliente = new Cliente();
        $cliente->setId($dados["id"]);
        $cliente->setNome($dados["nome"]);
        $cliente->setEmail($dados["email"]);

        return $cliente;

    }

    public function salvar(Cliente $cliente): bool
    {
        if ($cliente->getId() == null) {

            $sql = "INSERT INTO cliente
                    (nome,email)
                    VALUES
                    (?,?)";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(1, $this->texto($cliente->getNome()));
            $stmt->bindValue(2, $this->texto($cliente->getEmail()));
        } else {

            $sql = "UPDATE cliente
                       SET nome=?,
                           email=?
                     WHERE id=?";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(1, $this->texto($cliente->getNome()));
            $stmt->bindValue(2, $this->texto($cliente->getEmail()));
            $stmt->bindValue(3, $cliente->getId());
        }

        return $stmt->execute();
    }
}