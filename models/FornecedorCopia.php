<?php

//exige a tipificação dos atributos e métodos
declare(strict_types=1);

class Fornecedor
{
    //a interrogação indica que pode ser null
    private ?int $id = null;
    private string $nome = "";
    private string $cidade = "";

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = trim($nome);
        return $this;
    }

    public function getCidade(): string
    {
        return $this->cidade;
    }

    public function setCidade(string $cidade): self
    {
        $this->cidade = trim($cidade);
        return $this;
    }

}