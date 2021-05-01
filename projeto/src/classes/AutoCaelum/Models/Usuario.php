<?php 

namespace AutoCaelum\Models;
use Exception;

class Usuario
{
    private int $id = 0;
    private string $login = '';
    private string $senha = '';
    private bool $ativo = true;

    public function __construct(?string $login = null, ?string $senha = null, bool $ativo = true, int $id = 0)
    {
        if ($login !== null) $this->setLogin($login);
        if ($senha !== null) $this->setSenha($senha);
        if ($id) $this->setId($id);
        $this->setAtivo($ativo);
    }

    public function getId() { return $this->id; }
    public function setId(int $id) {
        if ($id <= 0) {
            throw new Exception('ID do Usuário é inválido!');
        }

        $this->id = $id;
        return $this;
    }

    public function getLogin() { return $this->login; }
    public function setLogin(string $login) {
        $this->login = filter_var($login, FILTER_VALIDATE_EMAIL) ?: throw new Exception('Login do Usuário deve ser um e-mail!');
        return $this;
    }

    public function getSenha() { return $this->senha; }
    public function setSenha(string $senha) {
        $this->senha = $senha ?: throw new Exception('Senha é obrigatório!');
        return $this;
    }

    public function getAtivo() { return $this->ativo; }
    public function setAtivo(bool $ativo) {
        $this->ativo = $ativo;
        return $this;
    }
}