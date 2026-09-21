<?php

declare(strict_types=1);

require_once '../models/Conn.php';
require_once '../models/Funcionario.php';

class FuncionarioDAO
{
    private PDO $conn;
    private string $tabela = "funcionario";

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

    public function consultarPorID(int $id): ?Funcionario
    {
        $sql = "SELECT * FROM {$this->tabela} WHERE id = ?";
        $executar = $this->conn->prepare($sql);
        $executar->bindValue(1, $id);
        $executar->execute();
        $dados = $executar->fetch(PDO::FETCH_ASSOC);

        if (!$dados) {
            return null;
        }

        $funcionario = new Funcionario();
        $funcionario->setId($dados["id"]);
        $funcionario->setNome($dados["nome"]);
        $funcionario->setEmail($dados["email"]);
        $funcionario->setCargo($dados["cargo"]);

        return $funcionario;

    }

    public function salvar(Funcionario $funcionario): bool
    {
        if ($funcionario->getId() == null) {

            $sql = "INSERT INTO funcionario
                    (nome,email,cargo)
                    VALUES
                    (?,?,?)";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(1, $this->texto($funcionario->getNome()));
            $stmt->bindValue(2, $this->texto($funcionario->getEmail()));
            $stmt->bindValue(3, $this->texto($funcionario->getCargo()));
        } else {

            $sql = "UPDATE funcionario
                       SET nome=?,
                           email=?,
                           cargo=?
                     WHERE id=?";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(1, $this->texto($funcionario->getNome()));
            $stmt->bindValue(2, $this->texto($funcionario->getEmail()));
            $stmt->bindValue(3, $this->texto($funcionario->getCargo()));
            $stmt->bindValue(4, $funcionario->getId());
        }

        return $stmt->execute();
    }
}