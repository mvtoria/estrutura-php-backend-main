<?php

include_once 'Conn.php';

class Fornecedor
{
    private $id;
    private $razao_social;
    private $email;
    private $telefone;
    private $conn;
    private $tabela = "fornecedor";

    public function getID(): mixed
    {
        return $this->id;
    }

    public function setID($id): static
    {
        $this->id = $id;
        return $this;
    }

    public function getRazaoSocial(): mixed
    {
        return $this->razao_social;
    }

    public function setRazaoSocial($razao_social): static
    {
        $this->razao_social = $razao_social;
        return $this;
    }

    public function getEmail(): mixed
    {
        return $this->email;
    }

    public function setEmail($email): static
    {
        $this->email = $email;
        return $this;
    }

    public function getTelefone(): mixed
    {
        return $this->telefone;
    }

    public function setTelefone($telefone): static
    {
        $this->telefone = $telefone;
        return $this;
    }


    public function salvar()
    {
        try {
            $this->conn = new Conn();

            $sql = "CALL salvar_fornecedor(?, ?, ?)";

            $executar = $this->conn->prepare($sql);

            $executar->bindValue(1, $this->id);
            $executar->bindValue(2, mb_strtoupper($this->nome));
            $executar->bindValue(3, mb_strtoupper($this->cidade));

            return $executar->execute() == 1 ? true : false;

        } catch (PDOException $erro) {
            echo $erro->getMessage();
            return false;
        }
    }

    public function listar($var_id)
    {
        try {
            $this->conn = new Conn();

            $sql = "CALL listar_fornecedor(?)";

            $executar = $this->conn->prepare($sql);
            $executar->bindValue(1, $var_id);

            return $executar->execute() == 1
                ? $executar->fetchAll(PDO::FETCH_ASSOC)
                : false;

        } catch (PDOException $erro) {
            echo $erro->getMessage();
            return false;
        }
    }


    //metodos sem procedure
    public function inserir()
    {
        try {
            $this->conn = new Conn();

            $sql = "INSERT INTO {$this->tabela}
                    (id, nome, cidade)
                    VALUES (?, ?, ?)";

            $executar = $this->conn->prepare($sql);

            $executar->bindValue(1, $this->id);
            $executar->bindValue(2, mb_strtoupper($this->nome));
            $executar->bindValue(3, mb_strtoupper($this->cidade));

            return $executar->execute();

        } catch (PDOException $erro) {
            echo $erro->getMessage();
            return false;
        }
    }

    public function alterar()
    {
        try {
            $this->conn = new Conn();

            $sql = "UPDATE {$this->tabela}
                    SET nome = ?, cidade = ?
                    WHERE id = ?";

            $executar = $this->conn->prepare($sql);

            $executar->bindValue(1, mb_strtoupper($this->nome));
            $executar->bindValue(2, mb_strtoupper($this->cidade));
            $executar->bindValue(3, $this->id);

            return $executar->execute();

        } catch (PDOException $erro) {
            echo $erro->getMessage();
            return false;
        }
    }

    public function excluir()
    {
        try {
            $this->conn = new Conn();

            $sql = "DELETE FROM {$this->tabela} WHERE id = ?";

            $executar = $this->conn->prepare($sql);
            $executar->bindValue(1, $this->id);

            return $executar->execute();

        } catch (PDOException $erro) {
            echo $erro->getMessage();
            return false;
        }
    }

    public function listarSemProcedure()
    {
        try {
            $this->conn = new Conn();

            $sql = "SELECT * FROM {$this->tabela} ORDER BY nome";

            $executar = $this->conn->prepare($sql);
            $executar->execute();

            return $executar->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $erro) {
            echo $erro->getMessage();
            return false;
        }
    }

    public function consultarPorID()
    {
        try {
            $this->conn = new Conn();

            $sql = "SELECT * FROM {$this->tabela} WHERE id = ?";

            $executar = $this->conn->prepare($sql);
            $executar->bindValue(1, $this->id);
            $executar->execute();

            return $executar->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $erro) {
            echo $erro->getMessage();
            return false;
        }
    }

    public function crudPhp($opcao)
    {
        try {
            $this->conn = new Conn();

            switch ($opcao) {

                case 'I':

                    $sql = "INSERT INTO {$this->tabela}
                            (id, nome, cidade)
                            VALUES (?, ?, ?)";

                    $executar = $this->conn->prepare($sql);

                    $executar->bindValue(1, $this->id);
                    $executar->bindValue(2, mb_strtoupper($this->nome));
                    $executar->bindValue(3, mb_strtoupper($this->cidade));

                    break;

                case 'A':

                    $sql = "UPDATE {$this->tabela}
                            SET nome = ?,
                                cidade = ?
                            WHERE id = ?";

                    $executar = $this->conn->prepare($sql);

                    $executar->bindValue(1, mb_strtoupper($this->nome));
                    $executar->bindValue(2, mb_strtoupper($this->cidade));
                    $executar->bindValue(3, $this->id);

                    break;

                case 'E':

                    $sql = "DELETE FROM {$this->tabela}
                            WHERE id = ?";

                    $executar = $this->conn->prepare($sql);
                    $executar->bindValue(1, $this->id);

                    break;

                default:
                    return false;
            }

            return $executar->execute();

        } catch (PDOException $erro) {
            echo $erro->getMessage();
            return false;
        }
    }
}