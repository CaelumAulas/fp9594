<?php 

namespace AutoCaelum\Models;
use Exception;

class Marca
{
    private int $id = 0;
    private string $nome = '';

    public function __construct(string $nome = '', int $id = 0)
    {
        if ($nome) $this->setNome($nome);
        if ($id) $this->setId($id);
    }

    public function getId() { return $this->id; }
    public function setId(int $id) {
        if ($id <= 0) {
            throw new Exception('ID da Marca é inválido!');
        }

        $this->id = $id;
        return $this;
    }

    public function getNome() { return $this->nome; }
    public function setNome(string $nome) {
        $this->nome = filter_var($nome, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) ?: throw new Exception('Nome da Marca é obrigatório!');
        return $this;
    }
}