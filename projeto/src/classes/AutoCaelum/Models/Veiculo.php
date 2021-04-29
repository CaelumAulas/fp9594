<?php 

namespace AutoCaelum\Models;
use Exception;

class Veiculo
{
    private int $id = 0;
    private ?Marca $marca = null;
    private string $modelo = ''; 
    private float $preco = 0;
    private string $descricao = '';
    private string $foto = '';

    /**
     * Getters & Setters da Classe
     */
    public function getId() { return $this->id; }
    public function setId(int $id) {
        if ($id <= 0) {
            throw new Exception('ID da Marca é inválido!');
        }

        $this->id = $id;
        return $this;
    }

    public function getMarca() { return $this->marca; }
    public function setMarca(Marca $marca) {
        $this->marca = $marca;
        return $this;
    }

    public function getModelo() { return $this->modelo; }
    public function setModelo(string $modelo) {
        $this->modelo = filter_var($modelo, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) ?: throw new Exception('Modelo é obrigatório!');
        return $this;
    }

    public function getPreco() { return $this->preco; }
    public function setPreco(float $preco) {
        if ($preco <= 0) {
            throw new Exception('Preço inválido!');
        }

        $this->preco = $preco;
        return $this;
    }

    public function getDescricao() { return $this->descricao; }
    public function setDescricao(string $descricao) {
        $this->descricao = filter_var($descricao, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) ?: throw new Exception('Descrição é obrigatório!');
        return $this;
    }

    public function getFoto() { return $this->foto; }
    public function setFoto(string $foto) {
        $this->foto = $foto;
        return $this;
    }
}